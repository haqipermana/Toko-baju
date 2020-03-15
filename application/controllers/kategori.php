<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kategori extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('kategori_model');
		$this->load->model('barang_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		if($this->session->userdata('login_status') == TRUE){

			$data['content_view'] = 'kategori_view';
			$data['arr'] = $this->barang_model->get_barang();
			$data['arr'] = $this->kategori_model->get_kategori();
			$this->load->view('Template', $data);

		
			

		} else { 
			redirect('login/index');
		}
	}

	public function tambah()
	{
		if($this->session->userdata('login_status') == TRUE){

			$this->form_validation->set_rules('nama', 'Nama Kategori', 'trim|required');

			if ($this->form_validation->run() == TRUE) {
				if($this->kategori_model->tambah() == TRUE)
				{
					$this->session->set_flashdata('pesan', 'Tambah kategori berhasil');
					redirect('kategori/index');
				} else {
					$this->session->set_flashdata('pesan', 'Tambah kategori gagal');
					redirect('kategori/index');
				}
			} else {
				$this->session->set_flashdata('pesan', validation_errors());
				redirect('kategori/index');
			}


		} else {
			redirect('login/index');
		}
	}

	

	public function hapus()
	{
		if($this->session->userdata('login_status') == TRUE){
            $id_kat = $this->uri->segment(3);

            if($this->kategori_model->hapus($id_kat)){
                $this->session->set_flashdata('pesan','Hapus Kategori berhasil!');
                
                redirect('kategori');
                
            }
            else {
                $this->session->set_flashdata('pesan','Hapus Kategori Gagal!');
                redirect('kategori');
            }
            
        }
	}

	public function get_data_kategori_by_id()
	{
		if($this->session->userdata('login_status') == TRUE){
			$id_kat = $this->uri->segment(3);

			$data = $this->kategori_model->get_data_kategori_by_id($id_kat);
			echo json_encode($data);      
		}
		else{
			redirect('Login');
		}
	}
	public function Ubah(){
		
			if ($this->session->userdata('login_status') == TRUE) {
				//validasi form
				
				$this->form_validation->set_rules('ubah_nama','nama_kat','trim|required');
				
		
				if ($this->form_validation->run() == TRUE) {
					
					if ($this->kategori_model->ubah() == TRUE) {
						
						$this->session->set_flashdata('pesan','Ubah Kategori berhasil!!!');
						redirect('kategori');
					} else {
						$this->session->set_flashdata('pesan','Ubah Kategori Gagal!!!');
						redirect('kategori');
		
		
					}
				} else {
					$this->session->set_flashdata('pesan', validation_errors());
					redirect('kategori');
				}
			} else {
				redirect('login');
			}
		}

}

/* End of file kategori.php */
/* Location: ./application/controllers/kategori.php */



