<div class="shadow p-3 mb-3 bg-white rounded">
    <h5><b>Pembelian</b></h5>
</div>

<?php 

$pembelian = array();
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan ON pembelian.id_pelanggan=pelanggan.id_pelanggan");
while($pecah = $ambil->fetch_assoc())

{
    $pembelian[] = $pecah;
}
?>

<div class="card shadow bg-white">
    <div class="card-body">
        <table class="table table-bordered table-hover table-striped" id="tables">
        <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th width="150">Tanggal</th> <!-- Menambahkan lebar kolom -->
        <th width="150">Total</th> <!-- Menambahkan lebar kolom -->
        <th width="2000">Status</th>
        <th>Resi</th>
        <th>Opsi</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($pembelian as $key => $value): ?>
    <tr>
        <td width="50"><?php echo $key+1; ?></td>
        <td><?php echo $value['nama_pelanggan']; ?></td>
        <td><?php echo $value['email']; ?></td>
        <td width="150"><?php echo date("D, d M Y", strtotime($value['tanggal_pembelian'])); ?></td>
        <td width="150">Rp <?php echo number_format($value['total_pembelian']); ?></td>
        <td><?php echo $value['status']; ?></td>
        <td><?php echo $value['resi']; ?></td>
        <td class="text-center" width="400">
    <a href="index.php?halaman=detail_pembelian&id=<?php echo $value['id_pembelian']; ?>" class="btn btn-sm btn-info">Detail</a>
    
    <?php if($value['status'] !== 'pending'): ?>
        <a href="index.php?halaman=pembayaran&id=<?php echo $value['id_pembelian']; ?>" class="btn btn-sm btn-success">Lihat Pembayaran</a>
        <a href="index.php?halaman=hapus_pembelian&id=<?php echo $value['id_pembelian']; ?>" class="btn btn-sm btn-danger mt-2">Hapus</a>
    <?php else: ?>
        <a href="index.php?halaman=hapus_pembelian&id=<?php echo $value['id_pembelian']; ?>" class="btn btn-sm btn-danger">Hapus</a>
    <?php endif; ?>
</td>

    </tr>
    <?php endforeach ?>
</tbody>


        </table>
    </div>
</div>