<?php 
session_start();
include 'koneksi/koneksi.php';

$id_produk = $_GET['idproduk'];
$ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
$produk = $ambil->fetch_assoc();
if (!$produk) {
    echo "<script>alert('Produk tidak ditemukan');</script>";
    echo "<script>location='index.php';</script>";
    exit();
}

$produkfoto = array();
$ambil = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk='$id_produk'");
while($pecah = $ambil->fetch_assoc()) {
    $produkfoto[] = $pecah;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
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
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .detail-form {
            margin-top: 20px; /* Adjust this value as needed */
        }
    </style>
</head>
<body>

<?php include 'include/navbar.php'; ?>

<section class="page-product">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.php">Beranda</a></li>
            <li>Detail Produk</li>
        </ul>

        <div class="row">
            <div class="col-md-3">
                <?php
                include 'koneksi/koneksi.php';

                $kategori = array();
                $ambil = $koneksi->query("SELECT * FROM kategori");
                while ($pecah = $ambil->fetch_assoc()) {
                    $kategori[] = $pecah;
                }
                ?>
                <div class="card">
                    <div class="card-header"><h4>Kategori Produk</h4></div>
                    <div class="card-body">
                        <ul class="nav nav-pills flex-column">
                            <?php foreach ($kategori as $key => $value): ?>
                                <li class="nav-item">
                                    <a href="produk.php?idkategori=<?php echo $value['id_kategori']; ?>" class="nav-link">
                                        <?php echo $value['nama_kategori']; ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                            <li class="nav-item">
                                <a href="produk.php" class="nav-link">Semua Produk</a>
                            </li>
                        </ul>
                    </div>
                </div>            
            </div>
            <div class="col-md-9 detail-produk">
                <div class="row">
                    <div class="col-6">
                        <div id="owl-nav"></div>
                        <div class="owl-carousel owl-theme">
                            <?php foreach ($produkfoto as $key => $value): ?>
                                <div class="item">
                                    <img src="assets/foto_produk/<?php echo $value['nama_produk_foto']; ?>" class="img-fluid">
                                </div> 
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-6 detail-form mt-3">
                        <form name="productForm" method="post" onsubmit="return validateForm()">
                            <div class="card">
                                <div class="card-body">
                                    <h3><?php echo $produk['nama_produk']; ?></h3>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Jumlah :</label>
                                        <div class="col-sm-9">
                                            <input type="number" name="jumlah" class="form-control" value="1" max="<?php echo $produk['stok_produk']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Stok :</label>
                                        <div class="col-sm-9">
                                            <input disabled class="form-control" value="<?php echo $produk['stok_produk']; ?>">
                                        </div>
                                    </div>
                                    <h5>Rp<?php echo number_format($produk['harga_produk']); ?></h5>
                                    
                                </div>
                                <div class="card-footer text-right">
                                    <button name="beli" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Keranjang</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card detail">
                    <div class="card-body">
                        <h2>Detail Produk</h2>
                        <?php echo $produk['deskripsi_produk']; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
if (isset($_POST['beli'])) {
    $jumlah = $_POST['jumlah'];

    if ($jumlah < 1 || $jumlah > $produk['stok_produk']) {
        echo "<script>alert('Jumlah tidak valid');</script>";
    } else {
        if (isset($_SESSION['keranjang_belanja'][$id_produk])) {
            $_SESSION['keranjang_belanja'][$id_produk] += $jumlah;
        } else {
            $_SESSION['keranjang_belanja'][$id_produk] = $jumlah;
        }
        echo "<script>alert('Produk berhasil masuk keranjang');</script>";
        echo "<script>location='keranjang.php';</script>";
    }
}
?>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-4">
                <h4>Halaman Utama</h4> 
                <ul class="footer-menu">
                    <li><a href="index.php">Beranda</a></li>
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="produk.php">Produk</a></li>
                    <li><a href="#">Kontak</a></li>
                </ul>
            </div>
            <div class="col-4">
                <h4>Hubungi Kami</h4> 
                <ul class="footer-kontak">
                    <b><i class="fas fa-store"></i> Zafer</b>
                    <br /><i class="fas fa-city"></i> Jawa Barat
                    <br /><i class="fas fa-map-marker-alt"></i> Cirebon
                    <br /><i class="fas fa-phone"></i> 081611282016
                    <br /><i class="fas fa-envelope"></i> kieko@gmail.com
                    <br /><i class="fas fa-user"></i> Yasmin Hafiza
                </ul>
            </div>
            <div class="col-4">
                <h3>Social Media</h3>
                <ul class="footer-social">
                    <li><a href="https://www.instagram.com/official.zafer?igsh=anMwOWx5N291dWhr"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="https://api.whatsapp.com/send?phone=6289652338750&text=Halo%20kak%20aku%20ingin%20order%20dong"><i class="fab fa-whatsapp"></i></a></li>
                </ul> 
            </div>
        </div>
    </div>
</footer>

<div class="created">
    <p>Created By <a href="#">Yasmin Hafiza</a> | &copy; 2024</p>
</div>

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
