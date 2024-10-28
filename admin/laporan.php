<div class="shadow p-3 mb-3 bg-white rounded">
    <h5><b>Laporan</b></h5>
</div>

<?php
$semuadata = array();
$tanggal_mulai = isset($_POST['tanggalm']) ? $_POST['tanggalm'] : date('Y-m-d');
$tanggal_selesai = isset($_POST['tanggals']) ? $_POST['tanggals'] : date('Y-m-d');
$status = isset($_POST['status']) ? $_POST['status'] : '';

if(isset($_POST['cari']))
{
    $tanggal_mulai = $_POST['tanggalm'];
    $tanggal_selesai = $_POST['tanggals'];
    $status = $_POST['status'];

    if ($status == 'all' || $status == '') {
        $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
        ON pembelian.id_pelanggan=pelanggan.id_pelanggan
        WHERE tanggal_pembelian BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'");
    } else {
        $ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
        ON pembelian.id_pelanggan=pelanggan.id_pelanggan
        WHERE status='$status' AND tanggal_pembelian 
        BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'");
    }

    while($pecah = $ambil->fetch_assoc())
    {
        $semuadata[] = $pecah;
    }
}
?>

<div class="alert alert-info shadow text-dark">
    <p>
        Laporan Pembelian dari <strong><em><?php echo date ("d F Y", strtotime($tanggal_mulai)); ?></em></strong> sampai <strong><em><?php echo date ("d F Y", strtotime($tanggal_selesai)); ?></em></strong>
    </p>
</div>

<div class="card shadow bg-white">
    <div class="card-body">
        <form method="post">

            <div class="row">

                <div class="col-md-4">
                    <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Tanggal Mulai :</label>
                        <div class="col-sm-9">
                            <input type="date" name="tanggalm" class="form-control" value="<?php echo $tanggal_mulai; ?>">
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                <div class="form-group row">
                        <label  class="col-sm-3 col-form-label">Tanggal Selesai :</label>
                        <div class="col-sm-9">
                            <input type="date" name="tanggals" class="form-control" value="<?php echo $tanggal_selesai; ?>">
                        </div>
                    </div>
                </div>
                
                <div class="col-md-3">
                <div class="form-group row">
                        <div class="col-sm-12">
                            <select name="status" class="form-control">
                            <option value="sedang diproses" <?php echo $status == 'sedang diproses' ? 'selected' : ''; ?>>Sedang diproses</option>
                            <option value="Pembayaran diterima dan sedang diproses" <?php echo $status == 'Pembayaran diterima dan sedang diproses' ? 'selected' : ''; ?>>Pembayaran diterima</option>
                            <option value="Produk sedang diproses" <?php echo $status == 'Produk sedang diproses' ? 'selected' : ''; ?>>Produk sedang diproses</option>
                            <option value="Barang sedang dikirim" <?php echo $status == 'Barang sedang dikirim' ? 'selected' : ''; ?>>Barang sedang dikirim</option>
                            <option value="Dibatalkan" <?php echo $status == 'Dibatalkan' ? 'selected' : ''; ?>>Dibatalkan</option>
                            <option value="pembayaran tidak sesuai" <?php echo $status == 'pembayaran tidak sesuai' ? 'selected' : ''; ?>>Pembayaran tidak sesuai</option>
                            <option value="sudah diterima" <?php echo $status == 'sudah diterima' ? 'selected' : ''; ?>>Sudah diterima</option>

                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-md-1">
                    <button name="cari" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>

            </div>

        </form>
    </div>
</div>

<div class="card shadow bg-white mt-3">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama pelanggan</th>
                        <th>Tanggal Pembelian</th>
                        <th>Status</th>
                        <th>Nomor Resi</th>
                        <th>Jumlah</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($semuadata)): ?>
                        <?php foreach ($semuadata as $key => $value): ?>
                            <tr>
                                <td width="50"><?php echo $key+1; ?></td>
                                <td><?php echo $value['nama_pelanggan']; ?></td>
                                <td><?php echo date("d F Y", strtotime($value['tanggal_pembelian'])); ?></td>
                                <td><?php echo $value['status']; ?></td>
                                <td><?php echo $value['resi']; ?></td>

                                <td>Rp. <?php echo number_format($value['total_pembelian']); ?></td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Tidak ada data yang ditemukan</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="alert alert-primary shadow mt-3">
    <a href="download.php?tanggalm=<?php echo $tanggal_mulai; ?>&tanggals=<?php echo $tanggal_selesai; ?>&status=<?php echo $status; ?>" class="btn btn-success" target="_blank">Download</a>
</div>
