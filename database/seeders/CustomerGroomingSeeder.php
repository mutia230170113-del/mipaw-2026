<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\GroomingBooking;
use App\Models\GroomingService;
use App\Models\Payment;
use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerGroomingSeeder extends Seeder
{
    protected int $jumlahCustomerBaru = 40;
    protected int $jumlahBooking      = 40;

    public function run(): void
    {
        // 1. Tambah customer baru (beserta pet-nya masing-masing 1-2 ekor)
        $namaDepan  = ['Andi', 'Budi', 'Citra', 'Dewi', 'Eka', 'Fajar', 'Gita', 'Hendra', 'Intan', 'Joko', 'Kirana', 'Lestari', 'Made', 'Nadia', 'Oscar'];
        $jenisHewan = ['Kucing', 'Anjing'];
        $rasKucing  = ['Anggora', 'Persia', 'Kampung', 'Munchkin', 'Maine Coon'];
        $rasAnjing  = ['Pomeranian', 'Poodle', 'Chihuahua', 'Golden Retriever', 'Kampung'];
        $namaHewan  = ['Milo', 'Luna', 'Coco', 'Kiki', 'Bella', 'Oreo', 'Simba', 'Mochi', 'Leo', 'Nala'];

        for ($i = 1; $i <= $this->jumlahCustomerBaru; $i++) {
            $nama = $namaDepan[array_rand($namaDepan)] . ' ' . Str::random(4);

            $user = User::create([
                'name'     => $nama,
                'email'    => 'customer' . time() . $i . '@mipaw.com',
                'password' => Hash::make('password'),
                'role'     => 'customer',
            ]);

            $customer = Customer::create([
                'user_id' => $user->id,
                'alamat'  => 'Jl. Mawar No. ' . rand(1, 99) . ', Kota Contoh',
                'no_hp'   => '08' . rand(1111111111, 9999999999),
            ]);

            // 1-2 pet per customer
            for ($p = 1; $p <= rand(1, 2); $p++) {
                $jenis = $jenisHewan[array_rand($jenisHewan)];

                Pet::create([
                    'customer_id' => $customer->id,
                    'nama_hewan'  => $namaHewan[array_rand($namaHewan)],
                    'jenis'       => $jenis,
                    'ras'         => $jenis === 'Kucing'
                        ? $rasKucing[array_rand($rasKucing)]
                        : $rasAnjing[array_rand($rasAnjing)],
                    'umur'        => rand(1, 8),
                    'berat'       => rand(2, 25) + (rand(0, 9) / 10),
                ]);
            }
        }

        // 2. Pastikan ada layanan grooming, kalau kosong buat dulu
        $services = GroomingService::all();

        if ($services->isEmpty()) {
            $layanan = [
                ['nama_layanan' => 'Mandi Kucing',          'harga' => 50000,  'durasi' => 45],
                ['nama_layanan' => 'Mandi Anjing',          'harga' => 60000,  'durasi' => 60],
                ['nama_layanan' => 'Potong Kuku',           'harga' => 20000,  'durasi' => 15],
                ['nama_layanan' => 'Cukur Bulu Full Body',  'harga' => 90000,  'durasi' => 90],
                ['nama_layanan' => 'Grooming Paket Lengkap', 'harga' => 150000, 'durasi' => 120],
                ['nama_layanan' => 'Sisir & Rapikan Bulu',  'harga' => 35000,  'durasi' => 30],
            ];

            foreach ($layanan as $item) {
                $services->push(GroomingService::create($item));
            }
        }

        // 3. Semua customer (lama + baru) yang punya pet, dibuatkan booking grooming
        $semuaCustomer = Customer::with('pets')->get()->filter(fn ($c) => $c->pets->isNotEmpty());

        if ($semuaCustomer->isEmpty()) {
            $this->command?->warn('Tidak ada customer dengan pet, booking grooming dilewati.');
            return;
        }

        $statusBooking  = ['pending', 'diproses', 'selesai', 'dibatalkan'];
        $metodeBayar    = ['cash', 'qris', 'transfer'];

        for ($i = 1; $i <= $this->jumlahBooking; $i++) {

            DB::transaction(function () use ($i, $semuaCustomer, $services, $statusBooking, $metodeBayar) {

                $customer = $semuaCustomer->random();
                $pet      = $customer->pets->random();
                $service  = $services->random();

                $tanggal = now()->addDays(rand(-30, 14));
                $jam     = sprintf('%02d:%02d', rand(9, 17), collect([0, 15, 30, 45])->random());

                // Bobot: status 'selesai' lebih sering muncul
                $status = collect($statusBooking)
                    ->flatMap(fn ($s) => $s === 'selesai' ? array_fill(0, 3, $s) : [$s])
                    ->random();

                $booking = GroomingBooking::create([
                    'customer_id' => $customer->id,
                    'pet_id'      => $pet->id,
                    'service_id'  => $service->id,
                    'tanggal'     => $tanggal->toDateString(),
                    'jam'         => $jam,
                    'status'      => $status,
                    'qr_booking'  => null,
                ]);

                if (in_array($status, ['diproses', 'selesai'])) {
                    Payment::create([
                        'invoice'             => 'PAY-' . now()->format('YmdHis') . '-G' . $i,
                        'customer_id'         => $customer->id,
                        'grooming_booking_id' => $booking->id,
                        'total'               => $service->harga,
                        'metode'              => $metodeBayar[rand(0, 2)],
                        'status'              => $status === 'selesai' ? 'verified' : 'pending',
                        'paid_at'             => $status === 'selesai' ? $tanggal : null,
                    ]);
                }
            });
        }

        $this->command?->info("Berhasil membuat {$this->jumlahCustomerBaru} customer baru dan {$this->jumlahBooking} booking grooming.");
    }
}