<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Menampilkan daftar pembayaran customer.
     */
    public function index()
    {
        $customer = auth()->user()->customer;

        $payments = Payment::with([
                'order',
                'groomingBooking'
            ])
            ->where('customer_id', $customer->id)
            ->latest()
            ->paginate(10);

        return view(
            'customer.payments.index',
            compact('payments')
        );
    }

    /**
     * Menampilkan detail pembayaran.
     */
    public function show(Payment $payment)
    {
        if ($payment->customer_id != auth()->user()->customer->id) {
            abort(403);
        }

        return view(
            'customer.payments.show',
            compact('payment')
        );
    }

    /**
     * Form upload bukti pembayaran.
     */
    public function create(Order $order)
    {
        if ($order->customer_id != auth()->user()->customer->id) {
            abort(403);
        }

        return view(
            'customer.payments.create',
            compact('order')
        );
    }

    /**
     * Simpan pembayaran.
     */
    public function store(Request $request, Order $order)
    {
        if ($order->customer_id != auth()->user()->customer->id) {
            abort(403);
        }

        $request->validate([
            'metode' => 'required|in:cash,qris,transfer',
            'bukti'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $path = null;

        if ($request->hasFile('bukti')) {

            $path = $request
                ->file('bukti')
                ->store('payments', 'public');

        }

        Payment::create([

            'invoice' => 'PAY-' . now()->format('YmdHis'),

            'customer_id' => $order->customer_id,

            'order_id' => $order->id,

            'grooming_booking_id' => null,

            'total' => $order->total,

            'metode' => $request->metode,

            'bukti' => $path,

            'status' => 'pending',

            'paid_at' => now(),

        ]);

        return redirect()
            ->route('customer.payments')
            ->with(
                'success',
                'Bukti pembayaran berhasil dikirim.'
            );
    }

    public function receipt(Payment $payment)
{
    return view('customer.payments.receipt', compact('payment'));
}
}