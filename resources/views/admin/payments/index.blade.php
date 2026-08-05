@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>
            <h1 class="text-4xl font-bold text-[#5A3928]">
                Pembayaran 💳
            </h1>

            <p class="text-gray-500 mt-2">
                Kelola seluruh pembayaran customer.
            </p>
        </div>

    </div>



    {{-- Alert --}}
    @if(session('success'))

        <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-2xl">
            {{ session('success') }}
        </div>

    @endif


    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <div class="px-6 py-5 border-b flex justify-between items-center">

            <div>

                <h2 class="text-xl font-bold text-[#5A3928]">
                    Daftar Pembayaran
                </h2>

                <p class="text-gray-500 text-sm">
                    Total Pembayaran :
                    <span class="font-bold">{{ $totalPayment }}</span>
                </p>

            </div>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-[#FFF5EE]">

                    <tr>

                        <th class="px-4 py-4 text-left">No</th>

                        <th class="px-4 py-4 text-left">Invoice</th>

                        <th class="px-4 py-4 text-left">Jenis</th>

                        <th class="px-4 py-4 text-left">Customer</th>

                        <th class="px-4 py-4 text-right">Total</th>

                        <th class="px-4 py-4 text-center">Metode</th>

                        <th class="px-4 py-4 text-center">Status</th>

                        <th class="px-4 py-4 text-center">Bukti</th>

                        <th class="px-4 py-4 text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($payments as $payment)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="px-4 py-4">
                            {{ $payments->firstItem() + $loop->index }}
                        </td>

                        <td class="px-4 py-4 font-semibold text-[#6B412C]">
                            {{ $payment->invoice }}
                        </td>

                        {{-- Jenis Transaksi --}}
                        <td class="px-4 py-4">

                            @if($payment->order)

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                    Order Produk
                                </span>

                            @elseif($payment->groomingBooking)

                                <span class="bg-pink-100 text-pink-700 px-3 py-1 rounded-full text-sm">
                                    Grooming
                                </span>

                            @endif

                        </td>

                        {{-- Customer --}}
                        <td class="px-4 py-4">

                            {{ $payment->customer->user->name }}

                        </td>

                        {{-- Total --}}
                        <td class="px-4 py-4 text-right">

                            Rp {{ number_format($payment->total,0,',','.') }}

                        </td>

                        {{-- Metode --}}
                        <td class="px-4 py-4 text-center">

                            {{ strtoupper($payment->metode) }}

                        </td>

                        {{-- Status --}}
                        <td class="px-4 py-4 text-center">

                            @if($payment->status=='pending')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                    Pending
                                </span>

                            @elseif($payment->status=='verified')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                    Verified
                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                    Rejected
                                </span>

                            @endif

                        </td>

                        {{-- Bukti --}}
                        <td class="px-4 py-4 text-center">

                            @if($payment->bukti)

                                <img
                                    src="{{ asset('storage/'.$payment->bukti) }}"
                                    class="w-14 h-14 rounded-lg object-cover mx-auto">

                            @else

                                <span class="text-gray-400">-</span>

                            @endif

                        </td>

                    
                        {{-- Aksi --}}
                        <td class="px-4 py-4">

                            <div class="flex justify-center gap-2 flex-wrap">

                                {{-- Detail --}}
                                <a href="{{ route('payments.show',$payment) }}"
                                    class="bg-sky-500 hover:bg-sky-600 text-white px-3 py-2 rounded-xl text-sm">

                                    Detail

                                </a>

                                @if($payment->status == 'pending')

                                    {{-- Verifikasi --}}
                                    <form action="{{ route('payments.verify',$payment) }}"
                                        method="POST">

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            onclick="return confirm('Verifikasi pembayaran ini?')"
                                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-xl text-sm">

                                            Verifikasi

                                        </button>

                                    </form>

                                    {{-- Tolak --}}
                                    <form action="{{ route('payments.reject',$payment) }}"
                                        method="POST">

                                        @csrf
                                        @method('PATCH')

                                        <button
                                            onclick="return confirm('Tolak pembayaran ini?')"
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-xl text-sm">

                                            Tolak

                                        </button>

                                    </form>

                                @elseif($payment->status == 'verified')

                                    {{-- Tombol Struk --}}
                                    <a href="{{ route('payments.receipt',$payment) }}"
                                        target="_blank"
                                        class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-3 py-2 rounded-xl text-sm">

                                        🧾 Struk

                                    </a>

                                    <span class="bg-green-100 text-green-700 px-3 py-2 rounded-xl text-sm">

                                        Terverifikasi

                                    </span>

                                @else

                                    <span class="bg-red-100 text-red-700 px-3 py-2 rounded-xl text-sm">

                                        Ditolak

                                    </span>

                                @endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9"
                            class="text-center py-10 text-gray-400">

                            Belum ada data pembayaran.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="p-6">

            {{ $payments->links() }}

        </div>

    </div>

</div>

@endsection