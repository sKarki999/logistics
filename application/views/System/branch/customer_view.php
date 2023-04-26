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
                    <h1 class="d-inline-block card-title">Customer Panel&nbsp;&nbsp;</h1>
                    <h3.5 class="d-inline-block font-weight-bold" ><?php echo $this->session->userdata('branchName');?>&nbsp;&nbsp;</h3.5>
                    <div class="col-md-2.1 float-right">
                        <a href="<?php echo base_url();?>Branch/Dashboard" class="btn btn-sm btn-secondary" style="color:white;">Home</a>
                        <a href="<?php echo base_url();?>Branch/Customer" class="btn btn-sm btn-secondary"  style="margin-left: 1em;color:white;">Master Record</a>
                        <a href="<?php echo base_url();?>Branch/Customer/addCustomer" class="btn btn-sm btn-secondary" style="margin-left: 1em;color:white;">Add New Customer</a>
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
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-body-- table-responsive">
                                        <table class="table table-striped table-bordered" id="customerTable">
                                            <thead class='font-weight-bold' style="background:#A0DAA9;" >
                                                <tr>
                                                    <th>S.N</th>
                                                    <th>Customer Code</th>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th>Contact</th>
                                                    <th>Email</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    if($customers != 'false') {
                                                    $i = 1;
                                                    foreach($customers as $customer) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i;?></td> 
                                                    <td><?php echo $customer['customer_code'];?></td>
                                                    <td><?php echo $customer['customer_name'];?></td>
                                                    <td><?php echo $customer['address'];?></td>
                                                    <td><?php echo $customer['contact_number'];?></td>
                                                    <td><?php echo $customer['email'];?></td>
                                                    <td> <a href="<?php echo base_url();?>Branch/Customer/getCustomer/<?php echo $customer['customer_id'];?>" class="btn btn-secondary btn-sm" style="color:white;">Edit</a> | 
                                                         <a href="<?php echo base_url();?>Branch/Customer/deleteCustomer/<?php echo $customer['customer_id'];?>" class="btn btn-secondary btn-sm" style="color:white;" onclick="if (!confirm('Are you sure?')) { return false }"> Del </a>
                                                    </td>
                                                </tr>
                                                <?php  $i++; } 
                                                    } else {
                                                ?>
                                                <div class="card-body">
                                                    No Customer at the moment!!!
                                                    <script> $("#customerTable").hide();</script>
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
