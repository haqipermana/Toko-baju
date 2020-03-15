<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendorsiconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendorscss/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendorscss/vendor.bundle.addons.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/css/style.css">
  <!-- endinject -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>/assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <h2 class="text-center mb-4">Register</h2>
            <div class="auto-form-wrapper">
            <?php
			$notif = $this->session->flashdata('notif');
			if($notif != NULL){
				echo '
					<div class="alert alert-danger">'.$notif.'</div>
				';
			}
		?>
              <form action="<?php echo base_url(); ?>index.php/register/tambah" method="post">
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Nama" name="nama">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Username" name="username">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <div class="input-group-append">
                      <span class="input-group-text">
                        <i class="mdi mdi-check-circle-outline"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" value="Simpan" class="btn btn-primary submit-btn btn-block">Register</button>
                </div>
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Already have and account ?</span>
                  <a href="<?php echo base_url(); ?>index.php/Login" class="text-black text-small">Login</a>
                </div>
                
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  
  <!-- container-scroller -->
  <!-- plugins:js -->
   <script src="<?php echo base_url(); ?>/assets/vendors/js/vendor.bundle.base.js"></script>
   <script src="<?php echo base_url(); ?>/assets/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
   <script src="<?php echo base_url(); ?>/assets/off-canvas.js"></script>
   <script src="<?php echo base_url(); ?>/assets/misc.js"></script>
  <!-- endinject -->
</body>

</html>