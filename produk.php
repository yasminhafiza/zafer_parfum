<?php 
session_start();
include 'koneksi/koneksi.php';

function fetchProducts($koneksi, $query) {
    $result = $koneksi->query($query);
    if (!$result) {
        die("Query Error: " . $koneksi->error);
    }
    return $result->fetch_all(MYSQLI_ASSOC);
}

if (isset($_GET['idkategori'])) {
    $id_kategori = $koneksi->real_escape_string($_GET['idkategori']);
    $kategori_produk = fetchProducts($koneksi, "SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori WHERE produk.id_kategori='$id_kategori'");
} elseif (isset($_GET['keyword'])) {
    $keyword = $koneksi->real_escape_string($_GET['keyword']);
    $cariproduk = fetchProducts($koneksi, "SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR deskripsi_produk LIKE '%$keyword%'");
} else {
    $produk = fetchProducts($koneksi, "SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori LIMIT 20");
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
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'include/navbar.php'; ?>

<section class="page-product">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.php">Beranda</a></li>
            <li>Produk</li>
            <?php if(isset($keyword)): ?>
                <li><?php echo htmlspecialchars($keyword); ?></li>
            <?php endif; ?>
        </ul>

        <div class="row">
            <div class="col-md-3">
                <?php include 'include/slidebar.php'; ?>
            </div>
            <div class="col-md-9">
                <div class="card-box bg-white">
                    <div class="card-body">
                        <h2>Produk Kami</h2>
                        <p style="text-align: justify;"> parfum berkualitas tinggi yang menawarkan berbagai pilihan aroma eksklusif untuk pria dan wanita. Setiap produk dirancang untuk memberikan pengalaman yang menyenangkan dan memikat, dengan campuran bahan-bahan terbaik untuk memastikan kesegaran dan daya tahan yang luar biasa sepanjang hari.</p>
                    </div>
                </div>
                <div class="row mt-4">
                    <?php
                    $products = isset($kategori_produk) ? $kategori_produk : (isset($cariproduk) ? $cariproduk : $produk);
                    foreach ($products as $value): ?>
                        <div class="col-md-4 card-produk">
                            <div class="card">
                                <img src="assets/foto_produk/<?php echo htmlspecialchars($value['foto_produk']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($value['nama_produk']); ?>">
                                <div class="card-body content">
                                    <h5><?php echo htmlspecialchars($value['nama_produk']); ?></h5>
                                    <p>Rp <?php echo number_format($value['harga_produk']); ?></p>
                                    <p>Jumlah Terjual: <?php echo htmlspecialchars($value['jumlah_terjual']); ?></p>
                                    <div class="btn-group" role="group">
                                        <a href="beli.php?idproduk=<?php echo htmlspecialchars($value['id_produk']); ?>" class="btn btn-success">
                                            <i class="fas fa-shopping-cart"></i> Keranjang
                                        </a>
                                        <a href="detail_produk.php?idproduk=<?php echo htmlspecialchars($value['id_produk']); ?>" class="btn btn-info">
                                            <i class="fas fa-info-circle"></i> Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <?php if (empty($products)): ?>
                        <div class="col-md-12">
                            <div class="alert alert-danger shadow">
                                <p>Produk tidak ditemukan</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="pagination justify-content-center">
                    <!-- Pagination logic goes here -->
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'include/footer.php'; ?>

<!-- JavaScript libraries and scripts -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

</body>
</html>
