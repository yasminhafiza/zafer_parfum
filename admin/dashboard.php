<div class="shadow p-3 mb-3 bg-white rounded">
    <h5>Selamat Datang <strong><?php echo $_SESSION['admin']['nama_lengkap']; ?> </strong> Anda Login Sebagai Admin</h5>
</div>

<?php 

$admin = null;
$ambil = $koneksi->query("SELECT * FROM admin");
if ($ambil->num_rows > 0) {
    $admin = $ambil->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_admin = $_POST['id_admin'];
    $nama_lengkap = $_POST['nama_lengkap'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $foto_nama = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];

    // Proses upload foto
    if (!empty($foto_tmp)) {
        move_uploaded_file($foto_tmp, "../assets/foto_admin/".$foto_nama);
        $koneksi->query("UPDATE admin SET nama_lengkap='$nama_lengkap', foto_admin='$foto_nama' WHERE id_admin='$id_admin'");
    } else {
        $koneksi->query("UPDATE admin SET nama_lengkap='$nama_lengkap' WHERE id_admin='$id_admin'");
    }

    echo "<script>alert('Data admin berhasil diperbarui');</script>";
    echo "<script>location='index.php';</script>";
}
?>

<div class="card shadow bg-white">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_admin" value="<?php echo $admin['id_admin']; ?>">
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" value="<?php echo $admin['nama_lengkap']; ?>">
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $admin['username']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $admin['password']; ?>" readonly>
            </div>
            <div class="form-group">
                <label>Foto</label>
                <input type="file" name="foto">
                <?php if ($admin['foto_admin']): ?>
                    <img src="../assets/foto_admin/<?php echo $admin['foto_admin']; ?>" width="100">
                <?php endif; ?>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
