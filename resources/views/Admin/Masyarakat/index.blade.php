@extends('layouts.admin')

@section('title', 'Halaman Masyarakat')
    
@section('css')
   <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
@endsection

@section('header', 'Data Masyarakat')

@section('content')
   <table id="masyarakatTable" class="table">
      <thead>
         <tr>
            <th>No</th>
            <th>NIK</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Telp</th>
            <th>Jenis Kelamin</th>
            <th>Alamat</th>
         </tr>
      </thead>
      <tbody>
         @foreach ($masyarakat as $k => $v)
            <tr>
               <td>{{ $k += 1 }}</td>
               <td>{{ $v->nik }}</td>
               <td>{{ $v->nama }}</td>
               <td>{{ $v->username }}</td>
               <td>{{ $v->telp }}</td>
               <td>{{ $v->jenis_kelamin}}</td>
               <td>{{ $v->alamat}}</td>
               {{-- <td><a href="{{ route('masyarakat.show', $v->nik) }}" style="text-decoration: none">LIHAT</a></td> --}}
            </tr>
         @endforeach
      </tbody>
   </table>
@endsection

{{-- Javascript --}}
@section('js')
   <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
   <script>
      $(document).ready(function () {
         $('#masyarakatTable').DataTable();
      });
   </script>
@endsection