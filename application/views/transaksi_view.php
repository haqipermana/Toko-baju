<div class="main-panel">
<div class="content-wrapper">
  <div class="row purchace-popup">
    <div class="col-12">
		<h3 class="page-title">Transaksi</h3>
		<?php
			$pesan = $this->session->flashdata('pesan');
			if($pesan != NULL){
				echo '
					<div class="alert alert-danger">'.$pesan.'</div>
				';
			}
		?>
           
                  

		<div class="row">
			<div class="col-md-12">
				<!-- TABLE STRIPED -->
				<div class="panel">
                <h4 class="card-title">Search Item</h4>
                    <p></p>
					<div class="panel-body">
						<form action="<?php echo base_url(); ?>index.php/transaksi/cari_barang" method="post">
							<div class="row">
								<div class="col-md-9">
									<input type="text" class="form-control input-lg" placeholder="ID Barang" name="id_barang" id="id_barang" required>
								</div>
								<div class="col-md-3">
									<input type="submit" class="btn btn-success btn-lg btn-block" name="submit" value="TAMBAH">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
            </div>
            </div>
            </div>        


		<div class="row">
			<div class="col-md-12">
				<!-- TABLE STRIPED -->
				<div class="panel">
					<div class="card-title">KERANJANG BELANJA</div>
                    <p></p>
					
              <div class="card">
                <div class="card-body">

						<form action="<?php echo base_url(); ?>index.php/transaksi/bayar" method="post">
							<table class="table table-bordered">
								<thead>
									<tr class="table-primary">
										<th>Number</th>
										<th>Name</th>
										<th>Type</th>
										<th>Category</th>
										<th>Stock</th>
										<th>Price</th>
										<th>Total</th>
										<th>Sub Total</th>
                                        <th>Action</th>
									</tr>
								</thead>
								<tbody>
								
								<?php
									$no = 1;
									if($cart_transaksi != NULL){
										foreach ($cart_transaksi as $cart) {

											echo '
												<tr>
													<input type="hidden" name="id_barang[]" value="'.$cart->id_barang.'">
													<td>'.$no.'</td>
                                                    <td>'.$cart->nama_barang.'</td>
                                                    <td>'.$cart->jenis_barang.'</td>
													<td>'.$cart->nama_kat.'</td>
													<td>'.$cart->stok_barang.'</td>
													<td>'.$cart->harga_barang.'</td>
													<td>
														<input type="number" name="jumlah[]" class="form-control" onchange="hitung_subtotal('.$cart->id.','.$cart->harga_barang.',this.value,'.$cart->id_barang.')" value="'.$cart->jumlah.'">
													</td>
													<td><span id="subtot_'.$cart->id.'">'.$cart->harga_barang*$cart->jumlah.'</span></td>
													<td>
														<a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_hapus_cart" onclick="prepare_hapus_cart('.$cart->id.')">Hapus</a>
													</td>
												</tr>
											';
											$no++;
										}
									} else {
										echo '
											<tr>
												<td colspan="8">
													Keranjang belanja kosong.
												</td>
											</tr>
										';
									}
								?>
								</tbody>
							</table>
                            <p></p>
							<?php
								if($cart_transaksi != NULL)
								{
									echo '
										<div class="row">
											<div class="col-md-4">
												<h1 style="margin:0">Rp <span id="total_belanja"></span>,-</h1>
											</div>
											<div class="col-md-5">
												<input type="text" name="nama_pembeli" placeholder="NAMA PEMBELI" class="form-control input-lg" required>
											</div>
								
											<div class="col-md-3">
												<input type="submit" name="submit" value="BAYAR" class="btn btn-lg btn-block btn-primary">
											</div>

										';
								}
							?>
						</form>

					</div>
				</div>
				<!-- END TABLE STRIPED -->
			</div>
		</div>
	</div>
</div>
</div>
</div>
</div>

<div id="modal_hapus_cart" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Konfirmasi Hapus Item Cart</h4>
      </div>
      <form action="<?php echo base_url(); ?>index.php/transaksi/hapus_item_cart" method="post">
	      <div class="modal-body">
	        	<input type="hidden" name="hapus_id"  id="hapus_id">
	        	<p>Apakah anda yakin menghapus produk ini di cart ?</p>
	      </div>
	      <div class="modal-footer">
	        <input type="submit" class="btn btn-danger" name="submit" value="YA">
	        <button type="button" class="btn btn-default" data-dismiss="modal">TIDAK</button>
	      </div>
      </form>
    </div>

  </div>
</div>
</div>

<script type="text/javascript">
	$.getJSON("<?php echo base_url(); ?>index.php/transaksi/get_total_belanja", function(data){
        $("#total_belanja").text(data.total);
    });

	function prepare_hapus_cart(id)
	{
		$("#hapus_id").val(id);
	}

	function hitung_subtotal(id,harga_barang,qty,id_barang)
	{
		var price;
		price = harga_barang*qty;
		$("#subtot_"+id).text(harga_barang);
		//update qty ke tabel cart
		$.post("<?php echo base_url(); ?>index.php/transaksi/ubah_jumlah_cart",
	    {
	    	id: id,
	    	id_barang: id_barang,
	        jumlah: qty
	    }, function(data, status){
	    	console.log(data);
	    	if(data == '0'){
	    		alert("Stok barang tidak mencukupi!");
	    	}
	    });
		//mengganti total belanja di cart
	    $.getJSON("<?php echo base_url(); ?>index.php/transaksi/get_total_belanja", function(data){
	        $("#total_belanja").text(data.total);
	    });
	}
</script>
