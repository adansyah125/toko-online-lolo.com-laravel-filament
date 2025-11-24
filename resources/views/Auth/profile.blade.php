@extends('layouts.app')

@section('content')
    <section class="container py-5" style="max-width: 900px;">

        <div class="bg-white rounded shadow-lg p-4 p-md-5" data-aos="fade-up">

            <!-- FOTO + NAMA -->
            <div class="d-flex flex-column flex-md-row align-items-center gap-4" data-aos="fade-right">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=000&color=fff"
                    class="rounded-circle shadow" style="width: 110px; height: 110px; object-fit: cover;">

                <div data-aos="fade-left" data-aos-delay="200">
                    <h2 class="fw-bold text-dark">{{ Auth::user()->name }}</h2>
                    <p class="text-secondary">{{ Auth::user()->email }}</p>
                </div>
            </div>

            <hr class="my-4" data-aos="zoom-in">

            <!-- FORM PROFIL -->
            <form id="profileForm" action="{{ route('user.profile.update') }}" method="POST" data-aos="fade-up"
                data-aos-delay="150">
                @csrf
                @method('PUT')

                <!-- NAMA -->
                <div class="mb-3" data-aos="fade-up" data-aos-delay="200">
                    <label class="form-label fw-semibold">Nama Lengkap</label>
                    <input type="text" id="name" name="name" value="{{ Auth::user()->name }}"
                        class="form-control">
                    <small id="nameError" class="text-danger d-none"></small>
                </div>

                <!-- EMAIL -->
                <div class="mb-3" data-aos="fade-up" data-aos-delay="250">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" id="email" name="email" value="{{ Auth::user()->email }}"
                        class="form-control">
                    <small id="emailError" class="text-danger d-none"></small>
                </div>

                <!-- ALAMAT -->
                <div class="mb-3" data-aos="fade-up" data-aos-delay="300">
                    <label class="form-label fw-semibold">Alamat</label>
                    <textarea id="alamat" name="alamat" rows="3" class="form-control">{{ Auth::user()->alamat ?? '' }}</textarea>
                    <small id="alamatError" class="text-danger d-none"></small>
                </div>

                <!-- NO TELEPON -->
                <div class="mb-3" data-aos="fade-up" data-aos-delay="350">
                    <label class="form-label fw-semibold">No. Telepon</label>
                    <input type="text" id="no_telp" name="no_telp" value="{{ Auth::user()->no_telp ?? '' }}"
                        class="form-control">
                    <small id="telpError" class="text-danger d-none"></small>
                </div>

                <!-- PASSWORD -->
                <div class="mb-4" data-aos="fade-up" data-aos-delay="400">
                    <label class="form-label fw-semibold">Password Baru (Opsional)</label>
                    <input type="password" id="password" name="password" class="form-control">
                    <small id="passwordError" class="text-danger d-none"></small>
                </div>

                <button class="btn btn-warning text-white fw-semibold px-4 py-2" data-aos="zoom-in" data-aos-delay="450">
                    Simpan Perubahan
                </button>

            </form>

        </div>

    </section>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1800
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                html: '{!! implode('<br>', $errors->all()) !!}',
            });
        </script>
    @endif
@endsection
