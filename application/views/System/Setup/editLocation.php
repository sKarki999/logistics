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
                    <h1 class="d-inline-block card-title">Location Panel&nbsp;</h1>
                    <a href="<?php echo base_url();?>Admin/Location" class="btn btn-sm btn-secondary mb-2"><span class='fa fa-arrow-left'>&nbsp;Back</span></a>
                </div>
            </div>
            <!-- Animated -->
            <div class="animated fadeIn">                
                <div class="card my-4">
                            <div class="card-body">
                                <form method="post" action="<?php echo base_url();?>Admin/Location/update/<?php echo $result['0']['location_id'];?>">

                                    <div class="form-group">
                                        <label for=""><h5 class="required font-weight-bold">Location Name </h5></label>
                                        <input type="text" class="form-control" name="location_name" 
                                        value="<?php echo (isset($result['0']['location_name'])) ? $result['0']['location_name'] : '' ; ?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('location_name', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="font-weight-bold">Category</h5></label>
                                        <select class="form-control" name="category">
                                            <option value="<?php echo (isset($result['0']['category'])) ? $result['0']['category'] : '' ; ?>">
                                                <?php echo (($result['0']['category'] == '0')) ? 'Domestic' : 'International' ; ?>
                                            </option>
                                            <option value="0">Domestic</option>
                                            <option value="1">International</option>                                               
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="font-weight-bold">Location Type</h5></label>
                                        <select class="form-control" name="location_type">
                                            <option value="<?php echo (isset($result['0']['location_type'])) ? $result['0']['location_type'] : '' ; ?>">
                                                <?php echo $result['0']['location_type']; ?>
                                            </option>
                                            <option value="District">District</option>
                                            <option value="Zone">Zone</option>
                                            <option value="City">City</option>          
                                        </select>
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