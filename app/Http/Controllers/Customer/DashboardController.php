<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Payment;
use App\Models\GroomingBooking;
use App\Models\Membership;

class DashboardController extends Controller
{
    public function index()
    {
        $customer = auth()->user()->customer;

        $orders = Order::where('customer_id', $customer->id)
            ->latest()
            ->take(5)
            ->get();

        $payments = Payment::where('customer_id', $customer->id)
            ->latest()
            ->take(5)
            ->get();

        $groomings = GroomingBooking::where('customer_id', $customer->id)
            ->latest()
            ->take(5)
            ->get();

        $membership = Membership::where('customer_id', $customer->id)
            ->first();

        return view('customer.dashboard', compact(
            'customer',
            'orders',
            'payments',
            'groomings',
            'membership'
        ));
    }

    public function payments()
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
            'customer.payments',
            compact('payments')
        );
    }
}