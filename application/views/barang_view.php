<div class="main-panel">
        <div class="content-wrapper">
          <div class="row purchace-popup">
            <div class="col-12">

            <?php if($this->session->flashdata('pesan')!=null): ?>
                                <div class= "alert alert-danger"><?= $this->session->flashdata('pesan');?></div>
                                <?php endif?>


              
          

            <div class="col-lg-12 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Item Tables</h4>
                  <a href="#tambah" class="btn btn-success" data-toggle="modal">
                   <span class="glyphicon glyphicon-plus"></span> + add item</a>
                   <p></p>
                  
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr class="table-primary">
                          <th>
                            Number
                          </th>
                          <th>
                            ID Items
                          </th>
                          <th>
                            Images
                          </th>
                          <th>
                            Name
                          </th>
                          <th>
                            Type
                          </th>
                          <th>
                            Category
                          </th>
                          <th>
                            Stock
                          </th>
                          <th>
                            Price
                          </th>
                          <th>
                            Action
                          </th>
                        </tr>
                      </thead>


                      <tbody>
                        <?php
                                $no=0;
                                
                                foreach ($arr as $dt_bar) {
                                  $no++;
                                  echo '<tr >
                                  <td>'.$no.'</td>
                                  <td>'.$dt_bar->id_barang.'</td>
                                  <td><img src="'.base_url().'assets/baju/'.$dt_bar->gambar_barang.'" width="50px" /></td>
                                  <td>'.$dt_bar->nama_barang.'</td>
                                  <td>'.$dt_bar->jenis_barang.'</td>
                                  <td>'.$dt_bar->nama_kat.'</td>

                                  
                                  <td>'.$dt_bar->stok_barang.'</td>
                                  <td>'.$dt_bar->harga_barang.'</td>
                                  <td>
                                  
                                   <a href="#" onclick="prepare_update_barang ('.$dt_bar->id_barang.'
                                  )" data-toggle="modal" data-target="#Ubah"
                                  class="btn btn-info btn-md">Ubah</a>

                                  
                                  <a href="'.base_url().'index.php/barang/hapus/'.$dt_bar->id_barang.'"class="btn btn-warning btn-md" 
                                  onclick="return confirm(\'Anda yakin Ingin Menghapus Data\')">Hapus</a> </td>
                                  </tr>';
                                }
                                ?>
                      </tbody>


                      <div class="modal fade" id="tambah">
        <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"></button>
            <h4 class="modal-title" id="myModalLabel">Add  Items</h4>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url() ?>index.php/barang/tambah" method="post" enctype="multipart/form-data">
            Name Items
            <input type="text" name="nama_barang" class="form-control"></br>
            
            Type Items
            <input type="text" name="jenis_barang" class="form-control"></br>
            Stock Items
            <input type="text" name="stok_barang" class="form-control"></br>
            Price Items
            <input type="text" name="harga_barang" class="form-control"></br>
            Category Items
            <select name="kategori" class="form-control">
					<?php
						foreach ($kat as $k) {
							echo '
								<option value="'.$k->id_kat.'">'.$k->nama_kat.'</option>
							';
						}
					?>	        		
	        	</select>
            Image Items
            <input type="file" name="gambar_barang" class="form-control"></br>
            <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
            <button type="button" data-dismiss="modal" class="btn btn-default">Close </button>
            
          </form>
                    </table>
                   
                                <div class="modal fade" id="Ubah">

      <div class="modal-dialog">
      <div class="modal-content">
      <form action="<?php echo base_url() ?>index.php/barang/ubah" method="post">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
          <span class="sr-only">Close</span></button>
          <h4 class="modal-title" id="myModalLabel">Edit Items</h4>
        </div>
        <div class="modal-body">
         
          <input type="hidden" name="ubah_id_barang" id="ubah_id_barang">

          Name Items
          <input type="text" name="nama_barang" id="nama_barang" class="form-control"></br>
         
          Type Items
          <input type="text" name="jenis_barang" id="jenis_barang" class="form-control"></br>
          Stock Items
          <input type="text" name="stok_barang" id="stok_barang" class="form-control"></br>
          Price Items
          <input type="text" name="harga_barang" id="harga_barang" class="form-control"></br>
          Category Items
          <select name="ubah_kategori" id="ubah_kategori" class="form-control">
          <?php
          foreach ($kat as $k) {
              echo '
                  <option value="'.$k->id_kat.'">'.$k->nama_kat.'</option>
              ';
          }
      ?>	        		
  </select>
  <br>
  <div id="gambar_barang"></div>
</div>
          <input type="submit" name="simpan" value="Simpan" class="btn btn-success" data>
            <button type="button" data-dismiss="modal" class="btn btn-default">Close </button>
                              </form>

      </div>
        </div>
      <script type="text/javascript">
                          function prepare_update_barang(id_barang){
                            $.getJSON('<?php echo base_url() ?>index.php/barang/get_data_barang_by_id/'+id_barang, function(data){

                              $("#ubah_id_barang").val(data.id_barang);
                              $("#gambar_barang").html('<img src="<?php echo base_url(); ?>assets/baju/' + data.gambar_barang + '" width="50px" >');
                              $("#ubah_kategori").val(data.id_kat);
                              $("#jenis_barang").val(data.jenis_barang);
                              $("#stok_barang").val(data.stok_barang);
                              $("#harga_barang").val(data.harga_barang);
                              $("#nama_barang").val(data.nama_barang);
                              
                              
                         

                            });
                          }
                          </script>

                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>




        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        
       
        