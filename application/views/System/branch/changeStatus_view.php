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
                    <div class="col-md-2.1 float-right">
                        <a href="<?php echo base_url();?>Branch/Dashboard" class="btn btn-sm btn-secondary" style="color:white">Home</a>
                        <a href="<?php echo base_url();?>Branch/Booking" class="btn btn-sm btn-secondary"  style="margin-left: 1em;color:white">Master Record</a>
                        <a href="<?php echo base_url();?>Branch/Booking/newBooking" class="btn btn-sm btn-secondary" style="margin-left: 1em;color:white">New Booking</a>
                    </div>
                </div>
            </div>

            <section class="content" style="background: RGB(273, 267, 240);">
                <?php
                    if($result['0']['delivery_status'] != 'Reroute') {
                    ?>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-header font-weight-bold" style="background:#A0DAA9;">
                        CN NO: #<?php echo $result['0']['bill_number'];?>
                        </div>
                        <div class="card-body">
                            <form method="post" action="<?php echo base_url();?>Branch/Booking/updateStatus/<?php echo $invoice;?>">                                            
                                <div class="form-group mb-4">
                                    <label for=""><h5 class="font-weight-bold"> Date</h5></label>
                                        <input type="text" class="form-control" name="status_updated_date" id="date"/>
                                </div>
                                <div class="form-group">
                                    <label for=""><h5 class="font-weight-bold">Status</h5></label>
                                    <select class="form-control" name="status" id ="status" required>
                                        <option value="">Change Status</option>
                                        <option value="Pending">Pending</option>
                                        <option value="Delivered">Delivered</option>
                                        <option value="Cancelled">Cancelled</option>
                                        <option value="Returned">Returned</option>
                                        <option value="Failed">Failed</option>
                                    </select>
                                </div>

                                <div id="remarks">
                                    <div class="form-group">
                                        <label for=""><h5 class="font-weight-bold">Remark</h5></label>
                                        <select class="form-control" name="package_remark" id="package_remark">
                                            <option value="">Choose a Reason</option>
                                            <option value="Wrong Item">Wrong Item</option>
                                            <option value="Missing Parts">Missing Parts</option>
                                            <option value="Quality Not Adequate">Quality Not Adequate</option>
                                            <option value="Accidental Order">Accidental Order</option>
                                            <option value="No longer Needed">No longer Needed</option>
                                            <option value="No Reason">Refused to Pay</option>
                                            <option value="No Reason">Not at Home</option>
                                            <option value="No Reason">No Reason</option>
                                        </select>
                                        <br/>
                                        <div class="form-group">
                                            <label for=""><h5 class="font-weight-bold">Package Condition</h5></label>
                                            <select class="form-control" name="package_condition" id="package_condition">
                                                <option value="">Select the Condition</option>
                                                <option value="damaged">Damaged</option>
                                                <option value="reroutable">Reroutable</option>
                                                <option value="good">Good</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr/>
                                <div class="form-group">
                                    <input type="submit" class="btn" style="background:#A0DAA9;" value="Update" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php } else { ?>
                        <div class="alert alert-danger" role="alert">
                        This CN Number has already been routed to another address!
                        Please check the Routed Reference Code No: <span class="font-weight-bold"><?php echo '#' . $result['0']['refno'];?></span>
                      </div>    
                    <?php }?>
            </section>

        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        
    </div>
    <!-- /#right-panel -->
    <?php $this->load->view('System/branch/Footer');?>


    <script>
        
        $("#date").datepicker({ dateFormat: 'yy-mm-dd' });
        
        $("div#remarks").hide();

        $("#status").blur(function(){
            var value = $(this).val();
            if(value == 'Cancelled' || value == 'Returned' || value == 'Failed') {
                $("div#remarks").show();
            } else {
                $("div#remarks").hide();
            }
        })
</script>