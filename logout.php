<?php
session_start();
include 'koneksi/koneksi.php';
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}
if (isset($_SESSION['pelanggan']) && isset($_SESSION['keranjang_belanja'])) {
    $id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
    $deleteQuery = "DELETE FROM keranjang WHERE id_pelanggan='$id_pelanggan'";
    if (!$koneksi->query($deleteQuery)) {
        die("Error executing query: " . $koneksi->error);
    }
    foreach ($_SESSION['keranjang_belanja'] as $id_produk => $jumlah) {
        $insertQuery = "INSERT INTO keranjang (id_pelanggan, id_produk, jumlah) VALUES ('$id_pelanggan', '$id_produk', '$jumlah')";
        if (!$koneksi->query($insertQuery)) {
            die("Error executing query: " . $koneksi->error);
        }
    }
}
session_destroy();
echo "<script>alert('Berhasil Logout');</script>";
echo "<script>location='login.php';</script>";
?>
