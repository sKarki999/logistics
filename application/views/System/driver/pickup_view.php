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
              <h1 class="">Pickup  Panel&nbsp;&nbsp;</h1>
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

          FUTURE WORK...!!!

      </div>
  </div>
    

    
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<?php $this->load->view('System/driver/Footer');?>


