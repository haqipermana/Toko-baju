<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transaksi_model extends CI_Model {

	public function cari_barang()
	{
		$data_cart = $this->db->where('barang.id_barang', $this->input->post('id_barang'))
							  ->join('kategori', 'kategori.id_kat = barang.id_kat')
							  ->get('barang')
							  ->row();
		if($data_cart != NULL){

			//cek stok
			if($data_cart->stok_barang > 0){
				$cart_array = array(
								'cart_id'	=> $this->session->userdata('username'),
								'id_barang' 	=> $data_cart->id_barang
							);						
				$this->db->insert('cart',$cart_array);

				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	public function get_data_barang_by_id($id)
	{
		return $this->db->where('id_barang', $id)
						->get('barang')
						->row();
	}

	public function get_cart()
	{
		return $this->db->where('cart.cart_id', $this->session->userdata('username'))
					    ->join('barang', 'barang.id_barang = cart.id_barang')
					    ->join('kategori', 'kategori.id_kat = barang.id_kat')
					    ->get('cart')
					    ->result();
	}

	public function hapus_item_cart()
	{
		$this->db->where('id', $this->input->post('hapus_id'))
				 ->delete('cart');

		if($this->db->affected_rows() > 0)
		{
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function ubah_jumlah_cart()
	{
		$data = array(
				'jumlah' => $this->input->post('jumlah')
			);

		//cek stok awal dulu untuk memastikan stok lebih dari jumlah yang dibeli
		$stok_awal = $this->get_data_barang_by_id($this->input->post('id_barang'))->stok_barang;
		if($stok_awal >= $this->input->post('jumlah')){
			$this->db->where('id', $this->input->post('id'))
					 ->update('cart', $data);
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function get_total_belanja()
	{
		return $this->db->select('SUM(barang.harga_barang*cart.jumlah) as total')
						->where('cart.cart_id', $this->session->userdata('username'))
						->join('barang', 'barang.id_barang = cart.id_barang')
						->get('cart')
						->row()->total;
	}

	public function tambah_transaksi()
	{
		$data_transaksi = array(
				'id_kasir'		=> $this->session->userdata('username'),
				'nama_pembeli'	=> $this->input->post('nama_pembeli')
			);
		$this->db->insert('transaksi', $data_transaksi);
		$last_insert_id = $this->db->insert_id();
		//insert detail transksi
		for($i = 0; $i < count($this->get_cart()); $i++)
		{
			$data_detail_transaksi = array(
				'id_transaksi'	=> $last_insert_id,
				'id_barang'		=> $this->input->post('id_barang')[$i],
				'jumlah'		=> $this->input->post('jumlah')[$i]
			);

			//memasukan ke tabel detail transaksi
			$this->db->insert('detail_transaksi', $data_detail_transaksi);

			//mengurangi stok buku
			$stok_awal = $this->get_data_barang_by_id($this->input->post('id_barang')[$i])->stok_barang;
			$stok_akhir = $stok_awal-$this->input->post('jumlah')[$i];
			$stok = array('stok_barang' => $stok_akhir);
			$this->db->where('id_barang', $this->input->post('id_barang')[$i])
					 ->update('barang', $stok);

		}


		//mengkosongkan cart berdasarkan kasir yang melakukan transaksi
		$this->db->where('cart_id', $this->session->userdata('username'))
				 ->delete('cart');

		return TRUE;

	}

	public function get_riwayat_transaksi()
	{
		return $this->db->select('transaksi.id_transaksi, transaksi.nama_pembeli, transaksi.id_kasir, transaksi.tgl_beli, (SELECT SUM(detail_transaksi.jumlah*barang.harga_barang) FROM detail_transaksi JOIN barang ON barang.id_barang = detail_transaksi.id_barang WHERE id_transaksi = transaksi.id_transaksi ) as total')
						->join('detail_transaksi','detail_transaksi.id_transaksi = transaksi.id_transaksi')
						->join('barang','barang.id_barang = detail_transaksi.id_barang')
						->group_by('id_transaksi')
						->get('transaksi')
						->result();
	}

	public function get_transaksi_by_id($id)
	{
		return $this->db->select('barang.nama_barang, kategori.nama_kat, barang.jenis_barang, barang.harga_barang, detail_transaksi.jumlah')
						->where('id_transaksi', $id)
						->join('barang','barang.id_barang = detail_transaksi.id_barang')
						->join('kategori','kategori.id_kat = barang.id_kat')
						->get('detail_transaksi')
						->result();
	}

}

/* End of file Transaksi_model.php */
/* Location: ./application/models/Transaksi_model.php */