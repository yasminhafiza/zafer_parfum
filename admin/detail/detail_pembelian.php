<?php
$id_pembelian = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan WHERE pembelian.id_pembelian='$id_pembelian'");
$detail = $ambil->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pembelian</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .card-custom-width {
            width: 100%;
            max-width: 600px; /* Atur sesuai kebutuhan */
        }
        .text-nowrap {
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="shadow p-3 mb-3 bg-white rounded">
        

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow bg-white">
                <div class="card-header">
                    <strong>Data Pembelian</strong>
                </div>
                <div class="card-body">
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
        </div>

        <div class="col-md-6">
            <div class="card shadow bg-white">
                <div class="card-header">
                    <strong>Data Pengiriman</strong>
                </div>
                <div class="card-body">
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
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow bg-white card-custom-width">
                <div class="card-header">
                    <strong>Data Pelanggan</strong>
                </div>
                <div class="card-body">
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
            </div>
        </div>
    </div>

    <?php

    $pembelian_produk = array();
    $ambil = $koneksi->query("SELECT * FROM pembelian_produk JOIN produk ON pembelian_produk.id_produk=produk.id_produk WHERE pembelian_produk.id_pembelian='$id_pembelian'");

    while($pecah = $ambil->fetch_assoc())
    {
        $pembelian_produk[] = $pecah;


    }

    ?>

    <div class="card shadow bg-white mt-4">
        <div class="card-body">
            <table class="table table-bordered table-hover table-striped" id="tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pembelian_produk as $key => $value): ?>
                        <?php $subtotal = $value['harga_produk']*$value['jumlah']; ?>
                    <tr>
                        <td width="50"><?php echo $key+1; ?></td>
                        <td><?php echo $value['nama_produk']; ?></td>
                        <td>Rp <?php echo number_format($value['harga_produk']); ?></td>
                        <td><?php echo $value['jumlah']; ?></td>
                        <td><?php echo number_format($subtotal); ?></td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
