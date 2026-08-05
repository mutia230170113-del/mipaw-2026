<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Membuat 40 customer (User + Customer) dengan data acak yang realistis.
     */
    public function run(): void
    {
        $namaDepan = [
            'Andi','Budi','Citra','Dewi','Eka','Fajar','Gita','Hendra','Intan','Joko',
            'Kartika','Lukman','Maya','Nanda','Oki','Putri','Rian','Sinta','Tono','Umi',
            'Vina','Wawan','Yuni','Zaki','Ayu','Bagas','Cahya','Dinda','Erlangga','Fitri',
            'Galih','Hana','Irfan','Julia','Krisna','Lestari','Made','Nia','Oscar','Prita',
        ];

        $namaBelakang = [
            'Saputra','Wijaya','Kusuma','Pratama','Santoso','Hidayat','Permata','Nugroho',
            'Setiawan','Ramadhan','Utami','Firmansyah','Anggraini','Susanto','Wibowo',
            'Handayani','Maulana','Puspita','Gunawan','Rahayu',
        ];

        $kota = [
            'Lhokseumawe','Banda Aceh','Medan','Jakarta','Bandung','Surabaya','Semarang',
            'Yogyakarta','Makassar','Palembang','Denpasar','Malang','Bogor','Depok',
            'Padang','Pekanbaru',
        ];

        $jalan = [
            'Jl. Merdeka','Jl. Sudirman','Jl. Diponegoro','Jl. Kartini','Jl. Ahmad Yani',
            'Jl. Gajah Mada','Jl. Cendrawasih','Jl. Melati','Jl. Mawar','Jl. Anggrek',
        ];

        $total = 40;

        for ($i = 1; $i <= $total; $i++) {
            $depan = $namaDepan[array_rand($namaDepan)];
            $belakang = $namaBelakang[array_rand($namaBelakang)];
            $nama = "{$depan} {$belakang}";

            $email = strtolower(str_replace(' ', '.', $nama)) . $i . '@mail.com';

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $nama,
                    'password' => Hash::make('password123'),
                    'role' => 'customer',
                ]
            );

            Customer::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'alamat' => $jalan[array_rand($jalan)] . ' No. ' . rand(1, 150) . ', ' . $kota[array_rand($kota)],
                    'no_hp' => '08' . rand(11, 99) . rand(1000000, 9999999),
                ]
            );
        }
    }
}
