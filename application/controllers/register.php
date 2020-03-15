<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('register_model');
	}

	public function index()
	{
		

		
            $data['register'] = $this->register_model->get_register();
            $this->load->view('register_view');
			

		
	}

	public function tambah()
	{
			// $this->form_validation->set_rules('nama', 'nama', 'trim|required');
			// $this->form_validation->set_rules('username', 'username', 'trim|required');
			// $this->form_validation->set_rules('password', 'password', 'trim|required');

			// if ($this->form_validation->run() == TRUE) {
			// 	if($this->register_model->tambah() == TRUE)
			// 	{
			// 		$this->session->set_flashdata('notif', 'Tambah pengguna berhasil');
			// 		redirect('register/index');
			// 	} else {
			// 		$this->session->set_flashdata('notif', 'Tambah pengguna gagal');
			// 		redirect('register/index');
			// 	}
			// } else {
			// 	$this->session->set_flashdata('notif', validation_errors());
			// 	redirect('register/index');
			// }
            $nama = $this->input->post('nama');
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));

            $insert = $this->register_model->tambah(array(
                'nama' => $nama,
                'username' => $username, 
                'password' => $password 
            ));

            if ($insert) {
                $this->session->set_flashdata('notification', 'Akun berhasil dibuat');
                redirect('login', 'refresh');
            }

            else {
                $this->session->set_flashdata('notification', 'Ada yang salah');
                redirect('login', 'refresh');
            }
		} 
    
}