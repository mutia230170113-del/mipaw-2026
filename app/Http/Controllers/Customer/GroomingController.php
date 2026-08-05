<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\GroomingBooking;
use App\Models\GroomingService;
use Illuminate\Http\Request;

class GroomingController extends Controller
{
    public function index()
{
    $services = GroomingService::all();

    $bookings = GroomingBooking::where(
        'customer_id',
        auth()->user()->customer->id
    )
    ->with('pet', 'service')
    ->latest()
    ->get();

    return view(
        'customer.grooming.index',
        compact('services', 'bookings')
    );
}

    public function create(GroomingService $service)
    {
        $customer = auth()->user()->customer;

        $pets = $customer->pets;

        return view('customer.grooming.create', compact(
            'service',
            'pets'
        ));
    }

    public function store(Request $request, GroomingService $service)
    {
        $request->validate([
            'pet_id'   => 'required|exists:pets,id',
            'tanggal'  => 'required|date',
            'jam'      => 'required',
        ]);

        GroomingBooking::create([
            'customer_id' => auth()->user()->customer->id,
            'pet_id'      => $request->pet_id,
            'service_id'  => $service->id,
            'tanggal'     => $request->tanggal,
            'jam'         => $request->jam,
            'status'      => 'pending',
        ]);

        return redirect()
            ->route('customer.grooming.history')
            ->with('success', 'Booking grooming berhasil dibuat.');
    }

    public function history()
    {
        $bookings = GroomingBooking::where(
            'customer_id',
            auth()->user()->customer->id
        )
        ->with('pet', 'service')
        ->latest()
        ->get();

        return view('customer.grooming.history', compact('bookings'));
    }

    public function show(GroomingBooking $booking)
    {
        if ($booking->customer_id != auth()->user()->customer->id) {
            abort(403);
        }

        return view('customer.grooming.show', compact('booking'));
    }
}