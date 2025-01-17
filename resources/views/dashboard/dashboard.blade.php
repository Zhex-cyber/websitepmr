@extends('layouts.absensi')

@section('content')
<style>
    .logout {
        position: absolute;
        color: white;
        font-size: 30px;
        text-decoration: none;
        right: 8px;
    }

    .logout:hover {
        color: white;

    }

    .image-listview>li .item {
        min-height: 80px !important;
        border-radius: 20px !important;
    }
</style>
<!-- App Capsule -->
<div id="appCapsule">
    <div class="section" id="user-section">
        <a href="/proseslogout" class="logout">
            <ion-icon name="exit-outline"></ion-icon>
        </a>
        <div id="user-detail">
            <div class="avatar">
                @if (!empty(Auth::user()->foto))
                @php
                    $path = Storage::url('uploads/anggota/' . Auth::user()->foto);
                @endphp
                <img src="{{ url($path) }}" alt="avatar" class="imaged w64" style="height: 60px;">
                @else
                <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" alt="avatar" class="imaged w64 rounded">
                @endif
            </div>

        </div>
    </div>

    <div class="section" id="menu-section">
        <div class="card bg-grey">
            <div class="card-body d-flex align-items-center">
                <!-- Gambar di sebelah kiri -->
                <div class="item-menu text-center">
                    <img src="{{ asset('assets/img/h.jpg') }}" style="width: 80px; height: 80px; border-radius: 50%;">
                </div>
                <!-- Teks di sebelah kanan -->
                <div class="item-menu text-center ml-3">
                    <h3 class="font-weight-bold">ABSENSI PMR WIRA SMKN 1 KAWALI</h3>
                </div>
            </div>
        </div>
    </div>



    {{-- <div class="section" id="menu-section">
        <div class="card">
            <div class="card-body text-center">
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/editprofile" class="green" style="font-size: 40px;">
                                <ion-icon name="person-sharp"></ion-icon>
                            </a>
                        </div>

                        <div class="menu-name">
                            <span class="text-center">Profil</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/absensi/histori" class="danger" style="font-size: 40px;">
                                <ion-icon name="document-text"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Histori</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="/absensi/izin" class="warning" style="font-size: 40px;">
                                <ion-icon name="calendar-number"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Izin</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="#" class="orange" style="font-size: 40px;">
                                <ion-icon name="location"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Lokasi</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="section mt-2" id="presence-section">
        <div class="todaypresence">
            <div class="row">
                <div class="col-6">
                    <div class="card gradasigreen">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    @if ($absensihariini != null && !empty($absensihariini->foto_in))
                                    @php
                                        $path = Storage::url('uploads/absensi/' . $absensihariini->foto_in);
                                    @endphp
                                    <img src="{{ url($path) }}" alt="" class="imaged w48">
                                    @else
                                    <ion-icon name="camera"></ion-icon>
                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Masuk</h4>
                                    <span>{{ $absensihariini != null ? $absensihariini->jam_in : 'Belum Absen' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card gradasired">
                        <div class="card-body">
                            <div class="presencecontent">
                                <div class="iconpresence">
                                    @if ($absensihariini != null && !empty($absensihariini->foto_out))
                                    @php
                                        $path = Storage::url('uploads/absensi/' . $absensihariini->foto_out);
                                    @endphp
                                    <img src="{{ url($path) }}" alt="" class="imaged w48">
                                    @else
                                    <ion-icon name="camera"></ion-icon>
                                    @endif
                                </div>
                                <div class="presencedetail">
                                    <h4 class="presencetitle">Pulang</h4>
                                    <span>{{ $absensihariini != null && $absensihariini->jam_out != null ? $absensihariini->jam_out : 'Belum Absen' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div id="rekapabsensi">
            <h3>Rekap Absensi Bulan {{ $namabulan[$bulanini] ?? 'Bulan Ini' }} Tahun {{ $tahunini }}</h3>
            <div class="row">
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 12px 12px !important; line-height:0.8rem">
                            <span class="badge bg-danger" style="position: absolute; top:3px; right:10px; font-size:0.6rem;">{{ $rekapabsensi->jmlhadir }}</span>
                            <ion-icon name="accessibility-outline" style="font-size: 1.6rem;" class="text-primary mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Hadir</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 12px 12px !important; line-height:0.8rem">
                            <span class="badge bg-danger" style="position: absolute; top:3px; right:10px; font-size:0.6rem; z-index:999">
                                {{ $rekapizin->jmlizin }}</span>
                            <ion-icon name="newspaper-outline" style="font-size: 1.6rem;" class="text-success mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Izin</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 12px 12px !important; line-height:0.8rem">
                            <span class="badge bg-danger" style="position: absolute; top:3px; right:10px; font-size:0.6rem; z-index:999">
                                {{ $rekapizin->jmlsakit }}
                            </span>
                            <ion-icon name="medkit-outline" style="font-size: 1.6rem;" class="text-warning mb-1"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight:500">Sakit</span>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body text-center" style="padding: 12px; line-height: 0.8rem;">
                            @if (!empty($rekapabsensi->jmlterlambat))

                                <span class="badge bg-danger"
                                      style="position: absolute; top: 3px; right: 10px; font-size: 0.6rem; z-index: 999;">
                                    {{ $rekapabsensi->jmlterlambat }}
                                </span>
                            @endif
                            <ion-icon name="alarm-outline" class="text-danger mb-1" style="font-size: 1.6rem;"></ion-icon>
                            <br>
                            <span style="font-size: 0.8rem; font-weight: 500;">Telat</span>
                        </div>
                    </div>
                </div>

        </div>
        <!--OPSIONAL-->
        {{-- <div class="presencetab mt-2">
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                            Bulan Ini
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#leaderboard" role="tab">
                            Leaderboard
                        </a>
                    </li>
                </ul>
            </div> --}}

            {{-- <div class="tab-content mt-2" style="margin-bottom:100px;">
                <!-- Tab "Bulan Ini" -->
                <div class="tab-pane fade show active" id="home" role="tabpanel">
                    <ul class="listview image-listview">
                        @foreach ($historibulanini as $data)
                        @php
                            $path = Storage::url('uploads/absensi/' . $data->foto_in);
                        @endphp
                        <li>
                            <div class="item">
                                <div class="icon-box bg-primary">
                                    <ion-icon name="pin-outline"></ion-icon>
                                </div>
                                <div class="in">
                                    <div>{{ date('d-m-Y', strtotime($data->tgl_absensi)) }}</div>
                                    <span class="badge badge-success">{{ $data->jam_in }}</span>
                                    <span class="badge badge-warning">
                                        {{ $data->jam_out != null ? $data->jam_out : 'Belum Absen' }}
                                    </span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>

                <!-- Leaderboard" -->
                <div class="tab-pane fade" id="leaderboard" role="tabpanel">
                    <ul class="listview image-listview">
                        @foreach ($leaderboard as $d)
                        <li>
                            <div class="item">
                                <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" alt="gambar" class="image">
                                <div class="in">
                                    <div>
                                        <b>{{ $d->nama_lengkap }}</b> <br>
                                        <small class="text-muted"> {{ $d->kelas_jurusan }}</small>
                                    </div>
                                    <span class="badge {{ $d->jam_in < '08:00' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $d->jam_in }}
                                    </span>
                                    <span class="badge {{ $d->jam_out > '12:00' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $d->jam_out }}
                                    </span>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- * App Capsule -->
@endsection
