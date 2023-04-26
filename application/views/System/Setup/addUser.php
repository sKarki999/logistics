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
                    <h1 class="d-inline-block card-title">User Panel&nbsp;</h1>
                    <a href="<?php echo base_url();?>Admin/User" class="btn btn-sm btn-secondary mb-2"><span class='fa fa-arrow-left'>&nbsp;Back</span></a>
                </div>
            </div>
            <!-- Animated -->
            <div class="animated fadeIn">                
                <div class="card my-4">
                            <div class="card-body">
                                <form method="post" action="<?php echo base_url();?>Admin/User/saveUser">
                                    
                                    <div class="form-group mb-4">
                                        <label for=""><h5 class="required font-weight-bold">Full Name </h5></label>
                                        <input type="text" class="form-control" name="full_name"
                                        value="<?php echo (isset($full_name)) ? $full_name : '' ; ?>" />
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('full_name', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="required font-weight-bold">User Name </h5></label>
                                        <input type="text" class="form-control" name="user_name" 
                                        value="<?php echo (isset($user_name)) ? $user_name : '' ; ?>"/>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('user_name', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="required font-weight-bold">User Password </h5></label>
                                        <input type="text" class="form-control" name="user_password" 
                                        value="<?php echo (isset($user_password)) ? $user_password : '' ; ?>" />
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('user_password', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="font-weight-bold">Branch </h5></label>
                                        <select class="form-control" name="branch_id">
                                            <option value="<?php echo (isset($current_branch['0']['branch_id']) ? $current_branch['0']['branch_id'] : ''); ?>">
                                                <?php echo (isset($current_branch['0']['branch_name'])) ? $current_branch['0']['branch_name'] : 'Choose a branch'; ?>
                                            </option>
                                            <?php foreach($branches as $branch) {?> 
                                            <option value="<?php echo $branch['branch_id'];?>"><?php echo $branch['branch_name'];?></option>
                                            <?php } ?>                                               
                                        </select>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('branch_id', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for=""><h5 class="font-weight-bold">User Type </h5></label>
                                        <select class="form-control" name="user_type">
                                            <option value="<?php echo (isset($current_branch['0']['user_type']) ? $current_branch['0']['user_type'] : ''); ?>">
                                                <?php echo (isset($current_branch['0']['user_type'])) ? $current_branch['0']['user_type'] : 'Choose user type'; ?>
                                            </option>
                                            <option value="Admin">Admin</option>
                                            <option value="Branch">Branch</option>                                               
                                        </select>
                                        <div class="text-danger h6 mt-1">
                                            <?php echo form_error('user_type', '<span class="color-red">', '</span>'); ?>
                                        </div>
                                    </div>


                                    <!-- <div class="form-group">
                                        <label for=""><h5 class="font-weight-bold">User Type </h5></label>
                                        <div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="user_type" id="topuser" value="Admin" checked>
                                                <label class="form-check-label font-italic" for="topuser">
                                                    Admin
                                                </label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="user_type" id="generaluser" value="Branch">
                                                <label class="form-check-label font-italic" for="generaluser">
                                                    Branch
                                                </label>
                                            </div>
                                        </div>    
                                    </div> -->

                                    <div class="form-group">
                                        <label for=""><h5 class="required font-weight-bold">Contact Number </h5></label>
                                        <input type="text" class="form-control" name="contact" 
                                        value="<?php echo (isset($contact)) ? $contact : '' ; ?>"/>
                                            <?php echo form_error('contact', '<span class="color-red">', '</span>'); ?>
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
                                        <input type="submit" class="btn" style="background:#9BB7D4;" value="Add" />
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