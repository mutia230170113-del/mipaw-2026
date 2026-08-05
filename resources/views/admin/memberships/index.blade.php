@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-[#5A3928]">
                Membership 👑
            </h1>

            <p class="text-gray-500 mt-2">
                Kelola data membership customer MiPaw.
            </p>

        </div>

        <a href="{{ route('memberships.create') }}"
            class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-6 py-3 rounded-2xl font-semibold">

            + Tambah Membership

        </a>

    </div>

    {{-- Alert --}}
    @if(session('success'))

        <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-2xl">

            {{ session('success') }}

        </div>

    @endif

    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

        <table class="w-full">

            <thead class="bg-[#6B412C] text-white">

                <tr>

                    <th class="p-4 text-center">No</th>

                    <th>Customer</th>

                    <th>Kode Member</th>

                    <th>Level</th>

                    <th>Poin</th>

                    <th class="text-center">Aksi</th>

                </tr>

            </thead>

            <tbody>

            @forelse($memberships as $membership)

                <tr class="border-b hover:bg-gray-50">

                    <td class="text-center p-4">

                        {{ $loop->iteration }}

                    </td>

                    <td>

                        <div class="font-semibold">

                            {{ $membership->customer->user->name }}

                        </div>

                    </td>

                    <td>

                        <span class="font-bold text-[#6B412C]">

                            {{ $membership->member_code }}

                        </span>

                    </td>

                    <td>

                        @if($membership->level == 'regular')

                            <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-semibold text-sm">

                                🩵 Regular Member

                            </span>

                        @else

                            <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 font-semibold text-sm">

                                👑 Premium Member

                            </span>

                        @endif

                    </td>

                    <td>

                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 font-bold">

                            {{ number_format($membership->poin) }} Poin

                        </span>

                    </td>

                    <td>

                        <div class="flex justify-center gap-2">

                            <a href="{{ route('memberships.show', $membership) }}"
                                class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-xl">

                                Detail

                            </a>

                            <a href="{{ route('memberships.edit', $membership) }}"
                                class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-xl">

                                Edit

                            </a>

                            <form
                                action="{{ route('memberships.destroy', $membership) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    onclick="return confirm('Yakin ingin menghapus membership ini?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-xl">

                                    Hapus

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6"
                        class="text-center py-12 text-gray-500">

                        Belum ada data membership.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection