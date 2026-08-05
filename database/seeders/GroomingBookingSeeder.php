<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Pet;
use App\Models\GroomingService;
use App\Models\GroomingBooking;
use Carbon\Carbon;

class GroomingBookingSeeder extends Seeder
{
    /**
     * Membuat 40 booking grooming untuk mengisi menu "Booking Jadwal".
     */
    public function run(): void
    {
        $customers = Customer::with('pets')->get();
        $services = GroomingService::all();

        if ($customers->isEmpty() || $services->isEmpty()) {
            return;
        }

        $statuses = ['pending', 'diproses', 'selesai', 'dibatalkan'];
        $jamPilihan = ['09:00', '10:00', '11:00', '13:00', '14:00', '15:00', '16:00'];

        $total = 40;

        for ($i = 1; $i <= $total; $i++) {
            $customer = $customers->random();
            $pet = $customer->pets->isNotEmpty()
                ? $customer->pets->random()
                : Pet::where('customer_id', $customer->id)->first();

            if (!$pet) {
                // Jaga-jaga bila customer belum punya hewan.
                $pet = Pet::create([
                    'customer_id' => $customer->id,
                    'nama_hewan' => 'Peliharaan ' . $i,
                    'jenis' => 'Kucing',
                    'ras' => 'Domestik',
                    'umur' => rand(1, 5),
                    'berat' => round(mt_rand(15, 100) / 10, 2),
                ]);
            }

            $service = $services->random();
            $tanggal = Carbon::now()->subDays(rand(0, 45))->addDays(rand(0, 20));

            GroomingBooking::create([
                'customer_id' => $customer->id,
                'pet_id' => $pet->id,
                'service_id' => $service->id,
                'tanggal' => $tanggal->format('Y-m-d'),
                'jam' => $jamPilihan[array_rand($jamPilihan)],
                'status' => $statuses[array_rand($statuses)],
                'qr_booking' => 'QRGRM-' . strtoupper(uniqid()),
            ]);
        }
    }
}
