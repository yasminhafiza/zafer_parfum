<div class="shadow p-3 mb-3 bg-white rounded">
    <h5><b>Edit Kategori</b></h5>
</div>

<?php

$id_kategori = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM kategori WHERE id_kategori='$id_kategori'");
$edit = $ambil->fetch_assoc();

?>

<form method="post">
    <div class="card shadow bg-white">
        <div class="card body p-3">

        <div class="form-group row mb-3">
            <label class="col-sm-3 col-form-label">Nama Kategori :</label>
            <div class="col-sm-9">
                <input type="text" name="nama" class="form-control" value="<?php echo $edit['nama_kategori']; ?>">
            </div>
        </div>
        </div>

        <div class="card-footer">
            <div class="row">
                <div class="col-md-11">
                    <button name="simpan" class="btn btn-sm btn-success">simpan</button>
                </div>
                <div class="col-md-1 tex-right">
                    <a href="index.php?halaman=kategori" class="btn btn-sm btn-danger">kembali</a>
                </div>
            </div>
        </div>
    
    </div>
</form>


<?php

if(isset($_POST['simpan']))

{
    $nama = $_POST['nama'];

    $koneksi->query("UPDATE kategori SET nama_kategori='$nama' WHERE id_kategori='$id_kategori'");
   
    echo "<script>alert('data berhasil disimpan');</script>";
    echo "<script>location='index.php?halaman=kategori';</script>";

}

?>