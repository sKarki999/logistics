<?php $this->load->view('System/branch/Header');?>
<!-- Left Panel -->
<?php $this->load->view('System/branch/sidebar');?>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <?php $this->load->view('System/branch/nav');?>
        <!-- Content -->
        <div class="content">
            <div class="card mt-3">
                <div class="card-header" style="background:#A0DAA9;">
                    <h1 class="d-inline-block card-title">Delivery Runsheet Detail&nbsp;&nbsp;</h1>
                    <h3.5 class="d-inline-block font-weight-bold" ><?php echo $this->session->userdata('branchName');?>&nbsp;&nbsp;</h3.5>
                    <div class="col-md-2.1 float-right">
                        <a href="<?php echo base_url();?>Branch/DeliveryRunsheet" class="btn btn-sm btn-secondary"  style="margin-left: 1em;color:white;">Create</a>
                    </div>
                </div>
            </div>

            <?php if($this->session->flashdata('msg')) {?>
                <div class="alert alert-success" role="alert" id="sessionMessage">
                    <h4 class="alert-heading"><?php echo $this->session->flashdata('msg');?></h4>
                </div> 
            <?php } ?>

            <section class="content" style="background: RGB(273, 267, 240);">
            <div class="orders">
                        <div class="row">
                            <div class="col-xl">
                                <div class="card">
                                    <div class="card-body-- table-responsive">
                                            <table class="table table-striped table-bordered" id="requestTable">
                                                <thead class='font-weight-bold' style="background:#A0DAA9;" >
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Runsheet Number</th>
                                                        <th>CREATED DATE</th>
                                                        <th>CN</th>
                                                        <th>DELIVERY BOY</th>
                                                        <th>Receiver</th>
                                                        <th>Address</th>
                                                        <th>Contact</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $serial = 0;
                                                        if($runsheets != null) {
                                                        foreach($runsheets as $runsheet) {
                                                            $serial++;
                                                    ?>
                                                    <tr> 
                                                        <td><?php echo $serial; ?></td>
                                                        <td>
                                                            <?php 
                                                                echo $runsheet['runsheet_number'];
                                                            ?>
                                                        </td>
                                                        <td><?php echo $runsheet['created_date'];?></td>
                                                        <td><?php echo $runsheet['cnno'];?></td>
                                                        <td>
                                                            <?php 
                                                                echo $runsheet['name'];
                                                            ?>
                                                        </td>
                                                        <td><?php echo $runsheet['receiver'];?></td>
                                                        <td><?php echo $runsheet['address'];?></td>
                                                        <td><?php echo $runsheet['contact'];?></td>
                                                    </tr>
                                                    <?php  } 
                                                        } else {
                                                    ?>
                                                    <div class="card-body">
                                                        No runsheet at the moment...,
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
        <!-- /.content -->
        <div class="clearfix"></div>
        
    </div>
    <!-- /#right-panel -->
    <?php $this->load->view('System/branch/Footer');?>
