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
                    <h1 class="d-inline-block card-title">User Panel&nbsp;</h1>
                    <a href="<?php echo base_url();?>Admin/User" class="btn btn-sm btn-secondary mb-2"><span class='fa fa-arrow-left'>&nbsp;Back</span></a>
                </div>
            </div>

            <?php // print_r($result); ?>

            <!-- Animated -->
            <div class="animated fadeIn">                
                <div class="card my-4">
                            <div class="card-body">
                                <form method="post" action="<?php echo base_url();?>Admin/User/update/<?php echo $result['0']['user_id'];?>">
                                    
                                    <div class="form-group mb-4">
                                        <label for=""><h5 class="required font-weight-bold">Full Name</h5></label>
                                        <input type="text" class="form-control" name="full_name"
                                        value="<?php echo (isset($result['0']['full_name'])) ? $result['0']['full_name'] : '' ; ?>" />
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('full_name', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="required font-weight-bold">User Name</h5></label>
                                        <input type="text" class="form-control" name="user_name" 
                                        value="<?php echo (isset($result['0']['user_name'])) ? $result['0']['user_name'] : '' ; ?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('user_name', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="font-weight-bold">User Password</h5></label>
                                        <input type="password" class="form-control" name="user_password" 
                                        value="<?php echo (isset($result['0']['user_password']) ? $result['0']['user_password'] : '')?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('user_password', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="required font-weight-bold">Branch</h5></label>
                                        <select class="form-control" name="branch_id">
                                            <option value="">Choose a Branch</option>
                                            <?php foreach($branches as $branch) {?> 
                                            <option value="<?php echo $branch['branch_id'];?>"> <?php echo $branch['branch_name'];?></option>
                                            <?php } ?>                                                  
                                        </select>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('branch_id', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="font-weight-bold">User Type </h5></label>
                                        <select class="form-control" name="user_type">
                                            <option value="">Choose user type</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Branch">Branch</option>                                               
                                        </select>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('user_type', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <!-- <div class="form-group">
                                        <label for=""><h5 class="required font-weight-bold">User Type</h5></label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="user_type" id="topuser" value="0" 
                                                    <?php //echo ($result['0']['user_type'] == '0') ? 'checked' : ''?>>
                                                <label class="form-check-label font-italic" for="topuser">
                                                    Top User
                                                </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="user_type" id="generaluser" value="1" 
                                                    <?php //echo ($result['0']['user_type'] == '1') ? 'checked' : ''?>>
                                                <label class="form-check-label font-italic" for="generaluser">
                                                    General User
                                                </label>
                                            </div>
                                        </div>
                                        <div class="text-danger h6 mt-1"></div>
                                    </div> -->

                                    <div class="form-group">
                                        <label for=""><h5 class="required font-weight-bold">Contact Number</h5></label>
                                        <input type="text" class="form-control" name="contact" 
                                        value="<?php echo (isset($result['0']['contact'])) ? $result['0']['contact'] : '' ; ?>"/>
                                        <div class="text-danger h6 mt-1">
                                        <?php echo form_error('contact', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="required font-weight-bold"> Module Grant/Revoke Service</h5></label>&nbsp;&nbsp;&nbsp;
                                        <input type="checkbox" id="addCheckAll">&nbsp;Check All
                                        <table>
                                            <tr>
                                                <td><input type="checkbox" name="dashboard" value="1">&nbsp;Dashboard&nbsp;</td>
                                                <td><input type="checkbox" name="booking" value="1">&nbsp;Booking&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" name="manifest" value="1">&nbsp;Manifest&nbsp;</td>
                                                <td> <input type="checkbox" name="manifest_received" value="1">&nbsp;Manifest Received&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" name="runsheet" value="1">&nbsp;Runsheet&nbsp;</td>
                                                <td><input type="checkbox" name="pod" value="1">&nbsp;POD&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" name="tracking" value="1">&nbsp;Tracking&nbsp;</td>
                                                <td><input type="checkbox" name="finance" value="1">&nbsp;Finance&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td><input type="checkbox" name="customer" value="1">&nbsp;Customer&nbsp;</td>
                                                <td><input type="checkbox" name="employee" value="1">&nbsp;Employee&nbsp;</td>
                                            </tr>
                                        </table>
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