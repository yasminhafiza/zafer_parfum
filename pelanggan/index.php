<?php 
session_start();
include '../koneksi/koneksi.php';

// Check if pelanggan session is set
if (!isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Anda harus login terlebih dahulu');</script>";
    echo "<script>location='../login.php';</script>";
    exit();
}

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
$pecah = $ambil->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Profil</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom fonts -->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
    <!-- Custom CSS if any -->
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
    <a href="index.php" class="navbar-brand">Zafer <span>Parfum</span></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="../index.php">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="../produk.php">Produk</a></li>
            <li class="nav-item"><a class="nav-link" href="../tentangkami.php">Tentang Kami</a></li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item"><a class="nav-link" href="../keranjang.php"><i class="fas fa-shopping-cart fa-lg"></i> <span class="sr-only">Keranjang</span></a></li>
            <?php if(isset($_SESSION['pelanggan'])): ?>
                <li class="nav-item"><a class="nav-link" href="../pelanggan/index.php"><i class="fas fa-user"></i> Profil</a></li>
                <li class="nav-item"><a class="nav-link" href="../logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            <?php else: ?>
                <li class="nav-item"><a class="nav-link" href="../login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                <li class="nav-item"><a class="nav-link" href="../daftar.php"><i class="fas fa-user-plus"></i> Daftar</a></li>
            <?php endif; ?>
        </ul>

    </div>
</nav>
<section class="page-profile">
    <div class="container">
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="../index.php">Beranda</a></li>
            <li class="breadcrumb-item active">Profil</li>
        </ul>

        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header text-center">
                        <h2 class="customer-name"><?php echo htmlspecialchars($pecah['nama_pelanggan']); ?></h2>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-pills flex-column">
                            <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                            <li class="nav-item"><a href="index.php?page=pesanan" class="nav-link">Pesanan</a></li>
                            <li class="nav-item"><a href="index.php?page=settings" class="nav-link">Edit Profile</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <?php 
                        if (isset($_GET['page'])) {
                            if ($_GET['page'] == "pesanan") 
                            {
                                include 'pesanan.php';

                            }
                            
                            elseif ($_GET['page'] == "detail_pembelian")
                             {

                                include 'detail_pembelian.php';

                            } 
                            
                            elseif ($_GET['page'] == "settings") 

                            {
                                include 'settings.php';
                                
                            } 
                            
                            elseif ($_GET['page'] == "update_password") 

                            {
                                include 'update_password.php';

                            }
                            
                            elseif ($_GET['page'] == "pembayaran") 

                            {
                                include 'pembayaran.php';
                            }

                            elseif ($_GET['page'] == "detail_pembayaran") 
                            
                            {
                                include 'detail_pembayaran.php';
                            }
                        } else {
                            include 'home.php';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h4>Halaman Utama</h4> 
                <ul class="footer-menu">
                    <li><a href="../index.php">Beranda</a></li>
                    <li><a href="../tentangkami.php">Tentang Kami</a></li>
                    <li><a href="../produk.php">Produk</a></li>
                </ul>
            </div>
            <div class="col-4">
                <h4>Hubungi Kami</h4> 
                <ul class="footer-kontak">
                    <b><i class="fas fa-store"></i> Zafer</b>
                    <br /><i class="fas fa-city"></i> Jawa Barat
                    <br /><i class="fas fa-map-marker-alt"></i> Kota Bogor
                    <br /><i class="fas fa-phone"></i> 081611282016
                    <br /><i class="fas fa-envelope"></i> kieko@gmail.com
                    <br /><i class="fas fa-user"></i> Yasmin Hafiza
                </ul>
            </div>
            <div class="col-4">
                <h3>Social Media</h3>
                <ul class="footer-social">
                    <li><a href="https://www.instagram.com/official.zafer?igsh=anMwOWx5N291dWhr"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="https://api.whatsapp.com/send?phone=6289652338750&text=Halo%20kak%20aku%20ingin%20order%20dong"><i class="fab fa-whatsapp"></i></a></li>
                </ul> 
            </div>
        </div>
    </div>
</footer>




<!-- Bootstrap core JavaScript -->
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript -->
<script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<!-- Custom scripts for all pages -->
<script src="../assets/js/sb-admin-2.min.js"></script>
<!-- Page level plugins -->
<script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Page level custom scripts -->
<script src="../assets/js/demo/datatables-demo.js"></script>
<!-- Custom JavaScript -->
<script src="../assets/js/main.js"></script>
<!-- Owl Carousel JavaScript -->
<script src="../assets/js/owl.carousel.min.js"></script>
<!-- Font Awesome 6 JavaScript -->
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
