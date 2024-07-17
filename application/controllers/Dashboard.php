<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function index()
	{
		not_login();
		$this->template->load('template', 'v_dashboard');
	}

	public function account_setting()
	{
		$this->template->load('template', 'v_akun', array(
			'username' => $this->session->userdata('username'),
			'email' => $this->session->userdata('email')
		)
		);
	}


}