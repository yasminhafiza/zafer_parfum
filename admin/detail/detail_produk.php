<div class="shadow p-3 mb-3 bg-white rounded">
    <h5><b>Edit Produk</b></h5>
</div>

<?php

// Ensure $id_produk is safe for use in a query
$id_produk = mysqli_real_escape_string($koneksi, $_GET['id']);

// Get product details from the database
$ambil = $koneksi->query("SELECT * FROM produk JOIN kategori ON produk.id_kategori=kategori.id_kategori WHERE id_produk='$id_produk'");
$detailproduk = $ambil->fetch_assoc();

// Get all categories for the dropdown
$categories = $koneksi->query("SELECT * FROM kategori");

// Get related product photos
$produk_foto = array();
$ambil_foto = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk='$id_produk'");
while ($tiap_foto = $ambil_foto->fetch_assoc()) {
    $produk_foto[] = $tiap_foto;
}

?>

<form method="post" enctype="multipart/form-data">
    <div class="card shadow bg-white">
        <div class="card-header">
            <strong>Data Produk</strong>
        </div>
        <div class="card-body">
            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Kategori</label>
                <div class="col-sm-9">
                    <select class="form-control" name="id_kategori">
                        <?php while ($category = $categories->fetch_assoc()): ?>
                            <option value="<?php echo $category['id_kategori']; ?>" <?php if ($category['id_kategori'] == $detailproduk['id_kategori']) echo "selected"; ?>>
                                <?php echo $category['nama_kategori']; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Produk</label>
                <div class="col-sm-9">
                    <input class="form-control" name="nama_produk" value="<?php echo $detailproduk['nama_produk']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Harga produk</label>
                <div class="col-sm-9">
                    <input class="form-control" name="harga_produk" value="<?php echo $detailproduk['harga_produk']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Berat Produk</label>
                <div class="col-sm-9">
                    <input class="form-control" name="berat_produk" value="<?php echo $detailproduk['berat_produk']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Deskripsi Produk</label>
                <div class="col-sm-9">
                    <textarea class="form-control" name="deskripsi_produk"><?php echo $detailproduk['deskripsi_produk']; ?></textarea>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Stok Produk</label>
                <div class="col-sm-9">
                    <input class="form-control" name="stok_produk" value="<?php echo $detailproduk['stok_produk']; ?>">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Update Foto Produk</label>
                <div class="col-sm-9">
                    <input type="file" name="produk_foto_baru" class="form-control">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-md-11">
                    <button name="update" class="btn btn-sm btn-primary">Update Produk</button>
                </div>
                <div class="col-md-1 text-right">
                    <a href="index.php?halaman=produk" class="btn btn-sm btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="row mt-4">
    <?php foreach ($produk_foto as $key => $value): ?>
        <div class="col-4">
            <div class="card" style="width: 22rem;">
                <img src="../assets/foto_produk/<?php echo $value['nama_produk_foto']; ?>" class="img-thumbnail">
                
            </div>
            <div class="card-footer text-center">
            <a href="index.php?halaman=hapus_foto&id=<?php echo $value['id_produk_foto']; ?>" class="btn btn-sm btn-danger">Hapus</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<form method="post" enctype="multipart/form-data">
    <div class="card shadow bg-white">
            <div class="row">
               
            </div>
        </div>
    </div>
</form>

<?php

if (isset($_POST['update'])) {
    $id_kategori = mysqli_real_escape_string($koneksi, $_POST['id_kategori']);
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $harga_produk = mysqli_real_escape_string($koneksi, $_POST['harga_produk']);
    $berat_produk = mysqli_real_escape_string($koneksi, $_POST['berat_produk']);
    $deskripsi_produk = mysqli_real_escape_string($koneksi, $_POST['deskripsi_produk']);
    $stok_produk = mysqli_real_escape_string($koneksi, $_POST['stok_produk']);

    $koneksi->query("UPDATE produk SET id_kategori='$id_kategori', nama_produk='$nama_produk', harga_produk='$harga_produk', berat_produk='$berat_produk', deskripsi_produk='$deskripsi_produk', stok_produk='$stok_produk' WHERE id_produk='$id_produk'");

    if ($_FILES['produk_foto_baru']['tmp_name']) {
        $namafoto = $_FILES['produk_foto_baru']['name'];
        $lokasifoto = $_FILES['produk_foto_baru']['tmp_name'];
        $tgl_foto = date('YmdHis') . $namafoto;
        move_uploaded_file($lokasifoto, "../assets/foto_produk/" . $tgl_foto);
        $koneksi->query("INSERT INTO produk_foto (id_produk, nama_produk_foto) VALUES ('$id_produk', '$tgl_foto')");
    }

    echo "<script>alert('Produk berhasil diupdate');</script>";
    echo "<script>location='index.php?halaman=detail_produk&id=$id_produk';</script>";
}

if (isset($_POST['simpan'])) {
    $namafoto = $_FILES['produk_foto']['name'];
    $lokasifoto = $_FILES['produk_foto']['tmp_name'];
    $tgl_foto = date('YmdHis') . $namafoto;
    move_uploaded_file($lokasifoto, "../assets/foto_produk/" . $tgl_foto);
    $koneksi->query("INSERT INTO produk_foto (id_produk, nama_produk_foto) VALUES ('$id_produk', '$tgl_foto')");
    echo "<script>alert('Foto produk berhasil disimpan');</script>";
    echo "<script>location='index.php?halaman=detail_produk&id=$id_produk';</script>";
}

?>
