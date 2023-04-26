<?php $this->load->view('System/driver/Header');?>

<div class="wrapper">
  <!-- Navbar -->
  <?php $this->load->view('System/driver/nav');?>
  <!-- /.navbar -->

  <!-- Side bar -->
  <?php $this->load->view('System/driver/sidebar');?>
  <!-- /. Side bar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content">
        <div class="card mt-3">
            <div class="card-header" style="background:#EEE8AA;">
                <h1 class="">Driver Dashboard&nbsp;&nbsp;</h1>
            </div>
        </div>

          <?php if($this->session->flashdata('msg')) {?>
              <div class="mt-3" id="sessionMessage">    
                  <div class="card-header alert alert-success">
                      <h6 class="d-inline-block card-title">
                          <?php echo $this->session->flashdata('msg');?>
                      </h6>
                  </div>
              </div>
          <?php } ?>

          <div class="row">
              <div class="col-sm-6" style="max-width: 35rem;">
                  <div class="card">
                      <div class="card-body">
                          <h3 class="card-header mb-3" style="background:#DCDCDC;">Delivery Runsheet</h3>
                              <div class="card text-white bg-flat-color-3">
                              </div>
                          <a href="<?php echo base_url();?>Driver/Runsheet" class="btn" style="background:#DCDCDC;color:black;">View</a>
                      </div>
                  </div>
              </div>
              <div class="col-sm-6" style="max-width: 35rem;">
                  <div class="card">
                      <div class="card-body">
                          <h3 class="card-header  mb-3" style="background:#DCDCDC;">Profile</h3>
                              <div class="card text-white bg-flat-color-3">
                              </div>
                          <a href="<?php echo base_url();?>Driver/Profile" class="btn" style="background:#DCDCDC;color:black;">View</a>
                      </div>
                  </div>
              </div>
          </div>  
      </div>
  </div>
  <!-- /.content-wrapper -->

  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?php $this->load->view('System/driver/Footer');?>


