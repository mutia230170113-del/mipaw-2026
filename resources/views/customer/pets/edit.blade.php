@extends('layouts.customer')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-3xl shadow p-10">

        <h1 class="text-3xl font-bold text-[#5A3928] mb-8">
            ✏️ Edit Data Hewan
        </h1>

        @if ($errors->any())

            <div class="bg-red-100 text-red-700 rounded-xl p-4 mb-6">

                <ul class="list-disc ml-5">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('customer.pets.update',$pet->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="space-y-6">

                <div>

                    <label class="font-semibold">
                        Nama Hewan
                    </label>

                    <input
                        type="text"
                        name="nama_hewan"
                        value="{{ old('nama_hewan',$pet->nama_hewan) }}"
                        class="w-full border rounded-xl p-3 mt-2"
                        required>

                </div>

                <div>

                    <label class="font-semibold">
                        Jenis
                    </label>

                    <select
                        name="jenis"
                        class="w-full border rounded-xl p-3 mt-2"
                        required>

                        <option value="Kucing"
                            {{ $pet->jenis=='Kucing'?'selected':'' }}>
                            Kucing
                        </option>

                        <option value="Anjing"
                            {{ $pet->jenis=='Anjing'?'selected':'' }}>
                            Anjing
                        </option>

                        <option value="Kelinci"
                            {{ $pet->jenis=='Kelinci'?'selected':'' }}>
                            Kelinci
                        </option>

                        <option value="Hamster"
                            {{ $pet->jenis=='Hamster'?'selected':'' }}>
                            Hamster
                        </option>

                        <option value="Burung"
                            {{ $pet->jenis=='Burung'?'selected':'' }}>
                            Burung
                        </option>

                    </select>

                </div>

                <div>

                    <label class="font-semibold">
                        Ras
                    </label>

                    <input
                        type="text"
                        name="ras"
                        value="{{ old('ras',$pet->ras) }}"
                        class="w-full border rounded-xl p-3 mt-2">

                </div>

                <div class="grid grid-cols-2 gap-6">

                    <div>

                        <label class="font-semibold">
                            Umur (Tahun)
                        </label>

                        <input
                            type="number"
                            name="umur"
                            value="{{ old('umur',$pet->umur) }}"
                            class="w-full border rounded-xl p-3 mt-2">

                    </div>

                    <div>

                        <label class="font-semibold">
                            Berat (Kg)
                        </label>

                        <input
                            type="number"
                            step="0.1"
                            name="berat"
                            value="{{ old('berat',$pet->berat) }}"
                            class="w-full border rounded-xl p-3 mt-2">

                    </div>

                </div>

                <div>

                    <label class="font-semibold">
                        Catatan
                    </label>

                    <textarea
                        name="catatan"
                        rows="4"
                        class="w-full border rounded-xl p-3 mt-2">{{ old('catatan',$pet->catatan) }}</textarea>

                </div>

            </div>

            <div class="mt-10 flex justify-end gap-4">

                <a
                    href="{{ route('customer.pets') }}"
                    class="bg-gray-300 px-6 py-3 rounded-xl">

                    Batal

                </a>

                <button
                    type="submit"
                    class="bg-[#6B412C] text-white px-8 py-3 rounded-xl">

                    Update

                </button>

            </div>

        </form>

    </div>

</div>

@endsection