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
                        <a href="" class="btn btn-sm" style="background: #DCDCDC;color:black;font-size:15px;">
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
                <hr/>
                <br/>
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body-- table-responsive">
                                        <table class="table table-striped table-bordered" id="orderTable">
                                            <thead class='font-weight-bold' style="background:#D8BFD8;" >
                                                <tr>
                                                    <th>CNN</th>
                                                    <th>BOOKED</th>
                                                    <th>RECEIVER</th>
                                                    <th>DESTINATION</th>
                                                    <th>Contact</th>
                                                    <th>TOTAL</th>
                                                    <th>MODE</th>
                                                    <th>STATUS</th>
                                                    <th>Date/Time</th>
                                                    <th>Remarks</th>
                                                    <th>Package Condition</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    if($orders != null) {
                                                    foreach($orders as $order) {
                                                ?>
                                                <tr> 
                                                    <td><?php echo $order['bill_number'];?></td>
                                                    <td><?php echo $order['booking_date'];?></td>
                                                    <td><?php echo $order['one_time_receiver'];?></td>
                                                    <td><?php echo $order['dropOff_address'];?></td>
                                                    <td><?php echo $order['receiver_number'];?></td>
                                                    <td><?php echo $order['total'];?></td>
                                                    <td><?php echo $order['payment_mode'];?></td>
                                                    <td><?php 
                                                            $status =  $order['delivery_status'];
                                                            if($status == 'Reroute') {
                                                                echo $status. "| <span class = ". "'badge' style = ". "'background: darkblue'>". 'Ref: ' . $order['refno']; 
                                                                // echo $status. '| Ref: ' . $order['refno'];
                                                            } elseif($status == 'Returned') {
                                                                echo "<span style='color:orange;'>" . $status. "</span>";
                                                            } elseif($status == 'Delivered') {
                                                                echo "<span style='color:green;'>" . $status. "</span>";
                                                            }
                                                            elseif($status == 'Cancelled') {
                                                                echo "<span style='color:darkred;'>" . $status. "</span>";
                                                            }elseif($status == 'Failed') {
                                                                echo "<span style='color:red;'>" . $status. "</span>";
                                                            }elseif($status == 'Pending') {
                                                                echo "<span style='color:black;'>" . $status. "</span>";
                                                            }
                                                    
                                                        ?>
                                                    </td>

                                                    <td><?php
                                                            if($order['delivery_status'] == "Delivered" && $order['status_updated_date'] != null) {
                                                                echo $order['status_updated_date'];        
                                                            } else {
                                                                echo '----';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?php
                                                            if($order['package_remark'] != null) {
                                                                echo $order['package_remark'];        
                                                            } else {
                                                                echo '----';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?php
                                                            if($order['package_condition'] != null && $order['delivery_status'] != "Delivered") {
                                                                echo $order['package_condition'];        
                                                            } else {
                                                                echo '----';
                                                            }
                                                        ?>
                                                    </td>
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
        </div>
    </div>
    <!-- /#right-panel -->
    <?php $this->load->view('System/vendor/Footer');?>