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
                  <h4 class="card-title">Tables Category</h4>
                  <a href="#modal_tambah_kategori" class="btn btn-success" data-toggle="modal">
                   <span class="glyphicon glyphicon-plus"></span> + add category</a>
                   <p></p>
                  
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr class="table-primary">
                          <th>
                            Number
                          </th>
                          <th>
                            ID
                          </th>
                          <th>
                            Category
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
                                  <td>'.$dt_bar->id_kat.'</td>
                                  <td>'.$dt_bar->nama_kat.'</td>
                                  <td>
                                  
                                   <a href="#" onclick="modal_ubah_kategori('.$dt_bar->id_kat.'
                                  )" data-toggle="modal" data-target="#Ubah"
                                  class="btn btn-info btn-md">Ubah</a>

                                  
                                  <a href="'.base_url().'index.php/kategori/hapus/'.$dt_bar->id_kat.'"class="btn btn-warning btn-md" 
                                  onclick="return confirm(\'Anda yakin Ingin Menghapus Data\')">Hapus</a> </td>
                                  </tr>';
                                }
                                ?>
                      </tbody>


                      <div id="modal_tambah_kategori" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                    
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                           
                            <h4 class="modal-title">Tambah Kategori</h4>
                          </div>
                          <form action="<?php echo base_url() ?>index.php/kategori/tambah" method="post">
                              <div class="modal-body">
                                    <input type="text" class="form-control" placeholder="Nama" name="nama">
                              </div>
                              <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" name="submit" value="SIMPAN">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                          </form>
                        </div>
                    
                      </div>
                    </div>
                    <div class="modal fade" id="Ubah">
                    <div class="modal-dialog">
                    <div class="modal-content">
                    <form action="<?php echo base_url() ?>index.php/kategori/Ubah" method="post">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">
                        <span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Edit User</h4>
                      </div>
                      <div class="modal-body">
                       
                        <input type="hidden" name="ubah_id" id="ubah_id">
              
                        Nama User
                        <input type="text" name="ubah_nama" class="form-control" id="ubah_nama"><br>
                        
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-success" data>
                          <button type="button" data-dismiss="modal" class="btn btn-default">Close </button>
                                            </form>
              
                    </div>

                   

                    
                    <div id="modal_hapus_kategori" class="modal fade" role="dialog">
                      <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Konfirmasi Hapus Kategori</h4>
                          </div>
                          <form action="<?php echo base_url('index.php/kategori/hapus'); ?>" method="post">
                              <div class="modal-body">
                                    <input type="hidden" name="hapus_id"  id="hapus_id">
                                    <p>Apakah anda yakin menghapus kategori <b><span id="hapus_nama"></span></b> ?</p>
                              </div>
                              <div class="modal-footer">
                                <input type="submit" class="btn btn-danger" name="submit" value="YA">
                                <button type="button" class="btn btn-default" data-dismiss="modal">TIDAK</button>
                              </div>
                              <script type="text/javascript">
                          function modal_ubah_kategori(id_kat){
                            $.getJSON('<?php echo base_url() ?>index.php/kategori/get_data_kategori_by_id/'+id_kat, function(data){

                              $("#ubah_id").val(data.id_kat);
                              $("#ubah_nama").val(data.nama_kat);
                              
                              
                              
                         

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
</div>
                   




        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        
       
        