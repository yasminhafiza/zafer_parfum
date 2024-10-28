<?php

$id_pelanggan = $_GET['id'];

$ambil = $koneksi->query("SELECT * FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");
$pecah = $ambil->fetch_assoc();

$koneksi->query("DELETE FROM pelanggan WHERE id_pelanggan='$id_pelanggan'");

echo "<script>alert('Data pelanggan berhasil dihapus');</script>";
echo "<script>location='index.php?halaman=pelanggan';</script>";

?>
