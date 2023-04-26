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
                    <h1 class="d-inline-block card-title">Branch Panel&nbsp;</h1>
                    <a href="<?php echo base_url();?>Admin/Branch" class="btn btn-sm btn-secondary mb-2"><span class='fa fa-arrow-left'>&nbsp;Back</span></a>
                </div>
            </div>
            <!-- Animated -->
            <div class="animated fadeIn">                
                <div class="card my-4">
                            <div class="card-body">
                                <form method="post" action="<?php echo base_url();?>Admin/Branch/update/<?php echo $result['0']['branch_id'];?>">
                                    
                                    <div class="form-group mb-4">
                                        <label for=""><h5 class="required font-weight-bold">Branch Name </h5></label>
                                        <input type="text" class="form-control" name="branch_name"
                                        value="<?php echo (isset($result['0']['branch_name'])) ? $result['0']['branch_name'] : '' ; ?>" />
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('branch_name', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="required font-weight-bold">Branch Code </h5></label>
                                        <input type="text" class="form-control" name="branch_code" 
                                        value="<?php echo (isset($result['0']['branch_code'])) ? $result['0']['branch_code'] : '' ; ?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('branch_code', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for=""><h5 class="required font-weight-bold">Branch Location </h5></label>
                                        
                                        <!-- <input type="text" class="form-control" name="branch_location" 
                                        value="<?php //echo (isset($result['0']['branch_location'])) ? $result['0']['branch_location'] : '' ; ?>"/> -->
                                        
                                        <select class='form-control' name='branch_location'>
                                            <?php echo (isset($current_location['0']['location_name'])) ? $current_location['0']['location_name'] : 'Choose a branch'; ?>
                                            <?php foreach ($locations as $location) {?>
                                                <option value='<?php echo $location['location_id'];?>'><?php echo $location['location_name'];?></option>
                                            <?php } ?>
                                        </select>
                                        
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('branch_location', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="required font-weight-bold">Branch Address </h5></label>
                                        <input type="text" class="form-control" name="branch_address" 
                                        value="<?php echo (isset($result['0']['branch_address'])) ? $result['0']['branch_address'] : '' ; ?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('branch_address', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="required font-weight-bold">Branch Contact </h5></label>
                                        <input type="text" class="form-control" name="branch_contact" 
                                        value="<?php echo (isset($result['0']['branch_contact'])) ? $result['0']['branch_contact'] : '' ; ?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('branch_contact', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="required font-weight-bold">Branch Email </h5></label>
                                        <input type="text" class="form-control" name="branch_email" 
                                        value="<?php echo (isset($result['0']['branch_email'])) ? $result['0']['branch_email'] : '' ; ?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('branch_email', '<span class="color-red">', '</span>'); ?>
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