<div class="shadow bg-white p-3 mb-3 rounded">
    <h5><strong>Pembayaran</strong></h5>
</div>

<?php  

$id_pembelian = $_GET['id'];

// Check if $id_pembelian is set and valid
if(!isset($id_pembelian) || empty($id_pembelian)){
    die("Invalid purchase ID.");
}

$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$id_pembelian'");

// Check if the query was successful
if(!$ambil) {
    die("Query failed: " . $koneksi->error);
}

$pecah = $ambil->fetch_assoc();
 
// Check if fetch_assoc returned a result
if(!$pecah) {
    die("No purchase found with ID $id_pembelian.");
}
?>

<div class="alert alert-primary shadow text-dark">
    Total tagihan anda : <b> Rp. <?php echo number_format($pecah['total_pembelian']); ?></b>
</div>

<div class="shadow bg-white p-3 mb-3 rounded">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama :</label>
            <div class="col-sm-9">
                <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Anda" required>
            </div>       
        </div>

        <div class="form-group row">
    <label class="col-sm-3 col-form-label">Bank :</label>
    <div class="col-sm-9">
        <select name="bank" class="form-control">
            <option selected disabled>Pilih Metode Pembayaran</option>
            <option value="BI">Bank Indonesia (BI)</option>
            <option value="Mandiri">Bank Mandiri</option>
            <option value="BRI">Bank Rakyat Indonesia (BRI)</option>
            <option value="BCA">Bank Central Asia (BCA)</option>
            <option value="BNI">Bank Negara Indonesia (BNI)</option>
            <option value="BTN">Bank Tabungan Negara (BTN)</option>
            <option value="CIMB Niaga">Bank CIMB Niaga</option>
            <option value="Danamon">Bank Danamon</option>
            <option value="HSBC">Bank HSBC Indonesia</option>
            <option value="Permata">Bank Permata</option>
            <option value="OCBC NISP">Bank OCBC NISP</option>
            <option value="Panin">Bank Panin</option>
            <option value="Mega">Bank Mega</option>
            <option value="Maybank">Bank Maybank Indonesia</option>
            <option value="Bukopin">Bank Bukopin</option>
            <option value="DBS">Bank DBS Indonesia</option>
            <option value="UOB">Bank UOB Indonesia</option>
            <option value="BTPN">Bank BTPN</option>
            <option value="Syariah Mandiri">Bank Syariah Mandiri</option>
            <option value="Muamalat">Bank Muamalat</option>
        </select>
    </div>
</div>


        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Jumlah :</label>
            <div class="col-sm-9">
                <input type="text" name="jumlah" class="form-control" value="<?php echo $pecah['total_pembelian']; ?>" readonly>
            </div>       
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Bukti :</label>
            <div class="col-sm-9">
                <input type="file" name="bukti" class="form-control" required>
                <small class="text-danger">masukkan bukti</small>
            </div>       
        </div>

        <div class="form-group row">
            <label class="col-sm-3 col-form-label"> </label>
            <div class="col-sm-9">
               <button name="kirim" class="btn btn-primary">Kirim</button>
            </div>       
        </div>

    </form>
</div>


<?php

if(isset($_POST['kirim']))
{
    $nama = $_POST['nama'];
    $bank = $_POST['bank'];
    $jumlah = $_POST['jumlah'];
    $tanggal = date('Y-m-d');

    $nama_bukti = $_FILES['bukti']['name'];
    $lokasi_bukti = $_FILES['bukti']['tmp_name'];
    $tgl_bukti = date('YmdHis').$nama_bukti;

    move_uploaded_file($lokasi_bukti, "../assets/foto_bukti/".$tgl_bukti);

    $koneksi->query("INSERT INTO pembayaran (id_pembelian,nama,bank,jumlah,tanggal,bukti)
    VALUES('$id_pembelian','$nama','$bank','$jumlah','$tanggal','$tgl_bukti')");

    $koneksi->query("UPDATE pembelian SET status='sedang diproses' WHERE id_pembelian='$id_pembelian'");

    echo "<script>alert('Pembayaran sudah terkirim');</script>";
    echo "<script>location='index.php?page=pesanan';</script>";
}

?>