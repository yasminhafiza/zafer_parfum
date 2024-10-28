<?php
$id_pembelian = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$id_pembelian'");
$detail = $ambil->fetch_assoc();

$idpembelian = $detail['id_pelanggan'];
$idpelanggan = $_SESSION['pelanggan']['id_pelanggan'];

if($idpembelian!==$idpelanggan)
{
    echo "<script>alert('session tidak ditemukan');</script>";
    echo "<script>location='index.php?page=pesanan';</script>";
}
?>






    <div class="shadow p-3 mb-3 bg-white rounded">
        

    <div class="row">
        <div class="col-md-6">
        <h5>Data Pengiriman</h5>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Alamat:</th>
                        <td><?php echo $detail['alamat']; ?></td>
                    </tr>
                    <tr>
                        <th>Kota/Kabupaten:</th>
                        <td><?php echo $detail['distrik']; ?></td>
                    </tr>
                    <tr>
                        <th>Provinsi:</th>
                        <td><?php echo $detail['provinsi']; ?></td>
                    </tr>
                    <tr>
                        <th>Ekspedisi:</th>
                        <td><?php echo $detail['ekspedisi']; ?></td>
                    </tr>
                    <tr>
                        <th>Jumlah Ongkir:</th>
                        <td>Rp. <?php echo number_format($detail['ongkir']);  ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-md-6">
            <h5>Data Pelanggan</h5>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Nama :</th>
                        <td><?php echo $detail['nama_pelanggan']; ?></td>
                    </tr>
                    <tr>
                        <th>Email :</th>
                        <td><?php echo $detail['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Telepon :</th>
                        <td><?php echo $detail['telepon_pelanggan']; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-md-6">
        <h5>Data Pembelian</h5>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>No.Pembelian :</th>
                        <td><?php echo $detail['id_pembelian']; ?></td>
                    </tr>
                    <tr>
                        <th>Tanggal :</th>
                        <td><?php echo $detail['tanggal_pembelian']; ?></td>
                    </tr>
                    <tr>
                        <th>Total :</th>
                        <td>Rp. <?php echo number_format($detail['total_pembelian']);  ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <?php

    $pembelian_produk = array();
    $ambil = $koneksi->query("SELECT * FROM pembelian_produk WHERE pembelian_produk.id_pembelian='$id_pembelian'");

    while($pecah = $ambil->fetch_assoc())
    {
        $pembelian_produk[] = $pecah;
    }

$total_subberat = 0;
$total_subharga = 0;

foreach ($pembelian_produk as $key => $value) {
    $total_subberat += isset($value['subberat']) ? $value['subberat'] : 0;
    $total_subharga += $value['subharga'];
}
?>



    <div class="card shadow bg-white mt-4">
        <div class="card-body">
           <div class="table-responsive">
           <table class="table table-bordered table-hover table-striped" >
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subberat</th>
                        <th>Subharga</th>
                    </tr>
                </thead>
                <tbody>
        <?php foreach ($pembelian_produk as $key => $value): ?>
        <tr>
            <td width="50"><?php echo $key+1; ?></td>
            <td><?php echo $value['nama']; ?></td>
            <td>Rp <?php echo number_format($value['harga']); ?></td>
            <td><?php echo $value['jumlah']; ?></td>
            <td><?php echo isset($value['subberat']) ? $value['subberat'] : 'N/A'; ?> Gr</td>
            <td>Rp. <?php echo number_format($value['subharga']); ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" align="right">Total</td>
            <td><?php echo $total_subberat; ?> Gr</td>
            <td>Rp. <?php echo number_format($total_subharga); ?></td>
        </tr>
    </tfoot>
            </table>
           </div>
        </div>
    </div>

    <div class="alert alert-primary shadow mt-3">
        <p>
            Silahkan Melakukan Pembayaran Rp. <?php echo number_format($detail['total_pembelian']); ?><br>
            <strong>Bank Mandiri : 131122345 AN.Yasmin Hafiza</strong>
        </p>
    </div>
