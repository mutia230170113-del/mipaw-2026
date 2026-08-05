@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div>

        <h1 class="text-4xl font-bold text-[#5A3928]">
            Detail Membership 👑
        </h1>

        <p class="text-gray-500 mt-2">
            Informasi lengkap membership customer MiPaw.
        </p>

    </div>

    <div class="bg-white rounded-3xl shadow-lg p-8">

        {{-- Customer --}}
        <div class="mb-6">

            <label class="block font-semibold text-[#5A3928] mb-2">
                Customer
            </label>

            <input
                type="text"
                value="{{ $membership->customer->user->name }}"
                class="w-full rounded-2xl border border-gray-300 px-4 py-3 bg-gray-100"
                readonly>

        </div>

        {{-- Kode Member --}}
        <div class="mb-6">

            <label class="block font-semibold text-[#5A3928] mb-2">
                Kode Member
            </label>

            <input
                type="text"
                value="{{ $membership->member_code }}"
                class="w-full rounded-2xl border border-gray-300 px-4 py-3 bg-gray-100 font-bold"
                readonly>

        </div>

        {{-- Level --}}
        <div class="mb-6">

            <label class="block font-semibold text-[#5A3928] mb-2">
                Level Membership
            </label>

            <div class="mt-2">

                @if($membership->level == 'regular')

                    <span class="inline-block px-4 py-2 rounded-full bg-blue-100 text-blue-700 font-semibold">

                        🩵 Regular Member

                    </span>

                @else

                    <span class="inline-block px-4 py-2 rounded-full bg-yellow-100 text-yellow-700 font-semibold">

                        👑 Premium Member

                    </span>

                @endif

            </div>

        </div>

        {{-- Poin --}}
        <div class="mb-8">

            <label class="block font-semibold text-[#5A3928] mb-2">
                Total Poin
            </label>

            <input
                type="text"
                value="{{ number_format($membership->poin) }} Poin"
                class="w-full rounded-2xl border border-gray-300 px-4 py-3 bg-gray-100 font-bold text-green-600"
                readonly>

        </div>

        {{-- Benefit --}}
        <div class="mb-8">

            <h3 class="font-bold text-[#5A3928] text-xl mb-3">
                Benefit Membership
            </h3>

            @if($membership->level == 'regular')

                <div class="bg-blue-50 rounded-2xl p-6">

                    <ul class="list-disc ml-6 space-y-2 text-gray-700">

                        <li>🩵 Diskon Grooming 5%</li>

                        <li>🩵 Mendapat 1 poin setiap transaksi Rp10.000.</li>

                        <li>🩵 Promo khusus member.</li>

                    </ul>

                </div>

            @else

                <div class="bg-yellow-50 rounded-2xl p-6">

                    <ul class="list-disc ml-6 space-y-2 text-gray-700">

                        <li>👑 Diskon Grooming 10%</li>

                        <li>👑 Mendapat 2 poin setiap transaksi Rp10.000.</li>

                        <li>👑 Prioritas booking grooming.</li>

                        <li>👑 Promo eksklusif Premium Member.</li>

                    </ul>

                </div>

            @endif

        </div>

        <div class="flex gap-3">

            <a
                href="{{ route('memberships.edit', $membership) }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-8 py-3 rounded-2xl font-semibold">

                ✏ Edit

            </a>

            <a
                href="{{ route('memberships.index') }}"
                class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-8 py-3 rounded-2xl font-semibold">

                ← Kembali

            </a>

        </div>

    </div>

</div>

@endsection