@extends('layouts.customer')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <h1 class="text-3xl font-bold text-[#5A3928] mb-2">
            👑 Membership MiPaw
        </h1>

        <p class="text-gray-500 mb-8">
            Nikmati berbagai keuntungan sebagai member MiPaw.
        </p>

        @if($membership)

        <div class="grid md:grid-cols-2 gap-6">

            {{-- Kartu Member --}}
            <div class="bg-gradient-to-r from-[#6B412C] to-[#A66C4A] text-white rounded-3xl p-8">

                <h2 class="text-2xl font-bold mb-4">
                    {{ auth()->user()->name }}
                </h2>

                <p class="opacity-80">
                    Kode Member
                </p>

                <h3 class="text-xl font-bold mb-6">
                    {{ $membership->member_code }}
                </h3>

                @if($membership->level == 'regular' || $membership->level == 'silver')

                    <span class="bg-slate-300 text-slate-800 px-4 py-2 rounded-full font-semibold shadow-md">
                        🥈 Silver Paw Member
                    </span>

                @else

                    <span class="bg-yellow-400 text-black px-4 py-2 rounded-full font-semibold shadow-md">
                        🏆 Golden Paw Member
                    </span>

                @endif

            </div>

            {{-- Informasi --}}
            <div class="space-y-5">

                <div class="bg-gray-100 rounded-2xl p-5">

                    <p class="text-gray-500">
                        Total Poin
                    </p>

                    <h2 class="text-4xl font-bold text-green-600">
                        {{ $membership->poin }}
                    </h2>

                </div>

                <div class="bg-gray-100 rounded-2xl p-5">

                    <p class="text-gray-500">
                        Status Membership
                    </p>

                    <h2 class="text-2xl font-bold text-[#6B412C]">
                        Aktif
                    </h2>

                </div>

            </div>

        </div>

        {{-- Benefit --}}
        <div class="mt-10">

            <h2 class="text-2xl font-bold text-[#5A3928] mb-5">
                Benefit Membership
            </h2>

            @if($membership->level == 'regular' || $membership->level == 'silver')

                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6">

                    <ul class="space-y-3 text-slate-700">

                        <li>✅ <strong>Diskon Grooming 5%</strong> untuk semua jenis hewan.</li>

                        <li>✅ Mendapat poin setiap transaksi produk & grooming.</li>

                        <li>✅ Promo khusus event Silver Paw.</li>

                    </ul>

                </div>

            @else

                <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6">

                    <ul class="space-y-3 text-yellow-900">

                        <li>👑 <strong>Diskon Grooming 10%</strong> tanpa minimum transaksi.</li>

                        <li>👑 Bonus perolehan poin 2x lebih banyak.</li>

                        <li>👑 Prioritas utama jalur booking antrean grooming.</li>

                        <li>👑 Promo eksklusif & Merchandise khusus Golden Paw.</li>

                    </ul>

                </div>

            @endif

        </div>

        @else

        {{-- ------------------------------------------------------------------------- --}}
        {{-- TAMPILAN BARU: PILIHAN DAFTAR MEMBERSHIP MANDIRI (SILVER & GOLDEN PAW)    --}}
        {{-- ------------------------------------------------------------------------- --}}
        <div class="text-center max-w-2xl mx-auto mb-10">
            <h2 class="text-3xl font-bold text-[#6B412C] mb-3">
                Kamu Belum Menjadi Member
            </h2>
            <p class="text-gray-600">
                Pilih tingkatan keanggotaan MiPaw yang kamu inginkan sekarang untuk langsung menikmati keuntungan spesialnya.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 mt-6">
            
            {{-- KARTU 1: SILVER PAW (REGULAR) --}}
            <div class="bg-gradient-to-b from-slate-50 to-slate-100 border-2 border-slate-200 rounded-3xl p-8 flex flex-col justify-between shadow-md hover:shadow-xl transition">
                <div>
                    <div class="text-4xl mb-3">🥈</div>
                    <h3 class="text-2xl font-bold text-slate-800">Silver Paw</h3>
                    <p class="text-gray-500 text-sm mt-1">Keanggotaan Standar MiPaw</p>
                    
                    <div class="my-6">
                        <span class="text-3xl font-extrabold text-slate-800">GRATIS</span>
                    </div>
                    
                    <hr class="border-slate-200 my-4">
                    
                    <ul class="space-y-3 text-left text-slate-700 text-sm mb-6">
                        <li class="flex items-center">✨ Diskon Grooming 5%</li>
                        <li class="flex items-center">✨ Dapatkan Poin Tiap Transaksi</li>
                        <li class="flex items-center">✨ Akses Promo Member Standar</li>
                    </ul>
                </div>
                
                <form action="{{ route('customer.membership.register') }}" method="POST">
                    @csrf
                    <input type="hidden" name="level" value="silver">
                    <button type="submit" class="w-full bg-slate-700 hover:bg-slate-800 text-white font-bold py-3 px-6 rounded-2xl transition shadow">
                        Daftar Silver Paw
                    </button>
                </form>
            </div>

            {{-- KARTU 2: GOLDEN PAW (PREMIUM) --}}
            <div class="bg-gradient-to-b from-yellow-50 to-amber-50 border-2 border-amber-300 rounded-3xl p-8 flex flex-col justify-between shadow-md hover:shadow-xl transition relative overflow-hidden">
                <div class="absolute top-0 right-0 bg-amber-400 text-amber-950 text-xs font-bold px-4 py-1 rounded-bl-xl uppercase tracking-wider">
                    Paling Populer
                </div>
                <div>
                    <div class="text-4xl mb-3">👑</div>
                    <h3 class="text-2xl font-bold text-amber-900">Golden Paw</h3>
                    <p class="text-amber-700 text-sm mt-1">Keanggotaan Eksklusif VIP</p>
                    
                    <div class="my-6">
                        <span class="text-3xl font-extrabold text-amber-900">Rp 50.000</span>
                        <span class="text-gray-500 text-sm">/selamanya</span>
                    </div>
                    
                    <hr class="border-amber-200 my-4">
                    
                    <ul class="space-y-3 text-left text-amber-900 text-sm mb-6">
                        <li class="flex items-center">🔥 Diskon Grooming 10%</li>
                        <li class="flex items-center">🔥 Bonus Perolehan Poin 2x Lipat</li>
                        <li class="flex items-center">🔥 Jalur Prioritas Booking Antrean</li>
                        <li class="flex items-center">🔥 Akses Promo Eksklusif VIP</li>
                    </ul>
                </div>
                
                <form action="{{ route('customer.membership.register') }}" method="POST">
                    @csrf
                    <input type="hidden" name="level" value="golden">
                    <button type="submit" class="w-full bg-[#6B412C] hover:bg-[#5A3928] text-white font-bold py-3 px-6 rounded-2xl transition shadow">
                        Daftar Golden Paw
                    </button>
                </form>
            </div>

        </div>

        @endif

    </div>

</div>

@endsection
