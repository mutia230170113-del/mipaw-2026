@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-[#5A3928]">
                Data Hewan 🐾
            </h1>

            <p class="text-gray-500 mt-2">
                Kelola seluruh data hewan milik customer.
            </p>

        </div>

        <a href="{{ route('pets.create') }}"
            class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-6 py-3 rounded-2xl shadow font-semibold transition">

            + Tambah Hewan

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
                    Daftar Hewan
                </h2>

                <p class="text-gray-500 text-sm">

                    Total Hewan :
                    <span class="font-bold">

                        {{ $totalPet }}

                    </span>

                </p>

            </div>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-[#FFF5EE]">

                    <tr>

                        <th class="px-4 py-4 text-left">No</th>

                        <th class="px-4 py-4 text-left">Nama Hewan</th>

                        <th class="px-4 py-4 text-left">Customer</th>

                        <th class="px-4 py-4 text-center">Jenis</th>

                        <th class="px-4 py-4 text-center">Ras</th>

                        <th class="px-4 py-4 text-center">Umur</th>

                        <th class="px-4 py-4 text-center">Berat</th>

                        <th class="px-4 py-4 text-center">Aksi</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($pets as $pet)

                    <tr class="border-b hover:bg-gray-50 transition">

                        <td class="px-4 py-4">

                            {{ $pets->firstItem() + $loop->index }}

                        </td>

                        <td class="px-4 py-4 font-semibold text-[#6B412C]">

                            {{ $pet->nama_hewan }}

                        </td>

                        <td class="px-4 py-4">

                            {{ $pet->customer->user->name }}

                        </td>

                        <td class="px-4 py-4 text-center">

                            {{ $pet->jenis }}

                        </td>

                        <td class="px-4 py-4 text-center">

                            {{ $pet->ras ?? '-' }}

                        </td>

                        <td class="px-4 py-4 text-center">

                            {{ $pet->umur ? $pet->umur.' Tahun' : '-' }}

                        </td>

                        <td class="px-4 py-4 text-center">

                            {{ $pet->berat ? $pet->berat.' Kg' : '-' }}

                        </td>

                        <td class="px-4 py-4">

                            <div class="flex justify-center gap-2">

                                <a href="{{ route('pets.show',$pet) }}"
                                    class="bg-sky-500 hover:bg-sky-600 text-white px-3 py-2 rounded-xl text-sm">

                                    Detail

                                </a>

                                <a href="{{ route('pets.edit',$pet) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-xl text-sm">

                                    Edit

                                </a>

                                <form action="{{ route('pets.destroy',$pet) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        onclick="return confirm('Yakin ingin menghapus data hewan ini?')"
                                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-xl text-sm">

                                        Hapus

                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="8"
                            class="text-center py-12 text-gray-400">

                            Belum ada data hewan.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <div class="p-6">

            {{ $pets->links() }}

        </div>

    </div>

</div>

@endsection