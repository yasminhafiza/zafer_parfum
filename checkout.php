<?php 
session_start();
include 'koneksi/koneksi.php';

// Check if pelanggan session is set
if (!isset($_SESSION['pelanggan'])) {
    echo "<script>alert('Anda harus login terlebih dahulu');</script>";
    echo "<script>location='login.php';</script>";
    exit();
}

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

// Initialize keranjang_belanja if not already set
if (empty($_SESSION['keranjang_belanja'])) {
    $_SESSION['keranjang_belanja'] = array();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Belanja</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <!-- Custom styles -->
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

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Foto</th>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Subharga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no = 1;
                            $subtotal = 0;
                            $totalberat = 0; // Initialize total weight
                            if(isset($_SESSION['keranjang_belanja']) && !empty($_SESSION['keranjang_belanja'])) {
                                foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah) { 
                                    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
                                    $pecah = $ambil->fetch_assoc();
                                    $subharga = $pecah['harga_produk'] * $jumlah;
                                    $subberat = $pecah['berat_produk'] * $jumlah;
                                    $totalberat += $subberat; // Add sub weight to total weight
                                    $totalbelanja = $subtotal+=$subharga;
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><img src="./assets/foto_produk/<?php echo $pecah['foto_produk']; ?>" width="100"></td>
                            <td><?php echo $pecah['nama_produk']; ?></td>
                            <td><?php echo $jumlah; ?></td>
                            <td>Rp<?php echo number_format($pecah['harga_produk']); ?></td>
                            <td>Rp <?php echo number_format($subharga); ?></td>
                        </tr>
                        <?php 
                                } 
                            } else {
                                echo '<tr><td colspan="6" class="text-center">Keranjang belanja Anda kosong.</td></tr>';
                            }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5">Total Belanja</th>
                            <th>Rp <?php echo number_format($totalbelanja); ?></th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <input type="text" class="form-control" value="<?php echo $_SESSION['pelanggan']['nama_pelanggan']; ?>" readonly>
                        <br>
                        <input type="text" class="form-control" value="<?php echo $_SESSION['pelanggan']['email']; ?>" readonly>
                        <br>
                        <input type="text" class="form-control" value="<?php echo $_SESSION['pelanggan']['telepon_pelanggan']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-body bg-white">
                    <form method="post">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat pengiriman"></textarea>
                            </div>
                        </div>   

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Provinsi</label>
                            <div class="col-sm-9">
                                <select name="provinsi" class="form-control">
                                    <!-- Provinsi options will be loaded here by jQuery -->
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Kota/Kabupaten</label>
                            <div class="col-sm-9">
                                <select name="distrik" class="form-control">
                                    <!-- Kota/Kabupaten options will be loaded here -->
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Ekspedisi</label>
                            <div class="col-sm-9">
                                <select name="ekspedisi" class="form-control">
                                    <!-- Ekspedisi options will be loaded here -->
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Paket</label>
                            <div class="col-sm-9">
                                <select name="paket" class="form-control">
                                    <!-- Paket options will be loaded here -->
                                </select>
                            </div>
                        </div>

                        <input type="text" name="total_berat" class="form-control" value="<?php echo $totalberat; ?>" hidden>
                        <input type="text" name="nama_provinsi" class="form-control" hidden>
                        <input type="text" name="nama_distrik" class="form-control" hidden>
                        <input type="text" name="type_distrik" class="form-control" hidden>
                        <input type="text" name="kode_pos" class="form-control" hidden>
                        <input type="text" name="nama_ekspedisi" class="form-control" hidden>
                        <input type="text" name="paket" class="form-control" hidden>
                        <input type="text" name="ongkir" class="form-control" hidden>
                        <input type="text" name="estimasi" class="form-control" hidden>

                        <div class="text-right">
                            <button name="checkout" class="btn btn-success">Beli Sekarang</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</section>

<?php

