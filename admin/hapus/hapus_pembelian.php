<?php

$id_pembelian = $_GET['id'];
$ambil = $koneksi->query("SELECT * FROM pembelian WHERE id_pembelian='$id_pembelian'");
$pecah = $ambil->fetch_assoc();
$koneksi->query("DELETE FROM pembelian WHERE id_pembelian='$id_pembelian'");

echo "<script>alert('Data pembelian berhasil dihapus');</script>";
echo "<script>location='index.php?halaman=pembelian';</script>";

?>
