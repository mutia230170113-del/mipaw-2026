@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-[#5A3928]">
                Order MiPaw 📦
            </h1>

            <p class="text-gray-500 mt-2">
                Kelola seluruh pesanan customer.
            </p>

        </div>

        <a href="{{ route('orders.create') }}"
            class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-6 py-3 rounded-2xl shadow font-semibold transition">

            + Tambah Order

        </a>

    </div>


    {{-- Alert --}}
    @if(session('success'))

        <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-2xl">

            {{ session('success') }}

        </div>

    @endif


    {{-- Card --}}
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <div class="px-6 py-5 border-b flex justify-between items-center">

            <div>

                <h2 class="text-xl font-bold text-[#5A3928]">
                    Daftar Order
                </h2>

                <p class="text-gray-500 text-sm">

                    Total Order :
                    <span class="font-bold">
                        {{ $totalOrder }}
                    </span>

                </p>

            </div>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-[#FFF5EE]">

                    <tr>

                        <th class="px-4 py-4 text-left">
                            No
                        </th>

                        <th class="px-4 py-4 text-left">
                            Invoice
                        </th>

                        <th class="px-4 py-4 text-left">
                            Customer
                        </th>

                        <th class="px-4 py-4 text-left">
                            Produk
                        </th>

                        <th class="px-4 py-4 text-center">
                            Qty
                        </th>

                        <th class="px-4 py-4 text-center">
                            Tanggal
                        </th>

                        <th class="px-4 py-4 text-right">
                            Total
                        </th>

                        <th class="px-4 py-4 text-center">
                            Status
                        </th>

                        <th class="px-4 py-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($orders as $order)

                    <tr class="border-b hover:bg-gray-50 transition">

                        <td class="px-4 py-4">

                            {{ $orders->firstItem() + $loop->index }}

                        </td>

                        <td class="px-4 py-4 font-semibold text-[#6B412C]">

                            {{ $order->invoice }}

                        </td>

                        <td class="px-4 py-4">

                            {{ $order->customer->user->name ?? '-' }}

                        </td>

                        {{-- Produk --}}
                        <td class="px-4 py-4">

                            @if($order->items->count())

                                <div class="font-semibold">

                                    {{ $order->items->first()->product->nama_produk }}

                                </div>

                                @if($order->items->count() > 1)

                                    <span class="text-xs text-gray-500">

                                        (+{{ $order->items->count() - 1 }} produk lainnya)

                                    </span>

                                @endif

                            @else

                                <span class="text-gray-400">

                                    Tidak ada produk

                                </span>

                            @endif

                        </td>

                        {{-- Qty --}}
                        <td class="px-4 py-4 text-center">

                            {{ $order->items->sum('qty') }}

                        </td>

                        <td class="px-4 py-4 text-center">

                            {{ \Carbon\Carbon::parse($order->tanggal)->format('d/m/Y') }}

                        </td>

                        <td class="px-4 py-4 text-right font-semibold">

                            Rp {{ number_format($order->total,0,',','.') }}

                        </td>

                        <td class="px-4 py-4 text-center">

                            @if($order->status == 'pending')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

                                    Pending

                                </span>

                            @elseif($order->status == 'diproses')

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">

                                    Diproses

                                </span>

                            @elseif($order->status == 'selesai')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                    Selesai

                                </span>

                            @else

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                                    Dibatalkan

                                </span>

                            @endif

                        </td>

                        <td class="px-4 py-4">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('orders.show',$order) }}"
                                    class="bg-sky-500 hover:bg-sky-600 text-white px-3 py-2 rounded-xl text-sm">

                                    Detail

                                </a>

                                <a href="{{ route('orders.edit',$order) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-xl text-sm">

                                    Edit

                                </a>

                                <form action="{{ route('orders.destroy',$order) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Yakin ingin menghapus order ini?')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-xl text-sm">

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="9"
                            class="text-center py-12 text-gray-400">

                            Belum ada data order.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        <div class="p-6">

            {{ $orders->links() }}

        </div>

    </div>

</div>

@endsection