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
                    <h1 class="d-inline-block card-title">Customer Payslip&nbsp;&nbsp;</h1>
                    <div class="col-md-2.1 float-right">
                        <a href="<?php echo base_url();?>Branch/Dashboard" class="btn btn-sm btn-secondary" style="color:white;">Home</a>
                        <a href="<?php echo base_url();?>Branch/Booking" class="btn btn-sm btn-secondary"  style="margin-left: 1em;color:white;">Create Payslip</a>
                        <a href="<?php echo base_url();?>Branch/Booking/newBooking" class="btn btn-sm btn-secondary" style="margin-left: 1em;color:white;">Master Record</a>
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
            
            <section class="content" style="background: RGB(273, 267, 240);">	
                <form method="post" id="orderForm" action="<?php echo base_url(); ?>Branch/CreditStatement/processCreditStatement">
                  <input type="hidden" name="prepared_on" value="<?php echo date("Y-m-d"); ?>" />
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault02">Payslip No</label>
                            <input type="text" class="form-control" name="payslip_number" readonly>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="date">Date</label>
                            <input type="text" class="form-control" name="pickup_date" id="date" placeholder="" value="<?php echo date("Y-m-d"); ?>" readonly>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault04">Our Vendors</label>
                            <select name="customer" id="customer" class="form-control">
                                <!-- <option>Choose Vendor</option> -->
                                <?php
                                    foreach($customers as $customer) {
                                ?>
                                    <option value="<?php echo $customer['customer_id'];?>"><?php echo $customer['customer_name'];?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault02">From Date</label>
                            <input type="text" class="form-control" name="pickup_contact" required>
                        </div>
                        <div class="col-md-3 mb-3">
                        <label for="date">To Date</label>
                        <input type="text" class="form-control" name="total_packet" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault05">Prepared By</label>
                            <input type="text" class="form-control" id="validationDefault05" name="total_weight">
                        </div>
                    </div>

                    <div style="margin-top: 5px;">
                        <button type="submit" class="btn btn-secondary">Generate Payslip</button>
                    </div>
                    <hr style="border: 2px solid black;" />

                <div class="orders">
                    <div class="row">
                        <div class="col-xl">
                            <div class="card">
                                <div class="card-body-- table-responsive">
                                    <table class="table table-striped table-bordered" id="requestTable">
                                        <thead class='font-weight-bold' style="background:#A0DAA9;" >
                                            <tr>
                                                <th>CNN</th>
                                                <th>Date</th>
                                                <th>Consignee</th>
                                                <th>Address</th>
                                                <th>COD Amount</th>
                                                <th>DC</th>
                                                <th>Status</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                
                                            ?>
                                            <tr> 
                                                <td><?php ?></td>
                                                <td><?php ?></td>
                                                <td><?php ?></td>
                                                <td><?php ?></td>
                                                <td><?php ?></td>
                                                <td><?php ?></td>
                                                <td><?php ?></td>
                                                <td><?php ?></td>
                                            </tr>
                                            <?php 
                                            ?>
                                            <?php
                                                
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div> <!-- /.card -->
                        </div>  <!-- /.col-lg-8 -->
                    </div>
                </div>
                <button id="credit" class="btn btn-secondary"><i class="fa fa-save "></i>&nbsp;&nbsp;SAVE STATEMENT</button>
            </form>
        </section>


        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        
    </div>
    <!-- /#right-panel -->
    <?php $this->load->view('System/branch/Footer');?>

    