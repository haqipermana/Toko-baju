<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class barang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('barang_model');
		$this->load->model('kategori_model');
	}

	public function index()
	{
		if($this->session->userdata('login_status') == TRUE){

			$data['content_view'] = 'barang_view';
			$data['arr'] = $this->barang_model->get_barang();

			//get_kategori untuk dropdown tambah/edit buku
			$data['kat'] = $this->kategori_model->get_kategori();
			$this->load->view('Template', $data);

		} else {
			redirect('login/index');
		}
	}

	public function tambah()
	{	
		if($this->session->userdata('login_status') == TRUE){
			$this->form_validation->set_rules('nama_barang', 'nama_barang', 'trim|required');
			$this->form_validation->set_rules('kategori', 'nama_kat', 'trim|required');
			$this->form_validation->set_rules('jenis_barang', 'jenis_barang', 'trim|required');
			
			$this->form_validation->set_rules('stok_barang', 'stok_barang', 'trim|required|numeric');
			$this->form_validation->set_rules('harga_barang', 'harga_barang', 'trim|required|numeric');
			

			if ($this->form_validation->run() == TRUE) {
				//upload file
				$config['upload_path'] = './assets/baju/';
				$config['allowed_types'] = 'jpg|png|jfif';
				$config['max_size'] = '2000000';
				$this->load->library('upload', $config);
				if($this->upload->do_upload('gambar_barang')){
					if($this->barang_model->tambah($this->upload->data()) == TRUE)
					{
						$this->session->set_flashdata('pesan', 'Tambah baju berhasil');
						redirect('barang');
					} else {
						$this->session->set_flashdata('pesan', 'Tambah baju gagal');
						redirect('barang');
					}
				} else {
					$this->session->set_flashdata('pesan', 'Tambah baju gagal upload');
					redirect('barang');
				}
			} else {
				$this->session->set_flashdata('pesan', validation_errors());
				redirect('barang');
			}
		} else {
			redirect('login/index');
		}
	}

	public function ubah()
	{
		if($this->session->userdata('login_status') == TRUE){

			$this->form_validation->set_rules('nama_barang', 'nama_barang', 'trim|required');
			$this->form_validation->set_rules('ubah_kategori', 'id_kat', 'trim|required');
			$this->form_validation->set_rules('jenis_barang', 'jenis_barang', 'trim|required');
			
			$this->form_validation->set_rules('stok_barang', 'stok_barang', 'trim|required|numeric');
			$this->form_validation->set_rules('harga_barang', 'harga_barang', 'trim|required|numeric');

			if ($this->form_validation->run() == TRUE) {
				if($this->barang_model->ubah() == TRUE)
				{
					$this->session->set_flashdata('pesan', 'Ubah barang berhasil!!');
					redirect('barang/index');
				} else {
					$this->session->set_flashdata('pesan', 'Ubah barang gagal!!');
					redirect('barang/index');
				}
			} else {
				$this->session->set_flashdata('pesan', validation_errors());
				redirect('barang/index');
			}


		} else {
			redirect('login/index');
		}
	}

	public function hapus()
	{
		if($this->session->userdata('login_status') == TRUE){
			$id_barang = $this->uri->segment(3);

			if($this->barang_model->hapus($id_barang) == TRUE){
				$this->session->set_flashdata('pesan', 'Hapus barang Berhasil!!');
				redirect('barang/index');
			} else {
				$this->session->set_flashdata('pesan', 'Hapus barang gagal!!');
				redirect('barang/index');
			}

		} else {
			redirect('login/index');
		}
	}

	public function get_data_barang_by_id($id_barang)
	{
		if($this->session->userdata('login_status') == TRUE){
			$id_barang = $this->uri->segment(3);
		
			$data = $this->barang_model->get_data_brg_by_id($id_barang);
			echo json_encode($data); //nge-get data sebelum edit supaya tidak refresh
		  }
		  else {
			redirect('login');
		  }

}
}

/* End of file Buku.php */
/* Location: ./application/controllers/Buku.php */