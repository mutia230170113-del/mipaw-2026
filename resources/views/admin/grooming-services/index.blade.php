@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-[#5A3928]">
                Paket Grooming ✂️
            </h1>

            <p class="text-gray-500 mt-2">
                Kelola seluruh layanan grooming MiPaw.
            </p>

        </div>

        <a href="{{ route('grooming-services.create') }}"
            class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-6 py-3 rounded-2xl shadow font-semibold transition">

            + Tambah Paket

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

                    Daftar Paket Grooming

                </h2>

                <p class="text-gray-500 text-sm">

                    Total Paket :
                    <span class="font-bold">

                        {{ $totalService }}

                    </span>

                </p>

            </div>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-[#FFF5EE]">

                    <tr>

                        <th class="px-4 py-4 text-left">No</th>

                        <th class="px-4 py-4 text-left">Nama Paket</th>

                        <th class="px-4 py-4 text-center">Durasi</th>

                        <th class="px-4 py-4 text-right">Harga</th>

                        <th class="px-4 py-4 text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($services as $service)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="px-4 py-4">

                            {{ $services->firstItem() + $loop->index }}

                        </td>

                        <td class="px-4 py-4 font-semibold text-[#6B412C]">

                            {{ $service->nama_layanan }}

                        </td>

                        <td class="px-4 py-4 text-center">

                            {{ $service->durasi }} Menit

                        </td>

                        <td class="px-4 py-4 text-right">

                            Rp {{ number_format($service->harga,0,',','.') }}

                        </td>

                        <td class="px-4 py-4">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('grooming-services.show',$service) }}"
                                    class="bg-sky-500 hover:bg-sky-600 text-white px-3 py-2 rounded-xl text-sm">

                                    Detail

                                </a>

                                <a href="{{ route('grooming-services.edit',$service) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-xl text-sm">

                                    Edit

                                </a>

                                <form action="{{ route('grooming-services.destroy',$service) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Hapus paket ini?')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-xl text-sm">

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5"
                            class="text-center py-12 text-gray-400">

                            Belum ada paket grooming.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="p-6">

            {{ $services->links() }}

        </div>

    </div>

</div>

@endsection