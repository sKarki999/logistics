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
                    <h1 class="d-inline-block card-title">Pickup Request&nbsp;&nbsp;</h1>
                    <h3.5 class="d-inline-block font-weight-bold" ><?php echo $this->session->userdata('branchName');?>&nbsp;&nbsp;</h3.5>
                </div>
            </div>

            <?php if($this->session->flashdata('msg')) {?>
                <div class="alert alert-success" role="alert" id="sessionMessage">
                    <h4 class="alert-heading"><?php echo $this->session->flashdata('msg');?></h4>
                </div> 
            <?php } ?>

            <section class="content" style="background: RGB(273, 267, 240);">	
                <form method="post" id="orderForm" action="<?php echo base_url(); ?>Branch/Pickup/addPickupRequest">
                  <input type="hidden" name="prepared_on" value="<?php echo date("Y-m-d"); ?>" />
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="date">Pickup Date</label>
                            <input type="text" class="form-control" name="pickup_date" id="date" placeholder="" value="<?php echo date("Y-m-d"); ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault02">Pickup Time</label>
                            <input type="text" class="form-control" name="pickup_time" required>
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
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault02">Address</label>
                            <input type="text" class="form-control" name="pickup_address" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault02">Contact</label>
                            <input type="text" class="form-control" name="pickup_contact" required>
                        </div>
                        <div class="col-md-3 mb-3">
                        <label for="date">Total Packet</label>
                        <input type="text" class="form-control" name="total_packet" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault05">Total Weight</label>
                            <input type="text" class="form-control" id="validationDefault05" name="total_weight">
                        </div>
                    </div>

                    <div style="margin-top: 5px;">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                    <hr style="border: 2px solid black;" />
                </form>

                <div class="orders">
                    <div class="row">
                        <div class="col-xl">
                            <div class="card">
                                <div class="card-body-- table-responsive">
                                        <table class="table table-striped table-bordered" id="requestTable">
                                            <thead class='font-weight-bold' style="background:#A0DAA9;" >
                                                <tr>
                                                    <th>SN</th>
                                                    <th>PKRN</th>
                                                    <th>VENDORS</th>
                                                    <th>PICKUP ADDRESS</th>
                                                    <th>CONTACT</th>
                                                    <th>PCS</th>
                                                    <th>WT/KG</th>
                                                    <th>DATE</th>
                                                    <th>TIME</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $serial = 0;
                                                    if($requestMessages != null) {
                                                    foreach($requestMessages as $message) {
                                                        $serial++;
                                                ?>
                                                <tr> 
                                                    <td><?php echo $serial; ?></td>
                                                    <td><?php echo $message['prno'];?></td>
                                                    <td><?php echo $message['customer_name'];?></td>
                                                    <td><?php echo $message['address'];?></td>
                                                    <td><?php echo $message['contact'];?></td>
                                                    <td><?php echo $message['total_packet'];?></td>
                                                    <td><?php echo $message['total_weight'];?></td>
                                                    <td><?php echo $message['pickup_date'];?></td>
                                                    <td><?php echo $message['pickup_time'];?></td>
                                        
                                                </tr>
                                                <?php  } 
                                                    } else {
                                                ?>
                                                <div class="card-body">
                                                    No Pickup Request at the moment.
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

    <script>

        $("#date").datepicker({ dateFormat: 'yy-mm-dd' });
        function preview(){
            var printContents = document.getElementById('p').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            window.location = "<?php echo base_url(); ?>branch/booking/newBooking";
        }

    </script>