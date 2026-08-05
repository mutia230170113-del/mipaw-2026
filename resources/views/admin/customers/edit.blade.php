@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div>

        <h1 class="text-4xl font-bold text-[#5A3928]">
            Edit Customer 👤
        </h1>

        <p class="text-gray-500 mt-2">
            Perbarui data customer MiPaw.
        </p>

    </div>


    {{-- Card --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form action="{{ route('customers.update', $customer) }}" method="POST">

            @csrf
            @method('PUT')

            {{-- Nama --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $customer->name) }}"
                    required
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:border-[#6B412C] focus:ring-[#6B412C]">

                @error('name')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Email --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $customer->email) }}"
                    required
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:border-[#6B412C] focus:ring-[#6B412C]">

                @error('email')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Nomor HP --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Nomor HP
                </label>

                <input
                    type="text"
                    name="no_hp"
                    value="{{ old('no_hp', $customer->customer->no_hp ?? '') }}"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:border-[#6B412C] focus:ring-[#6B412C]">

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
                    rows="5"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:border-[#6B412C] focus:ring-[#6B412C]">{{ old('alamat', $customer->customer->alamat ?? '') }}</textarea>

                @error('alamat')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- Tombol --}}
            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-8 py-3 rounded-2xl font-semibold transition">

                    💾 Update Customer

                </button>

                <a
                    href="{{ route('customers.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-8 py-3 rounded-2xl font-semibold transition">

                    ← Batal

                </a>

            </div>

        </form>

    </div>

</div>

@endsection