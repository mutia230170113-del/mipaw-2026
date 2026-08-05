@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div>

        <h1 class="text-4xl font-bold text-[#5A3928]">
            Tambah Customer 👤
        </h1>

        <p class="text-gray-500 mt-2">
            Tambahkan customer baru ke dalam sistem MiPaw.
        </p>

    </div>


    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form action="{{ route('customers.store') }}" method="POST">

            @csrf

            {{-- Nama --}}
            <div class="mb-6">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full rounded-2xl border-gray-300 focus:border-[#6B412C] focus:ring-[#6B412C]"
                    placeholder="Masukkan nama customer">

                @error('name')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Email --}}
            <div class="mb-6">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full rounded-2xl border-gray-300 focus:border-[#6B412C] focus:ring-[#6B412C]"
                    placeholder="Masukkan email">

                @error('email')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Password --}}
            <div class="mb-6">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="w-full rounded-2xl border-gray-300 focus:border-[#6B412C] focus:ring-[#6B412C]"
                    placeholder="Masukkan password">

                @error('password')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Konfirmasi Password --}}
            <div class="mb-6">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    class="w-full rounded-2xl border-gray-300 focus:border-[#6B412C] focus:ring-[#6B412C]"
                    placeholder="Ulangi password">

            </div>


            {{-- Nomor HP --}}
            <div class="mb-6">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Nomor HP
                </label>

                <input
                    type="text"
                    name="no_hp"
                    value="{{ old('no_hp') }}"
                    class="w-full rounded-2xl border-gray-300 focus:border-[#6B412C] focus:ring-[#6B412C]"
                    placeholder="08xxxxxxxxxx">

                @error('no_hp')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Alamat --}}
            <div class="mb-8">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Alamat
                </label>

                <textarea
                    name="alamat"
                    rows="4"
                    class="w-full rounded-2xl border-gray-300 focus:border-[#6B412C] focus:ring-[#6B412C]"
                    placeholder="Masukkan alamat customer">{{ old('alamat') }}</textarea>

                @error('alamat')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Tombol --}}
            <div class="flex gap-4">

                <button
                    type="submit"
                    class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-8 py-3 rounded-2xl font-semibold transition">

                    💾 Simpan

                </button>

                <a
                    href="{{ route('customers.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 px-8 py-3 rounded-2xl font-semibold">

                    Batal

                </a>

            </div>

        </form>

    </div>

</div>

@endsection