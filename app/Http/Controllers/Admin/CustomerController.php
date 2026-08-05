<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Menampilkan daftar customer
     */
    public function index()
    {
        $customers = User::where('role', 'customer')
            ->latest()
            ->paginate(10);

        $totalCustomer = User::where('role', 'customer')->count();

        return view('admin.customers.index', compact(
            'customers',
            'totalCustomer'
        ));
    }

    /**
     * Form tambah customer
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Simpan customer baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:8|confirmed',
            'no_hp'     => 'nullable|string|max:20',
            'alamat'    => 'nullable|string',
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'role'      => 'customer',
        ]);

        Customer::create([
            'user_id'   => $user->id,
            'no_hp'     => $request->no_hp,
            'alamat'    => $request->alamat,
        ]);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer berhasil ditambahkan.');
    }

    /**
     * Detail customer
     */
    public function show(User $customer)
    {
        return view('admin.customers.show', compact('customer'));
    }

    /**
     * Form edit customer
     */
    public function edit(User $customer)
    {
        return view('admin.customers.edit', compact('customer'));
    }

    /**
     * Update customer
     */
    public function update(Request $request, User $customer)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $customer->id,
            'no_hp'  => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
        ]);

        $customer->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        if ($customer->customer) {

            $customer->customer->update([
                'no_hp'  => $request->no_hp,
                'alamat' => $request->alamat,
            ]);

        }

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer berhasil diperbarui.');
    }

    /**
     * Hapus customer
     */
    public function destroy(User $customer)
    {
        if ($customer->customer) {
            $customer->customer->delete();
        }

        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer berhasil dihapus.');
    }
}