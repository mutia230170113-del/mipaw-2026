@extends('layouts.admin')


@section('content')


<div class="space-y-8">


    <div>
        <h1 class="text-3xl font-bold text-[#5a3928]">
            Edit Kategori 🗂️
        </h1>

        <p class="text-gray-500 mt-2">
            Perbarui kategori produk
        </p>

    </div>


    <div class="bg-[#fff3e6] rounded-3xl shadow-xl p-8 border border-[#ead3bd]">


        <form action="{{ route('categories.update',$category->id) }}"
            method="POST">

            @csrf

            @method('PUT')


            <div class="mb-6">

                <label
                    class="block text-[#5a3928] font-bold mb-2">
                    Nama Kategori
                </label>


                <input

                    type="text"
                    name="nama_kategori"
                    value="{{ $category->nama_kategori }}"
                    class="w-full rounded-xl border-[#ead3bd]
                    focus:ring-[#7b4b2f] focus:border-[#7b4b2f]">

            </div>


            <div class="flex gap-3">

                <button
                    type="submit"
                    class="bg-[#7b4b2f] text-white
                    px-6 py-3 rounded-xl hover:bg-[#5a3928]">
                    Update

                </button>



                <a href="{{ route('categories.index') }}"

                    class="bg-[#ead3bd] text-[#5a3928]
                    px-6 py-3 rounded-xl">
                    Kembali

                </a>

            </div>


        </form>

    </div>


</div>



@endsection