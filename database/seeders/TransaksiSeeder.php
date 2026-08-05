<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Receipt;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TransaksiSeeder extends Seeder
{
    /**
     * Jumlah transaksi (order) yang mau dibuat.
     */
    protected int $jumlahTransaksi = 40;

    public function run(): void
    {
        // 1. Pastikan ada customer. Kalau kosong, buat 10 customer dummy dulu.
        $customers = Customer::all();

        if ($customers->isEmpty()) {
            $customers = collect();

            for ($i = 1; $i <= 10; $i++) {
                $user = User::create([
                    'name'     => "Customer Seeder {$i}",
                    'email'    => "customer.seed{$i}@mipaw.com",
                    'password' => Hash::make('password'),
                    'role'     => 'customer',
                ]);

                $customers->push(Customer::create([
                    'user_id' => $user->id,
                    'alamat'  => 'Jl. Contoh No. ' . $i,
                    'no_hp'   => '08' . rand(1111111111, 9999999999),
                ]));
            }
        }

        // 2. Pastikan ada produk. Kalau kosong, buat beberapa produk dummy dulu.
        $products = Product::all();

        if ($products->isEmpty()) {
            $category = Category::first() ?? Category::create(['nama_kategori' => 'Umum']);

            $namaProduk = [
                'Royal Canin Kitten 1kg', 'Whiskas Adult 1.2kg', 'Pasir Kucing Gumpal 5L',
                'Mainan Bola Kucing', 'Snack Anjing Dental Stick', 'Shampoo Anjing Anti Kutu',
                'Kalung Anjing Nylon', 'Vitamin Kucing Multivitamin', 'Kandang Kucing Lipat',
                'Litter Box Kucing', 
            ];

            foreach ($namaProduk as $nama) {
                $products->push(Product::create([
                    'category_id' => $category->id,
                    'nama_produk' => $nama,
                    'harga'       => rand(15, 250) * 1000,
                    'stok'        => rand(20, 100),
                    'barcode'     => strtoupper(Str::random(10)),
                ]));
            }
        }

        $statusOrder      = ['pending', 'diproses', 'selesai', 'dibatalkan'];
        $metodePembayaran = ['cash', 'qris', 'transfer'];

        for ($i = 1; $i <= $this->jumlahTransaksi; $i++) {

            DB::transaction(function () use ($i, $customers, $products, $statusOrder, $metodePembayaran) {

                $customer = $customers->random();
                $tanggal  = now()->subDays(rand(0, 60))->subMinutes(rand(0, 1440));

                // Bobot status: 'selesai' dibuat lebih sering muncul biar realistis
                $status = collect($statusOrder)
                    ->flatMap(fn ($s) => $s === 'selesai' ? array_fill(0, 4, $s) : [$s])
                    ->random();

                // Format invoice mengikuti pola yang sudah dipakai di CartController,
                // ditambah index $i biar dijamin unik walau di-seed dalam detik yang sama
                $nomorInvoice = 'INV-' . $tanggal->format('Ymd') . '-' . strtoupper(Str::random(5)) . $i;

                $order = Order::create([
                    'customer_id' => $customer->id,
                    'invoice'     => $nomorInvoice,
                    'tanggal'     => $tanggal->toDateString(),
                    'total'       => 0,
                    'status'      => $status,
                ]);

                // 1-4 produk acak per transaksi
                $itemProduk = $products->random(rand(1, min(4, $products->count())));
                $totalOrder = 0;

                foreach ($itemProduk as $product) {
                    $qty   = rand(1, 3);
                    $harga = $product->harga;

                    OrderItem::create([
                        'order_id'   => $order->id,
                        'product_id' => $product->id,
                        'qty'        => $qty,
                        'harga'      => $harga,
                    ]);

                    $totalOrder += $qty * $harga;
                }

                $order->update(['total' => $totalOrder]);

                // Status pembayaran mengikuti status order
                $statusPembayaran = match ($status) {
                    'selesai'    => 'verified',
                    'dibatalkan' => 'rejected',
                    default      => 'pending',
                };

                Payment::create([
                    'invoice'     => 'PAY-' . $tanggal->format('YmdHis') . '-' . $i,
                    'customer_id' => $customer->id,
                    'order_id'    => $order->id,
                    'total'       => $totalOrder,
                    'metode'      => $metodePembayaran[array_rand($metodePembayaran)],
                    'status'      => $statusPembayaran,
                    'paid_at'     => $statusPembayaran === 'verified' ? $tanggal : null,
                ]);

                // Buat struk kalau order sudah selesai
                if ($status === 'selesai') {
                    Receipt::create([
                        'order_id'    => $order->id,
                        'nomor_struk' => 'STRUK-' . $order->id . '-' . strtoupper(Str::random(6)),
                        'qr_code'     => null,
                    ]);
                }
            });
        }

        $this->command?->info("Berhasil membuat {$this->jumlahTransaksi} transaksi (order + item + pembayaran).");
    }
}