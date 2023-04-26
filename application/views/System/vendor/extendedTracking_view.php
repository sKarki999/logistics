<?php $this->load->view('System/vendor/Header');?>
<!-- Left Panel -->
<?php $this->load->view('System/vendor/sidebar');?>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <?php $this->load->view('System/vendor/nav');?>
        <!-- Content -->
        <div class="content">
            <div class="card mt-3">
                <div class="card-header" style="background:#D8BFD8;">
                    <h1 class="d-inline-block card-title">Track Order&nbsp;&nbsp;</h1>
                    <h3.5 class="d-inline-block font-weight-bold" ><?php echo $this->session->userdata('customer_name');?>&nbsp;&nbsp;</h3.5>
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


            <section class="content" style="background: #F0F8FF;">
                
                <form method="post" id="podForm" action="<?php echo base_url(); ?>Vendor/Tracking/trackingResult">
                    <div class="form-row mb-5">
                        <div class="col-md-6 mb-3">
                            <!-- <label for="">Tracking Report</label> -->
                            <div class="input-group-prepend">
                                <input type="text" class="form-control" id="cnn" name = 'cnno' placeholder="Enter your CN number">
                                <button type="submit" name="search" class="btn btn-sm btn-primary" id="search"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- <hr style="border: 1px solid black;" /> -->
                </form>

                <?php 
                    if($cnnInfo) {

                    if($cnnInfo['delivery_status'] != 'Reroute') {
                ?>
                
                <div class="panel-heading">
                    <strong>Tracking Result for Consignment Number : #<?php echo $cnno; ?></strong>
                </div>
                <br>

                <div class="card-deck">
                    <div class="card">
                        <div class="card-header font-weight-bold">Schedule Delivery</div>
                        <div class="card-body text-dark">
                            <h5 class="card-title"><?php echo $cnnInfo['booking_date'];?></h5> <br>
                            <h5 class="card-title"><?php echo $cnnInfo['branch_name'];?></h5>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header font-weight-bold">Last Location</div>
                        <div class="card-body text-dark">
                            <h5 class="card-title"><?php echo $cnnInfo['dropOff_address'];?></h5>
                            <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header font-weight-bold">Current Status</div>
                        <div class="card-body text-dark">
                            <h5 class="card-title">
                                <?php
                                    if($deliveryDate){
                                        echo "<a href='' class='btn btn-info' style='background:green;'><b>DELIVERED</b></a>"; 
                                    }else{
                                        echo "<a href='' class='btn btn-info' style='background:#dc143c;'><b><i class='fa fa-truck fa-lg'></i>&nbsp;&nbsp;IN TRANSIT</b></a>";    
                                    }
                                ?>
                            </h5>
                            <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                        </div>
                    </div>
                </div>
                <br>
                <div class="card-deck">
                    <div class="card">
                        <div class="card-header font-weight-bold">Sender Information</div>
                        <div class="card-body text-dark">
                            <h5 class="card-title"><span class="font-weight-bold">Name:&nbsp;&nbsp;</span>
                            <?php
                                if($cnnInfo['one_time_customer']) {
                                    echo $cnnInfo['one_time_customer'];
                                } else {
                                    $customerName = $this->InvoiceModel->getColHead('tbl_customer','customer_id',$cnnInfo['customer_id'],'customer_name');
                                    echo $customerName['customer_name'];
                                }
                            ?>
                            </h5>
                            <h5 class="card-title"><span class="font-weight-bold">Address:&nbsp;&nbsp;</span><?php echo $cnnInfo['customer_address'];?></h5>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header font-weight-bold">Receiver Information</div>
                        <div class="card-body text-dark">
                            <h5 class="card-title"><span class="font-weight-bold">Name:&nbsp;&nbsp;</span><?php echo $cnnInfo['one_time_receiver'];?></h5>
                            <h5 class="card-title"><span class="font-weight-bold">Address:&nbsp;&nbsp;</span><?php echo $cnnInfo['dropOff_address'];?></h5>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header font-weight-bold">Additional Information</div>
                        <div class="card-body text-dark">
                            <h5 class="card-title"><span class="font-weight-bold">Payment Mode:&nbsp;&nbsp;</span><?php echo $cnnInfo['payment_mode'];?></h5>
                            <h5 class="card-title"><span class="font-weight-bold">Weight:&nbsp;&nbsp;</span><?php echo $cnnInfo['weight'];?></h5>
                            <h5 class="card-title"><span class="font-weight-bold">Quantity:&nbsp;&nbsp;</span><?php echo $cnnInfo['qty'];?></h5>
                        </div>
                    </div>
                </div>
                <br>
                <hr>
                <b>Travel History</b><br/><br>
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Activity</th>
                            <th scope="col">Date</th>
                            <th scope="col">Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Booked</td>
                            <td><?php echo $cnnInfo['booking_date'];?></td>
                            <td><?php echo $cnnInfo['branch_name'] . ', ' . $cnnInfo['branch_address'];?></td>
                        </tr>
                        <tr>
                            <?php 
                                if($dispatched != null) {
                            ?>
                            <td>Dispatched</td>
                            <td><?php echo $dispatched['0']['booked_on'];?></td>
                            <td><?php echo $dispatched['0']['branch_name'] . ', ' . $dispatched['0']['branch_address'];?></td>
                            <?php 
                                }
                            ?>
                        </tr>
                        <tr>
                            <?php 
                                if($arrived != null) {
                            ?>
                            <td>Arrived</td>
                            <td><?php echo $arrived['0']['manifest_received_date'];?></td>
                            <td><?php echo $arrived['0']['branch_name'] . ', ' . $arrived['0']['branch_address'];?></td>
                            <?php 
                                }
                            ?>
                        </tr>
                        <tr>
                            <?php 
                                if($deliveryDate != null) {
                            ?>
                            <td>Delivered</td>
                            <td><?php echo $deliveryDate['pod_created_date'];?></td>
                            <td><?php echo $deliveryDate['address'];?></td>
                            <?php 
                                }
                            ?>
                        </tr>
                    </tbody>
                </table>
                
                <?php } else { ?>
                        <div class="alert alert-danger" role="alert">
                        This CN Number has already been routed to another address!
                        Please track for the Referenced CNN: <span class="font-weight-bold"><?php echo '#' . $cnnInfo['refno'];?></span>
                      </div>
                    <?php 
                        }
                    } else {
                        echo '<b style="margin-left: 15px;color:red;">Sorry , Not Found !!!</b>';
                    }
                ?>
            </section>
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
</div>
<!-- /#right-panel -->
<?php $this->load->view('System/vendor/Footer');?>

<script>

    $('#search').click(function(){
        var cnno = $('#cnn').val();
        // alert(cnno);
        if(!cnno) {
            alert('ENTER CN NUMBER FOR TRACKING');
            return false;
        }
    });

</script>