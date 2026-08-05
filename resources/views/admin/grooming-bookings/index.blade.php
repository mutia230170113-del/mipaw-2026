@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-[#5A3928]">
                Booking Grooming 🐶
            </h1>

            <p class="text-gray-500 mt-2">
                Daftar booking grooming customer.
            </p>

        </div>

        <a href="{{ route('grooming-bookings.create') }}"
            class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-6 py-3 rounded-2xl font-semibold">

            + Tambah Booking

        </a>

    </div>


    {{-- Alert --}}
    @if(session('success'))

        <div class="bg-green-100 text-green-700 px-5 py-4 rounded-2xl">

            {{ session('success') }}

        </div>

    @endif


    {{-- Table --}}
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-[#6B412C] text-white">

                <tr>

                    <th class="p-4 text-center">No</th>

                    <th>Customer</th>

                    <th>Hewan</th>

                    <th>Paket</th>

                    <th>Tanggal</th>

                    <th>Jam</th>

                    <th>Status</th>

                    <th class="text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($bookings as $booking)

                <tr class="border-b hover:bg-gray-50">

                    <td class="p-4 text-center">

                        {{ $loop->iteration }}

                    </td>

                    <td>

                        {{ $booking->customer->user->name }}

                    </td>

                    <td>

                        {{ $booking->pet->nama_hewan }}

                    </td>

                    <td>

                        {{ $booking->service->nama_layanan }}

                    </td>

                    <td>

                        {{ \Carbon\Carbon::parse($booking->tanggal)->format('d M Y') }}

                    </td>

                    <td>

                        {{ $booking->jam }}

                    </td>

                    <td>

                        @if(!$booking->payment)

                            <a href="{{ route('payments.create',['booking'=>$booking->id]) }}"
                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-2 rounded-xl">

                                💳 Bayar

                            </a>

                        @elseif($booking->payment->status == 'pending')

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-2 rounded-xl">

                                Menunggu Verifikasi

                            </span>

                        @elseif($booking->payment->status == 'rejected')

                            <a href="{{ route('payments.edit',$booking->payment) }}"
                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-xl">

                                Bayar Lagi

                            </a>

                        @elseif($booking->payment->status == 'verified')

                            @if($booking->status == 'diproses')

                                <form action="{{ route('grooming-bookings.finish',$booking) }}"
                                    method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        onclick="return confirm('Selesaikan grooming ini?')"
                                        class="bg-indigo-500 hover:bg-indigo-600 text-white px-3 py-2 rounded-xl">

                                        ✅ Selesaikan Grooming

                                    </button>

                                </form>

                            @elseif($booking->status == 'selesai')

                                <span class="bg-green-100 text-green-700 px-3 py-2 rounded-xl">

                                    ✔ Grooming Selesai

                                </span>

                            @else

                                <span class="bg-green-100 text-green-700 px-3 py-2 rounded-xl">

                                    Sudah Dibayar

                                </span>

                            @endif

                        @endif

                    </td>
                    
                    <td>

                        <div class="flex flex-wrap justify-center gap-2">

                            <a
                                href="{{ route('grooming-bookings.show',$booking) }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-xl">

                                Detail

                            </a>

                            <a
                                href="{{ route('grooming-bookings.edit',$booking) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-xl">

                                Edit

                            </a>


                            <form
                                action="{{ route('grooming-bookings.destroy',$booking) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    onclick="return confirm('Yakin hapus booking ini?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-xl">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="8"
                        class="text-center py-10 text-gray-500">

                        Belum ada data booking grooming.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection