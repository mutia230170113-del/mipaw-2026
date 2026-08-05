<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {


        User::create([
            'name' => 'Admin',
            'email' => 'admin@mipaw.com',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
        ]);



        $categories = [

            'Makanan Kucing',
            'Makanan Anjing',
            'Snack & Treat',
            'Pasir Kucing',
            'Mainan',
            'Aksesoris',
            'Vitamin',
            'Grooming',

        ];



        foreach ($categories as $item) {

            Category::create([
                'nama_kategori' => $item
            ]);

        }



    }
}