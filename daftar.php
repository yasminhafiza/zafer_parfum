<?php 
include'koneksi/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Daftar</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <!-- Font Awesome CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom fonts -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <!-- Custom CSS if any -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /*Login*/
#login h1 {
    font-size: 1.6rem;
    letter-spacing: 4px;
    font-weight: bold;
}

#login i {
    font-size: 1.6rem;
    color: #0072b3;
}
    </style>
</head>
<body>

<?php include 'include/navbar.php'; ?>
<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center" id="login">
        <div class="col-md-6">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4" style="font-weight: bold;">Daftar</h1>
                                </div>
                                <form method="post" enctype="multipart/form-data" class="user">

                                <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            Nama Lengkap
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Anda" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            E-mail
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="email" name="email" class="form-control" placeholder="Masukkan E-Mail Anda" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            Password
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password Anda" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            Telepon
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="number" name="telepon" class="form-control" placeholder="Masukkan Nomor Handphone Anda" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">
                                            Alamat
                                        </label>
                                        <div class="col-sm-8">
                                            <textarea type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat Anda" required></textarea>
                                        </div>
                                    </div>

                                    

                                    <div class="text-right">
                                        <button name="daftar" class="btn btn-primary">
                                            Daftar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

if(isset($_POST['daftar'])) {
    
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    $telepon = $_POST['telepon'];
    $alamat = $_POST['alamat'];

    $nama_foto = $_FILES['foto']['name'];
    $lokasi_foto = $_FILES['foto']['tmp_name'];

    move_uploaded_file($lokasi_foto, "./assets/foto_pelanggan/" .$nama_foto);

    $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email='$email'");

    $ada_email = $ambil->num_rows;
    if($ada_email==1)
    {
        echo "<script>alert('Gagal untuk mendaftar, email sudah terdaftar');</script>";
        echo "<script>location='daftar.php';</script>";  
    }

    else
    {
        $koneksi->query("INSERT INTO pelanggan(nama_pelanggan,email,password_pelanggan,telepon_pelanggan,alamat_pelanggan,foto_pelanggan)
        VALUES('$nama','$email','$password','$telepon','$alamat','$nama_foto')");

echo "<script>alert('Berhasil Mendaftar');</script>";
echo "<script>location='login.php';</script>";  
    }

}

?>

<?php include 'include/footer.php'; ?>
    <!-- Bootstrap core JavaScript -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript -->
    <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages -->
    <script src="assets/js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="assets/js/demo/datatables-demo.js"></script>
    <!-- Custom JavaScript -->
    <script src="assets/js/main.js"></script>
    <!-- Owl Carousel JavaScript -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- Font Awesome 6 JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>
</html>