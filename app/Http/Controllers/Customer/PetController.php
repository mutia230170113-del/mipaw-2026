<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::where(
            'customer_id',
            auth()->user()->customer->id
        )->latest()->get();

        return view('customer.pets.index', compact('pets'));
    }

    public function create()
    {
        return view('customer.pets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_hewan' => 'required',
            'jenis' => 'required',
            'ras' => 'nullable',
            'umur' => 'nullable|numeric',
            'berat' => 'nullable|numeric',
            'catatan' => 'nullable',
        ]);

        Pet::create([
            'customer_id' => auth()->user()->customer->id,
            'nama_hewan' => $request->nama_hewan,
            'jenis' => $request->jenis,
            'ras' => $request->ras,
            'umur' => $request->umur,
            'berat' => $request->berat,
            'catatan' => $request->catatan,
        ]);

        return redirect()
            ->route('customer.pets')
            ->with('success','Data hewan berhasil ditambahkan.');
    }

    public function edit(Pet $pet)
    {
        return view('customer.pets.edit', compact('pet'));
    }

    public function update(Request $request, Pet $pet)
    {
        $pet->update($request->all());

        return redirect()->route('customer.pets');
    }

    public function destroy(Pet $pet)
    {
        $pet->delete();

        return back();
    }
}