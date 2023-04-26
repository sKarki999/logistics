<?php $this->load->view('System/Setup/Header');?>
<!-- Left Panel -->
<?php $this->load->view('System/Setup/sidebar');?>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <?php $this->load->view('System/Setup/nav');?>
        <!-- Content -->
        <div class="content">
            <div class="card mt-3">
                <div class="card-header" style="background:#9BB7D4;">
                    <h1 class="d-inline-block card-title">Admin Dashboard&nbsp;&nbsp;</h1>
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
                <div class="col-sm-6" style="max-width: 25rem;">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-header font-weight-bold mb-3" style="background:#DCDCDC;">Branch</h3>
                                <div class="card text-white bg-flat-color-3">
                                    <div class="card-body" style="background:white;">
                                        <div class="card-left pt-1 float-left">
                                            <h3 class="mb-0 fw-r">
                                                <span class="text-dark"><?php echo $totalBranch;?></span>
                                            </h3>
                                            <p class="text-dark mt-1 m-0 font-weight-bold">Total Branches</p>
                                        </div><!-- /.card-left -->
                                        <div class="card-right float-right text-right">
                                            <i class="icon fade-5 icon-lg pe-7s-users"></i>
                                        </div><!-- /.card-right -->
                                    </div>
                                </div>
                            <a href="<?php echo base_url();?>Admin/Branch" class="btn" style="background:#DCDCDC;color:black;">Branch Panel</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6" style="max-width: 25rem;">
                    <div class="card">
                    <div class="card-body">
                            <h3 class="card-header font-weight-bold mb-3" style="background:#DCDCDC;">Location</h3>
                                <div class="card text-white bg-flat-color-3">
                                    <div class="card-body" style="background:white;">
                                        <div class="card-left pt-1 float-left">
                                            <h3 class="mb-0 fw-r">
                                                <span class="text-dark"><?php echo $totalLocation;?></span>
                                            </h3>
                                            <p class="text-dark mt-1 m-0 font-weight-bold">Total Locations</p>
                                        </div><!-- /.card-left -->
                                        <div class="card-right float-right text-right">
                                            <i class="icon fade-5 icon-lg pe-7s-users"></i>
                                        </div><!-- /.card-right -->
                                    </div>
                                </div>
                            <a href="<?php echo base_url();?>Admin/Location" class="btn" style="background:#DCDCDC;color:black;">Location Panel</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6" style="max-width: 25rem;">
                    <div class="card">
                    <div class="card-body">
                            <h3 class="card-header font-weight-bold mb-3" style="background:#DCDCDC;">User</h3>
                                <div class="card text-white bg-flat-color-3">
                                    <div class="card-body" style="background:white;">
                                        <div class="card-left pt-1 float-left">
                                            <h3 class="mb-0 fw-r">
                                                <span class="text-dark"><?php echo $totalUser;?></span>
                                            </h3>
                                            <p class="text-dark mt-1 m-0 font-weight-bold">Total Users</p>
                                        </div><!-- /.card-left -->
                                        <div class="card-right float-right text-right">
                                            <i class="icon fade-5 icon-lg pe-7s-users"></i>
                                        </div><!-- /.card-right -->
                                    </div>
                                </div>
                            <a href="<?php echo base_url();?>Admin/User" class="btn" style="background:#DCDCDC;color:black;">User Panel</a>
                        </div>
                    </div>
                </div>
            </div>
            
        <!-- /.content -->
        <div class="clearfix"></div>
        
    </div>
    <!-- /#right-panel -->
    <?php $this->load->view('System/Setup/Footer');?>