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
              <h1 class="">Driver Profile&nbsp;&nbsp;</h1>
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

          <div class="card" style="width: 23rem;">
            <img class="card-img-top" src="<?php echo base_url(); ?>assets/img/driver_avatar.png" 
              style="border: 5px solid white;display:block;max-width:100%;height:auto;" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">Driver Name: <?php echo $this->session->userdata('name');?></h5>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">Address: <?php echo $this->session->userdata('address');?></li>
              <li class="list-group-item">Contact: <?php echo $this->session->userdata('contact');?></li>
              <li class="list-group-item">Email: <?php echo $this->session->userdata('email');?></li>
              <li class="list-group-item">Current Branch: <?php echo $this->session->userdata('branchName');?></li>
            </ul>
            <!-- <div class="card-body">
              <a href="#" class="card-link btn btn-secondary">Update Profile</a>
            </div> -->
          </div>
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


