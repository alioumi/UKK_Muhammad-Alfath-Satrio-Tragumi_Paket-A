@extends('layouts.user')
@include('sweetalert::alert')

@section('css')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
<link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
@endsection

@section('title', 'PEMASWA! - Pengaduan Masyarakat Wangun')
<form class="user" action="{{route(user.laporan)}}" method="POST">
    <div class="row mt-5">
        <div class="col-lg-8">
            <a class="d-inline tab {{ $siapa != 'me' ? 'tab-active' : ''}} mr-4" href="{{ route('laporma.laporan') }}">
                Laporan dari masyarakat lain
            </a>
            <a class="d-inline tab {{ $siapa == 'me' ? 'tab-active' : ''}}" href="{{ route('laporma.laporan', 'me') }}">
                Laporan saya
            </a>
            <hr>
        </div>

        @foreach ($pengaduan as $k => $v)
            @if (request()->is('laporan'))
                @if ($v->tanggapan->akses == 'public')
                    <div class="col-lg-8">
                        <div class="laporan-top">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <p><b>Nama Pengirim : </b> {{ $v->user->nama }}</p>
                                    @if ($v->status == '0')
                                    <p class="text-danger"><b style="color:black;">Status tanggapan : </b>Pending</p>
                                    @elseif($v->status == 'Proses')
                                    <p class="text-warning"><b style="color:black;">Status tanggapan : </b>{{ ucwords($v->status) }}</p>
                                    @else
                                    <p class="text-success"><b style="color:black;">Status tanggapan : </b>{{ ucwords($v->status) }}</p>
                                    @endif
                                </div>
                                <div>
                                    <p>{{ $v->tgl_pengaduan}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="laporan-mid">
                            <div class="judul-laporan">
                                {{ $v->judul_laporan }}
                            </div>
                            <p><h4>Isi laporan : </h4>{{ $v->isi_laporan }}</p>
                        </div>
                        <div class="laporan-bottom">
                            @if ($v->foto != null)
                            <img src="{{ Storage::url($v->foto) }}" alt="{{ 'Gambar '.$v->judul_laporan }}" class="gambar-lampiran">
                            @endif
                            @if ($v->tanggapan != null)
                            <p class="mt-3 mb-1">{{ '*Tanggapan dari '. $v->tanggapan->petugas->nama_petugas }}</p>
                            <p class="light"><strong> Tanggapan Pengaduan : </strong> {{ $v->tanggapan->tanggapan }}</p>
                            <div><b>Akses :</b> {{ $v->tanggapan->akses }} </div>
                            @endif
                        </div>
                        <hr>
                    </div>
                @endif
            @else
                <div class="col-lg-8">
                    <div class="laporan-top">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p><b>Nama Pengirim : </b> {{ $v->user->nama }}</p>
                                @if ($v->status == '0')
                                <p class="text-danger"><b style="color:black;">Status tanggapan : </b>Pending</p>
                                @elseif($v->status == 'Proses')
                                <p class="text-warning"><b style="color:black;">Status tanggapan : </b>{{ ucwords($v->status) }}</p>
                                @else
                                <p class="text-success"><b style="color:black;">Status tanggapan : </b>{{ ucwords($v->status) }}</p>
                                @endif
                            </div>
                            <div>
                                <p>{{ $v->tgl_pengaduan}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="laporan-mid">
                        <div class="judul-laporan">
                            {{ $v->judul_laporan }}
                        </div>
                        <p><h4>Isi laporan : </h4>{{ $v->isi_laporan }}</p>
                    </div>
                    <div class="laporan-bottom">
                        @if ($v->foto != null)
                        <img src="{{ Storage::url($v->foto) }}" alt="{{ 'Gambar '.$v->judul_laporan }}" class="gambar-lampiran">
                        @endif
                        @if ($v->tanggapan != null)
                        <p class="mt-3 mb-1">{{ '*Tanggapan dari '. $v->tanggapan->petugas->nama_petugas }}</p>
                        <p class="light"><strong> Tanggapan Pengaduan : </strong> {{ $v->tanggapan->tanggapan }}</p>
                        <div><b>Akses :</b> {{ $v->tanggapan->akses }} </div>
                        @endif
                    </div>
                    <hr>
                </div>
            @endif
            @endforeach
    </div>
</form>
