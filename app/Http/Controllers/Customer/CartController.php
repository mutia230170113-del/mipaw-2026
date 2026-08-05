<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $customer = auth()->user()->customer;

        $cart = Cart::with('items.product.category')
            ->where('customer_id', $customer->id)
            ->first();

        $carts = $cart ? $cart->items : collect();

        $total = $carts->sum(fn($item) => $item->qty * $item->harga);

        return view('customer.cart.index', compact('carts', 'total'));
    }

    // public function store(Product $product)
    // {
    //     $customer = auth()->user()->customer;

    //     $cart = Cart::firstOrCreate([
    //         'customer_id' => $customer->id,
    //     ]);

    //     $item = CartItem::where('cart_id', $cart->id)
    //         ->where('product_id', $product->id)
    //         ->first();

    //     if ($item) {
    //         $item->increment('qty');
    //     } else {
    //         CartItem::create([
    //             'cart_id' => $cart->id,
    //             'product_id' => $product->id,
    //             'qty' => 1,
    //             'harga' => $product->harga,
    //         ]);
    //     }

    //     return back()->with('success', 'Produk berhasil ditambahkan.');
    // }

    public function store(Request $request, \App\Models\Product $product)
    {
        $customer = auth()->user()->customer;

        // Ambil atau buat keranjang induk milik customer ini
        $cart = \App\Models\Cart::firstOrCreate([
            'customer_id' => $customer->id,
        ]);

        // Cari item produk di dalam keranjang anak
        $item = \App\Models\CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        // LOGIKA BARU: JIKA CUSTOMER KLIK TOMBOL MINUS (-)
        if ($request->has('aksi') && $request->aksi == 'kurang') {
            if ($item) {
                if ($item->qty <= 1) {
                    $item->delete(); // Jika sisa 1 diklik minus, hapus dari tabel anak
                } else {
                    $item->decrement('qty'); // Kurangi 1 angka secara permanen
                }
            }
            return back()->with('success', 'Jumlah produk berhasil dikurangi.');
        }

        // LOGIKA JIKA CUSTOMER KLIK TOMBOL PLUS (+) ATAU BELI DI TOKO
        if ($item) {
            // Cek ketersediaan stok produk sebelum ditambah
            if ($product->stok > $item->qty) {
                $item->increment('qty');
            } else {
                return back()->with('error', 'Stok produk tidak mencukupi!');
            }
        } else {
            \App\Models\CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'qty' => 1,
                'harga' => $product->harga,
            ]);
        }

        return back()->with('success', 'Produk berhasil ditambahkan.');
    }



        public function destroy($id)
    {
        // Cari data item keranjang belanja yang ingin dikurangi
        $cartItem = \App\Models\Cart::findOrFail($id);

        // LOGIKA BARU KITA:
        // Jika kuantitas barang lebih dari 1, kurangi 1 angka saja secara permanen di database
        if ($cartItem->qty > 1) {
            $cartItem->decrement('qty');
        } else {
            // Tapi jika jumlahnya sudah tinggal 1, baru hapus total produknya dari keranjang
            $cartItem->delete();
        }

        return redirect()->back()->with('success', 'Keranjang berhasil diperbarui');
    }

    public function checkout()
    {
        $customer = auth()->user()->customer;

        // 1. Ambil data keranjang beserta item dan produknya
        $cart = Cart::with('items.product')
            ->where('customer_id', $customer->id)
            ->first();

        // Validasi: Jika keranjang kosong atau tidak punya item
        if (!$cart || $cart->items->isEmpty()) {
            return back()->with('error', 'Keranjang belanja Anda masih kosong.');
        }

        // 2. Mulai transaksi database aman
        DB::beginTransaction();

        try {
            // Hitung total harga belanjaan
            $totalHarga = $cart->items->sum(fn($item) => $item->qty * $item->harga);

            // MEMBUAT NOMOR INVOICE UNIK OTOMATIS (Contoh: INV-20260715-A1B2C)
            $nomorInvoice = 'INV-' . date('Ymd') . '-' . strtoupper(substr(md5(microtime()), 0, 5));

            // 3. Buat data Order utama
            $order = Order::create([
                'customer_id' => $customer->id,
                'invoice'     => $nomorInvoice, // Kolom wajib di database yang sebelumnya kosong
                'status'      => 'pending',     // Status awal orderan
                'total'       => $totalHarga,
                'tanggal'     => now(),         // Tanggal transaksi dibuat
            ]);

            // 4. Pindahkan setiap item dari keranjang ke detail order (OrderItem)
            foreach ($cart->items as $item) {
                
                // VALIDASI: Periksa apakah stok produk mencukupi
                if ($item->product->stok < $item->qty) {
                    DB::rollBack();
                    return back()->with('error', "Stok produk '{$item->product->nama}' tidak mencukupi.");
                }

                // Buat data item order baru
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'qty'        => $item->qty,
                    'harga'      => $item->harga,
                ]);

                // Kurangi stok produk secara otomatis
                $item->product->decrement('stok', $item->qty);
            }

            // 5. Kosongkan item di dalam keranjang belanja karena checkout sukses
            CartItem::where('cart_id', $cart->id)->delete();

            // Commit / Simpan permanen semua perubahan ke database
            DB::commit();

            // 6. Alihkan halaman ke daftar order milik customer dengan pesan sukses
            return redirect()
                ->route('customer.orders')
                ->with('success', 'Checkout berhasil! Silakan lakukan pembayaran.');

        } catch (\Exception $e) {
            // Batalkan semua query jika di tengah jalan terjadi error sistem
            DB::rollBack();

            return back()->with('error', 'Terjadi kesalahan sistem saat checkout: ' . $e->getMessage());
        }
    }
}
