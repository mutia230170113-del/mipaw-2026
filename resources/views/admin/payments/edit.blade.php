@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div>

        <h1 class="text-4xl font-bold text-[#5A3928]">
            Edit Pembayaran 💳
        </h1>

        <p class="text-gray-500">
            Perbarui data pembayaran customer.
        </p>

    </div>

    <div class="bg-white rounded-3xl shadow-lg p-8">

        <form
            action="{{ route('payments.update',$payment) }}"
            method="POST"
            enctype="multipart/form-data">

            @csrf
            @method('PUT')

            {{-- Invoice --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Invoice
                </label>

                <input
                    type="text"
                    value="{{ $payment->order?->invoice ?? $payment->invoice }}"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 bg-gray-100"
                    readonly>

            </div>

            {{-- Customer --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Customer
                </label>

                <input
                    type="text"
                    value="{{ $payment->customer->user->name }}"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 bg-gray-100"
                    readonly>

            </div>

            {{-- Total --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Total Pembayaran
                </label>

                <input
                    type="text"
                    value="Rp {{ number_format($payment->order?->total ?? $payment->groomingBooking?->service?->harga ?? $payment->total, 0, ',', '.') }}"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3 bg-gray-100"
                    readonly>

            </div>

            {{-- Metode --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Metode Pembayaran
                </label>

                <select
                    name="metode"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3">

                    <option value="cash"
                        {{ $payment->metode=='cash' ? 'selected' : '' }}>

                        Cash

                    </option>

                    <option value="qris"
                        {{ $payment->metode=='qris' ? 'selected' : '' }}>

                        QRIS

                    </option>

                </select>

            </div>

            {{-- Bukti --}}
            <div class="mb-5">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Bukti Pembayaran
                </label>

                @if($payment->bukti)

                    <img
                        src="{{ asset('storage/'.$payment->bukti) }}"
                        class="w-40 rounded-xl border mb-4">

                @endif

                <input
                    type="file"
                    name="bukti"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3">

            </div>

            {{-- Status --}}
            <div class="mb-8">

                <label class="block font-semibold text-[#5A3928] mb-2">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full rounded-2xl border border-gray-300 px-4 py-3">

                    <option value="pending"
                        {{ $payment->status=='pending' ? 'selected' : '' }}>

                        Pending

                    </option>

                    <option value="verified"
                        {{ $payment->status=='verified' ? 'selected' : '' }}>

                        Verified

                    </option>

                    <option value="rejected"
                        {{ $payment->status=='rejected' ? 'selected' : '' }}>

                        Rejected

                    </option>

                </select>

            </div>

            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-8 py-3 rounded-2xl font-semibold">

                    💾 Update Pembayaran

                </button>

                <a
                    href="{{ route('payments.index') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-8 py-3 rounded-2xl font-semibold">

                    ← Kembali

                </a>

            </div>

        </form>

    </div>

</div>

@endsection