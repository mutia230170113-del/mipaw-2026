<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar order
     */
    public function index()
    {
        $orders = Order::with('customer.user')
            ->latest()
            ->paginate(10);

        $totalOrder = Order::count();

        return view('admin.orders.index', compact(
            'orders',
            'totalOrder'
        ));
    }

    /**
     * Form tambah order
     */
    public function create()
    {
        $customers = Customer::with('user')->get();

        $products = Product::orderBy('nama_produk')->get();

        return view(
            'admin.orders.create',
            compact(
                'customers',
                'products'
            )
        );
    }

    /**
     * Simpan order baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'invoice' => 'required|unique:orders,invoice',
            'tanggal' => 'required|date',
            'status' => 'required|in:pending,diproses,selesai,dibatalkan',

            'product_id' => 'required|array|min:1',
            'product_id.*' => 'exists:products,id',

            'qty' => 'required|array|min:1',
            'qty.*' => 'integer|min:1',
        ]);

        DB::beginTransaction();

        try {

            $total = 0;

            foreach ($request->product_id as $index => $productId) {

                $product = Product::findOrFail($productId);

                if ($product->stok < $request->qty[$index]) {

                    return back()
                        ->withInput()
                        ->with('error', 'Stok produk "' . $product->nama_produk . '" tidak mencukupi.');
                }

                $total += $product->harga * $request->qty[$index];
            }

            $order = Order::create([
                'customer_id' => $request->customer_id,
                'invoice' => $request->invoice,
                'tanggal' => $request->tanggal,
                'total' => $total,
                'status' => $request->status,
            ]);

            foreach ($request->product_id as $index => $productId) {

                $product = Product::findOrFail($productId);

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'qty' => $request->qty[$index],
                    'harga' => $product->harga,
                ]);

                // Kurangi stok produk
                $product->decrement('stok', $request->qty[$index]);
            }

            DB::commit();

            return redirect()
                ->route('orders.index')
                ->with('success', 'Order berhasil ditambahkan.');
        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Detail order
     */
    public function show(Order $order)
    {
        $order->load([
            'customer.user',
            'items.product',
        ]);

        return view('admin.orders.show', compact('order'));
    }

    /**
     * Form edit order
     */
    public function edit(Order $order)
    {
        $order->load([
            'customer.user',
            'items.product',
        ]);

        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Update status order
     */
    public function update(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,diproses,selesai,dibatalkan',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('orders.index')
            ->with('success', 'Status order berhasil diperbarui.');
    }

    /**
     * Hapus order
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()
            ->route('orders.index')
            ->with('success', 'Order berhasil dihapus.');
    }
}