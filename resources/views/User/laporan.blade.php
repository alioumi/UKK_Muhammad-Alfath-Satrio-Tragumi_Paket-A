@extends('layouts.user')
@include('sweetalert::alert')

@section('css')
<link rel="stylesheet" href="{{ asset('css/landing.css') }}">
<link rel="stylesheet" href="{{ asset('css/laporan.css') }}">
@endsection

{{-- Sweet Alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

@section('title', 'Pengaduan Masyarakat Wangun')

@section('content')
{{-- Section Header --}}
<section class="header ">
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent" style="padding-top: 20px;">
        <div class="container">
            <div class="container-fluid">
                {{-- <a class="navbar-brand" href="{{ route('laporma.index') }}">
                    <h4 class="semi-bold mb-0 text-dark">Laporan Pengaduan Masyarakat</h4>
                    <p class="italic mt-0 text-dark">Wangun</p>
                </a> --}}
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    @if(Auth::guard('masyarakat')->check())
                    <ul class="navbar-nav text-center ml-auto">
                        {{-- <li class="nav-item">
                            <a class="nav-link ml-3 text-white" href="#" >Lihat Laporan</a>
                        </li> --}}
                        {{-- <li class="nav-item">
                            <a class="nav-link scrollto text-dark" href="{{ route('laporma.index') }}" class="btn btn-primary">Kembali Ke Halaman Utama</a>
                        </li>
                        <li> --}}
                            <a class="nav-link scrollto active text-dark" href="{{ route('laporma.index') }}">Kembali Ke Halaman Utama</a>
                        </li>
                        <li><div class="self-align ml-5">
                            <h5><a style="color: #e4c200" href="#">{{ Auth::guard('masyarakat')->user()->nama }}</a></h5>
                            <p class="text-dark">{{ Auth::guard('masyarakat')->user()->username }}</p>
                        </div></li>
                        <br><br>
                        {{-- <div class="col-lg-6 d-flex flex-column justify-content-center">
                            <h1 data-aos="fade-up">Layanan Laporan Pengaduan Masyarakat Wangun </h1>
                            <h2 data-aos="fade-up" data-aos-delay="400">Sampaikan laporan anda terkait permasalahan di ligkungan kepada ketua Rt dan Rw </h2> --}}
                    </ul>
                    @else
                    <ul class="navbar-nav text-center ml-auto">
                        <li class="nav-item">
                            <button class="btn text-white" type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#loginModal">Masuk</button>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('laporma.formRegister') }}" class="btn btn-outline-purple">Daftar</a>
                        </li>
                    </ul>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

<div class="container">
    <div class="col-lg-10 d-flex flex-column ">
        <h1 data-aos="fade-up text-center">Layanan Laporan Pengaduan Masyarakt Wangun </h1>
        <h2 data-aos="fade-up" data-aos-delay="400">Sampaikan laporan anda terkait permasalahan di ligkungan kepada ketua Rt dan Rw </h2>
        <br><br>
</div>
</section>
<br><br><br><br>
{{-- Bagian Table Pengaduan --}}
<div class="container">
    <div class="row justify-content-between">
        <div class="col-lg-15 col-md-12 col-sm-12 col-12 col">
            <div class="content content-top shadow">
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                    @endforeach
                @endif

                @if (Session::has('pengaduan'))
                    <div class="alert alert-{{ Session::get('type') }}">{{ Session::get('pengaduan') }}</div>
                @endif
                    {{-- <div class="font-italic" style="align-items: center">Tulis Laporan Anda Disini</div> --}}
                    <form action="{{ route('laporma.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row text-center">
                        <div class="col">
                            <p class="normal mb-2">Terverifikasi</p>
                            <div class="text-center">
                                {{ $hitung[0] }}
                            </div>
                        </div>
                        <div class="col">
                            <p class="normal mb-2">Proses</p>
                            <div class="text-center">
                                {{ $hitung[1] }}
                            </div>
                        </div>
                        <div class="col">
                            <p class="normal mb-2">Selesai</p>
                            <div class="text-center">
                                {{ $hitung[2] }}
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        Masukkan Laporan Anda di Bawah Ini
                        <textarea name="isi_laporan" class="form-control"
                            rows="5">{{ old('isi_laporan') }}</textarea>
                    </div>

                    <div class="form-group">
                        Tambahkan Foto Laporan
                        <input type="file" name="foto" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-custom mt-2">Kirim</button>

{{-- Bagian table Pengaduan --}}
    <div class="row mt-3">
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
                                @elseif($v->status == 'proses')
                                <p class="text-danger"><b style="color:black;">Status tanggapan  : </b>{{ ucwords($v->status)}}</p>
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
                        {{-- <div><b>Akses :</b> {{ $v->tanggapan->akses }} </div> --}}
                        @endif
                    </div>
                    <hr>
                </div>
            @endif
            @endforeach
    </div>
                </form>
            </div>
        </div>
    </div>
{{-- Footer --}}
    <div class="mt-3">
    <hr>
    <div class="text-center">
        <p class="italic text-secondary"></p>
    </div>
</div>
@endsection


@section('js')
@if (Session::has('pesan'))
<script>
    $('#loginModal').modal('show');

</script>
@endif
@endsection
