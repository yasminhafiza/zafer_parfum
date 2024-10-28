<?php 
session_start();
include'koneksi/koneksi.php';

$produk = array();
$ambil = $koneksi->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori LIMIT 8");

while($pecah = $ambil->fetch_assoc())
{
    $produk[]=$pecah;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zafer Parfum</title>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-HZL7JrSms9L+OD4c8Y0AB1qCR1JP8/Z5h6R2ySBJ+0BhIy5AUB8H3x3fN0swECYqTGno1pGnmKrP1U0E7ecV0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    

</head>
<body>
<?php include 'include/navbar.php'; ?>
<div class="container">
    <!-- Hero Section Start -->
    <section class="hero">
    <!-- Additional slider items -->
    <div class="item">
    <img src="assets/foto/zafer4.webp" alt="Zafer Parfume" style="width:100%; height:auto;">
    </div>
    <!-- Add more slider items as needed -->
</section>
<!-- Hero Section End -->

<!-- About Section Start -->
<section class="about">
    <div class="row">
        <div class="col-md-6 about-img">
            <img src="assets/foto/about1.png" alt="Zafer Perfume">
        </div>
        <div class="col-md-6 content mt-2">
            <h3>Toko Kami</h3>
            <p>Zafer Parfume adalah pilihan sempurna bagi para pecinta parfum yang mencari aroma tahan lama dengan sentuhan minimalis dengan konsep sederhana namun tetap mewah. Aroma yang elegan dan menyegarkan membuat Kamu tampil percaya diri sepanjang hari.</p>
            <p>Zafer Perfume adalah perusahaan parfum premium yang berdedikasi untuk menciptakan aroma yang menggambarkan esensi kemewahan dan keindahan. Berdiri dengan misi untuk menghadirkan pengalaman indra yang tak tertandingi, kami menggabungkan bahan-bahan berkualitas tinggi dengan seni pembuatan parfum yang ahli.</p>
        </div>
    </div>
</section>
<!-- About Section End -->

        <!-- kategori section start -->
        <section class="kategori mt-5">
            <div class="row">
                <div class="col-md-4">
                    <a href="produk.php?idkategori=1">
                        <img src="assets/foto/woman.png" alt="Kategori Wanita" class="img-fluid">
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="produk.php?idkategori=2">
                        <img src="assets/foto/man.png" alt="Kategori Pria" class="img-fluid">
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="produk.php?idkategori=3">
                        <img src="assets/foto/unisex.png" alt="Kategori Unisex" class="img-fluid">
                    </a>
                </div>
            </div>
        </section>
        <!-- kategori section end -->

<!-- produk section start -->
        <section class="produk">
            <h2 class="judul"><span>Produk Terlaris</span></h2>
            <div class="row">
                <?php 
                $produkBestSeller = array();
                $ambilBestSeller = $koneksi->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori ORDER BY jumlah_terjual DESC LIMIT 4");

                while($pecahBestSeller = $ambilBestSeller->fetch_assoc())
                {
                    $produkBestSeller[]=$pecahBestSeller;
                }

                foreach ($produkBestSeller as $produk): ?>
                    <div class="col-md-3 card-produk">
                        <div class="card">
                            <a href="detail_produk.php?idproduk=<?php echo $produk['id_produk']; ?>">
                                <img src="assets/foto_produk/<?php echo $produk['foto_produk']; ?>" class="card-img-top" alt="<?php echo $produk['nama_produk']; ?>">
                            </a>
                            <div class="card-body content">
                                <h5><?php echo $produk['nama_produk']; ?></h5>
                                <p>Rp <?php echo number_format($produk['harga_produk']); ?></p>
                                <p>Jumlah Terjual: <?php echo $produk['jumlah_terjual']; ?></p>
                                <div class="btn-group" role="group">
                                    <a href="beli.php?idproduk=<?php echo $produk['id_produk']; ?>" class="btn btn-success">
                                        <i class="fas fa-shopping-cart"></i> Keranjang
                                    </a>
                                    <a href="detail_produk.php?idproduk=<?php echo $produk['id_produk']; ?>" class="btn btn-info">
                                        <i class="fas fa-info-circle"></i> Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
<!-- produk section end -->
</div>

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
