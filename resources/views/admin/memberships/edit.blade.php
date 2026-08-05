@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div>

        <h1 class="text-4xl font-bold text-[#5A3928]">
            Edit Membership 👑
        </h1>

        <p class="text-gray-500 mt-2">
            Perbarui data membership customer.
        </p>

    </div>

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form action="{{ route('memberships.update', $membership) }}" method="POST">

            @csrf
            @method('PUT')

            {{-- Customer --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Customer
                </label>

                <select
                    name="customer_id"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3"
                    required>

                    @foreach($customers as $customer)

                        <option
                            value="{{ $customer->id }}"
                            {{ old('customer_id', $membership->customer_id) == $customer->id ? 'selected' : '' }}>

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
                    value="{{ $membership->member_code }}"
                    class="w-full rounded-2xl border border-gray-300 bg-gray-100 px-4 py-3"
                    readonly>

                <p class="text-sm text-gray-500 mt-2">
                    Kode member dibuat otomatis oleh sistem dan tidak dapat diubah.
                </p>

            </div>

            {{-- Level Membership --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Level Membership
                </label>

                <select
                    name="level"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3"
                    required>

                    <option value="regular"
                        {{ old('level', $membership->level) == 'regular' ? 'selected' : '' }}>
                        🩵 Regular Member
                    </option>

                    <option value="premium"
                        {{ old('level', $membership->level) == 'premium' ? 'selected' : '' }}>
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
                    Poin
                </label>

                <input
                    type="number"
                    name="poin"
                    value="{{ old('poin', $membership->poin) }}"
                    min="0"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3"
                    required>

                <p class="text-sm text-gray-500 mt-2">
                    Poin dapat diubah oleh admin bila diperlukan.
                </p>

                @error('poin')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-8 py-3 rounded-2xl font-semibold">

                    💾 Update Membership

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