<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\GroomingService;
use App\Models\GroomingBooking;
use Illuminate\Http\Request;

class GroomingBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = GroomingBooking::with([
            'customer.user',
            'pet',
            'service',
            'payment'
        ])->latest()->get();

        return view('admin.grooming-bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::with('user')->get();
        $pets = Pet::all();
        $services = GroomingService::all();

        return view(
            'admin.grooming-bookings.create',
            compact(
                'customers',
                'pets',
                'services'
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'pet_id' => 'required|exists:pets,id',
            'service_id' => 'required|exists:grooming_services,id',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'status' => 'required'
        ]);

        GroomingBooking::create([
            'customer_id' => $request->customer_id,
            'pet_id' => $request->pet_id,
            'service_id' => $request->service_id,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'status' => $request->status,
            'qr_booking' => null
        ]);

        return redirect()
            ->route('grooming-bookings.index')
            ->with('success', 'Booking Grooming berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GroomingBooking $groomingBooking)
    {
        return view(
            'admin.grooming-bookings.show',
            [
                'booking' => $groomingBooking->load([
                    'customer.user',
                    'pet',
                    'service',
                    'payment'
                ])
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GroomingBooking $groomingBooking)
    {
        $customers = Customer::with('user')->get();
        $pets = Pet::all();
        $services = GroomingService::all();

        return view(
            'admin.grooming-bookings.edit',
            [
                'booking' => $groomingBooking,
                'customers' => $customers,
                'pets' => $pets,
                'services' => $services
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GroomingBooking $groomingBooking)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'pet_id' => 'required|exists:pets,id',
            'service_id' => 'required|exists:grooming_services,id',
            'tanggal' => 'required|date',
            'jam' => 'required',
            'status' => 'required'
        ]);

        if (
            $groomingBooking->payment &&
            $groomingBooking->payment->status != 'verified' &&
            in_array($request->status, ['diproses', 'selesai'])
        ) {
            return back()->with(
                'error',
                'Booking belum dibayar atau pembayaran belum diverifikasi.'
            );
        }

        $groomingBooking->update([
            'customer_id' => $request->customer_id,
            'pet_id' => $request->pet_id,
            'service_id' => $request->service_id,
            'tanggal' => $request->tanggal,
            'jam' => $request->jam,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('grooming-bookings.index')
            ->with('success', 'Booking Grooming berhasil diperbarui.');
    }

    /**
     * Selesaikan Grooming
     */
    public function finish(GroomingBooking $groomingBooking)
    {
        if ($groomingBooking->status != 'diproses') {
            return back()->with(
                'error',
                'Booking belum dalam proses grooming.'
            );
        }

        $groomingBooking->update([
            'status' => 'selesai'
        ]);

        return redirect()
            ->route('grooming-bookings.index')
            ->with('success', 'Grooming berhasil diselesaikan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GroomingBooking $groomingBooking)
    {
        $groomingBooking->delete();

        return redirect()
            ->route('grooming-bookings.index')
            ->with('success', 'Booking Grooming berhasil dihapus.');
    }
}