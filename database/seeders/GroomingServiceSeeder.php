<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GroomingService;

class GroomingServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['nama_layanan' => 'Mandi Basic', 'harga' => 50000, 'durasi' => 45, 'deskripsi' => 'Mandi dengan shampoo standar, keringkan, dan sisir bulu.'],
            ['nama_layanan' => 'Mandi + Blow Dry', 'harga' => 75000, 'durasi' => 60, 'deskripsi' => 'Mandi lengkap dengan pengeringan blow dry agar bulu rapi.'],
            ['nama_layanan' => 'Grooming Lengkap', 'harga' => 120000, 'durasi' => 90, 'deskripsi' => 'Mandi, potong bulu, potong kuku, dan bersihkan telinga.'],
            ['nama_layanan' => 'Potong Kuku', 'harga' => 25000, 'durasi' => 15, 'deskripsi' => 'Layanan potong kuku hewan peliharaan.'],
            ['nama_layanan' => 'Potong Bulu (Styling)', 'harga' => 100000, 'durasi' => 75, 'deskripsi' => 'Potong dan styling bulu sesuai model yang diinginkan.'],
            ['nama_layanan' => 'Cuci Telinga', 'harga' => 20000, 'durasi' => 10, 'deskripsi' => 'Pembersihan kotoran dan cairan pada telinga hewan.'],
            ['nama_layanan' => 'Sikat Gigi', 'harga' => 30000, 'durasi' => 15, 'deskripsi' => 'Perawatan kebersihan gigi dan mulut hewan.'],
            ['nama_layanan' => 'Paket Spa Hewan', 'harga' => 150000, 'durasi' => 100, 'deskripsi' => 'Paket lengkap mandi, spa, pijat, dan aromaterapi untuk hewan.'],
        ];

        foreach ($services as $service) {
            GroomingService::firstOrCreate(
                ['nama_layanan' => $service['nama_layanan']],
                $service
            );
        }
    }
}
