@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div>

        <h1 class="text-4xl font-bold text-[#5A3928]">
            Edit Order 📦
        </h1>

        <p class="text-gray-500">
            Perbarui status pesanan customer.
        </p>

    </div>

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form action="{{ route('orders.update',$order) }}" method="POST">

            @csrf
            @method('PUT')

            {{-- Invoice --}}
            <div class="mb-5">

                <label class="font-semibold text-[#5A3928]">
                    Invoice
                </label>

                <input
                    type="text"
                    value="{{ $order->invoice }}"
                    class="w-full mt-2 rounded-2xl border-gray-300 bg-gray-100"
                    readonly>

            </div>

            {{-- Customer --}}
            <div class="mb-5">

                <label class="font-semibold text-[#5A3928]">
                    Customer
                </label>

                <input
                    type="text"
                    value="{{ $order->customer->user->name }}"
                    class="w-full mt-2 rounded-2xl border-gray-300 bg-gray-100"
                    readonly>

            </div>

            {{-- Tanggal --}}
            <div class="mb-5">

                <label class="font-semibold text-[#5A3928]">
                    Tanggal
                </label>

                <input
                    type="text"
                    value="{{ \Carbon\Carbon::parse($order->tanggal)->format('d F Y') }}"
                    class="w-full mt-2 rounded-2xl border-gray-300 bg-gray-100"
                    readonly>

            </div>

            {{-- Total --}}
            <div class="mb-5">

                <label class="font-semibold text-[#5A3928]">
                    Total
                </label>

                <input
                    type="text"
                    value="Rp {{ number_format($order->total,0,',','.') }}"
                    class="w-full mt-2 rounded-2xl border-gray-300 bg-gray-100"
                    readonly>

            </div>

            {{-- Status --}}
            <div class="mb-8">

                <label class="font-semibold text-[#5A3928]">
                    Status Order
                </label>

                <select
                    name="status"
                    class="w-full mt-2 rounded-2xl border-gray-300">

                    <option
                        value="pending"
                        {{ $order->status=='pending' ? 'selected' : '' }}>

                        Pending

                    </option>

                    <option
                        value="diproses"
                        {{ $order->status=='diproses' ? 'selected' : '' }}>

                        Diproses

                    </option>

                    <option
                        value="selesai"
                        {{ $order->status=='selesai' ? 'selected' : '' }}>

                        Selesai

                    </option>

                    <option
                        value="dibatalkan"
                        {{ $order->status=='dibatalkan' ? 'selected' : '' }}>

                        Dibatalkan

                    </option>

                </select>

                @error('status')

                    <p class="text-red-500 text-sm mt-2">

                        {{ $message }}

                    </p>

                @enderror

            </div>

            {{-- Tombol --}}
            <div class="flex gap-3">

                <button
                    class="bg-[#6B412C] text-white px-7 py-3 rounded-2xl hover:bg-[#5A3928] transition">

                    Update Status

                </button>

                <a
                    href="{{ route('orders.index') }}"
                    class="bg-gray-300 px-7 py-3 rounded-2xl hover:bg-gray-400 transition">

                    Batal

                </a>

            </div>

        </form>

    </div>

</div>

@endsection