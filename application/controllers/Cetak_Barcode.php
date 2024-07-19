<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Cetak_Barcode extends CI_Controller
{
    public function index()
    {
        $kode_barang = $this->input->get('kode_barang');

        // Generate barcode image
        $barcode = new JsBarcode();
        $barcode->setText($kode_barang);
        $barcode->setFormat('CODE128');
        $barcode->setDisplayValue(true);
        $barcode->setFontSize(18);
        $barcode->setHeight(50);
        $barcode->setWidth(2);
        $barcode_image = $barcode->generate();

        // Create a new image resource
        $image = imagecreatefromstring($barcode_image);

        // Output the image
        header('Content-Type: image/png');
        imagepng($image);
        imagedestroy($image);
    }
}