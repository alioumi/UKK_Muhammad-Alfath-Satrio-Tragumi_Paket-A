@extends('layouts.admin')

@section('title', 'Form Edit Petugas')

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
    </style>
@endsection

@section('header')
    <a href="{{ route('petugas.index') }}" class="text-primary">Data Petugas</a>
    <a href="#" class="text-grey">/</a>
    <a href="#" class="text-grey">Form Edit Petugas </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6  col-5">
            <div class="card">
                </div>
                <div class="card-body">
                    <table class="table">
                        <form action="{{ route('petugas.update', $petugas->id_petugas) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <tbody>
                            <tr>
                                <td><label for="nama_petugas">Nama Petugas</label></td>
                                <td>:</td>
                                <td><input type="text" value="{{ $petugas->nama_petugas }}" name="nama_petugas" id="nama_petugas" class="form_control" required></td>
                            </tr>
                            <tr>
                                <td><label for="username">Username</label></td>
                                <td>:</td>
                                <td><input type="text" value="{{ $petugas->username }}" name="username" id="username" class="form_control" required></td>
                            </tr>
                            <tr>
                                <td><label for="password">Password</label></td>
                                <td>:</td>
                                <td><input type="password" name="password" id="password" class="form_control" required></td>
                            </tr>
                            <tr>
                                <td><label for="telp">Nomor Telp</label></td>
                                <td>:</td>
                                <td><input type="number" value="{{ $petugas->telp }}" name="telp" id="telp" class="form_control" required></td>
                            </tr>
                            <tr>
                                <td><label for="level">Level</label></td>
                                <td>:</td>
                                <td>
                                    <select name="level" id="level" class="custom-select">
                                    @if($petugas->level == 'admin')
                                    <option selected value="admin">Admin</option>
                                    <option value="petugas">Petugas</option>
                                    @else
                                    <option value="admin">Admin</option>
                                    <option selected value="petugas">Petugas</option>
                                    @endif
                                </select>
                            </td>
                            </tr>
                            <tr>
                                <td colspan="2"><button type="submit" class="btn" style="width: 100%">UPDATE</button></td>
                            </form>
                                <td>
                                <form action="{{ route('petugas.destroy', $petugas->id_petugas) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" style="width: 100%" onclick="return confirm('Apakah anda yakin data ingin dihapus ?')">HAPUS</button>
                                </form>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
