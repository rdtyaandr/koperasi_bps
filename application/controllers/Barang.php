<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_barang');
		$this->load->library('form_validation');
		not_login();
	}

	public function index()
	{
		$data['judul'] = 'Tabel Data Barang';
		$data['barang'] = $this->m_barang->getAllBarang();
		$this->template->load('template', 'barang/v_barang', $data);

	}

	public function tambah()
	{
		$this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required|is_unique[tb_barang.kode_barang]');
		$this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
		$this->form_validation->set_rules('detail_barang', 'Detail Barang', 'required');
		$this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required');
		$this->form_validation->set_rules('harga_beli', 'Harga Beli', 'required');

		if ($this->form_validation->run() == false) {
			$data['judul'] = 'Tambah Data Barang';
			$this->template->load('template', 'barang/v_tambahbarang', $data);
		} else {
			$this->m_barang->tambahDataBarang();
			$this->session->set_flashdata('flash', ' Ditambahkan');
			redirect('barang/tambah');
		}
	}

	public function ubah($id)
	{
		$this->form_validation->set_rules('kode_barang', 'Kode Barang', 'required');
		if ($this->form_validation->run() == false) {
			$data['satuan'] = ['PCS', 'RIM', 'DUS'];
			$data['kategori'] = ['ATK', 'PRC', 'SUP', 'AKB'];
			$data['ubah'] = $this->m_barang->getBarangById($id);
			$this->template->load('template', 'barang/v_ubahdatabarang', $data);
		} else {
			$this->m_barang->ubahDataBarang();
			$this->session->set_flashdata('flash', ' Diubah');
			redirect('barang');
		}
	}

	public function hapus($id)
	{
		$this->m_barang->hapusBarang($id);
		$this->session->set_flashdata('flash', 'Dihapus');
		redirect('barang');
	}

	public function generate_barcode($kode_barang)
	{
		// Load the php-barcode library
		require_once (APPPATH . 'third_party/php-barcode/autoload.php');

		// Create a new barcode object
		$barcode = new \Barcode\Barcode();

		// Set the barcode type and code
		$barcode->setType('code128');
		$barcode->setCode($kode_barang);

		// Generate the barcode image
		$image = $barcode->generate();

		// Output the barcode image
		header('Content-Type: image/png');
		echo $image;
	}

	public function cetak_barcode()
	{
		$kode_barang = $this->input->get('kode_barang');
		// Generate barcode image using JsBarcode or any other library
		$barcode_svg = '<svg id="barcode-' . $kode_barang . '"></svg>';
		$script = '<script>JsBarcode("#barcode-' . $kode_barang . '", "' . $kode_barang . '", {
            format: "CODE128",
            displayValue: true,
            fontSize: 18,
            height: 50,
            width: 2
        });</script>';

		// Create a new HTML page for the barcode
		$html = '<html><body>' . $barcode_svg . $script . '</body></html>';

		// Output the HTML page
		echo $html;
	}


}