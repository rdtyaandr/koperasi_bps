<?php
include 'vendor/autoload.php'; // Sesuaikan dengan lokasi autoload.php jika diperlukan

use Picqer\Barcode\BarcodeGeneratorHTML;

// Fungsi untuk menghasilkan gambar barcode HTML
function generateBarcodeHTML($code)
{
    $generator = new BarcodeGeneratorHTML();
    return $generator->getBarcode($code, $generator::TYPE_CODE_128);
}

// Ambil kode dari hasil scan (contoh: dari $_POST atau $_GET)
$barcodeText = $_GET['barcode']; // Sesuaikan dengan cara Anda menerima hasil scan

// Output gambar barcode HTML
echo generateBarcodeHTML($barcodeText);

// Function untuk menampilkan hasil scan


?>