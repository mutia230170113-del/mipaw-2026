<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\Customer;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with('customer.user')
            ->latest()
            ->paginate(10);

        $totalPet = Pet::count();

        return view('admin.pets.index', compact(
            'pets',
            'totalPet'
        ));
    }

    public function create()
    {
        $customers = Customer::with('user')
            ->orderBy('id')
            ->get();

        return view('admin.pets.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'nama_hewan' => 'required|max:100',
            'jenis' => 'required',
            'ras' => 'nullable|max:100',
            'umur' => 'nullable|integer|min:0',
            'berat' => 'nullable|numeric|min:0',
            'catatan' => 'nullable'
        ]);

        Pet::create($request->all());

        return redirect()
            ->route('pets.index')
            ->with('success','Data hewan berhasil ditambahkan.');
    }

    public function show(Pet $pet)
    {
        $pet->load('customer.user');

        return view('admin.pets.show', compact('pet'));
    }

    public function edit(Pet $pet)
    {
        $customers = Customer::with('user')->get();

        return view('admin.pets.edit', compact(
            'pet',
            'customers'
        ));
    }

    public function update(Request $request, Pet $pet)
    {
        $request->validate([
            'customer_id'=>'required|exists:customers,id',
            'nama_hewan'=>'required|max:100',
            'jenis'=>'required',
            'ras'=>'nullable|max:100',
            'umur'=>'nullable|integer|min:0',
            'berat'=>'nullable|numeric|min:0',
            'catatan'=>'nullable'
        ]);

        $pet->update($request->all());

        return redirect()
            ->route('pets.index')
            ->with('success','Data hewan berhasil diperbarui.');
    }

    public function destroy(Pet $pet)
    {
        $pet->delete();

        return redirect()
            ->route('pets.index')
            ->with('success','Data hewan berhasil dihapus.');
    }
}