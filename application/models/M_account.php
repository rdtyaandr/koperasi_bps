<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_account extends CI_Model {

    public function updateAccount($nama_lengkap, $username, $password, $new_password, $confirm_password) {
        // Contoh update jika password baru tidak kosong
        if (!empty($new_password) && ($new_password == $confirm_password)) {
            // Lakukan update dengan password baru
            $data = array(
                'nama_lengkap' => $nama_lengkap,
                'username' => $username,
                'password' => $new_password // Kalau pakai hash : 'password' => password_hash($new_password, PASSWORD_DEFAULT) klo enggak : 'password' => $new_password 
            );
        } else {
            // Lakukan update tanpa mengubah password
            $data = array(
                'nama_lengkap' => $nama_lengkap,
                'username' => $username
            );
        }
    
        // Misalnya, update berdasarkan id user yang sedang login
        $this->db->where('id', $this->session->userdata('id'));
        $this->db->update('tb_admin', $data);
    }
    
    public function getPasswordById($user_id) {
        $this->db->select('password');
        $this->db->where('id', $user_id);
        $query = $this->db->get('tb_admin');
    
        if ($query->num_rows() == 1) {
            return $query->row()->password;
        } else {
            return FALSE;
        }
    }
    
}