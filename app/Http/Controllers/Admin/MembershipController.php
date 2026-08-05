<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Customer;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    /**
     * Daftar Membership
     */
    public function index()
    {
        $memberships = Membership::with('customer.user')
            ->latest()
            ->get();

        return view('admin.memberships.index', compact('memberships'));
    }

    /**
     * Form Tambah Membership
     */
    public function create()
    {
        // Hanya customer yang belum memiliki membership
        $customers = Customer::with('user')
            ->doesntHave('membership')
            ->get();

        return view('admin.memberships.create', compact('customers'));
    }

    /**
     * Simpan Membership
     */
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id|unique:memberships,customer_id',
            'level'       => 'required|in:regular,premium',
            'poin'        => 'required|integer|min:0',
        ]);

        // Generate kode member otomatis
        $lastMember = Membership::latest()->first();

        if ($lastMember) {
            $number = (int) substr($lastMember->member_code, 2) + 1;
        } else {
            $number = 1;
        }

        $memberCode = 'MP' . str_pad($number, 3, '0', STR_PAD_LEFT);

        Membership::create([
            'customer_id' => $request->customer_id,
            'member_code' => $memberCode,
            'level'       => $request->level,
            'poin'        => $request->poin,
        ]);

        return redirect()
            ->route('memberships.index')
            ->with('success', 'Membership berhasil ditambahkan.');
    }

    /**
     * Detail Membership
     */
    public function show(Membership $membership)
    {
        $membership->load('customer.user');

        return view('admin.memberships.show', compact('membership'));
    }

    /**
     * Form Edit Membership
     */
    public function edit(Membership $membership)
    {
        $customers = Customer::with('user')->get();

        return view(
            'admin.memberships.edit',
            compact('membership', 'customers')
        );
    }

    /**
     * Update Membership
     */
    public function update(Request $request, Membership $membership)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id|unique:memberships,customer_id,' . $membership->id,
            'level'       => 'required|in:regular,premium',
            'poin'        => 'required|integer|min:0',
        ]);

        $membership->update([
            'customer_id' => $request->customer_id,
            'level'       => $request->level,
            'poin'        => $request->poin,
        ]);

        return redirect()
            ->route('memberships.index')
            ->with('success', 'Membership berhasil diperbarui.');
    }

    /**
     * Hapus Membership
     */
    public function destroy(Membership $membership)
    {
        $membership->delete();

        return redirect()
            ->route('memberships.index')
            ->with('success', 'Membership berhasil dihapus.');
    }
}