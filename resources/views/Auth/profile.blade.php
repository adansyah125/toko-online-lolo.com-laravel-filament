@extends('layouts.app')

@section('content')
    <section class="max-w-[900px] mx-auto px-6 py-12">


        <!-- CARD -->
        <div class="bg-white rounded-xl shadow-lg p-8">

            <!-- FOTO + NAMA -->
            <div class="flex flex-col md:flex-row items-center gap-6">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=ff6f00&color=fff"
                    class="w-28 h-28 rounded-full shadow">

                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-600">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <hr class="my-8">

            <!-- FORM PROFIL -->
            <form id="profileForm" action="" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <!-- NAMA -->
                <div>
                    <label class="font-semibold mb-1 block">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ Auth::user()->name }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#ff6f00]">
                    <p id="nameError" class="text-red-600 text-sm mt-1 hidden"></p>
                </div>

                <!-- EMAIL -->
                <div>
                    <label class="font-semibold mb-1 block">Email</label>
                    <input type="email" id="email" name="email" value="{{ Auth::user()->email }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#ff6f00]">
                    <p id="emailError" class="text-red-600 text-sm mt-1 hidden"></p>
                </div>

                <!-- ALAMAT -->
                <div>
                    <label class="font-semibold mb-1 block">Alamat</label>
                    <textarea id="alamat" name="alamat" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#ff6f00]">{{ Auth::user()->alamat ?? '' }}</textarea>
                    <p id="alamatError" class="text-red-600 text-sm mt-1 hidden"></p>
                </div>

                <!-- NOMOR TELEPON -->
                <div>
                    <label class="font-semibold mb-1 block">No. Telepon</label>
                    <input type="text" id="no_telp" name="no_telp" value="{{ Auth::user()->no_telp ?? '' }}"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#ff6f00]">
                    <p id="telpError" class="text-red-600 text-sm mt-1 hidden"></p>
                </div>

                <!-- PASSWORD -->
                <div>
                    <label class="font-semibold mb-1 block">Password Baru (Opsional)</label>
                    <input type="password" id="password" name="password"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-[#ff6f00]">
                    <p id="passwordError" class="text-red-600 text-sm mt-1 hidden"></p>
                </div>

                <button
                    class="px-6 py-3 bg-[#ff6f00] text-white rounded-lg shadow hover:bg-[#e65c00] transition font-semibold">
                    Simpan Perubahan
                </button>
            </form>

        </div>

    </section>

    {{-- VALIDASI REALTIME --}}
    <script>
        const nameInput = document.getElementById("name");
        const emailInput = document.getElementById("email");
        const alamatInput = document.getElementById("alamat");
        const telpInput = document.getElementById("no_telp");
        const passwordInput = document.getElementById("password");

        const nameError = document.getElementById("nameError");
        const emailError = document.getElementById("emailError");
        const alamatError = document.getElementById("alamatError");
        const telpError = document.getElementById("telpError");
        const passError = document.getElementById("passwordError");

        // VALIDASI NAMA
        nameInput.addEventListener("input", () => {
            if (nameInput.value.trim().length < 3) {
                nameError.textContent = "Nama minimal 3 karakter.";
                nameError.classList.remove("hidden");
            } else {
                nameError.classList.add("hidden");
            }
        });

        // VALIDASI EMAIL
        emailInput.addEventListener("input", () => {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!regex.test(emailInput.value)) {
                emailError.textContent = "Format email tidak valid.";
                emailError.classList.remove("hidden");
            } else {
                emailError.classList.add("hidden");
            }
        });

        // VALIDASI ALAMAT
        alamatInput.addEventListener("input", () => {
            if (alamatInput.value.trim().length < 5) {
                alamatError.textContent = "Alamat terlalu pendek.";
                alamatError.classList.remove("hidden");
            } else {
                alamatError.classList.add("hidden");
            }
        });

        // VALIDASI NO TELP
        telpInput.addEventListener("input", () => {
            if (!/^[0-9]+$/.test(telpInput.value)) {
                telpError.textContent = "Nomor telepon hanya boleh angka.";
                telpError.classList.remove("hidden");
            } else {
                telpError.classList.add("hidden");
            }
        });

        // VALIDASI PASSWORD
        passwordInput.addEventListener("input", () => {
            if (passwordInput.value && passwordInput.value.length < 6) {
                passError.textContent = "Password minimal 6 karakter.";
                passError.classList.remove("hidden");
            } else {
                passError.classList.add("hidden");
            }
        });
    </script>
@endsection
