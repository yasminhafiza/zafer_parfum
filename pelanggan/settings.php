<?php

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
$pecah = $ambil->fetch_assoc();

?>

<div class="container">
        <div class="shadow p-3 mb-3 rounded bg-white text-center shadow-custom">
            <h4>Edit Profile</h4>
        </div>

        <div class="shadow p-4 rounded bg-white shadow-custom">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="nama" class="col-sm-3 col-form-label">Nama :</label>
                    <div class="col-sm-9">
                        <input type="text" name="nama" class="form-control" value="<?php echo $pecah['nama_pelanggan']; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Email :</label>
                    <div class="col-sm-9">
                        <input type="text"  class="form-control" value="<?php echo $pecah['email']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-sm-3 col-form-label">Password :</label>
                    <div class="col-sm-9">
                        <input type="password"  class="form-control" value="<?php echo $pecah['password_pelanggan']; ?>" readonly>
                        <a href="index.php?page=update_password" class="btn btn-primary mt-3">Update Password</a>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="telepon" class="col-sm-3 col-form-label">Telepon :</label>
                    <div class="col-sm-9">
                        <input type="text" name="telepon" class="form-control" value="<?php echo $pecah['telepon_pelanggan']; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="alamat" class="col-sm-3 col-form-label">Alamat :</label>
                    <div class="col-sm-9">
                        <textarea name="alamat" class="form-control"><?php echo $pecah['alamat_pelanggan']; ?></textarea>
                    </div>
                </div>


                <div class="form-group row">
    <label for="email" class="col-sm-3 col-form-label"></label>
    <div class="col-sm-9">
        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
    </div>
</div>


            </form>
        </div>
    </div>

    <?php
if(isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $pass = sha1($_POST['password']); 
    $telp = $_POST['telepon'];
    $alamat = $_POST['alamat'];
    
    // Proses upload foto
    $nama_foto = $_FILES['foto']['name'];
    $lokasi_foto = $_FILES['foto']['tmp_name'];

    if(!empty($lokasi_foto)) {
        move_uploaded_file($lokasi_foto, "../assets/foto_pelanggan/".$nama_foto);

        $koneksi->query("UPDATE pelanggan SET
            nama_pelanggan = '$nama',
            password_pelanggan = '$pass',
            telepon_pelanggan = '$telp',
            alamat_pelanggan = '$alamat',
            foto_pelanggan = '$nama_foto'
            WHERE id_pelanggan='$id_pelanggan';");

    } else {
        $koneksi->query("UPDATE pelanggan SET
            nama_pelanggan = '$nama',
            password_pelanggan = '$pass',
            telepon_pelanggan = '$telp',
            alamat_pelanggan = '$alamat'
            WHERE id_pelanggan='$id_pelanggan';");
    }
    echo "<script>alert('Perubahan berhasil disimpan');</script>";
    echo "<script>location='index.php';</script>";

}
?>
