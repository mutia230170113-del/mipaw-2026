<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MembershipController extends Controller
{
    public function index()
    {
        $membership = auth()->user()
            ->customer
            ->membership;

        return view(
            'customer.membership.index',
            compact('membership')
        );
    }

    /**
     * Memproses Pendaftaran Membership Mandiri Silver & Golden Paw
     */
    public function register(Request $request)
    {
        $request->validate([
            'level' => 'required|in:silver,golden'
        ]);

        $user = auth()->user();

        // 1. Cek apakah customer sudah punya data customer profil, jika belum buat otomatis
        $customer = \App\Models\Customer::where('user_id', $user->id)->first();
        if (!$customer) {
            $customer = \App\Models\Customer::create([
                'user_id' => $user->id,
                'no_hp' => '-',
                'alamat' => '-'
            ]);
        }

        // 2. Cek apakah sudah pernah daftar member sebelumnya agar tidak ganda
        $cekMembership = \App\Models\Membership::where('customer_id', $customer->id)->first();
        if ($cekMembership) {
            return redirect()->back()->with('error', 'Kamu sudah terdaftar sebagai member!');
        }

        // 3. Membuat kode unik kartu member MiPaw (Contoh: MPW-2026-0001)
        $kodeMember = 'MPW-' . date('Y') . '-' . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);

        // 4. Konversi nilai level agar cocok dengan kolom ENUM database asli (regular/premium)
        $levelDatabase = ($request->level == 'silver') ? 'regular' : 'premium';

        // Simpan data tingkatan paket ke database keanggotaan
        \App\Models\Membership::create([
            'customer_id' => $customer->id,
            'member_code' => $kodeMember,
            'level' => $levelDatabase, // <--- Sudah aman, menggunakan nilai konversi
            'poin' => 0,
            'status' => 'aktif'
        ]);

        return redirect()->route('customer.membership')->with('success', 'Selamat! Akun kamu berhasil terdaftar sebagai member MiPaw');
    }
}
