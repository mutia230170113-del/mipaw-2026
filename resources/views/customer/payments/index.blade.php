@extends('layouts.customer')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div>

        <h1
            class="text-3xl font-bold text-[#5A3928]">

            Riwayat Pembayaran

        </h1>

        <p
            class="text-gray-600 mt-2">

            Daftar pembayaran yang telah dilakukan.

        </p>

    </div>


    {{-- Table --}}
    <div
        class="bg-white rounded-3xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-[#6B412C] text-white">

                <tr>

                    <th class="px-6 py-4 text-left">

                        Invoice

                    </th>

                    <th class="px-6 py-4 text-center">

                        Metode

                    </th>

                    <th class="px-6 py-4 text-center">

                        Status

                    </th>

                    <th class="px-6 py-4 text-center">

                        Total

                    </th>

                    <th class="px-6 py-4 text-center">

                        Tanggal

                    </th>

                    <th class="px-6 py-4 text-center">

                        Aksi

                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($payments as $payment)

                    <tr class="border-b hover:bg-gray-50">

                        {{-- Invoice --}}
                        <td class="px-6 py-4 font-semibold">

                            {{ $payment->invoice }}

                        </td>


                        {{-- Metode --}}
                        <td class="text-center">

                            @if($payment->metode == 'cash')

                                💵 Cash

                            @elseif($payment->metode == 'qris')

                                📱 QRIS

                            @else

                                🏦 Transfer

                            @endif

                        </td>


                        {{-- Status --}}
                        <td class="text-center">

                            @if($payment->status == 'pending')

                                <span
                                    class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full">

                                    ⏳ Pending

                                </span>

                            @elseif($payment->status == 'verified')

                                <span
                                    class="bg-green-100 text-green-700 px-3 py-1 rounded-full">

                                    ✅ Verified

                                </span>

                            @else

                                <span
                                    class="bg-red-100 text-red-700 px-3 py-1 rounded-full">

                                    ❌ Rejected

                                </span>

                            @endif

                        </td>


                        {{-- Total --}}
                        <td class="text-center font-semibold text-green-600">

                            Rp {{ number_format($payment->total,0,',','.') }}

                        </td>


                        {{-- Tanggal --}}
                        <td class="text-center">

                            {{ $payment->paid_at
                                ? \Carbon\Carbon::parse($payment->paid_at)->format('d M Y')
                                : '-' }}

                        </td>


                        {{-- Aksi --}}
                        <td class="text-center">

                            <a
                                href="{{ route('customer.payments.show', $payment) }}"
                                class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-4 py-2 rounded-lg">

                                Detail

                            </a>

                            @if($payment->status == 'verified')
                            <a href="{{ route('customer.payments.receipt',$payment) }}"
                                class="bg-green-600 text-white px-3 py-2 rounded">
                                Cetak Struk
                            </a>
                        @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="6"
                            class="py-12 text-center text-gray-500">

                            Belum ada pembayaran.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>


    {{-- Pagination --}}
    <div>

        {{ $payments->links() }}

    </div>

</div>

@endsection