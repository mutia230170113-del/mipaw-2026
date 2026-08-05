<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Order;
use App\Models\GroomingBooking;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{
    /**
     * Daftar Pembayaran
     */
    public function index()
    {
        $payments = Payment::with([
            'customer.user',
            'order',
            'groomingBooking.pet',
            'groomingBooking.service'
        ])
        ->latest()
        ->paginate(10);

        $totalPayment = Payment::count();

        return view('admin.payments.index', compact('payments', 'totalPayment'));
    }

    /**
     * Form Tambah Pembayaran
     */
    public function create(Request $request)
    {
        $orders = Order::with('customer.user')
            ->whereDoesntHave('payment')
            ->get();

        $bookings = GroomingBooking::with([
            'customer.user',
            'pet',
            'service'
        ])
        ->whereDoesntHave('payment')
        ->get();

        $selectedBooking = null;

        if ($request->filled('booking')) {
            $selectedBooking = GroomingBooking::with([
                'customer.user',
                'pet',
                'service'
            ])->find($request->booking);
        }

        return view('admin.payments.create', compact('orders', 'bookings', 'selectedBooking'));
    }

    /**
     * Simpan Pembayaran
     */
    public function store(Request $request)
    {
        $request->validate([
            'order_id'            => 'nullable|exists:orders,id',
            'grooming_booking_id' => 'nullable|exists:grooming_bookings,id',
            'metode'              => 'required|in:cash,qris',
            'status'              => 'required|in:pending,verified,rejected',
            'bukti'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if (!$request->order_id && !$request->grooming_booking_id) {
            return back()
                ->withInput()
                ->with('error', 'Pilih Order atau Booking Grooming.');
        }

        return DB::transaction(function () use ($request) {
            $invoice = 'PAY-' . now()->format('YmdHis');
            $customerId = null;
            $total = 0;

            if ($request->filled('order_id')) {
                $order = Order::findOrFail($request->order_id);
                $customerId = $order->customer_id;
                $total = $order->total;
            } elseif ($request->filled('grooming_booking_id')) {
                $booking = GroomingBooking::with('service')->findOrFail($request->grooming_booking_id);
                $customerId = $booking->customer_id;
                $total = $booking->service ? $booking->service->harga : 0;
            }

            $buktiPath = null;
            if ($request->hasFile('bukti')) {
                $buktiPath = $request->file('bukti')->store('payments', 'public');
            }

            $paidAt = ($request->status === 'verified') ? now() : null;

            $payment = Payment::create([
                'invoice'             => $invoice,
                'customer_id'         => $customerId,
                'order_id'            => $request->order_id,
                'grooming_booking_id' => $request->grooming_booking_id,
                'metode'              => $request->metode,
                'status'              => $request->status,
                'total'               => $total,
                'bukti'               => $buktiPath,
                'paid_at'             => $paidAt,
            ]);

            // Jika langsung di-verify pada saat create
            if ($request->status === 'verified') {
                $this->applyVerificationEffects($payment);
            }

            return redirect()
                ->route('payments.index')
                ->with('success', 'Pembayaran berhasil ditambahkan.');
        });
    }

    /**
     * Detail Pembayaran
     */
    public function show(Payment $payment)
    {
        $payment->load([
            'customer.user',
            'order',
            'groomingBooking.pet',
            'groomingBooking.service'
        ]);

        return view('admin.payments.show', compact('payment'));
    }

    /**
     * Form Edit Pembayaran
     */
    public function edit(Payment $payment)
    {
        $payment->load([
            'customer.user',
            'order',
            'groomingBooking.pet',
            'groomingBooking.service'
        ]);

        return view('admin.payments.edit', compact('payment'));
    }

    /**
     * Update Pembayaran
     */
    public function update(Request $request, Payment $payment)
    {
        $request->validate([
            'metode' => 'required|in:cash,qris',
            'status' => 'required|in:pending,verified,rejected',
            'bukti'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        return DB::transaction(function () use ($request, $payment) {
            $data = [
                'metode' => $request->metode,
                'status' => $request->status,
            ];

            // Upload bukti baru
            if ($request->hasFile('bukti')) {
                if ($payment->bukti) {
                    Storage::disk('public')->delete($payment->bukti);
                }
                $data['bukti'] = $request->file('bukti')->store('payments', 'public');
            }

            // Jika status berubah menjadi verified dan belum pernah paid
            if ($request->status === 'verified' && $payment->paid_at === null) {
                $data['paid_at'] = now();
                $payment->update($data);
                $this->applyVerificationEffects($payment);
            } else {
                $payment->update($data);

                if ($request->status === 'rejected') {
                    $this->applyRejectionEffects($payment);
                }
            }

            return redirect()
                ->route('payments.index')
                ->with('success', 'Pembayaran berhasil diperbarui.');
        });
    }

    /**
     * Verifikasi Pembayaran
     */
    public function verify(Payment $payment)
    {
        return DB::transaction(function () use ($payment) {
            if ($payment->status !== 'verified') {
                $payment->update([
                    'status'  => 'verified',
                    'paid_at' => $payment->paid_at ?? now(),
                ]);

                $this->applyVerificationEffects($payment);
            }

            return redirect()
                ->route('payments.index')
                ->with('success', 'Pembayaran berhasil diverifikasi.');
        });
    }

    /**
     * Tolak Pembayaran
     */
    public function reject(Payment $payment)
    {
        return DB::transaction(function () use ($payment) {
            $payment->update([
                'status' => 'rejected',
            ]);

            $this->applyRejectionEffects($payment);

            return redirect()
                ->route('payments.index')
                ->with('success', 'Pembayaran berhasil ditolak.');
        });
    }

    /**
     * Preview Struk Pembayaran
     */
    public function receipt(Payment $payment)
    {
        $payment->load([
            'customer.user',
            'order.items.product',
            'groomingBooking.pet',
            'groomingBooking.service',
        ]);

        return view('admin.payments.receipt', compact('payment'));
    }

    /**
     * Cetak Struk PDF
     */
    public function receiptPdf(Payment $payment)
    {
        $payment->load([
            'customer.user',
            'order.items.product',
            'groomingBooking.pet',
            'groomingBooking.service',
        ]);

        $pdf = Pdf::loadView('admin.payments.receipt-pdf', compact('payment'));

        // Ukuran kertas thermal 80 mm (kira-kira 226pt x auto / fixed height)
        $pdf->setPaper([0, 0, 226, 600], 'portrait');

        return $pdf->stream('Struk-' . $payment->invoice . '.pdf');
    }

    /**
     * Hapus Pembayaran
     */
    public function destroy(Payment $payment)
    {
        if ($payment->bukti) {
            Storage::disk('public')->delete($payment->bukti);
        }

        $payment->delete();

        return redirect()
            ->route('payments.index')
            ->with('success', 'Pembayaran berhasil dihapus.');
    }

    /**
     * Helper: Menangani efek verifikasi (Poin & Update Status Order/Booking)
     */
    private function applyVerificationEffects(Payment $payment)
    {
        if ($payment->order) {
            $payment->order->update(['status' => 'selesai']);
        }

        if ($payment->groomingBooking) {
            $payment->groomingBooking->update(['status' => 'diproses']);
        }

       // Tambah poin Membership jika customer punya membership
if ($payment->customer_id) {

    $membership = Membership::where('customer_id', $payment->customer_id)->first();

    if ($membership) {

        // Regular = 1x poin
        // Premium = 2x poin
        $multiplier = $membership->level == 'regular' ? 1 : 2;

        // Setiap Rp10.000 = 1 poin
        $point = floor($payment->total / 10000) * $multiplier;

        if ($point > 0) {

            $membership->poin += $point;

            // Auto Upgrade ke Premium jika poin >=100
            if (
                $membership->level == 'regular' &&
                $membership->poin >= 100
            ) {
                $membership->level = 'premium';
            }

            $membership->save();
        }
    }
}

    }

    /**
     * Helper: Menangani efek penolakan (Reset Status Order/Booking ke pending)
     */
    private function applyRejectionEffects(Payment $payment)
    {
        if ($payment->order) {
            $payment->order->update(['status' => 'pending']);
        }

        if ($payment->groomingBooking) {
            $payment->groomingBooking->update(['status' => 'pending']);
        }
    }
}