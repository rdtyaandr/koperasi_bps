<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Auth extends CI_Controller{

	public function index(){
		already_login();
		$this->load->view('auth/v_login');
	}

		public function logout()
	{
		$params = ['id','username'];
		$this->session->unset_userdata($params);
		redirect('auth');
	}

	public function process()
	{
		$post = $this->input->post(null, TRUE);

		if(isset($post['login'])){
			//ambil data dari tabel dengan model
			$this->load->model('m_user');

			$query = $this->m_user->login($post);

			//validasi
			if($query->num_rows() > 0)
			{
				$row = $query->row();
				$params = array(
					'id'=> $row->id,
					'nama_lengkap' => $row->nama_lengkap,
					'username' => $row->username,
				);

				//set session
				$this->session->set_userdata($params);
				$this->session->set_flashdata('login', 'berhasil');
				redirect('dashboard');
			} else {
				$this->session->set_flashdata('login', 'gagal');
				redirect('auth');
			}
		}
	}

	public function update_account() {
    $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required');
    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('error', 'Update account failed');
        redirect(base_url('dashboard/account_setting'));
    } else {
        $data = array(
            'nama_lengkap' => $this->input->post('nama_lengkap'),
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
        );
        $this->session->set_userdata($data);
        $this->session->set_flashdata('success', 'Update account successful');
        redirect(base_url('dashboard/account_setting'));
    }
}
}
