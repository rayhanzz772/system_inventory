<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Tambah Alat</title>
    <link rel="stylesheet" href="../assets/css/verifikasi.css">
    <!-- Custom fonts for this template-->
    <link href="../assets/admin_css/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/admin_css/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <header>
        @include('layouts.navbar')

    </header>
    <!-- Form section -->
    <section class="form-verifikasi">
        <h1>Masukkan Barang Pinjaman anda</h1>
        <form method="POST" action="{{ route('tambahalat.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="nama_alat" class="form-label">Nama Alat</label>
                <input name="nama_alat" type="text" class="form-control" id="nim"
                    placeholder="Masukan Nama Alat">
            </div>
            <div class="form-group">
                <label for="jenis_alat_id" class="form-label">Jenis Alat</label>
                <select name="jenis_alat_id" class="form-control" id="jenis_alat_id">
                    <option value="1" selected>Case</option>
                    <option value="2">Perkabelan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="stok" class="form-label">Stok</label>
                <input name="stok" type="text" class="form-control" id="stok"
                    placeholder="Masukan jumlah stok">
            </div>
            <div class="form-group">
                <label for="image" class="form-label">Pilih Gambar</label>
                <input type="file" class="form-control-file" id="image" name="img">
            </div>
            <input type="text" name="keterangan_barang" value="Tersedia" hidden>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </section>
    <hr>


    <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; SITARI 2024</span>
            </div>
        </div>
    </footer>
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    {{-- 
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/admin_css/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/admin_css/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/admin_css/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/admin_css/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/admin_css/vendor/chart.js/Chart.min.js"></script>


</body>

</html>
