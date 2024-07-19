<?php
// Pastikan kode_barang ada dan tidak kosong
if (isset($_GET['kode_barang']) && !empty($_GET['kode_barang'])) {
    $kode_barang = $_GET['kode_barang'];
} else {
    // Jika kode_barang tidak ada, lakukan redirect atau tampilkan pesan error
    header("Location: " . base_url('barang')); // Ganti dengan halaman yang sesuai
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cetak Gambar Barcode</title>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
</head>

<body>
    <h1>Cetak Gambar Barcode</h1>
    <svg id="barcode"></svg>

    <script>
        JsBarcode("#barcode", "<?= $kode_barang ?>", {
            format: "CODE128",
            displayValue: true,
            fontSize: 18,
            height: 50,
            width: 2
        });
    </script>
</body>

</html>