@extends('layouts.admin')

@section('content')

<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">

        <div>

            <h1 class="text-4xl font-bold text-[#5A3928]">
                Customer MiPaw 👥
            </h1>

            <p class="text-gray-500 mt-2">
                Kelola seluruh customer MiPaw.
            </p>

        </div>

        <a href="{{ route('customers.create') }}"
            class="bg-[#6B412C] hover:bg-[#5A3928] text-white px-6 py-3 rounded-2xl shadow font-semibold transition">

            + Tambah Customer

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
                    Daftar Customer
                </h2>

                <p class="text-gray-500 text-sm">

                    Total Customer :
                    <span class="font-bold">
                        {{ $totalCustomer }}
                    </span>

                </p>

            </div>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-[#FFF5EE]">

                    <tr>

                        <th class="py-4 px-4 text-left">
                            No
                        </th>

                        <th class="py-4 px-4 text-left">
                            Nama
                        </th>

                        <th class="py-4 px-4 text-left">
                            Email
                        </th>

                        <th class="py-4 px-4 text-center">
                            Role
                        </th>

                        <th class="py-4 px-4 text-center">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                @forelse($customers as $customer)

                    <tr class="border-b hover:bg-gray-50 transition">

                        <td class="px-4 py-4">

                            {{ $customers->firstItem() + $loop->index }}

                        </td>

                        <td class="px-4 py-4 font-semibold">

                            {{ $customer->name }}

                        </td>

                        <td class="px-4 py-4">

                            {{ $customer->email }}

                        </td>

                        <td class="px-4 py-4 text-center">

                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">

                                {{ ucfirst($customer->role) }}

                            </span>

                        </td>

                        <td class="px-4 py-4">

                            <div class="flex justify-center gap-2">

                                {{-- Detail --}}
                                <a href="{{ route('customers.show',$customer) }}"
                                    class="bg-sky-500 hover:bg-sky-600 text-white px-3 py-2 rounded-xl text-sm">

                                    Detail

                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('customers.edit',$customer) }}"
                                    class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-xl text-sm">

                                    Edit

                                </a>

                                {{-- Delete --}}
                                <form
                                    action="{{ route('customers.destroy',$customer) }}"
                                    method="POST">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Yakin ingin menghapus customer ini?')"
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

                            Belum ada customer.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>


        <div class="p-6">

            {{ $customers->links() }}

        </div>

    </div>

</div>

@endsection