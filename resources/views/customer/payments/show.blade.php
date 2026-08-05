@extends('layouts.customer')

@section('content')

<div class="space-y-8">

    {{-- Tombol Kembali --}}
    <div>

        <a
            href="{{ route('customer.payments') }}"
            class="inline-flex items-center bg-gray-200 hover:bg-gray-300 px-5 py-3 rounded-xl font-semibold">

            ← Kembali

        </a>

    </div>


    {{-- Card --}}
    <div class="bg-white rounded-3xl shadow p-8">

        <h1
            class="text-3xl font-bold text-[#5A3928] mb-8">

            Detail Pembayaran

        </h1>


        <div class="space-y-6">

            {{-- Invoice --}}
            <div>

                <p class="text-gray-500">

                    Invoice Pembayaran

                </p>

                <h2 class="font-bold text-xl">

                    {{ $payment->invoice }}

                </h2>

            </div>


            {{-- Invoice Order --}}
            <div>

                <p class="text-gray-500">

                    Invoice Order

                </p>

                <h2 class="font-bold text-xl">

                    {{ optional($payment->order)->invoice ?? '-' }}

                </h2>

            </div>


            {{-- Total --}}
            <div>

                <p class="text-gray-500">

                    Total Pembayaran

                </p>

                <h2
                    class="text-3xl font-bold text-green-600">

                    Rp {{ number_format($payment->total,0,',','.') }}

                </h2>

            </div>


            {{-- Metode --}}
            <div>

                <p class="text-gray-500">

                    Metode Pembayaran

                </p>

                <h2 class="font-bold text-xl">

                    @if($payment->metode == 'cash')

                        💵 Cash

                    @elseif($payment->metode == 'qris')

                        📱 QRIS

                    @else

                        🏦 Transfer Bank

                    @endif

                </h2>

            </div>


            {{-- Status --}}
            <div>

                <p class="text-gray-500">

                    Status Pembayaran

                </p>

                @if($payment->status == 'pending')

                    <span
                        class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-full">

                        ⏳ Pending

                    </span>

                @elseif($payment->status == 'verified')

                    <span
                        class="bg-green-100 text-green-700 px-4 py-2 rounded-full">

                        ✅ Verified

                    </span>

                @else

                    <span
                        class="bg-red-100 text-red-700 px-4 py-2 rounded-full">

                        ❌ Rejected

                    </span>

                @endif

            </div>


            {{-- Tanggal --}}
            <div>

                <p class="text-gray-500">

                    Tanggal Pembayaran

                </p>

                <h2 class="font-semibold">

                    {{ $payment->paid_at ? \Carbon\Carbon::parse($payment->paid_at)->format('d M Y H:i') : '-' }}

                </h2>

            </div>


            {{-- Bukti --}}
            @if($payment->bukti)

                <div>

                    <p class="text-gray-500 mb-3">

                        Bukti Pembayaran

                    </p>

                    <img
                        src="{{ asset('storage/'.$payment->bukti) }}"
                        class="w-96 rounded-2xl shadow border">

                </div>

            @endif

        </div>

    </div>

</div>

@endsection