<div class="shadow p-3 mb-3 bg-white rounded">
    <h5><b>Pelanggan</b></h5>
</div>
<?php 

$pelanggan = array();
$ambil = $koneksi->query("SELECT * FROM pelanggan");
while ($pecah = $ambil->fetch_assoc())

{
    $pelanggan[] = $pecah;
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
                    <th>Telepon</th>
                    <th>Opsi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pelanggan as $key => $value): ?>
                <tr>
                <td width="50"><?php echo $key+1; ?></td>
                <td><?php echo $value['nama_pelanggan']; ?></td>
                <td><?php echo $value['email']; ?></td>
                <td><?php echo $value['telepon_pelanggan']; ?></td>
                
                <td class="text-center" width="150">
                <a href="index.php?halaman=hapus_pelanggan&id=<?php echo $value['id_pelanggan']; ?>" class="btn btn-sm btn-danger">Hapus</a>
                </td>

                <?php endforeach ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>