if(isset($_POST['checkout']))
{
    $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
    $tanggal_pembelian = date('y-m-d');
    $alamat = $_POST['alamat'];
    $berat = $_POST['total_berat'];
    $provinsi = $_POST['nama_provinsi'];
    $distrik = $_POST['nama_distrik'];
    $type = $_POST['type_distrik'];
    $pos = $_POST['kode_pos'];
    $ekspedisi = $_POST['nama_ekspedisi'];
    $paket = $_POST['paket'];
    $ongkir = (int)$_POST['ongkir']; // Cast to integer
    $estimasi = $_POST['estimasi'];
    $total_pembelian = $totalbelanja + $ongkir; // Ensure both are integers

    // Insert into the pembelian table
    $koneksi->query("INSERT INTO pembelian (id_pelanggan, tanggal_pembelian, total_pembelian, alamat, total_berat, provinsi, distrik, type, kode_pos, ekspedisi, paket, ongkir, estimasi)
    VALUES ('$id_pelanggan', '$tanggal_pembelian', '$total_pembelian', '$alamat', '$berat', '$provinsi', '$distrik', '$type', '$pos', '$ekspedisi', '$paket', '$ongkir', '$estimasi')");

    // Get the last inserted id
    $id_pembelian = $koneksi->insert_id;

    foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah)
{
    $ambil = $koneksi->query("SELECT * FROM produk WHERE id_produk='$id_produk'");
    $pecah = $ambil->fetch_assoc();
    $nama = $pecah['nama_produk'];
    $harga = $pecah['harga_produk'];
    $berat = $pecah['berat_produk'];
    $subberat = $pecah['berat_produk'] * $jumlah;
    $subharga = $pecah['harga_produk'] * $jumlah;

    // Insert into the pembelian_produk table
    $koneksi->query("INSERT INTO pembelian_produk (id_pembelian, id_produk, nama, harga, berat, subberat, subharga, jumlah)
    VALUES ('$id_pembelian', '$id_produk', '$nama', '$harga', '$berat', '$subberat', '$subharga', '$jumlah')");

    // Update the stock
    $koneksi->query("UPDATE produk SET stok_produk = stok_produk - $jumlah WHERE id_produk = '$id_produk'");

    // Update jumlah terjual
    $koneksi->query("UPDATE produk SET jumlah_terjual = jumlah_terjual + $jumlah WHERE id_produk = '$id_produk'");
}


    unset($_SESSION['keranjang_belanja']);
    echo "<script>alert('Pembelian sukses');</script>";
    echo "<script>location='pelanggan/index.php?page=pesanan';</script>";
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

<div class="createed">
    <p>Created By <a href="#">Yasmin Hafiza</a> | &copy; 2024</p>
</div>
<!-- JS Scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){
    $('#tables').DataTable();

    $.ajax({
        url: 'data_provinsi.php',
        type: 'post',
        success: function (data_provinsi){
            $("select[name=provinsi]").html(data_provinsi);
        }
    });

    $("select[name=provinsi]").on("change", function(){
        var id_provinsi = $(this).val();

        $.ajax({
            url: 'data_distrik.php',
            type: 'post',
            data: { id_provinsi: id_provinsi },
            success: function (data_distrik){
                $("select[name=distrik]").html(data_distrik);

                // Reset nilai input ketika provinsi diubah
                $("input[name=nama_provinsi]").val('');
                $("input[name=nama_distrik]").val('');
                $("input[name=kode_pos]").val('');
            },
            error: function(xhr, status, error) {
                console.error("Error saat memuat data distrik:", error);
            }
        });
    });

    // Event saat dropdown distrik dipilih
    $("select[name=distrik]").on("change", function(){
        var prov = $("option:selected",this).attr("nama_provinsi");
        var dist = $("option:selected",this).attr("nama_distrik");
        var pos = $("option:selected",this).attr("kode_pos");
        var type = $("option:selected",this).attr("type_distrik");

        $("input[name=nama_provinsi]").val(prov);
        $("input[name=nama_distrik]").val(dist);
        $("input[name=kode_pos]").val(pos);
        $("input[name=type_distrik]").val(type);
    });

    $.ajax({
        url: 'data_ekspedisi.php',
        type: 'post',
        success: function (data_ekspedisi) {
            $("select[name=ekspedisi]").html(data_ekspedisi);
        },
    });

    $("select[name=ekspedisi]").on("change", function() {
        var nama_ekspedisi = $("select[name=ekspedisi]").val();
        var datadistrik = $("option:selected", "select[name=distrik]").attr("id_distrik");
        var total_berat = $("input[name=total_berat]").val();

        console.log("Ekspedisi dipilih:", nama_ekspedisi);
        console.log("Distrik dipilih:", datadistrik);
        console.log("Total berat:", total_berat);

        $.ajax({
    url: 'data_paket.php',
    type: 'post',
    data: {
        ekspedisi: nama_ekspedisi,
        distrik: datadistrik,
        berat: total_berat
    },
    success: function (data_paket) {
        $("select[name=paket]").html(data_paket);
        $("input[name=nama_ekspedisi]").val(nama_ekspedisi);
    },
    error: function(xhr, status, error) {
        console.error("Error loading package data:", error);
    }
});

    });

    $("select[name=paket]").on("change", function(){
    var nama_ekspedisi = $("select[name=ekspedisi]").val();
    var paket = $("option:selected", this).val(); // Mengambil value dari opsi yang dipilih
    var ongkir = $("option:selected", this).attr("ongkir"); // Mengambil atribut 'ongkir'
    var estimasi = $("option:selected", this).attr("estimasi"); // Mengambil atribut 'estimasi'

    $("input[name=nama_ekspedisi]").val(nama_ekspedisi);
    $("input[name=paket]").val(paket); // Menyimpan nilai paket yang dipilih
    $("input[name=ongkir]").val(ongkir); // Menyimpan nilai ongkir
    $("input[name=estimasi]").val(estimasi); // Menyimpan nilai estimasi
});

});

</script>
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
