<div class="shadow p-3 mb-3 bg-white rounded">
    <h5><b>Halaman Pembayaran</b></h5>
</div>

<?php

$id_pembelian = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM pembayaran WHERE id_pembelian='$id_pembelian'");
$pecah = $ambil->fetch_assoc();

?>

<div class="card shadow bg-white">
    <div class="card-body row">
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
                        <th>Jumlah Pembayaran</th>
                        <td><?php echo htmlspecialchars($pecah['jumlah']); ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal</th>
                        <td><?php echo htmlspecialchars($pecah['tanggal']); ?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <img src="../assets/foto_bukti/<?php echo htmlspecialchars($pecah['bukti']); ?>" width="250" class="img-thumbnail img-responsive">
        </div>
    </div>

    <div class="card-footer">
        <form method="post">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nomor Resi Pengiriman :</label>
                <div class="col-sm-9">
                    <input type="text" name="resi" class="form-control" placeholder="Masukkan Resi" id="resi">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Status :</label>
                <div class="col-sm-9">
                    <select name="status" class="form-control" id="status">
                        <option selected disabled>Pilih Status</option>
                        <option value="sedang diproses">Sedang diproses</option>
                        <option value="Pembayaran diterima dan sedang diproses">Pembayaran diterima</option>
                        <option value="Produk sedang diproses">Produk sedang diproses</option>
                        <option value="Barang sedang dikirim">Barang sedang dikirim</option>
                        <option value="Dibatalkan">Dibatalkan</option>
                        <option value="pembayaran tidak sesuai">Pembayaran tidak sesuai</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-3"></div>
                <div class="col-sm-9">
                    <button name="proses" class="btn btn-primary btn-sm">Proses</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php 

if(isset($_POST['proses'])) {
    $resi = $_POST['resi'];
    $status = $_POST['status'];

    if ($status != "pembayaran tidak sesuai") {
        $koneksi->query("UPDATE pembelian SET resi='$resi', status='$status' WHERE id_pembelian='$id_pembelian'");
    } else {
        $koneksi->query("UPDATE pembelian SET resi='', status='$status' WHERE id_pembelian='$id_pembelian'");
    }

    echo "<script>alert('Pembelian diupdate');</script>";
    echo "<script>location='index.php?halaman=pembelian';</script>";
}

?>

<script>
    document.getElementById('status').addEventListener('change', function() {
        var resiInput = document.getElementById('resi');
        if (this.value === 'pembayaran tidak sesuai') {
            resiInput.disabled = true;
            resiInput.value = '';
        } else {
            resiInput.disabled = false;
        }
    });
</script>
