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
                    <a href="<?php echo base_url();?>Branch/Customer" class="btn btn-sm btn-secondary mb-2"><span class='fa fa-arrow-left'>&nbsp;Back</span></a>
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

            <div class="animated fadeIn">                
                <div class="card my-4">
                    <div class="card-body">
                        <form method="post" action="<?php echo base_url();?>Branch/Customer/saveCustomer">                            
                            <div class="form-group">
                                <label for=""><h5 class="required font-weight-bold">Customer Name </h5></label>
                                <input type="text" class="form-control" name="customer_name" required/>
                            </div>

                            <div class="form-group">
                                <label for=""><h5 class="required font-weight-bold">Address </h5></label>
                                <input type="text" class="form-control" name="address" required/>
                            </div>

                            <div class="form-group">
                                <label for=""><h5 class="required font-weight-bold">Contact </h5></label>
                                <input type="text" class="form-control" name="contact_number" required/>
                            </div>

                            <div class="form-group">
                                <label for=""><h5 class="required font-weight-bold">Email </h5></label>
                                <input type="text" class="form-control" name="email" required/>
                            </div>

                            <div class="form-group">
                                <label for=""><h5 class="required font-weight-bold">Username </h5></label>
                                <input type="text" class="form-control" name="username" required/>
                            </div>

                            <div class="form-group">
                                <label for=""><h5 class="required font-weight-bold">User Password </h5></label>
                                <input type="text" class="form-control" name="password" required/>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn" style="background:#A0DAA9;" value="Add" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        
    </div>
    <!-- /#right-panel -->
    <?php $this->load->view('System/branch/Footer');?>
