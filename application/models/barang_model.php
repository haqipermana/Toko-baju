<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class barang_model extends CI_Model {

	public function get_barang(){
		return $this->db->join('kategori','kategori.id_kat = barang.id_kat')
						->get('barang')
						->result();
	}

	public function get_kategori(){
		return $this->db->get('kategori')
						->result();
	}

	public function get_data_brg_by_id($id)
	{
		return $this->db->where('id_barang', $id)
						->get('barang')
						->row();
	}

	public function tambah($gambar_barang)
	{
		$data = array(
				'id_barang' 	=> $this->input->post('id_barang'),
				'nama_barang' 		=> $this->input->post('nama_barang'),
				'jenis_barang'			=> $this->input->post('jenis_barang'),
				'id_kat'			=> $this->input->post('kategori'),
				
				'stok_barang'		=> $this->input->post('stok_barang'),
				'harga_barang'			=> $this->input->post('harga_barang'),
				'gambar_barang'			=> $gambar_barang['file_name']
			);

		$this->db->insert('barang', $data);

		if($this->db->affected_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function ubah()
	{
		$data = array(
            
			'nama_barang' 		=> $this->input->post('nama_barang'),
			'jenis_barang'			=> $this->input->post('jenis_barang'),
			'id_kat'			=> $this->input->post('ubah_kategori'),
			
			'stok_barang'		=> $this->input->post('stok_barang'),
			'harga_barang'			=> $this->input->post('harga_barang')
		
			);

		$this->db->where('id_barang', $this->input->post('ubah_id_barang'))
				 ->update('barang', $data);
		
		if($this->db->affected_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function hapus($id)
	{
		$this->db->where('id_barang', $id)
				 ->delete('barang');

		if($this->db->affected_rows() > 0){
			return TRUE;
		} else {
			return FALSE;
		}
	}
	

}

/* End of file Buku_model.php */
/* Location: ./application/models/Buku_model.php */