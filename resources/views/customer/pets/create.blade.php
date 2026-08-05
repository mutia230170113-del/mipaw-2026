@extends('layouts.customer')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="bg-white rounded-3xl shadow p-10">

        <h1 class="text-3xl font-bold text-[#5A3928] mb-8">
            🐾 Tambah Hewan
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

        <form action="{{ route('customer.pets.store') }}" method="POST">

            @csrf

            <div class="space-y-6">

                <div>

                    <label class="font-semibold">
                        Nama Hewan
                    </label>

                    <input
                        type="text"
                        name="nama_hewan"
                        value="{{ old('nama_hewan') }}"
                        class="w-full border rounded-xl p-3 mt-2"
                        required>

                </div>

                <div>

                    <label class="font-semibold">
                        Jenis
                    </label>

                    <!-- Ditambahkan id="jenis_hewan" untuk pemicu JavaScript -->
                    <select
                        id="jenis_hewan"
                        name="jenis"
                        class="w-full border rounded-xl p-3 mt-2"
                        required>

                        <option value="">-- Pilih Jenis --</option>

                        <option value="Kucing">Kucing</option>

                        <option value="Anjing">Anjing</option>

                        <option value="Kelinci">Kelinci</option>

                        <option value="Hamster">Hamster</option>

                        <option value="Burung">Burung</option>

                    </select>

                </div>

                <div>
                    <label class="block font-semibold mb-2">Ras Peliharaan</label>
                    
                    <!-- Ditambahkan id="ras_hewan" untuk target penyaring JavaScript -->
                    <select id="ras_hewan" name="ras" class="w-full border rounded-xl p-3 mt-2 focus:border-[#6B412C] focus:ring-[#6B412C]" required>
                        <option value="">-- Pilih Ras Peliharaan --</option>
                        
                        <optgroup label="🐱 RAS KUCING">
                            <option value="Persia">Persia</option>
                            <option value="Anggora">Anggora</option>
                            <option value="Siam">Siam</option>
                            <option value="Kampung">Kampung / Domestik</option>
                            <option value="Maine Coon">Maine Coon</option>
                        </optgroup>

                        <optgroup label="🐶 RAS ANJING">
                            <option value="Bulldog">Bulldog</option>
                            <option value="Poodle">Poodle</option>
                            <option value="Golden">Golden Retriever</option>
                            <option value="Chihuahua">Chihuahua</option>
                            <option value="Pug">Pug</option>
                        </optgroup>

                        <optgroup label="🐰 RAS KELINCI">
                            <option value="Anggora Kelinci">Kelinci Anggora</option>
                            <option value="Rex">Kelinci Rex</option>
                            <option value="Lop">Kelinci Lop</option>
                            <option value="Lokal">Kelinci Lokal</option>
                        </optgroup>

                        <optgroup label="🐹 RAS HAMSTER">
                            <option value="Winter White">Winter White</option>
                            <option value="Campbell">Campbell</option>
                            <option value="Roborovski">Roborovski</option>
                            <option value="Syrian">Syrian</option>
                        </optgroup>

                        <optgroup label="🦜 RAS BURUNG">
                            <option value="Lovebird">Lovebird</option>
                            <option value="Murai Batu">Murai Batu</option>
                            <option value="Kenari">Kenari</option>
                            <option value="Kakatua">Kakatua</option>
                        </optgroup>
                    </select>
                </div>


                <div class="grid grid-cols-2 gap-6">

                    <div>

                        <label class="font-semibold">
                            Umur (Tahun)
                        </label>

                        <input
                            type="number"
                            name="umur"
                            value="{{ old('umur') }}"
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
                            value="{{ old('berat') }}"
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
                        class="w-full border rounded-xl p-3 mt-2">{{ old('catatan') }}</textarea>

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

                    Simpan

                </button>

            </div>

        </form>

    </div>

</div>

{{-- ------------------------------------------------------------------------- --}}
{{-- SCRIPT JAVASCRIPT PENYARING POP-UP OPTGROUP OTOMATIS                      --}}
{{-- ------------------------------------------------------------------------- --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    var jenisSelect = document.getElementById('jenis_hewan');
    var rasSelect = document.getElementById('ras_hewan');

    if (jenisSelect && rasSelect) {
        // Ambal seluruh grup data yang dibungkus optgroup di dalam select
        var groups = Array.from(rasSelect.getElementsByTagName('optgroup'));
        
        // Buat backup salinan grup asli agar datanya tidak hilang permanen saat dihapus
        var backupGroups = groups.map(function(group) {
            return {
                element: group,
                label: group.getAttribute('label').toUpperCase()
            };
        });

        jenisSelect.addEventListener('change', function() {
            var selectedJenis = this.value.toUpperCase();
            
            // Setel ulang pilihan Ras menjadi kosong setiap kali Jenis Hewan diubah
            rasSelect.innerHTML = '<option value="">-- Pilih Ras Peliharaan --</option>';

            if (selectedJenis) {
                // Saring kelompok ras yang namanya mengandung kata jenis hewan pilihan
                backupGroups.forEach(function(groupData) {
                    if (groupData.label.includes(selectedJenis)) {
                        rasSelect.appendChild(groupData.element.cloneNode(true));
                    }
                });
            } else {
                // Jika jenis hewan dikosongkan kembali, tampilkan semua optgroup sebagai standar
                backupGroups.forEach(function(groupData) {
                    rasSelect.appendChild(groupData.element.cloneNode(true));
                });
            }
        });

        // Trigger pemicu awal saat pertama kali halaman terbuka
        if (jenisSelect.value) {
            jenisSelect.dispatchEvent(new Event('change'));
        }
    }
});
</script>

@endsection
