<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {
        $customer = auth()->user()->customer;

        $orders = Order::with([
                'items.product',
                'payment'
            ])
            ->where('customer_id', $customer->id)
            ->latest()
            ->paginate(10);

        return view(
            'customer.orders.index',
            compact('orders')
        );
    }

    public function show(Order $order)
    {
        if ($order->customer_id != auth()->user()->customer->id) {
            abort(403);
        }

        $order->load([
            'items.product',
            'payment'
        ]);

        return view(
            'customer.orders.show',
            compact('order')
        );
    }
}