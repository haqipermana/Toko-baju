<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class transaksi extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('transaksi_model');
	}

	public function index()
	{
		if($this->session->userdata('login_status') == TRUE){

			$data['content_view'] = 'transaksi_view';

			//get_cart_content
			$data['cart_transaksi'] = $this->transaksi_model->get_cart();
			$this->load->view('Template', $data);

		} else {
			redirect('login/index');
		}
	}

	public function cari_barang()
	{
		if($this->session->userdata('login_status') == TRUE){

			if($this->transaksi_model->cari_barang() == TRUE)
			{
				redirect('transaksi/index');
			} else {
				$this->session->set_flashdata('pesan', 'Data barang tidak ditemukan atau stok sudah habis!');
				redirect('transaksi/index');
			}

		} else {
			redirect('login/index');
		}
	}

	public function hapus_item_cart()
	{
		if($this->session->userdata('login_status') == TRUE){

			if($this->transaksi_model->hapus_item_cart() == TRUE)
			{
				redirect('transaksi/index');
			} else {
				$this->session->set_flashdata('pesan', 'Hapus item cart gagal');
				redirect('transaksi/index');
			}

		} else {
			redirect('login/index');
		}
	}

	public function ubah_jumlah_cart()
	{
		if($this->session->userdata('login_status') == TRUE){

			if($this->transaksi_model->ubah_jumlah_cart() == TRUE){
				echo json_encode(1);
			} else {
				echo json_encode(0);
			}
		} else {
			redirect('login/index');
		}
	}

	public function get_total_belanja()
	{
		if($this->session->userdata('login_status') == TRUE){

			$total_belanja['total'] = $this->transaksi_model->get_total_belanja();
			echo json_encode($total_belanja);

		} else {
			redirect('login/index');
		}
	}

	public function bayar()
	{
		if($this->session->userdata('login_status') == TRUE){

			//insert ke tabel transaksi dulu
			if($this->transaksi_model->tambah_transaksi() == TRUE)
			{
				$this->session->set_flashdata('pesan', 'Proses pembelian berhasil');
				redirect('transaksi/index');

			} else {
				$this->session->set_flashdata('pesan', 'Proses pembelian gagal');
				redirect('transaksi/index');
			}

		} else {
			redirect('login/index');
		}
	}

	public function riwayat()
	{
		if($this->session->userdata('login_status') == TRUE){
			$data['content_view'] = 'riwayat_transaksi_view';
			$data['riwayat'] = $this->transaksi_model->get_riwayat_transaksi();

			$this->load->view('template', $data);
		} else {
			redirect('login/index');
		}
	}

	public function get_detil_transaksi_by_id($id)
	{
		if($this->session->userdata('login_status') == TRUE){
			$detil_transaksi = $this->transaksi_model->get_transaksi_by_id($id);
			$data['show_detil'] = "";
			$total = 0;
			$no = 1;
			$data['show_detil'] .= '<table class="table table-bordered">
									<tr class="table-primary">
                                    <th>Number</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>Total</th>
										<th>Sub Total</th>
									</tr>';

			foreach ($detil_transaksi as $d) {
				$data['show_detil'] .= '<tr>
									<td>'.$no.'</td>
									<td>'.$d->nama_barang.'</td>
									<td>'.$d->nama_kat.'</td>
									<td>'.$d->jenis_barang.'</td>
									<td>'.$d->harga_barang.'</td>
                                    <td>'.$d->jumlah.'</td>
									<td>'.$d->harga_barang*$d->jumlah.'</td>
								</tr>';

				$no++;
				$total += $d->harga_barang*$d->jumlah;
			}
			$data['show_detil'] .= '</table>';
			$data['show_detil'] .= '<p></p><h2><p class="text-right">Total Belanja</p></h2>
									<h2><p class="text-right">Rp '.$total.',- </p></h2>';
			echo json_encode($data);
		} else {
			redirect('login/index');
		}
	}

	public function cetak_nota()
	{
		$this->load->view('cetak_nota_view');
	}

}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */