<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_qrcode extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        // Load library dan helper yang dibutuhkan
        $this->load->database();
    }

    // Contoh fungsi untuk menyimpan data QR Code
    public function saveQrCodeData($data)
    {
        $this->db->insert('qrcode_table', $data);
        return $this->db->insert_id();
    }

    // Contoh fungsi untuk mengambil data QR Code
    public function getQrCodeData($id)
    {
        $query = $this->db->get_where('qrcode_table', array('id' => $id));
        return $query->row_array();
    }

    // Contoh fungsi untuk menghapus data QR Code
    public function deleteQrCodeData($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('qrcode_table');
    }
}
