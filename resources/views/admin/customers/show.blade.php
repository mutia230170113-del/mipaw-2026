@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-[#5A3928]">
                Detail Customer 👤
            </h1>

            <p class="text-gray-500 mt-2">
                Informasi lengkap customer MiPaw.
            </p>

        </div>

        <a href="{{ route('customers.index') }}"
            class="bg-gray-300 hover:bg-gray-400 px-6 py-3 rounded-2xl font-semibold">

            ← Kembali

        </a>

    </div>


    {{-- Card --}}
    <div class="bg-white rounded-3xl shadow-lg p-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            {{-- Nama --}}
            <div>

                <label class="text-sm text-gray-500">
                    Nama Lengkap
                </label>

                <div class="mt-2 text-xl font-bold text-[#5A3928]">
                    {{ $customer->name }}
                </div>

            </div>

            {{-- Email --}}
            <div>

                <label class="text-sm text-gray-500">
                    Email
                </label>

                <div class="mt-2 text-xl">
                    {{ $customer->email }}
                </div>

            </div>

            {{-- Role --}}
            <div>

                <label class="text-sm text-gray-500">
                    Role
                </label>

                <div class="mt-2">

                    <span class="bg-blue-100 text-blue-700 px-4 py-2 rounded-full">

                        {{ ucfirst($customer->role) }}

                    </span>

                </div>

            </div>

            {{-- Nomor HP --}}
            <div>

                <label class="text-sm text-gray-500">
                    Nomor HP
                </label>

                <div class="mt-2">

                    {{ $customer->customer->no_hp ?? '-' }}

                </div>

            </div>

            {{-- Alamat --}}
            <div class="md:col-span-2">

                <label class="text-sm text-gray-500">
                    Alamat
                </label>

                <div class="mt-2 bg-[#FFF8F2] p-5 rounded-2xl">

                    {{ $customer->customer->alamat ?? '-' }}

                </div>

            </div>

            {{-- Tanggal Bergabung --}}
            <div>

                <label class="text-sm text-gray-500">
                    Bergabung Sejak
                </label>

                <div class="mt-2">

                    {{ $customer->created_at->format('d F Y') }}

                </div>

            </div>

        </div>

        {{-- Tombol --}}
        <div class="flex gap-3 mt-10">

            <a href="{{ route('customers.edit',$customer) }}"
                class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-3 rounded-2xl">

                ✏️ Edit

            </a>

            <form action="{{ route('customers.destroy',$customer) }}"
                method="POST">

                @csrf
                @method('DELETE')

                <button
                    onclick="return confirm('Yakin ingin menghapus customer ini?')"
                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-2xl">

                    🗑 Hapus

                </button>

            </form>

        </div>

    </div>

</div>

@endsection