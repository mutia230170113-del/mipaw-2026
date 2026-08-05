<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiPaw Login</title>
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<!-- BACKGROUND LUAR: Menggunakan abu-abu netral tipis agar tidak mengganggu fokus mata -->
<div class="min-h-screen bg-gradient-to-r from-[#b47d5b] via-[#d8b08f] to-[#dea969] flex items-center justify-center p-8">

    <!-- CONTAINER UTAMA: Gradasi dibuat jauh lebih terang, porsi warna cokelat jingga hangat dibuat dominan (70% area kanan ke tengah) -->
    <div class="
            w-[1100px]
            h-[650px]
            bg-gradient-to-tr from-[#1d4f3a] via-[#e38451] to-[#f1ba9c]
            rounded-[40px]
            shadow-2xl
            overflow-hidden
            grid
            grid-cols-2
            relative
        ">

        {{-- LEFT SIDE --}}
        <div class="
                bg-transparent
                p-14
                relative
                overflow-hidden
                flex
                flex-col
            ">

            {{-- Bagian Atas: Logo, Judul, dan Menu --}}
            <div class="relative z-10 flex flex-col">
                {{-- Logo --}}
                <div class="flex items-center gap-4">
                    <div class="text-6xl drop-shadow-md">🐾</div>
                    <div>
                        <h1 class="text-4xl font-bold text-[#fcf2e8] tracking-wide drop-shadow">MiPaw</h1>
                        <p class="text-[#f5e6d3] text-sm font-medium drop-shadow-sm">Pet Shop & Grooming</p>
                    </div>
                </div>

                {{-- Title --}}
                <h2 class="mt-8 text-5xl font-bold text-[#fcf2e8] leading-tight drop-shadow-md">
                    Little Paws, <br>
                    <span class="text-[#ffb1a4]">Big Love ❤️</span>
                </h2>

                <p class="mt-4 text-base text-[#f5e6d3] leading-relaxed max-w-[90%] drop-shadow-sm">
                    Kebutuhan hewan kesayangan, produk terbaik, dan layanan grooming profesional dalam satu tempat.
                </p>

                {{-- MENU CARD --}}
                <!-- Menggunakan background semi-transparan kecokelatan dengan garis tepi halus -->
                <div class="flex gap-4 mt-6">
                    <div class="bg-[#4a3427]/40 backdrop-blur-sm border border-[#fff5eb]/20 rounded-2xl p-4 w-28 shadow-md text-center">
                        <span class="text-2xl block mb-1">🛒</span>
                        <p class="font-semibold text-[#fcf2e8] text-xs">Produk</p>
                    </div>

                    <div class="bg-[#4a3427]/40 backdrop-blur-sm border border-[#fff5eb]/20 rounded-2xl p-4 w-28 shadow-md text-center">
                        <span class="text-2xl block mb-1">✂️</span>
                        <p class="font-semibold text-[#fcf2e8] text-xs">Grooming</p>
                    </div>

                    <div class="bg-[#4a3427]/40 backdrop-blur-sm border border-[#fff5eb]/20 rounded-2xl p-4 w-28 shadow-md text-center">
                        <span class="text-2xl block mb-1">⭐</span>
                        <p class="font-semibold text-[#fcf2e8] text-xs">Member</p>
                    </div>
                </div>
            </div>

            {{-- DEKORASI JEJAK KAKI ALAMI --}}
            <div class="absolute right-6 top-1/3 text-white/10 text-4xl space-y-4 select-none pointer-events-none">
                <div class="rotate-12 translate-x-2">🐾</div>
                <div class="-rotate-12 translate-x-6">🐾</div>
                <div class="rotate-45 translate-x-10">🐾</div>
            </div>

            {{-- PET IMAGE --}}
            <div class="absolute bottom-0 left-0 w-full flex justify-center z-0 pointer-events-none">
                <img
                    src="{{ asset('images/pet.png') }}"
                    class="w-[430px] max-w-[90%] h-auto object-contain block align-bottom brightness-105"
                    alt="Pet Image"
                >
            </div>
        </div>

        {{-- RIGHT SIDE --}}
        <div class="
                bg-transparent
                p-16
                flex
                flex-col
                justify-center
                relative
                z-10
            ">

            <!-- Warna judul Selamat Datang cokelat gelap arang pekat sesuai foto -->
            <h1 class="text-5xl font-bold text-[#3d1a0b] tracking-tight">Selamat Datang</h1>
            <p class="mt-3 text-[#522916] text-lg font-medium">Masuk ke akun MiPaw</p>

            <form method="POST" action="{{ route('login') }}" class="mt-10">
                @csrf

                <label class="text-[#3d1a0b] font-semibold text-sm">Email</label>
                <!-- KOLOM INPUT: Diubah menjadi krem-putih pucat dengan lengkungan penuh (rounded-full) -->
                <div class="relative mt-2">
                    <input
                        name="email"
                        type="email"
                        placeholder="Email"
                        class="w-full rounded-full border border-[#3d1a0b]/20 bg-[#fbf6f0] p-4 pl-6 text-[#3d1a0b] font-medium placeholder-[#8a7263] focus:outline-none focus:ring-2 focus:ring-[#3d1a0b] shadow-inner"
                        required
                    >
                    <!-- Tambahan visual jejak kaki kecil di ujung kanan kolom input -->
                    <span class="absolute right-6 top-1/2 -translate-y-1/2 text-lg opacity-40 select-none">🐾</span>
                </div>

                <label class="block mt-5 text-[#3d1a0b] font-semibold text-sm">Password</label>
                <div class="relative mt-2">
                    <input
                        name="password"
                        type="password"
                        placeholder="Password"
                        class="w-full rounded-full border border-[#3d1a0b]/20 bg-[#fbf6f0] p-4 pl-6 text-[#3d1a0b] font-medium placeholder-[#8a7263] focus:outline-none focus:ring-2 focus:ring-[#3d1a0b] shadow-inner"
                        required
                    >
                    <span class="absolute right-6 top-1/2 -translate-y-1/2 text-lg opacity-40 select-none">🐾</span>
                </div>

                <div class="flex justify-between mt-5 text-[#3d1a0b] text-sm font-semibold">
                    <label class="flex items-center gap-2 cursor-pointer select-none">
                        <input type="checkbox" class="w-4 h-4 rounded border-[#522916] text-[#522916] focus:ring-[#522916] accent-[#522916]">
                        Ingat saya
                    </label>
                    <a href="{{ route('register') }}" class="hover:underline text-[#3d1a0b] font-bold">
                        Daftar
                    </a>
                </div>

                <!-- TOMBOL MASUK: Gradasi warna cokelat kayu hangat dengan bentuk kapsul lonjong sempurna -->
                <button class="
                        mt-8
                        w-full
                        bg-gradient-to-r from-[#805338] via-[#996545] to-[#805338]
                        text-[#fff5eb]
                        py-4
                        rounded-full
                        font-bold
                        text-xl
                        tracking-wider
                        shadow-lg shadow-black/20
                        hover:brightness-110
                        active:scale-[0.99]
                        transition-all
                        cursor-pointer
                        flex
                        items-center
                        justify-center
                        gap-2
                    ">
                    Masuk <span class="text-sm opacity-80">🐾</span>
                </button>
            </form>
        </div>

    </div>

</body>
</html>