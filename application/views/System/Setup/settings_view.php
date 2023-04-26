<?php $this->load->view('System/Setup/Header');?>
<!-- Left Panel -->
<?php $this->load->view('System/Setup/sidebar');?>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <?php $this->load->view('System/Setup/nav');?>
        <!-- Content -->
        <?php  ?>

        <div class="content">
            <div class="card mt-3">
                <div class="card-header" style="background:#9BB7D4;">
                    <h1 class="d-inline-block card-title">Settings Panel&nbsp;</h1>
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
                <div class="card my-4">
                            <div class="card-body">
                                <form method="post" action="<?php echo base_url();?>Admin/Settings/updateSettings/<?php echo $settings['0']['id'];?>">
                                    
                                    <div class="form-group mb-4">
                                        <label for=""><h5 class="required font-weight-bold">Business Name </h5></label>
                                        <input type="text" class="form-control" name="business_name"
                                        value="<?php echo (isset($settings['0']['business_name'])) ? $settings['0']['business_name'] : '' ; ?>" />
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('business_name', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="required font-weight-bold">Business Address </h5></label>
                                        <input type="text" class="form-control" name="business_address" 
                                        value="<?php echo (isset($settings['0']['business_address'])) ? $settings['0']['business_address'] : '' ; ?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('business_address', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="required font-weight-bold">Business Number </h5></label>
                                        <input type="text" class="form-control" name="business_contact" 
                                        value="<?php echo (isset($settings['0']['business_contact'])) ? $settings['0']['business_contact'] : '' ; ?>"/>
                                            <?php echo form_error('business_contact', '<span class="color-red">', '</span>'); ?>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="required font-weight-bold">Web Url </h5></label>
                                        <input type="text" class="form-control" name="business_url" 
                                        value="<?php echo (isset($settings['0']['business_url'])) ? $settings['0']['business_url'] : '' ; ?>" />
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('business_url', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="required font-weight-bold">Email </h5></label>
                                        <input type="text" class="form-control" name="business_email" 
                                        value="<?php echo (isset($settings['0']['business_email'])) ? $settings['0']['business_email'] : '' ; ?>" />
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('business_email', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <input type="submit" class="btn" style="background:#9BB7D4;" value="Update" />
                                    </div>
                                </form>
                            </div>
                        </div>


                <div class="clearfix"></div>
                <!-- Orders -->
                
                <!-- /.orders -->
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        
    </div>
    <!-- /#right-panel -->
    <?php $this->load->view('System/Setup/Footer');?>