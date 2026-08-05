@extends('layouts.admin')


@section('content')

<div class="space-y-8">


    <div class="flex justify-between items-center">


        <div>

            <h1 class="text-3xl font-bold text-[#5a3928]">
                Kategori MiPaw 🗂️
            </h1>


            <p class="text-gray-500 mt-2">
                Kelola kategori produk pet shop
            </p>

        </div>



        <a href="{{ route('categories.create') }}"
            class="bg-[#7b4b2f] text-white px-6 py-3 rounded-xl shadow hover:bg-[#5a3928]">

            + Tambah Kategori

        </a>


    </div>





    <div class="bg-[#fff3e6] rounded-3xl shadow-xl p-8 border border-[#ead3bd]">


        <table class="w-full">


            <thead>


                <tr class="border-b border-[#ead3bd] text-[#5a3928]">


                    <th class="text-left py-4">
                        No
                    </th>


                    <th class="text-left">
                        Kategori
                    </th>


                    <th class="text-center">
                        Aksi
                    </th>


                </tr>


            </thead>





            <tbody>


                @forelse($categories as $category)


                <tr class="border-b border-[#ead3bd] hover:bg-[#fae8d7]">


                    <td class="py-5">

                        {{ $loop->iteration }}

                    </td>




                    <td>


                        <div class="flex items-center gap-4">


                            <div class="w-12 h-12 rounded-2xl bg-[#ead3bd]
                            flex items-center justify-center text-xl">

                                🐾

                            </div>



                            <span class="font-bold text-[#4b2c1d]">

                                {{ $category->nama_kategori }}

                            </span>


                        </div>


                    </td>





                    <td>


                        <div class="flex justify-center gap-2">



                            <a href="{{ route('categories.edit',$category->id) }}"
                                class="px-5 py-2 rounded-xl bg-[#ead3bd] text-[#5a3928]">


                                Edit


                            </a>






                            <form action="{{ route('categories.destroy',$category->id) }}"
                                method="POST">


                                @csrf

                                @method('DELETE')



                                <button
                                    class="px-5 py-2 rounded-xl bg-[#f5d7cc] text-[#8b3a2a]">


                                    Hapus


                                </button>



                            </form>



                        </div>


                    </td>



                </tr>



                @empty



                <tr>


                    <td colspan="3"
                        class="text-center py-10 text-gray-400">


                        Belum ada kategori 🐾


                    </td>


                </tr>



                @endforelse



            </tbody>



        </table>



    </div>



</div>


@endsection