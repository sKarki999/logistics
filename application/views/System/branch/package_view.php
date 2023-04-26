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
                    <h1 class="d-inline-block card-title">Booking Panel&nbsp;&nbsp;</h1>
                    <h3.5 class="d-inline-block font-weight-bold" ><?php echo $this->session->userdata('branchName');?>&nbsp;&nbsp;</h3.5>
                    <div class="col-md-2.1 float-right">
                        <a href="<?php echo base_url();?>Branch/Dashboard" class="btn btn-sm btn-secondary">Home</a>
                        <a href="<?php echo base_url();?>Branch/Booking" class="btn btn-sm btn-secondary"  style="margin-left: 1em">Master Record</a>
                        <a href="<?php echo base_url();?>Branch/Booking/newBooking" class="btn btn-sm btn-secondary" style="margin-left: 1em">New Booking</a>
                    </div>
                </div>
            </div>

            <?php if($this->session->flashdata('del_msg')) {?>
                <div class="alert alert-danger" role="alert" id="sessionMessage">
                    <h4 class="alert-heading"><?php echo $this->session->flashdata('del_msg');?></h4>
                </div> 
            <?php } ?>
            <?php if($this->session->flashdata('msg')) {?>
                <div class="alert alert-success" role="alert" id="sessionMessage">
                    <h4 class="alert-heading"><?php echo $this->session->flashdata('msg');?></h4>
                </div> 
            <?php } ?>

            <section class="content" style="background: RGB(273, 267, 240);">
                <ul class="nav nav-pills nav-fill">
                    <li class="nav-item">
                        <a href="<?php echo base_url();?>Branch/Booking" class="btn btn-sm" style="background: #efe6cd;color:black;font-size:15px;">
                            ALL <span class="badge" style="background: #F08080;"><?php echo $totalInvoices;?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url();?>Branch/Booking/countPackage/Pending" class="btn btn-sm" style="background: #efe6cd;color:black;font-size:15px;">
                            PENDING<span class="badge" style="background: black;"><?php echo $countPending;?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url();?>Branch/Booking/countPackage/Reroute" class="btn btn-sm" style="background: #efe6cd;color:black;font-size:15px;">
                            REROUTE <span class="badge" style="background: darkblue;"><?php echo $countReroute;?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url();?>Branch/Booking/countPackage/Delivered" class="btn btn-sm" style="background: #efe6cd;color:black;font-size:15px;">
                            DELIVERED <span class="badge" style="background: green;"><?php echo $countDelivered;?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url();?>Branch/Booking/countPackage/Cancelled" class="btn btn-sm" style="background: #efe6cd;color:black;font-size:15px;">
                            CANCELLED <span class="badge" style="background: darkred;"><?php echo $countCancelled;?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url();?>Branch/Booking/countPackage/Returned" class="btn btn-sm" style="background: #efe6cd;color:black;font-size:15px;">
                            RETURNED <span class="badge" style="background: orange;"><?php echo $countReturned;?></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?php echo base_url();?>Branch/Booking/countPackage/Failed" class="btn btn-sm" style="background: #efe6cd;color:black;font-size:15px;">
                            FAILED DELIVERY <span class="badge" style="background: red;"><?php echo $countFailed;?></span>
                        </a>
                    </li>
                </ul>
                <br><hr>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background:#696969;color:white;">
                        <li class="breadcrumb-item">Showing '<?php echo $status?>' Parcel.</li>
                    </ol>
                </nav>
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body-- table-responsive">
                                        <table class="table table-striped table-bordered" id="invoiceTable">
                                            <thead class='font-weight-bold' style="background:#A0DAA9;" >
                                                <tr>
                                                    <th>CN.No</th>
                                                    <th>BOOKED</th>
                                                    <th>SENDER</th>
                                                    <th>Receiver</th>
                                                    <th>Category</th>
                                                    <th>DROP OFF ADDRESS</th>
                                                    <th>NUMBER</th>
                                                    <th>STATUS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    if($result != 'false') {
                                                    
                                                    foreach($result as $booking) {
                                                ?>
                                                <tr> 
                                                    <td><?php echo $booking['bill_number'];?></td>
                                                    <td><?php echo $booking['booking_date'];?></td>
                                                    <td><?php echo $booking['one_time_customer'];?></td>
                                                    <td><?php echo $booking['one_time_receiver'];?></td>
                                                    <td><?php echo $booking['category'];?></td>
                                                    <td><?php echo $booking['dropOff_address'];?></td>
                                                    <td><?php echo $booking['receiver_number'];?></td>
                                                    <td>
                                                        <?php 
                                                            if($booking['delivery_status'] == 'Pending') {
                                                                echo "<span class = ". "'badge' style = ". "'background: black'>";
                                                                echo "Pending";
                                                                echo "</span>";
                                                            }
                                                            if($booking['delivery_status'] == 'Delivered') {
                                                                echo "<span class = ". "'badge' style = ". "'background: green'>";
                                                                echo "Delivered";
                                                                echo "</span>";
                                                            }
                                                            if($booking['delivery_status'] == 'Reroute') {
                                                                echo "<span class = ". "'badge' style = ". "'background: darkblue'>";
                                                                echo "Reroute";
                                                                echo "</span>";
                                                            }
                                                            if($booking['delivery_status'] == 'Cancelled') {
                                                                echo "<span class = ". "'badge' style = ". "'background: darkred'>";
                                                                echo "Cancelled";
                                                                echo "</span>";
                                                            }
                                                            if($booking['delivery_status'] == 'Returned') {
                                                                echo "<span class = ". "'badge' style = ". "'background: orange'>";
                                                                echo "Returned";
                                                                echo "</span>";
                                                            }
                                                            if($booking['delivery_status'] == 'Failed') {
                                                                echo "<span class = ". "'badge' style = ". "'background: red'>";
                                                                echo "Failed";
                                                                echo "</span>";
                                                            }
                                                        ?>  <?php
                                                                if($booking['refno']){
                                                                    echo '|&nbsp;&nbsp;'. "<span class = ". "'badge' style = ". "'background: darkblue'>";
                                                                    echo "#".$booking['refno'];
                                                                    echo "</span>";      
                                                                } 
                                                            ?>
                                                    </td>
                                                </tr>
                                                <?php  } 
                                                    } else {
                                                ?>
                                                <div class="card-body">
                                                    No invoice at the moment!!!
                                                    <script> $("#invoiceTable").hide();</script>
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


    <script>
        $('#invoiceTable').dataTable({
        "bPaginate": false,
        "bLengthChange": true,
        "bFilter": false,
        "bSort": false,
        "bInfo": false,
        "bAutoWidth": false
    });

    <script>