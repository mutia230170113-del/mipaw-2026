<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MiPaw Customer</title>

    @vite(['resources/css/app.css'])

</head>

<body class="bg-[#F5E6D3]">

<div class="flex min-h-screen">

    {{-- Sidebar: Ditambahkan fixed, h-screen, top-0, left-0, dan overflow-y-auto --}}
    <aside class="w-72 bg-[#3d261b] text-white flex flex-col fixed h-screen top-0 left-0 overflow-y-auto">

        <div class="py-8 text-center border-b border-white/20">

            <img
                src="{{ asset('images/logo.png') }}"
                class="w-28 mx-auto rounded-xl">

            <h2 class="mt-4 text-3xl font-bold">
                MiPaw
            </h2>

            <p class="text-[#EAD6C0]">
                Customer Panel
            </p>

        </div>

        <nav class="flex-1 px-5 py-6 space-y-2">

            {{-- Dashboard --}}
            <a href="{{ route('customer.dashboard') }}"
                class="block px-4 py-3 rounded-xl transition
                {{ request()->routeIs('customer.dashboard') ? 'bg-[#8A5A40]' : 'hover:bg-[#8A5A40]' }}">

                🏠 Dashboard

            </a>


            {{-- Produk --}}
            <a href="{{ route('customer.products') }}"
                class="block px-4 py-3 rounded-xl transition
                {{ request()->routeIs('customer.products') || request()->routeIs('customer.products.show') ? 'bg-[#8A5A40]' : 'hover:bg-[#8A5A40]' }}">

                🛍 Produk

            </a>


            {{-- Keranjang --}}
            <a href="{{ route('customer.cart.index') }}"
                class="block px-4 py-3 rounded-xl transition
                {{ request()->routeIs('customer.cart.*') ? 'bg-[#8A5A40]' : 'hover:bg-[#8A5A40]' }}">

                🛒 Keranjang

            </a>


            {{-- Order --}}
            <a href="{{ route('customer.orders') }}"
                class="block px-4 py-3 rounded-xl transition
                {{ request()->routeIs('customer.orders') || request()->routeIs('customer.orders.show') ? 'bg-[#8A5A40]' : 'hover:bg-[#8A5A40]' }}">

                📦 Order Saya

            </a>


            {{-- Hewan Saya --}}
            <a href="{{ route('customer.pets') }}"
                class="block px-4 py-3 rounded-xl transition
                {{ request()->routeIs('customer.pets*') ? 'bg-[#8A5A40]' : 'hover:bg-[#8A5A40]' }}">

                🐾 Hewan Saya

            </a>

            {{-- Grooming --}}
            <a href="{{ route('customer.grooming') }}"
                class="block px-4 py-3 rounded-xl transition
                {{ request()->routeIs('customer.grooming*') ? 'bg-[#8A5A40]' : 'hover:bg-[#8A5A40]' }}">

                ✂️ Grooming

            </a>


            {{-- Pembayaran --}}
            <a href="{{ route('customer.payments') }}"
                class="block px-4 py-3 rounded-xl transition
                {{ request()->routeIs('customer.payments') ? 'bg-[#8A5A40]' : 'hover:bg-[#8A5A40]' }}">

                💳 Pembayaran

            </a>


            {{-- Membership --}}
            <a href="{{ route('customer.membership') }}"
                class="block px-4 py-3 rounded-xl transition
                {{ request()->routeIs('customer.membership') ? 'bg-[#8A5A40]' : 'hover:bg-[#8A5A40]' }}">

                👑 Membership

            </a>


            {{-- Profil --}}
            <a href="{{ route('profile.edit') }}"
                class="block px-4 py-3 rounded-xl transition
                {{ request()->routeIs('profile.edit') ? 'bg-[#8A5A40]' : 'hover:bg-[#8A5A40]' }}">

                👤 Profil

            </a>

        </nav>


        <div class="p-5 border-t border-white/20">

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button
                    type="submit"
                    class="w-full bg-[#A66C4A] hover:bg-[#8A5A40] py-3 rounded-xl font-bold transition">

                    Logout

                </button>

            </form>

        </div>

    </aside>


    {{-- Content: Ditambahkan ml-72 agar konten bergeser ke kanan dan tidak tertabrak sidebar --}}
    <main class="flex-1 p-8 ml-72">

        @yield('content')

    </main>

</div>

</body>

</html>
