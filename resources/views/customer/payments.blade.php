@extends('layouts.customer')

@section('content')

<div class="space-y-6">

    <div>

        <h1 class="text-3xl font-bold text-[#5A3928]">

            Riwayat Pembayaran 💳

        </h1>

        <p class="text-gray-600">

            Semua pembayaran Anda.

        </p>

    </div>

    <div class="bg-white rounded-3xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-[#F5E6D3]">

                <tr>

                    <th class="px-6 py-4 text-left">
                        Invoice
                    </th>

                    <th class="px-6 py-4 text-left">
                        Total
                    </th>

                    <th class="px-6 py-4 text-center">
                        Status
                    </th>

                    <th class="px-6 py-4 text-center">
                        Aksi
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($payments as $payment)

                <tr class="border-t">

                    <td class="px-6 py-4">

                        {{ $payment->invoice }}

                    </td>

                    <td class="px-6 py-4">

                        Rp {{ number_format($payment->total,0,',','.') }}

                    </td>

                    <td class="px-6 py-4 text-center">

                        @if($payment->status=='verified')

                            <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs">

                                Verified

                            </span>

                        @elseif($payment->status=='pending')

                            <span class="bg-yellow-400 text-white px-3 py-1 rounded-full text-xs">

                                Pending

                            </span>

                        @else

                            <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs">

                                Rejected

                            </span>

                        @endif

                    </td>

                    <td class="px-6 py-4 text-center">

                        @if($payment->status=='verified')

                            <a
                                href="{{ route('payments.receipt',$payment) }}"
                                target="_blank"
                                class="bg-[#6B412C] text-white px-4 py-2 rounded-lg">

                                Lihat Struk

                            </a>

                        @else

                            -

                        @endif

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4" class="text-center py-10">

                        Belum ada pembayaran.

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    {{ $payments->links() }}

</div>

@endsection