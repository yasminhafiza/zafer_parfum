<?php 
session_start();
include 'koneksi/koneksi.php';
if (!isset($_SESSION['keranjang_belanja'])) {
    $_SESSION['keranjang_belanja'] = array(); 
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom styles -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<?php include 'include/navbar.php'; ?>

<section class="page-keranjang">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="index.php">Beranda</a></li>
            <li>Keranjang Belanja</li>
        </ul>

        <div class="card box">
            <div class="card-body">
                <h2>Keranjang Belanja</h2>
                <p>
                    Anda memiliki <?php echo count($_SESSION['keranjang_belanja']); ?> item di dalam keranjang belanja.
                </p>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover table-striped" >
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Subtotal</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            if(isset($_SESSION['keranjang_belanja']) && !empty($_SESSION['keranjang_belanja'])) {
                                foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah) { 
                                    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                                    $pecah = $ambil->fetch_assoc();
                                    $subtotal = $pecah['harga_produk'] * $jumlah;
                        ?>
                        <tr>
                            <td width="25px"><?php echo $no++; ?></td>
                            <td><img src="./assets/foto_produk/<?php echo $pecah['foto_produk']; ?>" width="100"></td>
                            <td><?php echo $pecah['nama_produk']; ?></td>
                            <td><?php echo $jumlah; ?></td>
                            <td>Rp<?php echo number_format($pecah['harga_produk']); ?></td>
                            <td>Rp <?php echo number_format($subtotal); ?></td>
                            <td><a href="hapus_keranjang.php?idproduk=<?php echo $pecah['id_produk']; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a></td>
                        </tr>
                        <?php 
                                } 
                            } else {
                                echo '<tr><td colspan="7" class="text-center">Keranjang belanja Anda kosong.</td></tr>';
                            }
                        ?>
                    </tbody>
                </table>
                </div>
                
            </div>
            <div class="card-header">
                <div class="row">
                    <div class="col-md-10">
                        <a href="produk.php" class="btn btn-info">Halaman Produk</a>
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="checkout.php" class="btn btn-success">Checkout</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<?php include 'include/footer.php'; ?>

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
</body>
</html>