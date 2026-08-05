<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GroomingService;
use Illuminate\Http\Request;

class GroomingServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = GroomingService::latest()->paginate(10);

        $totalService = GroomingService::count();

        return view(
            'admin.grooming-services.index',
            compact(
                'services',
                'totalService'
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.grooming-services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_layanan' => 'required|max:255',
            'harga' => 'required|numeric|min:1000',
            'durasi' => 'required|numeric|min:1',
            'deskripsi' => 'nullable'
        ]);

        GroomingService::create([
            'nama_layanan' => $request->nama_layanan,
            'harga' => $request->harga,
            'durasi' => $request->durasi,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('grooming-services.index')
            ->with('success', 'Paket grooming berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(GroomingService $grooming_service)
    {
        return view(
            'admin.grooming-services.show',
            compact('grooming_service')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GroomingService $grooming_service)
    {
        return view(
            'admin.grooming-services.edit',
            compact('grooming_service')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GroomingService $grooming_service)
    {
        $request->validate([
            'nama_layanan' => 'required|max:255',
            'harga' => 'required|numeric|min:1000',
            'durasi' => 'required|numeric|min:1',
            'deskripsi' => 'nullable'
        ]);

        $grooming_service->update([
            'nama_layanan' => $request->nama_layanan,
            'harga' => $request->harga,
            'durasi' => $request->durasi,
            'deskripsi' => $request->deskripsi,
        ]);

        return redirect()
            ->route('grooming-services.index')
            ->with('success', 'Paket grooming berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GroomingService $grooming_service)
    {
        $grooming_service->delete();

        return redirect()
            ->route('grooming-services.index')
            ->with('success', 'Paket grooming berhasil dihapus.');
    }
}