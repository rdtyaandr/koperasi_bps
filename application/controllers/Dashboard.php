<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_account');
        $this->load->library('form_validation');
        not_login();
    }

    public function index() {
        not_login();
        $this->template->load('template', 'v_dashboard');
    }

    public function account_setting() {
        $this->template->load('template', 'v_akun', array(
            'nama_lengkap' => $this->session->userdata('nama_lengkap'),
            'username' => $this->session->userdata('username')
        ));
    }

	public function update_account() {
		// Ambil nilai dari form
		$nama_lengkap = $this->input->post('nama_lengkap');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$new_password = $this->input->post('new_password');
		$confirm_password = $this->input->post('confirm_password');
	
		// Set aturan validasi untuk username
		$this->form_validation->set_rules('username', 'username', 'trim|required|callback_check_valid_username');
		
		// Validasi password lama dengan password yang ada di database
		if (!empty($password)) {
			$this->form_validation->set_rules('password', 'password lama', 'trim|required|callback_check_old_password');
		}
	
		// Set aturan validasi untuk password baru
		if (!empty($new_password)) {
			$this->form_validation->set_rules('new_password', 'password baru', 'trim|required|callback_check_password_complexity|matches[confirm_password]');
			$this->form_validation->set_rules('confirm_password', 'konfirmasi password baru', 'trim|required|callback_check_password_complexity|matches[new_password]');
		}
	
		// Jalankan validasi form
		if ($this->form_validation->run() == FALSE) {
			// Validasi gagal, tampilkan kembali form dengan error
			$this->account_setting(); // Misalnya, kembali ke halaman pengaturan akun
		} else {
			// Panggil model untuk melakukan validasi atau update data ke database
			$this->M_account->updateAccount($nama_lengkap, $username, $password, $new_password, $confirm_password);
	
			// Set ulang session setelah update
			$this->session->set_userdata('username', $username);
			$this->session->set_userdata('nama_lengkap', $nama_lengkap);
	
			// Redirect atau tampilkan pesan sukses, sesuai kebutuhan
			redirect('dashboard/account_setting'); // Redirect kembali ke halaman detail akun
		}
	}	
	


















	
    // Callback 
    public function check_valid_username($str) {
        // Pemeriksaan menggunakan regular expression
        if (preg_match('/^\s*$/', $str)) {
            $this->form_validation->set_message('check_valid_username', 'Username tidak boleh kosong atau hanya terdiri dari spasi kosong');
            return FALSE;
        } else {
            return TRUE;
        }
    }
	public function check_password_complexity($str) {
		// Validasi panjang password minimal 4 karakter
		if (strlen($str) < 4) {
			$this->form_validation->set_message('check_password_complexity', 'Password minimal terdiri dari 4 karakter');
			return FALSE;
		}
		return TRUE;
	}
	public function check_old_password($str) {
		$user_id = $this->session->userdata('id'); // Ambil ID user dari session atau dari data lain yang sesuai
		$stored_password = $this->M_account->getPasswordById($user_id); // Gantikan dengan method yang sesuai untuk mengambil password dari database
	
		// Trim spasi dari kedua password
		$stored_password = trim($stored_password);
		$input_password = trim($str);
	
		// Bandingkan password dengan ===
		if ($stored_password !== $input_password) {
			$this->form_validation->set_message('check_old_password', 'Password lama tidak sesuai');
			return FALSE;
		}
		return TRUE;
	}
	
	
}