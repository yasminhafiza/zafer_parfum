<?php

if(isset($_POST['unggah_bukti'])) {
    $pembelian = $_GET['id']; 

    $namabukti = $_FILES['bukti']['name'];
    $lokasibukti = $_FILES['bukti']['tmp_name'];
    $namafiks = date("YmdHis").$namabukti;
    move_uploaded_file($lokasibukti, "../assets/foto_bukti/$namafiks");

    $koneksi->query("UPDATE pembayaran SET bukti='$namafiks' WHERE id_pembelian='$pembelian'");

    echo "<script>alert('Bukti pembayaran telah diupdate');</script>";
    echo "<script>location='index.php?page=pesanan&id=$pembelian';</script>";
}

$pembelian = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM pembayaran JOIN pembelian ON pembayaran.id_pembelian=pembelian.id_pembelian WHERE pembayaran.id_pembelian='$pembelian'");
$pecah = $ambil->fetch_assoc();

// Periksa jika data pembayaran ditemukan atau tidak
if(empty($pecah)) {
    echo "<script>alert('Belum ada data pembayaran');</script>";
    echo "<script>location='index.php?page=pesanan';</script>";
}

// Periksa sesi pelanggan untuk validasi
if($_SESSION['pelanggan']['id_pelanggan'] !== $pecah['id_pelanggan']) {
    echo "<script>alert('Session tidak ditemukan');</script>";
    echo "<script>location='index.php?page=pesanan';</script>"; 
}

// Memproses konfirmasi penerimaan barang
if(isset($_POST['konfirmasi_terima'])) {
    $koneksi->query("UPDATE pembelian SET status='sudah diterima' WHERE id_pembelian='$pembelian'");
    echo "<script>alert('Status pengiriman berhasil diperbarui');</script>";
    echo "<script>location='index.php?page=pesanan&id=$pembelian';</script>";
}
?>

<div class="shadow bg-white p-3 mb-3 rounded">
    <h5><strong>Detail Pembayaran</strong></h5>
    <div class="alert alert-primary shadow text-dark">
        Total tagihan anda: <b>Rp. <?php echo number_format($pecah['total_pembelian']); ?></b>
    </div>

    <div class="shadow bg-white p-3 mb-3 rounded">
        <div class="row">
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Nama</th>
                            <td><?php echo htmlspecialchars($pecah['nama']); ?></td>
                        </tr>
                        <tr>
                            <th>Bank</th>
                            <td><?php echo htmlspecialchars($pecah['bank']); ?></td>
                        </tr>
                        <tr>
                            <th>Jumlah</th>
                            <td>Rp. <?php echo number_format($pecah['jumlah']); ?></td>
                        </tr>
                        <tr>
                            <th>Tanggal</th>
                            <td><?php echo date("d F Y", strtotime($pecah['tanggal'])); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
            
            <div class="col-md-4">
                <img src="../assets/foto_bukti/<?php echo htmlspecialchars($pecah['bukti']); ?>" width="250" class="img-thumbnail img-responsive">
            </div>
        </div>
    </div>

    <div class="shadow bg-white p-3 mb-3 rounded">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Unggah Bukti Pembayaran Baru:</label>
                <div class="col-sm-9">
                    <input type="file" name="bukti" class="form-control" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <button name="unggah_bukti" class="btn btn-primary btn-sm">Unggah</button>
                </div>
            </div>
        </form>
    </div>

    <div class="shadow bg-white p-3 mb-3 rounded">
        <form method="post">
            <button type="submit" name="konfirmasi_terima" class="btn btn-success">Konfirmasi Penerimaan Barang</button>
        </form>
    </div>
</div>

