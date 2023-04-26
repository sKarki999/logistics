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
                    <a href="<?php echo base_url();?>Driver/Runsheet" class="btn btn-sm btn-secondary"  style="margin-left: 1em;color:white;">Runsheet View</a>
                </div>
          </div>
        </div>
            
          <section class="content" style="">
                    <div class="orders">
                            <div class="row">
                                <div class="col-xl">
                                    <div class="card">
                                        <div class="card-body-- table-responsive">
                                                <table class="table table-striped table-bordered" id="requestTable">
                                                    <thead class='font-weight-bold' style="background:#EEE8AA;" >
                                                        <tr>
                                                            <th>CNNO</th>
                                                            <th>Receiver</th>
                                                            <th>Address</th>
                                                            <th>Contact</th>
                                                            <th>Status</th>
                                                            <th>Delivered Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                            if($details != null) {
                                                            $i = 0;
                                                            foreach($details as $detail) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $detail['cnno'];?></td>
                                                            <td><?php echo $detail['receiver'];?></td>
                                                            <td><?php echo $detail['address'];?></td>
                                                            <td><?php echo $detail['contact'];?></td>
                                                            <td><?php echo $detail['status'];?></td>
                                                            <td><?php echo $detail['delivered_date'];?></td>
                                                        </tr>
                                                        <?php  $i = $i + 1; } 
                                                            } else {
                                                        ?>
                                                        <div class="card-body">
                                                            Relax. No Orders at the moment.
                                                            <script> $("#requestTable").hide();</script>
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
