@extends('layouts.admin')

@section('title', 'Halaman Dashboard')

@section('header', 'Dashboard')

@section('content')
     <div class="row">
        <div class="col-lg-3">
            <div class="card text-center card text-white bg-danger mb-3">
                <div class="card-header">Menunggu Ditanggapi</div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $baru }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card text-center card text-white bg-warning mb-3">
                <div class="card-header">Pengaduan Proses</div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $proses }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card text-center card text-white bg-success mb-3">
                <div class="card-header">Pengaduan Selesai</div>
                <div class="card-body">
                    <div class="text-center">
                        {{ $selesai }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
