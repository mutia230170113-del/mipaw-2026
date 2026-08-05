<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MiPaw Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#ead6c0]">

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside class="w-72 bg-[#3d261b] text-white fixed h-full overflow-y-auto">

        {{-- Logo --}}
        <div class="p-6 border-b border-[#5a3928]">

            <h1 class="text-3xl font-bold">
                🐾 MiPaw
            </h1>

            <p class="text-sm text-gray-300">
                Pet Shop & Grooming
            </p>

        </div>

        <nav class="p-5 space-y-6">

            {{-- DASHBOARD --}}
            <div>

                <p class="text-xs uppercase text-gray-400 mb-2 tracking-widest">
                    Dashboard
                </p>

                <!-- Menyalakan menu Dashboard jika aktif -->
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-[#5a3928] font-bold shadow-md' : 'hover:bg-[#5a3928] opacity-80' }}">

                    🏠 Dashboard

                </a>

            </div>


            {{-- MASTER DATA --}}
            <div>

                <p class="text-xs uppercase text-gray-400 mb-2 tracking-widest">
                    Master Data
                </p>

                <div class="space-y-2">

                    <!-- Menyalakan menu Produk jika aktif (termasuk halaman create/edit produk) -->
                    <a href="{{ route('products.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('products.*') ? 'bg-[#5a3928] font-bold shadow-md' : 'hover:bg-[#5a3928] opacity-80' }}">

                        📦 Produk

                    </a>

                    <!-- Menyalakan menu Kategori jika aktif (termasuk halaman create/edit kategori) -->
                    <a href="{{ route('categories.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('categories.*') ? 'bg-[#5a3928] font-bold shadow-md' : 'hover:bg-[#5a3928] opacity-80' }}">

                        🗂 Kategori

                    </a>

                    <!-- Menyalakan menu Customer jika aktif -->
                    <a href="{{ route('customers.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('customers.*') ? 'bg-[#5a3928] font-bold shadow-md' : 'hover:bg-[#5a3928] opacity-80' }}">

                        👥 Customer

                    </a>

                    
                </div>

            </div>


            {{-- TRANSAKSI --}}
            <div>

                <p class="text-xs uppercase text-gray-400 mb-2 tracking-widest">
                    Transaksi
                </p>

                <div class="space-y-2">

                    <!-- Menyalakan menu Pesanan jika aktif -->
                    <a href="{{ route('orders.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('orders.*') ? 'bg-[#5a3928] font-bold shadow-md' : 'hover:bg-[#5a3928] opacity-80' }}">

                        🛒 Pesanan

                    </a>

                    <!-- Menyalakan menu Pembayaran jika aktif -->
                    <a href="{{ route('payments.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('payments.*') ? 'bg-[#5a3928] font-bold shadow-md' : 'hover:bg-[#5a3928] opacity-80' }}">

                        💳 Pembayaran

                    </a>

                </div>

            </div>


            {{-- GROOMING --}}
            <div>

                <p class="text-xs uppercase text-gray-400 mb-2 tracking-widest">
                    Grooming
                </p>

                <div class="space-y-2">

                    <!-- Menyalakan menu Paket Grooming jika aktif -->
                    <a href="{{ route('grooming-services.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('grooming-services.*') ? 'bg-[#5a3928] font-bold shadow-md' : 'hover:bg-[#5a3928] opacity-80' }}">

                        ✂️ Paket Grooming

                    </a>

                    <!-- Menyalakan menu Data Hewan jika aktif -->
                    <a href="{{ route('pets.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('pets.*') ? 'bg-[#5a3928] font-bold shadow-md' : 'hover:bg-[#5a3928] opacity-80' }}">

                        🐾 Data Hewan

                    </a>

                    <!-- Menyalakan menu Booking Grooming jika aktif -->
                    <a href="{{ route('grooming-bookings.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('grooming-bookings.*') ? 'bg-[#5a3928] font-bold shadow-md' : 'hover:bg-[#5a3928] opacity-80' }}">

                        🐶 Booking Grooming

                    </a>

                </div>

            </div>


            {{-- PROMO --}}
            <div>

                <p class="text-xs uppercase text-gray-400 mb-2 tracking-widest">
                    Promo
                </p>

                <div class="space-y-2">

                    <!-- Menyalakan menu Membership jika aktif -->
                    <a href="{{ route('memberships.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('memberships.*') ? 'bg-[#5a3928] font-bold shadow-md' : 'hover:bg-[#5a3928] opacity-80' }}">

                        ⭐ Membership

                    </a>

                </div>

            </div>


            {{-- LAPORAN --}}
            <div>

                <p class="text-xs uppercase text-gray-400 mb-2 tracking-widest">
                    Laporan
                </p>

                <div class="space-y-2">

                    <!-- Menyalakan menu Laporan jika aktif -->
                    <a href="{{ route('reports.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl transition {{ request()->routeIs('reports.*') ? 'bg-[#5a3928] font-bold shadow-md' : 'hover:bg-[#5a3928] opacity-80' }}">

                        📊 Laporan

                    </a>

                </div>

            </div>

            {{-- MENU AKUN & TOMBOL LOGOUT BARU --}}
            <div class="pt-4 border-t border-[#5a3928]">
                <p class="text-xs uppercase text-gray-400 mb-2 tracking-widest">
                    Akun
                </p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                        class="w-full flex items-center gap-3 px-4 py-3 rounded-xl bg-red-900/40 hover:bg-red-700 text-red-200 hover:text-white font-semibold transition text-left">
                        Logout 🚪
                    </button>
                </form>
            </div>

        </nav>

    </aside>


    {{-- CONTENT --}}
    <main class="ml-72 flex-1 p-10">

        <div class="max-w-7xl mx-auto">

            @yield('content')

        </div>

        {{-- TEKS HAK CIPTA / COPYRIGHT SEBELUM PENUTUP MAIN --}}
        <div class="text-center text-sm text-[#5a3928]/60 mt-16 font-medium">
            &copy;mipaw2026. All Rights Reserved.
        </div>

    </main>

</div>

</body>
</html>