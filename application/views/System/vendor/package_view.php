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
                    <h1 class="d-inline-block card-title">Order Panel&nbsp;&nbsp;</h1>
                    <h3.5 class="d-inline-block font-weight-bold" ><?php echo $this->session->userdata('customer_name');?>&nbsp;&nbsp;</h3.5>
                    <div class="col-md-2.1 float-right">
                        <a href="<?php echo base_url();?>Vendor/Dashboard" class="btn btn-sm btn-secondary" style="color:white;">Home</a>
                        <a href="<?php echo base_url();?>Vendor/Order" class="btn btn-sm btn-secondary"  style="margin-left: 1em;color:white;">Master Record</a>
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
            
            <section class="content" style="background:#F0F8FF;">
            <ul class="nav nav-pills nav-fill">
                    <li class="nav-item">
                        <a href="<?php echo base_url();?>Vendor/Order" class="btn btn-sm" style="background: #DCDCDC;color:black;font-size:15px;">
                            ALL <span class="badge" style="background: #F08080;"><?php echo $totalInvoices;?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url();?>Vendor/Order/countPackage/Pending" class="btn btn-sm" style="background: #DCDCDC;color:black;font-size:15px;">
                            PENDING<span class="badge" style="background: black;"><?php echo $countPending;?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url();?>Vendor/Order/countPackage/Reroute" class="btn btn-sm" style="background: #DCDCDC;color:black;font-size:15px;">
                            REROUTE <span class="badge" style="background: darkblue;"><?php echo $countReroute;?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url();?>Vendor/Order/countPackage/Delivered" class="btn btn-sm" style="background: #DCDCDC;color:black;font-size:15px;">
                            DELIVERED <span class="badge" style="background: green;"><?php echo $countDelivered;?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url();?>Vendor/Order/countPackage/Cancelled" class="btn btn-sm" style="background: #DCDCDC;color:black;font-size:15px;">
                            CANCELLED <span class="badge" style="background: darkred;"><?php echo $countCancelled;?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url();?>Vendor/Order/countPackage/Returned" class="btn btn-sm" style="background: #DCDCDC;color:black;font-size:15px;">
                            RETURNED <span class="badge" style="background: orange;"><?php echo $countReturned;?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url();?>Vendor/Order/countPackage/Failed" class="btn btn-sm" style="background: #DCDCDC;color:black;font-size:15px;">
                            FAILED DELIVERY <span class="badge" style="background: red;"><?php echo $countFailed;?></span>
                        </a>
                    </li>
                </ul>
                <br><hr>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background:#696969;color:white;">
                        <li class="breadcrumb-item">Showing '<?php echo $status?>' Package Details</li>
                    </ol>
                </nav>
                <br>
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-9">
                            <div class="card">
                                <div class="card-body-- table-responsive">
                                        <table class="table table-striped table-bordered" id="orderTable">
                                            <thead class='font-weight-bold' style="background:#D8BFD8;" >
                                                <tr>
                                                    <th>CN.No</th>
                                                    <th>BOOKED</th>
                                                    <th>RECEIVER</th>
                                                    <th>DESTINATION</th>
                                                    <th>NUMBER</th>
                                                    <th>QTY</th>
                                                    <th>TOTAL</th>
                                                    <th>MODE</th>
                                                    <th>STATUS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    if($orders != 'false') {
                                                    foreach($orders as $order) {
                                                ?>
                                                <tr> 
                                                    <td><?php echo $order['bill_number'];?></td>
                                                    <td><?php echo $order['booking_date'];?></td>
                                                    <td><?php echo $order['one_time_receiver'];?></td>
                                                    <td><?php echo $order['dropOff_address'];?></td>
                                                    <td><?php echo $order['receiver_number'];?></td>
                                                    <td><?php echo $order['qty'];?></td>
                                                    <td><?php echo $order['total'];?></td>
                                                    <td><?php echo $order['payment_mode'];?></td>
                                                    <td><?php echo $order['delivery_status'];?></td>
                                                </tr>
                                                <?php  } 
                                                    } else {
                                                ?>
                                                <div class="card-body">
                                                    No Orders at the moment.
                                                    <script> $("#orderTable").hide();</script>
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

        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
</div>
<!-- /#right-panel -->
<?php $this->load->view('System/vendor/Footer');?>