<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {

        $categories = [

            'Makanan Kucing',
            'Makanan Anjing',
            'Snack & Treat',
            'Pasir Kucing',
            'Kandang',
            'Mainan',
            'Aksesoris',
            'Kalung & Tali',
            'Vitamin',
            'Obat Hewan',
            'Grooming',
            'Shampoo Hewan',
            'Perawatan Bulu',
            'Kebersihan',
            'Perlengkapan Hewan'

        ];



        foreach($categories as $category)
        {

            Category::create([
                'nama_kategori'=>$category
            ]);

        }

    }
}