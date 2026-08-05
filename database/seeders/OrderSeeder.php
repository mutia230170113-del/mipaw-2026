<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Membuat 40 pesanan (order) lengkap dengan item produknya.
     */
    public function run(): void
    {
        $customers = Customer::all();
        $products = Product::all();

        if ($customers->isEmpty() || $products->isEmpty()) {
            return;
        }

        $statuses = ['pending', 'diproses', 'selesai', 'dibatalkan'];
        $total = 40;

        for ($i = 1; $i <= $total; $i++) {
            $customer = $customers->random();
            $tanggal = Carbon::now()->subDays(rand(0, 60));

            $order = Order::create([
                'customer_id' => $customer->id,
                'invoice' => 'INV-' . $tanggal->format('Ymd') . '-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'tanggal' => $tanggal->format('Y-m-d'),
                'total' => 0,
                'status' => $statuses[array_rand($statuses)],
                'catatan' => null,
            ]);

            $jumlahItem = rand(1, 4);
            $itemProduk = $products->random(min($jumlahItem, $products->count()));
            $grandTotal = 0;

            foreach ($itemProduk as $product) {
                $qty = rand(1, 3);
                $harga = $product->harga;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'qty' => $qty,
                    'harga' => $harga,
                ]);

                $grandTotal += $qty * $harga;
            }

            $order->update(['total' => $grandTotal]);
        }
    }
}
