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
              <h1 class="">Runsheet Panel&nbsp;&nbsp;</h1>
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

          
          <section class="content" style="background: RGB(273, 267, 240);">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header font-weight-bold" style="background:#EEE8AA;">
                        CN NO: #<?php echo $cnno;?>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo base_url();?>Driver/Order/updateStatus/<?php echo $cnno;?>">  
                                <!-- <div class="form-group mb-4">
                                    <label for=""><h5 class="font-weight-bold">POD NO:</h5></label>
                                        <input type="text" class="form-control" name="pod_number" readon/>
                                </div>                                           -->
                                <div class="form-group mb-4">
                                    <label for=""><h5 class="font-weight-bold">Date of Delivery</h5></label>
                                        <input type="text" class="form-control" name="delivered_date" id="date" required/>
                                </div>
                                <div class="form-group">
                                    <label for=""><h5 class="font-weight-bold">Status</h5></label>
                                    <select class="form-control" name="status" id ="status" required>
                                        <option value="">Select Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Delivered">Delivered</option>
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label for=""><h5 class="font-weight-bold">Handed To:</h5></label>
                                        <input type="text" class="form-control" name="handed_to" />
                                </div>
                                <div class="form-group mb-4">
                                    <label for=""><h5 class="font-weight-bold">Mode</h5></label>
                                    <select class="form-control" name="mode" id ="mode">
                                        <option value="">Select mode of Proof</option>
                                        <option value="Signature">Signature</option>
                                        <option value="Stamp">Stamp</option>
                                    </select>
                                </div>                    
                                <hr/>
                                <div class="form-group">
                                    <input type="submit" class="btn" style="background:#EEE8AA;" value="Update" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

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


<script>
    $("#date").datepicker({ dateFormat: 'yy-mm-dd' });
</script>