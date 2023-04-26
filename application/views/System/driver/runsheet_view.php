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
                <div class="col-md-2.1 float-right">
                    <a href="<?php echo base_url();?>Driver/Dashboard" class="btn btn-sm btn-secondary" style="color:white;">Home</a>
                    <a href="<?php echo base_url();?>Driver/Runsheet/masterRecord" class="btn btn-sm btn-secondary"  style="margin-left: 1em;color:white;">Master Record</a>
                </div>
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
          <?php if($this->session->flashdata('error')) {?>
              <div class="mt-3" id="sessionMessage">    
                  <div class="card-header alert alert-danger">
                      <h6 class="d-inline-block card-title">
                          <?php echo $this->session->flashdata('error');?>
                      </h6>
                  </div>
              </div>
          <?php } ?>

            
          <section class="content" style="">
                <form method="post" action="<?php echo base_url();?>Driver/Runsheet/changeStatus">
                    <button type="submit" class="btn btn-secondary mb-3" id="updateStatus">Update Status</button>
                    <div class="orders">
                            <div class="row">
                                <div class="col-xl">
                                    <div class="card">
                                        <div class="card-body-- table-responsive">
                                                <table class="table table-striped table-bordered" id="requestTable">
                                                    <thead class='font-weight-bold' style="background:#EEE8AA;" >
                                                        <tr>
                                                            <th style="width: 35px;"><input type="checkbox" id="checkall" /></th>
                                                            <th>CNNO</th>
                                                            <th>Receiver</th>
                                                            <th>Address</th>
                                                            <th>Contact</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                            if($runsheets != null) {
                                                            $i = 0;
                                                            foreach($runsheets as $runsheet) {
                                                        ?>
                                                        <tr>
                                                            <td style="width: 35px;"><nobr><input type="checkbox" name="cnn[]" value="<?php echo $runsheet['cnno']; ?>" class="checkboxcnn" />
                                                                
                                                            </td>
                                                            <!-- <td><input type="text" name="cnno[]" value="<?php echo $runsheet['cnno'];?>" readonly></td>
                                                            <td><input type="text" name="receiver[]" value="<?php echo $runsheet['receiver'];?>" readonly></td>
                                                            <td><input type="text" name="address[]" value="<?php echo $runsheet['address'];?>" readonly></td>
                                                            <td><input type="text" name="contact[]" value="<?php echo $runsheet['contact'];?>" readonly></td>
                                                            <td><input type="text" name="status[]" value="<?php echo $runsheet['status'];?>" readonly></td> -->
                                                            <td><?php echo $runsheet['cnno'];?></td>
                                                            <td><?php echo $runsheet['receiver'];?></td>
                                                            <td><?php echo $runsheet['address'];?></td>
                                                            <td><?php echo $runsheet['contact'];?></td>
                                                            <td><?php echo $runsheet['status'];?></td>
                                                        </tr>
                                                        <?php  $i = $i + 1; } 
                                                            } else {
                                                        ?>
                                                        <div class="card-body">
                                                            Relax. No Orders at the moment.
                                                            <script> 
                                                                $("#requestTable").hide();
                                                                $("#updateStatus").hide();
                                                            </script>
                                                        </div>
                                                        <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                        </div>
                                    </div> <!-- /.card -->
                                </div>  <!-- /.col-lg-8 -->
                            </div>
                        </div>
                </form>
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

    $("#checkall").change(function(){
        var check = $(this).is(':checked');
        if(check){
        $(".checkboxcnn").each(function(){
            $(this).prop("checked",true);
            });  
        }else{
            $(".checkboxcnn").each(function(){
            $(this).prop("checked",false);
            });
        }
    });
</script>
