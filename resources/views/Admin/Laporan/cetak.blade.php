<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pengaduan Masyarakat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css"> --}}
    <style>
        /* @page { size: A4 } */

        h1 {
            font-weight: bold;
            font-size: 20pt;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 80%;
        }

        .table th {
            padding: 10px 10px;
            border:1px solid #000000;
            text-align: center;
        }

        .table td {
            padding: 5px 5px;
            border:1px solid #000000;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <section class="sheet padding-10mm">
        <center>
            <table border="0" align="center">
                <tr>
                {{-- <td><img src="{{ asset('assets/landing/img/karangtarunabg.png') }}" width="70" height="70"></td> --}}
                <td>
                <center>
                    <font size="5"> <b>Karang Taruna Wangun Tengah</b> </font><br>
                    <font size="4"> Laporan Masyarakat Wangun Melalui PEMASWA!!</font><br>
                    <font size="2">Keluhan Masyarakat Wangun Mengenai Kerusaakan Fasilitas Umum</font><br>
                    <font size="2"> <i>Jln.Raya Wangun Kecamatan Bogor Timur Kota Bogor</i></font><br>
                </center>
                </td>
                </tr>
                <tr>
                    <td colspan="5"><hr></td>
                </tr>
            </table>
        <table class="table" align="center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Pelapor</th>
                    <th>Isi Laporan</th>
                    <th>tanggapan</th>
                    <th>Nama Petugas</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody align="center">
                @foreach ($pengaduan as $k => $v)
                    <tr>
                        <td>{{ $k += 1 }}</td>
                        <td>{{ $v->tgl_pengaduan }}</td>
                        <td>{{ $v->user->nama }}</td>
                        <td>{{ $v->isi_laporan }}</td>
                         {{-- @if ($v->tanggapan != null)
                         <td>{{ $v->tanggapan->tgl_tanggapan }}</td>
                     @else
                         <td>-</td>
                     @endif --}}
                        @if ($v->tanggapan != null)
                        <td>{{ $v->tanggapan->tanggapan}}</td>
                        @else
                        <td>-</td>
                        @endif
                        <td>
                            @if($v->tanggapan == null)
                            -
                            @else
                            {{ $v->tanggapan->petugas->nama_petugas }}
                            @endif
                        </td>
                        <td>{{ $v->status == '0' ? 'Pending' : ucwords($v->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
            </center>
    </section>
</body>
</html>
