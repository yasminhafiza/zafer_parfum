<!DOCTYPE html>
<html>
<head>
    <title>LAPORAN</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.10/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.10/vfs_fonts.js"></script>
</head>
<body>

<?php
require_once '../koneksi/koneksi.php';

$tanggal_mulai = $_GET['tanggalm'];
$tanggal_selesai = $_GET['tanggals'];
$status = $_GET['status'];

$semuadata = array();
$ambil = $koneksi->query("SELECT * FROM pembelian JOIN pelanggan 
ON pembelian.id_pelanggan=pelanggan.id_pelanggan
WHERE status='$status' AND tanggal_pembelian 
BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'");

while($pecah = $ambil->fetch_assoc()) {
    $pecah['total_pembelian'] = 'Rp.' . number_format($pecah['total_pembelian'], 0, ',', '.');
    $semuadata[] = $pecah;
}

echo '<script>';
echo 'var data = ' . json_encode($semuadata) . ';';
echo '</script>';
?>

<h2 style="text-align: center;">Laporan Pembelian</h2>
<div style="border: 2px solid black; margin: 0 500px 0 "></div>
<table style="border: 1px solid #f2f2f2; color: #232323; width: 100%; text-align: center; margin-top: 20px;">
    <tr style="background: #35a9db; color:#fff;">
        <th>No</th>
        <th>Nama pelanggan</th>
        <th>Tanggal Pembelian</th>
        <th>Status</th>
        <th>Jumlah</th>
    </tr>
    <tbody id="table-body">
        <?php foreach ($semuadata as $key => $value): ?>
        <tr>
            <th><?php echo $key + 1; ?></th>
            <th><?php echo $value['nama_pelanggan']; ?></th>
            <th><?php echo date("d F Y", strtotime($value['tanggal_pembelian'])); ?></th>
            <th><?php echo $value['status']; ?></th>
            <th><?php echo $value['total_pembelian']; ?></th>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script>
    var docDefinition = {
        content: [
            { text: 'Data Laporan', style: 'header' },
            {
                table: {
                    headerRows: 1,
                    widths: [ 'auto', '*', 'auto', 'auto', 'auto', 'auto' ],
                    body: [
                        [
                            { text: 'No', style: 'tableHeader' },
                            { text: 'Nama pelanggan', style: 'tableHeader' },
                            { text: 'Tanggal Pembelian', style: 'tableHeader' },
                            { text: 'Status', style: 'tableHeader' },
                            { text: 'Nomor Resi', style: 'tableHeader' }, // Tambahkan kolom Nomor Resi
                            { text: 'Jumlah', style: 'tableHeader' }
                        ],
                        ...data.map((item, index) => [
                            { text: (index + 1).toString(), style: 'tableBody' },
                            { text: item.nama_pelanggan, style: 'tableBody' },
                            { text: item.tanggal_pembelian, style: 'tableBody' },
                            { text: item.status, style: 'tableBody' },
                            { text: item.resi, style: 'tableBody' }, // Menampilkan Nomor Resi
                            { text: item.total_pembelian, style: 'tableBody' }
                        ])
                    ]
                }
            }
        ],
        styles: {
            header: {
                fontSize: 18,
                bold: true,
                alignment: 'center',
                margin: [0, 0, 0, 10]
            },
            tableHeader: {
                bold: true,
                fontSize: 13,
                color: 'black'
            },
            tableBody: {
                fontSize: 11,
                color: 'black'
            }
        }
    };

    // Download PDF on Page Load (optional)
    pdfMake.createPdf(docDefinition).download('Laporan.pdf');
</script>


</body>
</html>
