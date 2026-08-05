@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div>

        <h1 class="text-4xl font-bold text-[#5A3928]">
            Tambah Membership 👑
        </h1>

        <p class="text-gray-500 mt-2">
            Tambahkan membership baru untuk customer MiPaw.
        </p>

    </div>

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form action="{{ route('memberships.store') }}" method="POST">

            @csrf

            {{-- Customer --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Customer
                </label>

                <select
                    name="customer_id"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3"
                    required>

                    <option value="">-- Pilih Customer --</option>

                    @foreach($customers as $customer)

                        <option
                            value="{{ $customer->id }}"
                            {{ old('customer_id') == $customer->id ? 'selected' : '' }}>

                            {{ $customer->user->name }}

                        </option>

                    @endforeach

                </select>

                @error('customer_id')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            {{-- Kode Member --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Kode Member
                </label>

                <input
                    type="text"
                    value="Otomatis dibuat oleh sistem"
                    class="w-full rounded-2xl border border-gray-300 bg-gray-100 px-4 py-3"
                    readonly>

            </div>

            {{-- Level --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Level Membership
                </label>

                <select
                    name="level"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3"
                    required>

                    <option value="regular"
                        {{ old('level') == 'regular' ? 'selected' : '' }}>
                        🩵 Regular Member
                    </option>

                    <option value="premium"
                        {{ old('level') == 'premium' ? 'selected' : '' }}>
                        👑 Premium Member
                    </option>

                </select>

                @error('level')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            {{-- Poin --}}
            <div class="mb-8">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Poin Awal
                </label>

                <input
                    type="number"
                    name="poin"
                    value="{{ old('poin',0) }}"
                    min="0"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3"
                    required>

                <p class="text-sm text-gray-500 mt-2">
                    Isi 0 jika member baru belum memiliki poin.
                </p>

                @error('poin')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-8 py-3 rounded-2xl font-semibold">

                    💾 Simpan Membership

                </button>

                <a
                    href="{{ route('memberships.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-8 py-3 rounded-2xl font-semibold">

                    ← Kembali

                </a>

            </div>

        </form>

    </div>

</div>

@endsection