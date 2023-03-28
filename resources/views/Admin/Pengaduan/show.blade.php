@extends('layouts.admin')

@section('title', 'Detail Pengaduan')

@section('css')
    <style>
        .text-primary:hover {
            text-decoration: underline;
        }

        .text-grey {
            color: #6c757d;
        }

        .text-grey:hover {
            color: #6c757d;
        }

        .btn-purple {
            background: #6a70fc;
            border: 1px solid #6a70fc;
            color: #fff;
            width: 100%;
        }
    </style>
@endsection

@section('header')
    <a href="{{ route('pengaduan.index') }}" class="text-primary">Data Pengaduan</a>
    <a href="#" class="text-grey">/</a>
    <a href="#" class="text-grey">Detail Pengaduan</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="text-center">
                Pengaduan Masyarakat
            </div>
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>NIK</th>
                                <td>:</td>
                                <td>{{ $pengaduan->user->nik }}</td>
                            </tr>
                            <tr>
                                <th>Nama Pelapor</th>
                                <td>:</td>
                                <td>{{ $pengaduan->user->nama}}</td>
                            </tr>
                            <tr>
                                <th>Nama Pelapor</th>
                                <td>:</td>
                                <td>{{ $pengaduan->user->nama }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Pengaduan</th>
                                <td>:</td>
                                <td>{{ $pengaduan->tgl_pengaduan }}</td>
                            </tr>
                            <tr>
                                <th>Isi Laporan</th>
                                <td>:</td>
                                <td>{{ $pengaduan->isi_laporan }}</td>
                            </tr>
                            <tr>
                                <th>Jenis Kelamin</th>
                                <td>:</td>
                                <td>{{ $pengaduan->user->jenis_kelamin }}</td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                                <td>:</td>
                                <td>{{ $pengaduan->user->alamat }}</td>
                            </tr>
                            <tr>
                                <th>Foto</th>
                                <td>:</td>
                                <td>
                                    @if($pengaduan->foto == null)
                                    -
                                    @else
                                    <img src="{{ Storage::url($pengaduan->foto) }}" alt="Foto pengaduan" class="embed-responsive"></td>
                                    @endif
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>:</td>
                                <td>
                                    @if ($pengaduan->status == '0')
                                        <a href="" class="badge badge-danger">Terverifikasi</a>
                                    @elseif($pengaduan->status == 'proses')
                                        <a href="" class="badge badge-warning text-white">Proses</a>
                                    @else
                                        <a href="" class="badge badge-succes">Selesai</a>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <div class="col-lg-6 col-12">
            <div class="text-center">
                Tanggapan Petugas
            </div>
            <div class="card-body">
                <form action="{{ route('tanggapan.createOrUpdate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_pengaduan" value="{{ $pengaduan->id_pengaduan }}">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <div class="input-group mb-3">
                            <select name="status" id="status" class="custom-select">
                                @if ($pengaduan->status == '0')
                                    <option selected value="0">Pending</option>
                                    <option value="proses">Verifikasi</option>
                                    <option value="selesai">Selesai</option>
                                @elseif($pengaduan->status == 'proses')
                                    <option value="0">Pending</option>
                                    <option selected value="proses">Proses</option>
                                    <option value="selesai">Selesai</option>
                                @else
                                    <option value="0">Pending</option>
                                    <option value="proses">Proses</option>
                                    <option selected value="selesai">Selesai</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="akses">Akses</label>
                            <div class="input-group mb-3">
                                <select name="akses" id="akses" class="custom-select">
                                    @if ($tanggapan != null && $tanggapan->akses == 'public')
                                        <option selected value="public">Public</option>
                                        <option value="private">Private</option>
                                    @else
                                        <option value="public">Public</option>
                                        <option value="private" selected>Private</option>
                                    @endif
                                </select>
                            </div>
                    </div>
                    <div class="form-group">
                        <label for="tanggapan">Tanggapan</label>
                        <textarea name="tanggapan" id="tanggapan" rows="4" class="form-control" placeholder="Belum ada tanggapan">{{ $tanggapan->tanggapan ?? '' }}</textarea>
                    </div>
                    <button type="submit" class="btn ">KIRIM</button>
                </form>
                @if(Session::has('status'))
                    <div class="alert alert-success mt-2">
                        {{ Session::get('status') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
