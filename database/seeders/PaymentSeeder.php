<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\GroomingBooking;
use App\Models\Payment;
use Carbon\Carbon;

class PaymentSeeder extends Seeder
{
    /**
     * Membuat data pembayaran untuk setiap order & booking grooming
     * yang sudah dibuat, supaya menu Pembayaran tidak kosong.
     */
    public function run(): void
    {
        $metode = ['cash', 'qris', 'transfer'];

        // Pembayaran untuk order produk.
        foreach (Order::all() as $order) {
            $status = $order->status === 'selesai' ? 'verified'
                : ($order->status === 'dibatalkan' ? 'rejected' : 'pending');

            Payment::create([
                'invoice' => $order->invoice,
                'customer_id' => $order->customer_id,
                'order_id' => $order->id,
                'grooming_booking_id' => null,
                'total' => $order->total,
                'metode' => $metode[array_rand($metode)],
                'status' => $status,
                'paid_at' => $status === 'verified'
                    ? Carbon::parse($order->tanggal)->addHours(rand(1, 5))
                    : null,
            ]);
        }

        // Pembayaran untuk booking grooming.
        foreach (GroomingBooking::with('service')->get() as $booking) {
            $status = $booking->status === 'selesai' ? 'verified'
                : ($booking->status === 'dibatalkan' ? 'rejected' : 'pending');

            Payment::create([
                'invoice' => 'INV-GRM-' . str_pad($booking->id, 5, '0', STR_PAD_LEFT),
                'customer_id' => $booking->customer_id,
                'order_id' => null,
                'grooming_booking_id' => $booking->id,
                'total' => $booking->service->harga ?? 0,
                'metode' => $metode[array_rand($metode)],
                'status' => $status,
                'paid_at' => $status === 'verified'
                    ? Carbon::parse($booking->tanggal)->addHours(rand(1, 5))
                    : null,
            ]);
        }
    }
}
