<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Qrcode extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load model yang dibutuhkan
        $this->load->model('M_qrcode', 'qrcode');
    }

    public function index()
    {
        $this->load->model('M_barang'); // load the model
        $brg = $this->M_barang->get_all_barang(); // retrieve data from the model
        $this->load->view('qrcode/index', array('barang' => $brg));
    }

    public function saveQrCode()
    {
        // Simpan data QR Code ke dalam database
        $data = array(
            'qr_code_content' => $this->input->post('qr_code_content')
            // Tambahkan field lain yang diperlukan
        );

        $insert_id = $this->qrcode->saveQrCodeData($data);
        // Lakukan sesuatu setelah berhasil menyimpan, misalnya redirect atau tampilkan pesan
    }

    public function getQrCode($id)
    {
        // Ambil data QR Code berdasarkan ID
        $qrCodeData = $this->qrcode->getQrCodeData($id);
        // Lakukan sesuatu dengan data yang diambil, misalnya tampilkan di view
    }

    public function deleteQrCode($id)
    {
        // Hapus data QR Code berdasarkan ID
        $this->qrcode->deleteQrCodeData($id);
        // Lakukan sesuatu setelah berhasil menghapus, misalnya redirect atau tampilkan pesan
    }
}
