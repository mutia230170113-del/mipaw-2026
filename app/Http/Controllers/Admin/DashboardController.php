<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use App\Models\GroomingBooking;

class DashboardController extends Controller
{

    public function index()
    {

        $totalProduk = Product::count();

        $totalCustomer = Customer::count();

        $totalOrder = Order::count();


        // kalau tabel grooming belum ada data
        // sementara aman
        $totalGrooming = class_exists(GroomingBooking::class)
            ? GroomingBooking::count()
            : 0;



        $products = Product::latest()
            ->take(3)
            ->get();



        $orders = Order::latest()
            ->take(5)
            ->get();




        return view('admin.dashboard', compact(

            'totalProduk',

            'totalCustomer',

            'totalOrder',

            'totalGrooming',

            'products',

            'orders'

        ));

    }

}