<?php
// Load autoloader dari Composer
require 'vendor/autoload.php';

use Zend\Barcode\Barcode;

// Ambil teks dari query string
$text = isset($_GET['text']) ? $_GET['text'] : '';

// Set tipe barcode (bisa diatur sesuai kebutuhan, misalnya 'code128', 'qr', dll)
$barcodeType = Barcode::TYPE_CODE_128;

// Set konfigurasi barcode (opsional, bisa diatur sesuai kebutuhan)
$barcodeOptions = ['text' => $text];

// Membuat barcode menggunakan Zend Barcode
$barcode = Barcode::factory($barcodeType, 'image', $barcodeOptions);

// Set header untuk menampilkan gambar
header('Content-Type: ' . $barcode->getMimeType());

// Tampilkan gambar barcode
echo $barcode->draw();
