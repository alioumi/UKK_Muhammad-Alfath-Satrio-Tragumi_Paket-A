<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Custom fonts for this template-->
    <link href="assets/admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../assets/admin/css/sb-admin-2.min.css" rel="stylesheet">

    {{-- sweetalert --}}
    <script src="https://cdn.jsdeliver.net/npm/sweetalert2@9"></script>

    <title>Halaman Register Masyarakat</title>
</head>

<body class="">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-lg-5">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">From Pendaftaran Masyarakat</h1>
                                    </div>
                                    <form class="user" action="{{ route('laporma.register') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <input type="number" class="form-control " placeholder="NIK" name="nik">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control " placeholder="Nama Lengkap" name="nama">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control " placeholder="Username" name="username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control " placeholder="Password" name="password">
                                        </div>
                                        <div class="form-group">
                                            <input type="number" class="form-control " placeholder="Nomor Telp" name="telp">
                                        </div>
                                        <div class="form-group">Pilih Jenis Kelamin
                                                    <select name="jenis_kelamin" id="Jenis_kelamin" class="custom-select">
                                                        <option value="#">-</option>
                                                        <option value="laki_laki">Laki-Laki</option>
                                                        <option value="peremouan">Perempuan</option>
                                                    </select>
                                        </div>
                                        <div class="form-group"> Masukkan Nomer Rt, Rw dan No Rumah
                                            <textarea id="alamat" name="alamat" placeholder="Contoh : Rt02/Rw03 15" rows="4" cols="41"></textarea>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Sign Up</button>
                                    </form>
                                    @if (Session::has('pesan'))
                                    <div class="alert alert-danger mt-2">
                                        {{ Session::get('pesan') }}
                                    </div>
                                    @endif
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('laporma.index') }}">Kembali ke Halaman Utama</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('laporma.formLogin') }}">Sudah memiliki akun? <i>login</i> sekarang!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

<!-- Bootstrap core JavaScript-->
  <script src="assets/admin/vendor/jquery/jquery.min.js"></script>
  <script src="assets/admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/admin/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="assets/admin/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="assets/admin/js/demo/chart-area-demo.js"></script>
  <script src="assets/admin/js/demo/chart-pie-demo.js"></script>
</body>
</html>
