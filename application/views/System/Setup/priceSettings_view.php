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
                    <h1 class="d-inline-block card-title">Price Settings Panel&nbsp;&nbsp;</h1>
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
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row mb-5">
                    <div class="col-lg-4 col-md-8">
                         <form action="<?php echo base_url();?>Admin/PriceSettings/setPrice" method="post">
                            <div class="input-group">
                                <div class="input-group mb-3">
                                    <select class="form-control" name="branch_id" required>
                                            <option value="">Choose a branch</option>
                                            <?php foreach($branches as $branch) {?> 
                                            <option value="<?php echo $branch['branch_id'];?>"> <?php echo $branch['branch_name'];?></option>
                                            <?php } ?>                                               
                                        </select>
                                    <div class="input-group-append">
                                        <span class="input-group-btn">
                                            <button class="btn btn-secondary" id="setPrice" type="submit">GO</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        
    </div>
    <!-- /#right-panel -->
    <?php $this->load->view('System/Setup/Footer');?>
