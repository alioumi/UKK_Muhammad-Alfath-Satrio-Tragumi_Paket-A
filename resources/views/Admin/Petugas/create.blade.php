@extends('layouts.admin')

@section('title', 'Form Tambah Petugas')

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
    <a href="#" class="text-grey">Form Tambah Petugas</a>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-6 col-12">
            <div class="card">
                <div class="card-header">
                    Form Tambah Petugas
                </div>
                <div class="card-body">
                    <table class="table">
                        <form action="{{ route('petugas.store') }}" method="POST">
                        @csrf 
                        <tbody>
                            <tr>
                                <td><label for="nama_petugas">Nama Petugas</label></td>
                                <td>:</td>
                                <td> <input type="text" name="nama_petugas" id="nama_petugas" class="form_control" required></td>
                            </tr>
                            <tr>
                                <td><label for="username">Username</label></td>
                                <td>:</td>
                                <td> <input type="text" name="username" id="username" class="form_control" required></td>
                            </tr>
                            <tr>
                                <td><label for="password">Password</label></td>
                                <td>:</td>
                                <td><input type="password" name="password" id="password" class="form_control" required></td>
                            </tr>
                            <tr>
                                <td><label for="telp">Nomor Telp</label></td>
                                <td>:</td>
                                <td><input type="number" name="telp" id="telp" class="form_control" required></td>
                            </tr>
                            <tr>
                                <td><label for="level">Level</label></td>
                                <td>:</td>
                                <td>
                                    <select name="level" id="level" class="custom-select">
                                        <option value="petugas" selected>Pilih Level (Default Petugas)</option>
                                        <option value="admin">Admin</option>
                                        <option value="petugas">Petugas</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><button type="submit" class="btn btn-success" style="width: 100%">SIMPAN</button></td>
                            </tr>
                        </form>
                        </tbody>
                    </table>
                </div>
                
                
        <div class="col-lg-6 col-12">
            @if(Session::has('username'))
                <div class="alert alert-danger">
                    {{ Session::get('username') }}
                </div>
            @endif
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection