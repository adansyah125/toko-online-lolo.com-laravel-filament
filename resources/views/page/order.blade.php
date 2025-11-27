@extends('layouts.app')

@section('content')
    <section class="container mt-5 mb-5">


        @if (count($cart) > 0)
            {{-- PRODUK --}}
            <div class="bg-white p-4 rounded shadow-sm mb-4">
                <h4 class="fw-semibold mb-3">Produk yang dipesan</h4>

                @foreach ($cart as $item)
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <img src="{{ asset('storage/' . $item->product->image1) }}" class="rounded"
                                style="width: 80px; height: 80px; object-fit: cover;">
                            <div>
                                <p class="fw-semibold mb-1">{{ $item['name'] }}</p>
                                <small class="text-secondary">Qty: {{ $item['qty'] }}</small>
                            </div>
                        </div>

                        <p class="fw-bold text-black m-0">
                            Rp {{ number_format($item['harga'] * $item['qty'], 0, ',', '.') }}
                        </p>
                    </div>
                @endforeach

                <div class="d-flex justify-content-between align-items-center mt-3 fs-5 fw-semibold">
                    <span>Total:</span>
                    <span class="text-black">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>

            {{-- FORM CHECKOUT --}}
            <form id="loginForm" action="{{ route('pesanan.add') }}" method="POST" class="bg-white p-4 rounded shadow-sm">
                @csrf
                <h4 class="fw-semibold mb-3">Informasi Penerima</h4>

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Nama Penerima</label>
                        <input type="text" name="nama_penerima" id="nama_penerima" class="form-control" required>
                        <small class="text-danger" id="error_nama"></small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">No. Telepon</label>
                        <input type="text" name="telepon" id="telepon" class="form-control"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,13)" required>
                        <small class="text-danger" id="error_telepon"></small>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Provinsi</label>
                        <select name="province" id="province" class="form-select" required>
                            <option disabled selected>-- Pilih provinsi --</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                            </option>
                        </select>
                        <small class="text-danger" id="error_province"></small>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Kab/Kota</label>
                        <select name="regencie" id="regencie" class="form-select" required>
                            {{-- @foreach ($regencies as $regencie)
                                <option value="{{ $regencie->id }}">{{ $regencie->name }}</option>
                            @endforeach --}}
                        </select>
                        <small class="text-danger" id="error_regencie"></small>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Kecamatan</label>
                        <select name="district" id="district" class="form-select" required>

                        </select>
                        <small class="text-danger" id="error_district"></small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">desa/kelurahan</label>
                        <select name="village" id="village" class="form-select" required>

                        </select>
                        <small class="text-danger" id="error_village"></small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Kode Pos</label>
                        <input type="text" name="kode_pos" id="kode_pos" class="form-control"
                            oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0,5)" required>
                        <small class="text-danger" id="error_kodepos"></small>
                    </div>
                    <div class="col-12">
                        <label class="form-label">Jl, Gang / Patokan</label>
                        <textarea name="alamat" id="alamat" rows="3" class="form-control" required></textarea>
                        <small class="text-danger" id="error_alamat"></small>
                    </div>
                    {{-- <div class="mb-3">
                        <label class="form-label fw-semibold">Kode Pesanan</label>
                        <input type="text" name="order_id" value="{{ $orderid }}" class="form-control"
                            placeholder="Masukkan Order ID" readonly>
                    </div> --}}
                    <input type="hidden" name="order_id" value="{{ $orderid }}">

                    <div class="text-end mt-4">
                        <button id="submitBtn" type="submit" class="btn btn-black px-4 py-2 fw-semibold">
                            Buat Pesanan
                        </button>
                    </div>

            </form>
        @else
            <p class="text-center text-secondary py-5">Keranjang kosong</p>
        @endif

    </section>

    {{-- TOAST NOTIF --}}
    @if (session('success'))
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div class="toast show bg-success text-white">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div class="toast show bg-danger text-white">
                <div class="toast-body">
                    {{ session('error') }}
                </div>
            </div>
        </div>
    @endif

    <script>
        // ELEMENT INPUT
        const nama = document.getElementById("nama_penerima");
        const telepon = document.getElementById("telepon");
        const alamat = document.getElementById("alamat");
        const kota = document.getElementById("kota");
        const kodepos = document.getElementById("kode_pos");
        const ekspedisi = document.getElementById("ekspedisi");

        const submitBtn = document.getElementById("submitBtn");
        const loading = document.getElementById('loading');

        // ELEMENT ERROR
        const errorNama = document.getElementById("error_nama");
        const errorTelepon = document.getElementById("error_telepon");
        const errorAlamat = document.getElementById("error_alamat");
        const errorKota = document.getElementById("error_kota");
        const errorKodepos = document.getElementById("error_kodepos");
        const errorEkspedisi = document.getElementById("error_ekspedisi");

        // Disable button diawal
        // submitBtn.disabled = true;

        // EVENT LISTENER
        nama.addEventListener("input", validateNama);
        telepon.addEventListener("input", validateTelepon);
        alamat.addEventListener("input", validateAlamat);
        kota.addEventListener("input", validateKota);
        kodepos.addEventListener("input", validateKodepos);
        ekspedisi.addEventListener("change", validateEkspedisi);

        // VALIDASI NAMA
        function validateNama() {
            const value = nama.value.trim();

            if (value.length < 3) {
                errorNama.innerText = "Nama minimal 3 karakter";
                nama.classList.add("is-invalid");
            } else {
                errorNama.innerText = "";
                nama.classList.remove("is-invalid");
            }
            checkAllValid();
        }

        // VALIDASI TELEPON (HARUS ANGKA & 13 DIGIT)
        function validateTelepon() {
            const value = telepon.value.trim();
            const angkaOnly = /^[0-9]+$/;

            if (!angkaOnly.test(value)) {
                errorTelepon.innerText = "Nomor telepon hanya boleh angka";
                telepon.classList.add("is-invalid");
            } else if (value.length !== 13 && value.length !== 12) {
                errorTelepon.innerText = "Nomor telepon harus 12 atau 13 digit";
                telepon.classList.add("is-invalid");
            } else {
                errorTelepon.innerText = "";
                telepon.classList.remove("is-invalid");
            }
            checkAllValid();
        }

        // VALIDASI ALAMAT
        function validateAlamat() {
            const value = alamat.value.trim();

            if (value.length < 5) {
                errorAlamat.innerText = "Alamat terlalu pendek";
                alamat.classList.add("is-invalid");
            } else {
                errorAlamat.innerText = "";
                alamat.classList.remove("is-invalid");
            }
            checkAllValid();
        }

        // VALIDASI KOTA
        function validateKota() {
            const value = kota.value.trim();

            if (value.length < 3) {
                errorKota.innerText = "Nama kota terlalu pendek";
                kota.classList.add("is-invalid");
            } else {
                errorKota.innerText = "";
                kota.classList.remove("is-invalid");
            }
            checkAllValid();
        }

        // VALIDASI KODE POS (HARUS ANGKA & 5 DIGIT)
        function validateKodepos() {
            const value = kodepos.value.trim();
            const angkaOnly = /^[0-9]+$/;

            if (!angkaOnly.test(value)) {
                errorKodepos.innerText = "Kode pos hanya boleh angka";
                kodepos.classList.add("is-invalid");
            } else if (value.length !== 5) {
                errorKodepos.innerText = "Kode pos harus 5 digit";
                kodepos.classList.add("is-invalid");
            } else {
                errorKodepos.innerText = "";
                kodepos.classList.remove("is-invalid");
            }
            checkAllValid();
        }

        // VALIDASI EKSPEDISI
        function validateEkspedisi() {
            if (ekspedisi.value === "") {
                errorEkspedisi.innerText = "Pilih ekspedisi terlebih dahulu";
                ekspedisi.classList.add("is-invalid");
            } else {
                errorEkspedisi.innerText = "";
                ekspedisi.classList.remove("is-invalid");
            }
            checkAllValid();
        }

        // CEK SEMUA VALID
        function checkAllValid() {
            loading.classList.remove("hidden");
            const valid =
                errorNama.innerText === "" &&
                errorTelepon.innerText === "" &&
                errorAlamat.innerText === "" &&
                errorKota.innerText === "" &&
                errorKodepos.innerText === "" &&
                errorEkspedisi.innerText === "" &&
                nama.value.trim() !== "" &&
                telepon.value.trim() !== "" &&
                alamat.value.trim() !== "" &&
                kota.value.trim() !== "" &&
                kodepos.value.trim() !== "" &&
                ekspedisi.value !== "";

            submitBtn.disabled = !valid;
        }
    </script>
    {{-- get data wilayah --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#province').on('change', function() {
                let id_province = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('get.regencie') }}",
                    data: {
                        id_province: id_province
                    },
                    cahce: 'false',

                    success: function(response) {
                        $('#regencie').html(response);
                        $('#district').html('');
                        $('#village').html('');

                    }
                })
            })

            $('#regencie').on('change', function() {
                let id_regencie = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('get.district') }}",
                    data: {
                        id_regencie: id_regencie
                    },
                    cahce: 'false',

                    success: function(response) {
                        $('#district').html(response);
                        $('#village').html('');
                    }
                })
            })

            $('#district').on('change', function() {
                let id_district = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('get.village') }}",
                    data: {
                        id_district: id_district
                    },
                    cahce: 'false',

                    success: function(response) {
                        $('#village').html(response);
                    }
                })
            })
        });
    </script>



@endsection
