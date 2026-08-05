<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Pet;

class PetSeeder extends Seeder
{
    /**
     * Membuat data hewan peliharaan untuk tiap customer,
     * supaya cukup untuk 40+ booking grooming.
     */
    public function run(): void
    {
        $namaKucing = ['Milo','Mochi','Kitty','Oyen','Tom','Luna','Coco','Momo','Snowy','Biscuit'];
        $namaAnjing = ['Bruno','Max','Rocky','Bella','Coco','Leo','Buddy','Charlie','Lucy','Jack'];

        $jenisRas = [
            'Kucing' => ['Persia','Anggora','Domestik','British Shorthair','Maine Coon'],
            'Anjing' => ['Poodle','Golden Retriever','Pomeranian','Shih Tzu','Local/Kampung'],
        ];

        $customers = Customer::all();

        if ($customers->isEmpty()) {
            return;
        }

        foreach ($customers as $customer) {
            // Setiap customer punya 1-2 hewan peliharaan.
            $jumlahHewan = rand(1, 2);

            for ($i = 0; $i < $jumlahHewan; $i++) {
                $jenis = rand(0, 1) === 0 ? 'Kucing' : 'Anjing';
                $nama = $jenis === 'Kucing'
                    ? $namaKucing[array_rand($namaKucing)]
                    : $namaAnjing[array_rand($namaAnjing)];

                Pet::create([
                    'customer_id' => $customer->id,
                    'nama_hewan' => $nama,
                    'jenis' => $jenis,
                    'ras' => $jenisRas[$jenis][array_rand($jenisRas[$jenis])],
                    'umur' => rand(1, 8),
                    'berat' => round(mt_rand(15, 250) / 10, 2),
                    'catatan' => null,
                ]);
            }
        }
    }
}
