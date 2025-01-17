@extends('layouts.backend.app')
@section('title')
    Laporan Absensi
@endsection

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                    Laporan Absensi
                </h2>
            </div>
        </div>
    </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title mb-0">Pilih Periode dan Anggota</h3>
                    </div>
                    <div class="card-body">
                        <form action="/absensi/cetaklaporan" id="formLaporan" target="_blank" method="POST">
                            @csrf
                            <!-- Bulan -->
                            <div class="mb-3">
                                <label for="bulan" class="form-label">Bulan</label>
                                <select name="bulan" id="bulan" class="form-select">
                                    <option value="">Pilih Bulan</option>
                                    @for ($i=1; $i<=12; $i++)
                                        <option value="{{ $i }}" {{ date("m") == $i ? 'selected' : ''  }}>
                                            {{ $namabulan[$i] }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Tahun -->
                            <div class="mb-3">
                                <label for="tahun" class="form-label">Tahun</label>
                                <select name="tahun" id="tahun" class="form-select">
                                    <option value="">Pilih Tahun</option>
                                    @php
                                    $tahunmulai = 2024;
                                    $tahunskrg = date("Y");
                                    @endphp
                                    @for ($tahun=$tahunmulai; $tahun<= $tahunskrg; $tahun++)
                                        <option value="{{ $tahun }}" {{ date("Y") == $tahun ? 'selected' : ''  }}>
                                            {{ $tahun }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Anggota -->
                            <div class="mb-3">
                                <label for="nis" class="form-label">Anggota</label>
                                <select name="nis" id="nis" class="form-select">
                                    <option value="">Pilih Anggota</option>
                                    @foreach ($anggota as $d)
                                        <option value="{{ $d->nis }}">{{ $d->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tombol Submit -->
                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" name="cetak" class="btn btn-primary w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2"></path>
                                            <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4"></path>
                                            <path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z"></path>
                                        </svg>
                                        Cetak
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="submit" name="exportexcel" class="btn btn-success w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-download" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2"></path>
                                            <path d="M7 11l5 5l5 -5"></path>
                                            <path d="M12 4l0 12"></path>
                                        </svg>
                                        Export to Excel
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('myscript')
<script>
    $(function() {
        $("#frmLaporan").submit(function(e) {
            var bulan = $("#bulan").val();
            var tahun = $("#tahun").val();
            var nis = $("#nis").val();
            if (bulan == "") {
                Swal.fire({
                    title: 'Warning!'
                    , text: 'Bulan Harus Dipilih!'
                    , icon: 'warning'
                    , confirmButtonText: 'Ok'
                }).then((result) => {
                    $("#bulan").focus();
                });
                return false;
            } else if (tahun == "") {
                Swal.fire({
                    title: 'Warning!'
                    , text: 'Tahun Harus Dipilih!'
                    , icon: 'warning'
                    , confirmButtonText: 'Ok'
                }).then((result) => {
                    $("#tahun").focus();
                });
                return false;
            } else if (nis == "") {
                Swal.fire({
                    title: 'Warning!'
                    , text: 'Anggota Harus Diisi!'
                    , icon: 'warning'
                    , confirmButtonText: 'Ok'
                }).then((result) => {
                    $("#nis").focus();
                });
                return false;
            }
        });
    });
</script>
@endpush
