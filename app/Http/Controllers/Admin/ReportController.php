<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\GroomingBooking;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function index()
    {
        $payments = Payment::with([
            'customer.user',
            'order',
            'groomingBooking'
        ])->latest()->get();

        $totalOrder = Order::count();
        $totalGrooming = GroomingBooking::count();
        $totalPayment = Payment::count();
        $totalPendapatan = Payment::where('status', 'verified')->sum('total');

        return view('admin.reports.index', compact(
            'payments',
            'totalOrder',
            'totalGrooming',
            'totalPayment',
            'totalPendapatan'
        ));
    }

    public function pdf()
    {
        $payments = Payment::with([
            'customer.user',
            'order',
            'groomingBooking'
        ])
        ->where('status', 'verified')
        ->latest()
        ->get();

        $totalOrder = Order::count();
        $totalGrooming = GroomingBooking::count();
        $totalPayment = Payment::count();
        $totalPendapatan = Payment::where('status', 'verified')->sum('total');

        $pdf = Pdf::loadView('admin.reports.pdf', compact(
            'payments',
            'totalOrder',
            'totalGrooming',
            'totalPayment',
            'totalPendapatan'
        ));

        $pdf->setPaper('legal', 'portrait');

        return $pdf->stream('Laporan-MiPaw.pdf');
    }

    public function preview()
    {
        $payments = Payment::with('customer.user')
            ->where('status', 'verified')
            ->latest()
            ->get();

        $totalOrder = Order::count();

        $totalGrooming = GroomingBooking::count();

        $totalPayment = Payment::count();

        $totalPendapatan = Payment::where('status','verified')
            ->sum('total');

        return view('admin.reports.preview', compact(
            'payments',
            'totalOrder',
            'totalGrooming',
            'totalPayment',
            'totalPendapatan'
        ));
    }
    
}