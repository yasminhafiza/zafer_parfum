<?php 
session_start();
include'koneksi/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <div class="row justify-content-center" id="login">
        <div class="col-md-5">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4" style="font-weight: bold;"><strong>LOGIN</strong> Zafer Parfume</h1>
                                </div>
                                <form method="post" class="user">

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">
                                            <i class="fas fa-envelope"></i>
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="email" name="email" class="form-control" placeholder="Masukkan E-Mail Anda">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">
                                            <i class="fas fa-lock"></i>
                                        </label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password Anda">
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <button name="login" class="btn btn-primary">
                                            Login
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
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = sha1($_POST['password']);
    
    $ambil = $koneksi->query("SELECT * FROM pelanggan WHERE email='$email' AND password_pelanggan='$password'");
    $akun = $ambil->num_rows;
    
    if ($akun == 1) {
        $_SESSION['pelanggan'] = $ambil->fetch_assoc();
        
        $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
        $keranjangQuery = $koneksi->query("SELECT * FROM keranjang WHERE id_pelanggan='$id_pelanggan'");
        $_SESSION['keranjang_belanja'] = array();
        
        while ($row = $keranjangQuery->fetch_assoc()) {
            $_SESSION['keranjang_belanja'][$row['id_produk']] = $row['jumlah'];
        }

        echo "<script>alert('Login Sukses');</script>";
        if (isset($_SESSION['keranjang_belanja']) && !empty($_SESSION['keranjang_belanja'])) {
            echo "<script>location='index.php';</script>";
        } else {
            echo "<script>location='pelanggan/index.php';</script>";
        }
    } else {
        echo "<script>alert('Login Gagal');</script>";
        echo "<script>location='login.php';</script>";
    }
}
?>

<?php include 'include/footer.php'; ?>

<div class="createed">
    <p>Created By <a href="#">Yasmin Hafiza</a> | &copy; 2024</p>
</div>    
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="assets/js/sb-admin-2.min.js"></script>
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="assets/js/demo/datatables-demo.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function() {
    var btnProfile = document.getElementById('btn-profile');
    var btnLogout = document.getElementById('btn-logout');
    var btnLogin = document.getElementById('btn-login');
    var dropdownUser = document.getElementById('dropdown-user');
    var searchForm = document.querySelector('.search-form');
    var searchBox = document.getElementById('search-box');
    var btnSearch = document.getElementById('btn-search');

    if (btnProfile) {
        btnProfile.addEventListener('click', function() {
            dropdownUser.style.display = (dropdownUser.style.display === 'block') ? 'none' : 'block';
        });
    }

    if (btnLogout) {
        btnLogout.addEventListener('click', function() {
            alert('Anda telah logout.');
        });
    }

    if (btnLogin) {
        btnLogin.addEventListener('click', function() {});
    }

    window.addEventListener('click', function(event) {
        if (dropdownUser && !dropdownUser.contains(event.target) && event.target !== btnProfile) {
            dropdownUser.style.display = 'none';
        }
    });

    if (btnSearch) {
        btnSearch.addEventListener('click', function(e) {
            searchForm.classList.toggle('active');
            searchBox.focus();
            e.preventDefault();
        });
    }

    if (searchBox) {
        searchBox.addEventListener('blur', function() {
            searchForm.classList.remove('active');
        });
    }
});
</script>
</body>
</html>
