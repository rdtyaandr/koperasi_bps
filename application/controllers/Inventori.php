<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventori extends CI_Controller
{

	public function edit()
	{
		// Tangani permintaan edit disini
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			// Ambil data yang diubah dari $_POST
			$id_inventori = $this->input->post('id_inventori');
			$kode_barang = $this->input->post('kode_barang');
			$nama_barang = $this->input->post('nama_barang');
			$detail_barang = $this->input->post('detail_barang');
			$qty = $this->input->post('qty');

			// Contoh proses update di database (menggunakan Model untuk query ke database)
			$this->load->model('Inventori_model');
			$this->Inventori_model->update_inventori($id_inventori, $kode_barang, $nama_barang, $detail_barang, $qty);

			// Set flash data untuk memberi pesan sukses
			$this->session->set_flashdata('flash', 'Data inventori berhasil diubah');

			// Redirect ke halaman daftar inventori atau halaman yang sesuai
			redirect('inventori');
		} else {
			// Jika tidak ada POST request, mungkin akan ditangani dengan cara lain
			redirect('inventori');
		}
	}

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_inventori');
		$this->load->library('form_validation');
		$this->load->model('m_barang');
		not_login();
	}

	public function index()
	{
		$data['judul'] = 'Tabel Data Inventori';
		$data['inventori'] = $this->m_inventori->getAllInventori();
		$this->template->load('template', 'inventori/v_inventori', $data);
	}

	public function tambah()
	{

		$this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required');
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
		$this->form_validation->set_rules('detail_barang', 'Detail Barang', 'required');
		$this->form_validation->set_rules('qty', 'Quantity', 'required');

		if ($this->form_validation->run() == false) {
			$data['judul'] = 'Tambah Data Inventori';
			$this->template->load('template', 'inventori/v_tambahinventori', $data);
		} else {
			$this->m_inventori->tambah();
			$this->session->set_flashdata('flash', ' Ditambahkan');
			redirect('inventori');
		}
	}

	// Fungsi untuk mendapatkan detail barang berdasarkan kode barang
	public function autokodebaranginv(){
		$id_barang = $this->input->post('kode_barang');
		$rows = $this->m_barang->getAutoBarangById($id_barang);
		foreach ($rows as $row) {
			$row[] = $rows;
		}
		// Membuat array data dengan informasi barang
		$data = array(
			'id_barang'=>$row['id_barang'], // ID barang
			'nama_barang'=>$row['nama_barang'], // Nama barang
			'detail_barang'=>$row['detail_barang'] // Detail barang
		);
		// Mengubah array data menjadi format JSON dan mengirimkannya sebagai respon
		echo json_encode($data);
	}

	public function ubah($id)
	{
		$this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required');
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
		$this->form_validation->set_rules('detail_barang', 'Detail Barang', 'required');
		$this->form_validation->set_rules('qty', 'Quantity', 'required');

		if ($this->form_validation->run() == false) {
			$data['judul'] = 'Edit Data Inventori';
			$data['inventori'] = $this->m_inventori->getInventoryById($id)->row_array();
			$this->template->load('template', 'inventori/v_ubahinventori', $data);
		} else {
			$this->m_inventori->editDataInventori();
			$this->session->set_flashdata('flash', ' Diubah');
			redirect('inventori');
		}
	}

	public function hapus($inv, $brg, $qty)
	{
		$this->m_inventori->hapusDataInventori($inv, $brg, $qty);
		$this->session->set_flashdata('flash', 'Dihapus');
		redirect('inventori');
	}
}