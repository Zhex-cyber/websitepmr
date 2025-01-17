@extends('layouts.absensi')
@section('title')
 Buat Izin | PMR
@endsection
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
<style>
    .datepicker-modal {
        max-height: 430px !important;
    }

    .datepicker-date-display {
        background-color: #1e74fd !important;
    }

    .datepicker-cancel, .datepicker-clear, .datepicker-today, .datepicker-done {
    color: #1e74fd;
    padding: 0 1rem;
    }

    .datepicker-table td.is-selected {
    background-color: #1e74fd;
    color: #fff;
    }

    .datepicker-table td.is-today {
    color: #1e74fd;
    }
</style>

<!-- App Header -->
<div class="appHeader bg-primary text-light">
   <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div> <!-- Penutupan div .left yang benar -->
    <div class="pageTitle">Form Izin</div>
    <div class="right"></div>
</div>
<!-- App Header -->
@endsection

@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">
            <form method="POST" action="/absensi/storeizin" id="formizin">
                @csrf
                <div class="form-group">
                    <input type="text" id="tgl_izin" name="tgl_izin" class="form-control datepicker" placeholder="Tanggal">
                </div>
                <div class="form-group">
                    <select name="status" id="status" class="form-control">
                        <option value="">Izin / Sakit</option>
                        <option value="i">Izin</option>
                        <option value="s">Sakit</option>
                    </select>
                </div>
                <div class="form-group">
                    <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control" placeholder="Keterangan"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary w-100">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        var currYear = (new Date()).getFullYear();

            $(document).ready(function() {
            $(".datepicker").datepicker({

                format: "yyyy-mm-dd"
            });

            $("#tgl_izin").change(function(e) {
                var tgl_izin = $(this).val(); // Menyimpan nilai tanggal izin yang dipilih

                $.ajax({
                    type: "POST", // Metode pengiriman data (POST)
                    url: "/absensi/cekpengajuanizin", // URL untuk memproses pengecekan izin
                    data: {
                        _token: "{{ csrf_token() }}", // Token CSRF untuk keamanan (biasanya pada Laravel)
                        tgl_izin: tgl_izin // Mengirimkan nilai tanggal izin
                    },
                    cache: false, // Menonaktifkan cache
                    success: function(respond) {
                        if (respond == 1) {
                        Swal.fire({
                        title: 'Oops !',
                        text: 'Anda Sudah Melakukan Izin Pada Tanggal Tersebut! ',
                        icon: 'warning',
                        }).then((result)=> {
                            $("#tgl_izin").val("");
                        });
                        }
                    }
                });
            });

                $("#formizin").submit(function(){
                var tgl_izin = $("#tgl_izin").val();
                var status = $("#status").val();
                var keterangan = $("#keterangan").val();
                if (tgl_izin == "") {
                     Swal.fire({
                        title: 'Oops !',
                        text: 'Tanggal Harus Diisi ',
                        icon: 'warning',
                        })
                    return false;
                } else if (status == "") {
                    Swal.fire({
                        title: 'Oops !',
                        text: 'Status Harus Diisi ',
                        icon: 'warning',
                        })
                    return false;
                } else if (keterangan == "") {
                    Swal.fire({
                        title: 'Oops !',
                        text: 'Keterangan Harus Diisi ',
                        icon: 'warning',
                        })
                    return false;
                }
            });
         });
    </script>
@endpush
