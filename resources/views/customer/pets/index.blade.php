@extends('layouts.customer')

@section('content')

<div class="space-y-8">

    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-3xl font-bold text-[#5A3928]">
                🐾 Hewan Saya
            </h1>

            <p class="text-gray-500 mt-2">
                Kelola data hewan kesayanganmu.
            </p>

        </div>

        <a href="{{ route('customer.pets.create') }}"
            class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-6 py-3 rounded-xl font-semibold">

            + Tambah Hewan

        </a>

    </div>

    @if(session('success'))

        <div class="bg-green-100 text-green-700 p-4 rounded-xl">
            {{ session('success') }}
        </div>

    @endif

    @if($pets->count())

    <div class="bg-white rounded-3xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-4 text-left">Nama</th>
                    <th>Jenis</th>
                    <th>Ras</th>
                    <th>Umur</th>
                    <th>Berat</th>
                    <th>Aksi</th>

                </tr>

            </thead>

            <tbody>

            @foreach($pets as $pet)

                <tr class="border-t">

                    <td class="p-4 font-semibold">
                        {{ $pet->nama_hewan }}
                    </td>

                    <td class="text-center">
                        {{ $pet->jenis }}
                    </td>

                    <td class="text-center">
                        {{ $pet->ras }}
                    </td>

                    <td class="text-center">
                        {{ $pet->umur }}
                    </td>

                    <td class="text-center">
                        {{ $pet->berat }} Kg
                    </td>

                    <td class="text-center">

                        <a href="{{ route('customer.pets.edit',$pet->id) }}"
                            class="text-blue-600 font-semibold">

                            Edit

                        </a>

                        |

                        <form action="{{ route('customer.pets.destroy',$pet->id) }}"
                            method="POST"
                            class="inline">

                            @csrf
                            @method('DELETE')

                            <button
                                onclick="return confirm('Hapus hewan ini?')"
                                class="text-red-600 font-semibold">

                                Hapus

                            </button>

                        </form>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

    @else

        <div class="bg-white rounded-3xl shadow p-12 text-center">

            <h2 class="text-2xl font-bold text-gray-700">
                Belum ada data hewan 🐶🐱
            </h2>

            <p class="text-gray-500 mt-3">

                Tambahkan hewan terlebih dahulu agar bisa booking grooming.

            </p>

        </div>

    @endif

</div>

@endsection