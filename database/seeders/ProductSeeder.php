<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Seed 87 produk MiPaw lengkap dengan gambar.
     * Gambar sumber ada di: database/seeders/images/products/*
     * Seeder ini akan menyalinnya ke storage/app/public/products
     * lalu menyimpan path relatifnya ke kolom `gambar`.
     */
    public function run(): void
    {
        $sourceDir = database_path('seeders/images/products');
        $destDir = storage_path('app/public/products');

        if (!File::exists($destDir)) {
            File::makeDirectory($destDir, 0755, true);
        }

        $products = [
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Royal Canin Kitten', 'harga' => 85000, 'stok' => 25, 'barcode' => '8851300901234', 'deskripsi' => 'Makanan kitten premium dengan nutrisi lengkap untuk pertumbuhan anak kucing.', 'gambar' => 'products/royal-canin-kitten.jpg'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Whiskas Adult Tuna 1.2kg', 'harga' => 55000, 'stok' => 30, 'barcode' => '8999999001122', 'deskripsi' => 'Makanan kering rasa tuna untuk kucing dewasa dengan protein seimbang.', 'gambar' => 'products/whiskas-adult-tuna-1-2kg.jpg'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Me-O Persian Cat Food', 'harga' => 65000, 'stok' => 20, 'barcode' => '8850477004567', 'deskripsi' => 'Makanan khusus kucing persia untuk menjaga kesehatan bulu.', 'gambar' => 'products/me-o-persian-cat-food.jpg'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Pro Plan Cat Adult', 'harga' => 120000, 'stok' => 15, 'barcode' => '7613035123456', 'deskripsi' => 'Premium cat food dengan formula kesehatan pencernaan.', 'gambar' => 'products/pro-plan-cat-adult.jpg'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Friskies Seafood Sensation', 'harga' => 60000, 'stok' => 18, 'barcode' => '8998888123456', 'deskripsi' => 'Makanan kucing rasa seafood dengan vitamin dan mineral.', 'gambar' => 'products/friskies-seafood-sensation.jpg'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Bolt Cat Food Tuna', 'harga' => 45000, 'stok' => 35, 'barcode' => '8997777123456', 'deskripsi' => 'Makanan ekonomis dengan rasa tuna favorit kucing.', 'gambar' => 'products/bolt-cat-food-tuna.jpg'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Kitchen Flavour Cat Food', 'harga' => 75000, 'stok' => 12, 'barcode' => '8859999123456', 'deskripsi' => 'Makanan kucing premium dengan kandungan protein tinggi.', 'gambar' => 'products/kitchen-flavour-cat-food.jpg'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Equilibrio Cat Adult', 'harga' => 95000, 'stok' => 10, 'barcode' => '7891234567890', 'deskripsi' => 'Nutrisi lengkap untuk menjaga berat badan dan kesehatan kucing.', 'gambar' => 'products/equilibrio-cat-adult.jpg'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Bolt Cat Food Salmon', 'harga' => 47000, 'stok' => 28, 'barcode' => '8900010000011', 'deskripsi' => 'Makanan kucing rasa salmon dengan kandungan omega untuk bulu sehat.', 'gambar' => 'products/bolt-cat-food-salmon.jpg'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Cat Choice Adult', 'harga' => 58000, 'stok' => 22, 'barcode' => '8900010000028', 'deskripsi' => 'Makanan kucing dewasa dengan formula seimbang harga terjangkau.', 'gambar' => 'products/cat-choice-adult.webp'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Cat Choice Kitten', 'harga' => 56000, 'stok' => 20, 'barcode' => '8900010000035', 'deskripsi' => 'Makanan anak kucing untuk mendukung tumbuh kembang optimal.', 'gambar' => 'products/cat-choice-kitten.webp'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Cleo Cat Adult Chicken', 'harga' => 68000, 'stok' => 16, 'barcode' => '8900010000042', 'deskripsi' => 'Makanan kucing rasa ayam dengan tekstur disukai kucing dewasa.', 'gambar' => 'products/cleo-cat-adult-chicken.jpg'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Felibite Adult', 'harga' => 52000, 'stok' => 24, 'barcode' => '8900010000059', 'deskripsi' => 'Makanan kucing dewasa ekonomis dengan nutrisi harian lengkap.', 'gambar' => 'products/felibite-adult.jpg'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Felibite Kitten', 'harga' => 54000, 'stok' => 20, 'barcode' => '8900010000066', 'deskripsi' => 'Makanan anak kucing dengan protein tinggi untuk masa pertumbuhan.', 'gambar' => 'products/felibite-kitten.jpeg'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Friskies Indoor Delights', 'harga' => 63000, 'stok' => 15, 'barcode' => '8900010000073', 'deskripsi' => 'Makanan kucing indoor dengan kontrol berat badan.', 'gambar' => 'products/friskies-indoor-delights.webp'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'LifeCat Premium Adult', 'harga' => 78000, 'stok' => 14, 'barcode' => '8900010000080', 'deskripsi' => 'Makanan premium dengan bahan berkualitas untuk kucing dewasa.', 'gambar' => 'products/lifecat-premium-adult.jpg'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Maxi Cat Adult Tuna', 'harga' => 50000, 'stok' => 26, 'barcode' => '8900010000097', 'deskripsi' => 'Makanan kucing dewasa rasa tuna dengan harga ekonomis.', 'gambar' => 'products/maxi-cat-adult-tuna.jpg'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Maxi Cat Seafood', 'harga' => 51000, 'stok' => 22, 'barcode' => '8900010000103', 'deskripsi' => 'Makanan kucing rasa seafood dengan kandungan gizi seimbang.', 'gambar' => 'products/maxi-cat-seafood.webp'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Me-O Adult Seafood', 'harga' => 67000, 'stok' => 18, 'barcode' => '8900010000110', 'deskripsi' => 'Makanan kucing dewasa rasa seafood dengan taurine untuk kesehatan mata.', 'gambar' => 'products/me-o-adult-seafood.webp'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Me-O Kitten', 'harga' => 64000, 'stok' => 20, 'barcode' => '8900010000127', 'deskripsi' => 'Makanan anak kucing dengan DHA untuk perkembangan otak.', 'gambar' => 'products/me-o-kitten.jpg'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Me-O Tuna', 'harga' => 62000, 'stok' => 19, 'barcode' => '8900010000134', 'deskripsi' => 'Makanan kucing rasa tuna favorit dengan aroma menggugah selera.', 'gambar' => 'products/me-o-tuna.webp'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Pro Plan Kitten Chicken', 'harga' => 125000, 'stok' => 12, 'barcode' => '8900010000141', 'deskripsi' => 'Makanan anak kucing rasa ayam dengan nutrisi premium Pro Plan.', 'gambar' => 'products/pro-plan-kitten-chicken.jpg'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Royal Canin Hair & Skin Care', 'harga' => 135000, 'stok' => 10, 'barcode' => '8900010000158', 'deskripsi' => 'Makanan khusus untuk menjaga kesehatan kulit dan bulu kucing.', 'gambar' => 'products/royal-canin-hair-and-skin-care.png'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Royal Canin Indoor Adult', 'harga' => 130000, 'stok' => 11, 'barcode' => '8900010000165', 'deskripsi' => 'Makanan kucing indoor dengan kontrol hairball dan berat badan.', 'gambar' => 'products/royal-canin-indoor-adult.jpg'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Royal Canin Sterilised', 'harga' => 132000, 'stok' => 9, 'barcode' => '8900010000172', 'deskripsi' => 'Makanan khusus kucing steril untuk menjaga berat badan ideal.', 'gambar' => 'products/royal-canin-sterilised.webp'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Royal Canin Persian Adult', 'harga' => 140000, 'stok' => 8, 'barcode' => '8900010000189', 'deskripsi' => 'Makanan khusus ras persia dewasa untuk kesehatan bulu panjang.', 'gambar' => 'products/royal-canin-persian-adult.webp'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'SmartHeart Cat Adult', 'harga' => 70000, 'stok' => 20, 'barcode' => '8900010000196', 'deskripsi' => 'Makanan kucing dewasa dengan protein hewani berkualitas.', 'gambar' => 'products/smartheart-cat-adult.jpg'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'SmartHeart Cat Kitten', 'harga' => 72000, 'stok' => 18, 'barcode' => '8900010000202', 'deskripsi' => 'Makanan anak kucing dengan nutrisi lengkap dari SmartHeart.', 'gambar' => 'products/smartheart-cat-kitten.webp'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Whiskas Kitten Ocean Fish 500g', 'harga' => 48000, 'stok' => 26, 'barcode' => '8900010000219', 'deskripsi' => 'Makanan anak kucing rasa ikan laut kemasan 500 gram.', 'gambar' => 'products/whiskas-kitten-ocean-fish-500g.png'],
            ['category' => 'Makanan Kucing', 'nama_produk' => 'Whiskas Kitten Ocean Fish 1.2kg', 'harga' => 95000, 'stok' => 16, 'barcode' => '8900010000226', 'deskripsi' => 'Makanan anak kucing rasa ikan laut kemasan hemat 1.2 kg.', 'gambar' => 'products/whiskas-kitten-ocean-fish-1-2kg.webp'],
            ['category' => 'Makanan Anjing', 'nama_produk' => 'Pedigree Adult Beef', 'harga' => 70000, 'stok' => 25, 'barcode' => '8999999002233', 'deskripsi' => 'Makanan anjing dewasa rasa sapi dengan nutrisi seimbang.', 'gambar' => 'products/pedigree-adult-beef.jpeg'],
            ['category' => 'Makanan Anjing', 'nama_produk' => 'Royal Canin Dog Food', 'harga' => 150000, 'stok' => 10, 'barcode' => '3182550712345', 'deskripsi' => 'Makanan premium untuk kesehatan tubuh anjing.', 'gambar' => 'products/royal-canin-dog-food.jpeg'],
            ['category' => 'Makanan Anjing', 'nama_produk' => 'Pro Plan Puppy', 'harga' => 135000, 'stok' => 15, 'barcode' => '7613036123456', 'deskripsi' => 'Makanan anak anjing untuk pertumbuhan optimal.', 'gambar' => 'products/pro-plan-puppy.jpeg'],
            ['category' => 'Makanan Anjing', 'nama_produk' => 'SmartHeart Dog Food', 'harga' => 85000, 'stok' => 20, 'barcode' => '8850478005678', 'deskripsi' => 'Makanan anjing dengan protein dan vitamin lengkap.', 'gambar' => 'products/smartheart-dog-food.jpeg'],
            ['category' => 'Makanan Anjing', 'nama_produk' => 'Dog Choice Adult', 'harga' => 65000, 'stok' => 18, 'barcode' => '8996666123456', 'deskripsi' => 'Makanan anjing dewasa dengan rasa ayam.', 'gambar' => 'products/dog-choice-adult.jpeg'],
            ['category' => 'Makanan Anjing', 'nama_produk' => 'Cesar Dog Food', 'harga' => 45000, 'stok' => 30, 'barcode' => '8997778123456', 'deskripsi' => 'Wet food anjing dengan rasa daging yang lezat.', 'gambar' => 'products/cesar-dog-food.jpeg'],
            ['category' => 'Makanan Anjing', 'nama_produk' => 'Hill\'s Science Diet', 'harga' => 180000, 'stok' => 8, 'barcode' => '052742012345', 'deskripsi' => 'Makanan anjing premium dengan formula kesehatan khusus.', 'gambar' => 'products/hill-s-science-diet.jpeg'],
            ['category' => 'Makanan Anjing', 'nama_produk' => 'Pedigree Puppy', 'harga' => 75000, 'stok' => 14, 'barcode' => '8998889123456', 'deskripsi' => 'Makanan anak anjing untuk mendukung perkembangan.', 'gambar' => 'products/pedigree-puppy.jpg'],
            ['category' => 'Snack & Treat', 'nama_produk' => 'Temptations Cat Treat', 'harga' => 35000, 'stok' => 40, 'barcode' => '8851300789123', 'deskripsi' => 'Snack kucing sebagai hadiah dengan rasa lezat.', 'gambar' => 'products/temptations-cat-treat.jpeg'],
            ['category' => 'Snack & Treat', 'nama_produk' => 'Whiskas Dentabites', 'harga' => 45000, 'stok' => 25, 'barcode' => '8999999012345', 'deskripsi' => 'Snack kucing untuk membantu menjaga kebersihan gigi.', 'gambar' => 'products/whiskas-dentabites.jpeg'],
            ['category' => 'Snack & Treat', 'nama_produk' => 'JerHigh Chicken Stick', 'harga' => 28000, 'stok' => 35, 'barcode' => '8851750003456', 'deskripsi' => 'Snack stik ayam untuk anjing.', 'gambar' => 'products/jerhigh-chicken-stick.jpeg'],
            ['category' => 'Snack & Treat', 'nama_produk' => 'Dreamies Cat Treat', 'harga' => 30000, 'stok' => 30, 'barcode' => '8995555123456', 'deskripsi' => 'Cemilan renyah untuk kucing.', 'gambar' => 'products/dreamies-cat-treat.jpeg'],
            ['category' => 'Snack & Treat', 'nama_produk' => 'Vitakraft Treat', 'harga' => 50000, 'stok' => 15, 'barcode' => '4008239345678', 'deskripsi' => 'Snack premium untuk hewan peliharaan.', 'gambar' => 'products/vitakraft-treat.jpeg'],
            ['category' => 'Snack & Treat', 'nama_produk' => 'Dog Churpi', 'harga' => 55000, 'stok' => 20, 'barcode' => '8994444123456', 'deskripsi' => 'Snack kunyah untuk membantu mengurangi kebosanan.', 'gambar' => 'products/dog-churpi.jpeg'],
            ['category' => 'Snack & Treat', 'nama_produk' => 'Snack Ayam Kering Pet', 'harga' => 25000, 'stok' => 45, 'barcode' => '8993333123456', 'deskripsi' => 'Cemilan ayam kering untuk anjing dan kucing.', 'gambar' => 'products/snack-ayam-kering-pet.jpeg'],
            ['category' => 'Snack & Treat', 'nama_produk' => 'Pocky Pet Snack', 'harga' => 40000, 'stok' => 22, 'barcode' => '8992222123456', 'deskripsi' => 'Snack sehat dengan rasa ayam.', 'gambar' => 'products/pocky-pet-snack.jpeg'],
            ['category' => 'Snack & Treat', 'nama_produk' => 'JerHigh Treat Dog Food', 'harga' => 32000, 'stok' => 28, 'barcode' => '8900010000233', 'deskripsi' => 'Snack tambahan untuk anjing dengan rasa daging pilihan.', 'gambar' => 'products/jerhigh-treat-dog-food.jpeg'],
            ['category' => 'Pasir Kucing', 'nama_produk' => 'Bentonite Cat Litter', 'harga' => 75000, 'stok' => 20, 'barcode' => '8998888001234', 'deskripsi' => 'Pasir bentonite dengan daya serap tinggi.', 'gambar' => 'products/bentonite-cat-litter.jpeg'],
            ['category' => 'Pasir Kucing', 'nama_produk' => 'Tofu Cat Litter Green Tea', 'harga' => 85000, 'stok' => 15, 'barcode' => '6971234567890', 'deskripsi' => 'Pasir tofu ramah lingkungan dengan aroma segar.', 'gambar' => 'products/tofu-cat-litter-green-tea.jpeg'],
            ['category' => 'Pasir Kucing', 'nama_produk' => 'Catsan Hygiene Plus', 'harga' => 95000, 'stok' => 12, 'barcode' => '4008429112345', 'deskripsi' => 'Pasir kucing anti bau dengan daya serap maksimal.', 'gambar' => 'products/catsan-hygiene-plus.jpeg'],
            ['category' => 'Pasir Kucing', 'nama_produk' => 'Crystal Cat Litter', 'harga' => 90000, 'stok' => 10, 'barcode' => '6923456789012', 'deskripsi' => 'Pasir kristal yang cepat menyerap cairan.', 'gambar' => 'products/crystal-cat-litter.jpeg'],
            ['category' => 'Pasir Kucing', 'nama_produk' => 'Zeolite Cat Litter', 'harga' => 45000, 'stok' => 25, 'barcode' => '8991111123456', 'deskripsi' => 'Pasir ekonomis dengan kontrol bau.', 'gambar' => 'products/zeolite-cat-litter.jpeg'],
            ['category' => 'Pasir Kucing', 'nama_produk' => 'Ever Clean Litter', 'harga' => 150000, 'stok' => 8, 'barcode' => '5060255491234', 'deskripsi' => 'Pasir premium dengan aroma tahan lama.', 'gambar' => 'products/ever-clean-litter.jpeg'],
            ['category' => 'Pasir Kucing', 'nama_produk' => 'Sanicat Litter', 'harga' => 85000, 'stok' => 14, 'barcode' => '8411514801234', 'deskripsi' => 'Pasir berkualitas dengan bahan aman.', 'gambar' => 'products/sanicat-litter.jpeg'],
            ['category' => 'Pasir Kucing', 'nama_produk' => 'Petkit Cat Litter', 'harga' => 175000, 'stok' => 7, 'barcode' => '6973293801234', 'deskripsi' => 'Pasir modern untuk kebutuhan kucing indoor.', 'gambar' => 'products/petkit-cat-litter.jpeg'],
            ['category' => 'Mainan', 'nama_produk' => 'Bola Cat Bell', 'harga' => 15000, 'stok' => 50, 'barcode' => '8997777001111', 'deskripsi' => 'Bola mainan dengan suara lonceng.', 'gambar' => 'products/bola-cat-bell.jpg'],
            ['category' => 'Mainan', 'nama_produk' => 'Feather Wand Toy', 'harga' => 25000, 'stok' => 35, 'barcode' => '8997777002222', 'deskripsi' => 'Mainan tongkat bulu untuk aktivitas kucing.', 'gambar' => 'products/feather-wand-toy.jpg'],
            ['category' => 'Mainan', 'nama_produk' => 'Laser Pointer Pet', 'harga' => 20000, 'stok' => 30, 'barcode' => '8997777003333', 'deskripsi' => 'Mainan laser untuk melatih gerak hewan.', 'gambar' => 'products/laser-pointer-pet.jpg'],
            ['category' => 'Mainan', 'nama_produk' => 'Boneka Catnip', 'harga' => 35000, 'stok' => 20, 'barcode' => '8997777004444', 'deskripsi' => 'Boneka dengan aroma catnip untuk kucing.', 'gambar' => 'products/boneka-catnip.jpg'],
            ['category' => 'Mainan', 'nama_produk' => 'Tunnel Kucing', 'harga' => 65000, 'stok' => 10, 'barcode' => '8997777005555', 'deskripsi' => 'Terowongan bermain untuk kucing.', 'gambar' => 'products/tunnel-kucing.jpg'],
            ['category' => 'Mainan', 'nama_produk' => 'Frisbee Dog Toy', 'harga' => 55000, 'stok' => 12, 'barcode' => '8997777007777', 'deskripsi' => 'Mainan lempar untuk anjing.', 'gambar' => 'products/frisbee-dog-toy.jpg'],
            ['category' => 'Mainan', 'nama_produk' => 'Chew Toy Puppy', 'harga' => 40000, 'stok' => 25, 'barcode' => '8997777008888', 'deskripsi' => 'Mainan kunyah aman untuk anak anjing.', 'gambar' => 'products/chew-toy-puppy.jpg'],
            ['category' => 'Mainan', 'nama_produk' => 'Rope Toy Anjing', 'harga' => 45000, 'stok' => 18, 'barcode' => '8997777006666', 'deskripsi' => 'Mainan tali untuk aktivitas anjing.', 'gambar' => null],
            ['category' => 'Aksesoris', 'nama_produk' => 'Kalung Kucing Adjustable', 'harga' => 30000, 'stok' => 25, 'barcode' => '8995555001234', 'deskripsi' => 'Kalung ringan dengan ukuran yang bisa disesuaikan.', 'gambar' => 'products/kalung-kucing-adjustable.jpeg'],
            ['category' => 'Aksesoris', 'nama_produk' => 'Harness Pet Premium', 'harga' => 75000, 'stok' => 15, 'barcode' => '8995555002345', 'deskripsi' => 'Harness nyaman untuk berjalan bersama hewan.', 'gambar' => 'products/harness-pet-premium.webp'],
            ['category' => 'Aksesoris', 'nama_produk' => 'Tempat Makan Stainless', 'harga' => 45000, 'stok' => 20, 'barcode' => '8995555003456', 'deskripsi' => 'Tempat makan tahan lama dan mudah dibersihkan.', 'gambar' => 'products/tempat-makan-stainless.jpeg'],
            ['category' => 'Aksesoris', 'nama_produk' => 'Carrier Pet', 'harga' => 250000, 'stok' => 8, 'barcode' => '8995555004567', 'deskripsi' => 'Tas pembawa hewan untuk perjalanan.', 'gambar' => 'products/carrier-pet.jpeg'],
            ['category' => 'Aksesoris', 'nama_produk' => 'Tempat Tidur Pet', 'harga' => 175000, 'stok' => 10, 'barcode' => '8995555005678', 'deskripsi' => 'Kasur nyaman untuk tempat istirahat hewan.', 'gambar' => 'products/tempat-tidur-pet.jpeg'],
            ['category' => 'Aksesoris', 'nama_produk' => 'Botol Minum Pet', 'harga' => 65000, 'stok' => 18, 'barcode' => '8995555006789', 'deskripsi' => 'Botol minum portable untuk hewan.', 'gambar' => 'products/botol-minum-pet.jpeg'],
            ['category' => 'Aksesoris', 'nama_produk' => 'Sisir Bulu Pet', 'harga' => 35000, 'stok' => 30, 'barcode' => '8995555007890', 'deskripsi' => 'Sisir grooming untuk menjaga bulu rapi.', 'gambar' => 'products/sisir-bulu-pet.jpeg'],
            ['category' => 'Aksesoris', 'nama_produk' => 'Tali Leash Anjing', 'harga' => 60000, 'stok' => 20, 'barcode' => '8995555008901', 'deskripsi' => 'Tali jalan anjing dengan bahan kuat.', 'gambar' => 'products/tali-leash-anjing.jpeg'],
            ['category' => 'Vitamin', 'nama_produk' => 'Nutri Plus Gel Pet', 'harga' => 85000, 'stok' => 15, 'barcode' => '8994444001234', 'deskripsi' => 'Vitamin gel untuk meningkatkan energi hewan.', 'gambar' => 'products/nutri-plus-gel-pet.jpeg'],
            ['category' => 'Vitamin', 'nama_produk' => 'Omega 3 Fish Oil Pet', 'harga' => 95000, 'stok' => 10, 'barcode' => '8994444002345', 'deskripsi' => 'Suplemen untuk kesehatan kulit dan bulu.', 'gambar' => 'products/omega-3-fish-oil-pet.jpeg'],
            ['category' => 'Vitamin', 'nama_produk' => 'Probiotic Pet Care', 'harga' => 65000, 'stok' => 18, 'barcode' => '8994444003456', 'deskripsi' => 'Membantu menjaga sistem pencernaan.', 'gambar' => 'products/probiotic-pet-care.jpeg'],
            ['category' => 'Vitamin', 'nama_produk' => 'Calcium Pet Supplement', 'harga' => 70000, 'stok' => 15, 'barcode' => '8994444004567', 'deskripsi' => 'Vitamin kalsium untuk tulang hewan.', 'gambar' => 'products/calcium-pet-supplement.jpeg'],
            ['category' => 'Vitamin', 'nama_produk' => 'Beaphar Multi Vitamin', 'harga' => 120000, 'stok' => 8, 'barcode' => '8711234567890', 'deskripsi' => 'Multivitamin lengkap untuk hewan.', 'gambar' => 'products/beaphar-multi-vitamin.jpeg'],
            ['category' => 'Vitamin', 'nama_produk' => 'Vitamin B Complex Pet', 'harga' => 50000, 'stok' => 20, 'barcode' => '8994444005678', 'deskripsi' => 'Vitamin tambahan untuk menjaga kesehatan.', 'gambar' => 'products/vitamin-b-complex-pet.jpeg'],
            ['category' => 'Vitamin', 'nama_produk' => 'Imboost Pet', 'harga' => 90000, 'stok' => 12, 'barcode' => '8994444006789', 'deskripsi' => 'Suplemen daya tahan tubuh hewan.', 'gambar' => 'products/imboost-pet.jpeg'],
            ['category' => 'Vitamin', 'nama_produk' => 'Kucing Fit Vitamin', 'harga' => 45000, 'stok' => 25, 'barcode' => '8994444007890', 'deskripsi' => 'Vitamin harian untuk kucing.', 'gambar' => 'products/kucing-fit-vitamin.jpeg'],
            ['category' => 'Grooming', 'nama_produk' => 'Shampoo Kucing', 'harga' => 55000, 'stok' => 25, 'barcode' => '8993333001234', 'deskripsi' => 'Shampoo khusus kucing untuk membersihkan bulu.', 'gambar' => 'products/shampoo-kucing.jpg'],
            ['category' => 'Grooming', 'nama_produk' => 'Shampoo Anjing', 'harga' => 65000, 'stok' => 20, 'barcode' => '8993333002345', 'deskripsi' => 'Shampoo anjing dengan formula lembut.', 'gambar' => 'products/shampoo-anjing.jpg'],
            ['category' => 'Grooming', 'nama_produk' => 'Conditioner Pet', 'harga' => 60000, 'stok' => 15, 'barcode' => '8993333003456', 'deskripsi' => 'Conditioner untuk melembutkan bulu hewan.', 'gambar' => 'products/conditioner-pet.jpg'],
            ['category' => 'Grooming', 'nama_produk' => 'Pet Hair Dryer', 'harga' => 250000, 'stok' => 8, 'barcode' => '8993333004567', 'deskripsi' => 'Pengering bulu dengan suhu aman.', 'gambar' => 'products/pet-hair-dryer.jpeg'],
            ['category' => 'Grooming', 'nama_produk' => 'Grooming Brush', 'harga' => 40000, 'stok' => 30, 'barcode' => '8993333005678', 'deskripsi' => 'Sisir untuk mengurangi bulu rontok.', 'gambar' => 'products/grooming-brush.jpeg'],
            ['category' => 'Grooming', 'nama_produk' => 'Nail Clipper Pet', 'harga' => 35000, 'stok' => 20, 'barcode' => '8993333006789', 'deskripsi' => 'Pemotong kuku hewan yang aman.', 'gambar' => 'products/nail-clipper-pet.jpeg'],
            ['category' => 'Grooming', 'nama_produk' => 'Ear Cleaner Pet', 'harga' => 45000, 'stok' => 18, 'barcode' => '8993333007890', 'deskripsi' => 'Cairan pembersih telinga hewan.', 'gambar' => 'products/ear-cleaner-pet.jpeg'],
            ['category' => 'Grooming', 'nama_produk' => 'Parfum Hewan', 'harga' => 50000, 'stok' => 15, 'barcode' => '8993333008901', 'deskripsi' => 'Parfum khusus hewan dengan aroma lembut.', 'gambar' => 'products/parfum-hewan.jpeg'],
        ];

        foreach ($products as $item) {
            $category = Category::firstOrCreate(['nama_kategori' => $item['category']]);

            $gambarPath = null;

            if ($item['gambar']) {
                // $item['gambar'] contoh: 'products/nama-file.jpg'
                $filename = basename($item['gambar']);
                $src = $sourceDir . DIRECTORY_SEPARATOR . $filename;
                $dest = $destDir . DIRECTORY_SEPARATOR . $filename;

                if (File::exists($src)) {
                    File::copy($src, $dest);
                    $gambarPath = 'products/' . $filename;
                }
            }

            Product::updateOrCreate(
                ['barcode' => $item['barcode']],
                [
                    'category_id' => $category->id,
                    'nama_produk' => $item['nama_produk'],
                    'harga' => $item['harga'],
                    'stok' => $item['stok'],
                    'gambar' => $gambarPath,
                    'deskripsi' => $item['deskripsi'],
                ]
            );
        }
    }
}