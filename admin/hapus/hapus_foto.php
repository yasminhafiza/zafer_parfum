<?php
$id_produk_foto = $_GET['id']; // ID produk_foto yang ingin dihapus fotonya

$ambil_foto = $koneksi->query("SELECT * FROM produk_foto WHERE id_produk_foto='$id_produk_foto'");
$foto_produk = $ambil_foto->fetch_assoc();

$nama_foto = $foto_produk['nama_produk_foto'];

// Hapus foto dari folder penyimpanan
$lokasi_foto = 'path/ke/folder/foto/'; // Sesuaikan dengan path tempat menyimpan foto
unlink($lokasi_foto . $nama_foto); // Hapus file foto dari folder

// Hapus data foto dari tabel produk_foto
$koneksi->query("DELETE FROM produk_foto WHERE id_produk_foto='$id_produk_foto'");

echo "<script>alert('Foto produk berhasil dihapus');</script>";
echo "<script>location='index.php?halaman=produk';</script>";

?>
