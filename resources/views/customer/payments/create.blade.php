@extends('layouts.customer')

@section('content')

<div class="max-w-2xl mx-auto">

    <div class="bg-white rounded-3xl shadow p-8">

        {{-- Judul --}}
        <h1
            class="text-3xl font-bold text-[#5A3928]">

            Upload Bukti Pembayaran

        </h1>

        <p
            class="text-gray-500 mt-2">

            Invoice Order :
            <span class="font-semibold">
                {{ $order->invoice }}
            </span>

        </p>

        <h2
            class="text-green-600 text-3xl font-bold mt-6">

            Rp {{ number_format($order->total,0,',','.') }}

        </h2>

        <form
            action="{{ route('customer.payments.store', $order) }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6 mt-8">

            @csrf

            {{-- Metode --}}
            <div>

                <label
                    class="block font-semibold mb-2">

                    Metode Pembayaran

                </label>

                <select
                    name="metode"
                    class="w-full border rounded-xl p-3">

                    <option value="cash"
                        {{ old('metode') == 'cash' ? 'selected' : '' }}>

                        💵 Cash

                    </option>

                    <option value="qris"
                        {{ old('metode') == 'qris' ? 'selected' : '' }}>

                        📱 QRIS

                    </option>

                    <option value="transfer"
                        {{ old('metode') == 'transfer' ? 'selected' : '' }}>

                        🏦 Transfer Bank

                    </option>

                </select>

                @error('metode')

                    <p class="text-red-500 text-sm mt-2">

                        {{ $message }}

                    </p>

                @enderror

            </div>


            {{-- Bukti --}}
            <div>

                <label
                    class="block font-semibold mb-2">

                    Bukti Pembayaran

                </label>

                <input
                    type="file"
                    name="bukti"
                    accept="image/*"
                    class="w-full border rounded-xl p-3">

                <p class="text-gray-500 text-sm mt-2">

                    Format: JPG, JPEG, PNG (maksimal 2 MB)

                </p>

                @error('bukti')

                    <p class="text-red-500 text-sm mt-2">

                        {{ $message }}

                    </p>

                @enderror

            </div>


            {{-- Tombol --}}
            <div class="flex gap-4 pt-4">

                <a
                    href="{{ route('customer.orders.show', $order) }}"
                    class="flex-1 text-center bg-gray-200 hover:bg-gray-300 py-3 rounded-xl font-semibold">

                    Kembali

                </a>

                <button
                    type="submit"
                    class="flex-1 bg-[#6B412C] hover:bg-[#5A3928] text-white py-3 rounded-xl font-bold">

                    Kirim Pembayaran

                </button>

            </div>

        </form>

    </div>

</div>

@endsection