<x-guest-layout>

<div class="min-h-screen bg-gradient-to-r from-[#b47d5b] via-[#d8b08f] to-[#f3cd9f] flex items-center justify-center p-8">

    <div class="w-full max-w-7xl rounded-[40px] overflow-hidden shadow-2xl bg-white grid lg:grid-cols-2">

        {{-- LEFT --}}
        <div class="relative bg-gradient-to-br from-[#b87c54] via-[#c88d63] to-[#dba986] overflow-hidden p-14">

            {{-- Blob --}}
            <div class="absolute -top-20 -left-20 w-72 h-72 bg-[#8f5d42]/40 rounded-full blur-3xl"></div>

            <div class="absolute bottom-0 right-0 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>

            {{-- Paw --}}
            <div class="absolute top-16 right-16 text-white/20 text-5xl">🐾</div>

            <div class="absolute top-56 left-10 text-white/20 text-4xl rotate-12">🐾</div>

            <div class="absolute bottom-48 right-24 text-white/20 text-6xl">🐾</div>

            {{-- Logo --}}
            <div class="relative z-10 flex items-center gap-3">

                <div class="text-5xl">
                    🐾
                </div>

                <div>

                    <h1 class="text-4xl font-bold text-white">
                        MiPaw
                    </h1>

                    <p class="text-white/80">
                        Pet Shop & Grooming
                    </p>

                </div>

            </div>

            {{-- Title --}}
            <div class="relative z-10 mt-16">

                <h2 class="text-5xl font-bold text-white leading-tight">

                    Buat
                    <br>
                    Akun Baru

                </h2>

                <div class="w-20 h-1 bg-white rounded-full mt-5"></div>

                <p class="mt-7 text-white/90 text-lg leading-8 max-w-md">

                    Bergabung bersama MiPaw dan nikmati layanan belanja,
                    grooming, serta promo spesial untuk hewan kesayanganmu.

                </p>

            </div>

            {{-- Pet --}}
            <img

                src="{{ asset('images/pet.png') }}"

                class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[470px]">

        </div>



        {{-- RIGHT --}}

        <div class="bg-[#faf7f4] flex items-center justify-center p-12">

            <div class="bg-white rounded-[35px] shadow-xl p-10 w-full max-w-xl">

                <h2 class="text-4xl font-bold text-[#60391f]">

                    Daftar 🐾

                </h2>

                <p class="text-gray-500 mt-2 mb-8">

                    Lengkapi data di bawah ini

                </p>

                <form method="POST" action="{{ route('register') }}">

                    @csrf

                    {{-- Nama --}}

                    <label class="font-semibold text-[#60391f]">

                        Nama Lengkap

                    </label>

                    <input

                        type="text"

                        name="name"

                        value="{{ old('name') }}"

                        class="mt-2 w-full rounded-full border border-gray-300 px-5 py-4 focus:ring-2 focus:ring-[#b87c54]"

                        placeholder="Nama lengkap"

                        required>

                    @error('name')

                        <p class="text-red-500 text-sm mt-2">

                            {{ $message }}

                        </p>

                    @enderror

                                        {{-- Email --}}
                    <div class="mt-6">

                        <label class="font-semibold text-[#60391f]">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="email@gmail.com"
                            class="mt-2 w-full rounded-full border border-gray-300 px-5 py-4 focus:ring-2 focus:ring-[#b87c54]"
                            required>

                        @error('email')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Password --}}
                    <div class="mt-6">

                        <label class="font-semibold text-[#60391f]">
                            Password
                        </label>

                        <div class="relative">

                            <input
                                id="password"
                                type="password"
                                name="password"
                                placeholder="********"
                                class="mt-2 w-full rounded-full border border-gray-300 px-5 py-4 pr-14 focus:ring-2 focus:ring-[#b87c54]"
                                required>

                            <button
                                type="button"
                                onclick="togglePassword('password','eye1')"
                                class="absolute right-5 top-6">

                                <span id="eye1">👁️</span>

                            </button>

                        </div>

                        @error('password')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Konfirmasi Password --}}
                    <div class="mt-6">

                        <label class="font-semibold text-[#60391f]">

                            Konfirmasi Password

                        </label>

                        <div class="relative">

                            <input

                                id="password_confirmation"

                                type="password"

                                name="password_confirmation"

                                placeholder="********"

                                class="mt-2 w-full rounded-full border border-gray-300 px-5 py-4 pr-14 focus:ring-2 focus:ring-[#b87c54]"

                                required>

                            <button

                                type="button"

                                onclick="togglePassword('password_confirmation','eye2')"

                                class="absolute right-5 top-6">

                                <span id="eye2">👁️</span>

                            </button>

                        </div>

                    </div>



                    <button

                        class="mt-8 w-full bg-gradient-to-r from-[#8b5a3c] to-[#a56b46] text-white py-4 rounded-full text-lg font-bold hover:scale-[1.02] transition">

                        Daftar Sekarang 🐾

                    </button>


                    <p class="text-center mt-7 text-gray-500">

                        Sudah punya akun?

                        <a

                            href="{{ route('login') }}"

                            class="font-bold text-[#8b5a3c] hover:underline">

                            Masuk

                        </a>

                    </p>

                </form>

            </div>

        </div>

    </div>

</div>

<script>

function togglePassword(id, eye){

    let input=document.getElementById(id);

    if(input.type==="password"){

        input.type="text";

        document.getElementById(eye).innerHTML="🙈";

    }else{

        input.type="password";

        document.getElementById(eye).innerHTML="👁️";

    }

}

</script>

</x-guest-layout>