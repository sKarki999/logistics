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
                    <h1 class="d-inline-block card-title">Vendor Dashboard&nbsp;&nbsp;</h1>
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


            <div class="row">
                <div class="col-sm-6" style="max-width: 30rem;">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-header font-weight-bold mb-3" style="background:#DCDCDC;">Orders Panel</h3>
                                <div class="card text-white bg-flat-color-3">
                                </div>
                            <a href="<?php echo base_url();?>Vendor/Order" class="btn" style="background:#DCDCDC;color:black;">View Orders</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6" style="max-width: 30rem;">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-header font-weight-bold mb-3" style="background:#DCDCDC;">Payment Panel</h3>
                                <div class="card text-white bg-flat-color-3">
                                </div>
                            <a href="<?php echo base_url();?>Vendor/Payment" class="btn" style="background:#DCDCDC;color:black;">View Payment</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6" style="max-width: 30rem;">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-header font-weight-bold mb-3" style="background:#DCDCDC;">Tracking Panel</h3>
                                <div class="card text-white bg-flat-color-3">
                                </div>
                            <a href="<?php echo base_url();?>Vendor/Tracking" class="btn" style="background:#DCDCDC;color:black;">Track Order</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6" style="max-width: 30rem;">
                    <div class="card">
                            <div class="card-body">
                                <h3 class="card-header font-weight-bold mb-3" style="background:#DCDCDC;">Settings Panel</h3>
                                    <div class="card text-white bg-flat-color-3">
                                    </div>
                                <a href="<?php echo base_url();?>Vendor/Settings" class="btn" style="background:#DCDCDC;color:black;">Update Information</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    <!-- /#right-panel -->
    <?php $this->load->view('System/vendor/Footer');?>