<?php
defined('BASEPATH') or exit('No direct script access allowed');
class M_barang extends CI_Model
{

	public function getAllBarang()
	{
		$this->db->order_by('id_barang', 'DESC');
		return $this->db->get('tb_barang')->result_array();
	}

    public function get_all_barang()
    {
        $this->load->dbforge(); // Load the dbforge library

        if (!$this->db->table_exists('barang')) {
            // Create the table if it doesn't exist
            $fields = array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'nama_barang' => array(
                    'type' => 'VARCHAR',
                    'constraint' => 255
                ),
                // Add other columns as needed
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('barang', TRUE);
        }

        $query = $this->db->query("SELECT * FROM barang");
        return $query->result_array();
    }

	public function tambahDataBarang()
	{
		$data = [
			'id_barang' => '',
			'kode_barang' => $this->input->post('kode_barang', TRUE),
			'nama_barang' => $this->input->post('nama_barang', TRUE),
			'detail_barang' => $this->input->post('detail_barang', TRUE),
			'satuan' => $this->input->post('satuan', TRUE),
			'kategori' => $this->input->post('kategori', TRUE),
			'harga_beli' => $this->input->post('harga_beli', TRUE),
			'harga_jual' => $this->input->post('harga_jual', TRUE),
			'stok' => 0,
			'updated_at' => 0,
		];

		$this->db->insert('tb_barang', $data);
	}

	public function getBarangById($id)
	{
		return $this->db->get_where('tb_barang', ['id_barang' => $id])->row_array();
	}

	public function getAutoBarangById($id_barang)
	{
		return $this->db->get_where('tb_barang', ['kode_barang' => $id_barang])->result_array();
	}

	public function getBarangStok()
	{
		$sql = "SELECT * FROM tb_barang WHERE stok > 0";
		return $this->db->query($sql)->result_array();
	}

	public function ubahDataBarang()
	{

		date_default_timezone_set('Asia/Jakarta');

		$data = [
			'kode_barang' => $this->input->post('kode_barang', TRUE),
			'nama_barang' => $this->input->post('nama_barang', TRUE),
			'detail_barang' => $this->input->post('detail_barang', TRUE),
			'satuan' => $this->input->post('satuan', TRUE),
			'kategori' => $this->input->post('kategori', TRUE),
			'updated_at' => date("Y-m-d h:i:s"),
		];

		$this->db->where('id_barang', $this->input->post('id_barang', true));
		$this->db->update('tb_barang', $data);
	}

	public function hapusBarang($id)
	{
		$this->db->delete('tb_barang', ['id_barang' => $id]);
	}






}