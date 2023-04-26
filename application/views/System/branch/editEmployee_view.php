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
                    <h1 class="d-inline-block card-title">Employee Panel&nbsp;&nbsp;</h1>
                    <a href="<?php echo base_url();?>Branch/Employee" class="btn btn-sm btn-secondary mb-2"><span class='fa fa-arrow-left'>&nbsp;Back</span></a>
                    <div class="col-md-2.1 float-right">
                        <a href="<?php echo base_url();?>Branch/Dashboard" class="btn btn-sm btn-secondary" style="color:white;">Home</a>
                        <a href="<?php echo base_url();?>Branch/Employee" class="btn btn-sm btn-secondary"  style="margin-left: 1em;color:white;">Master Record</a>
                        <a href="<?php echo base_url();?>Branch/Employee/addEmployee" class="btn btn-sm btn-secondary" style="margin-left: 1em;color:white;">Add New</a>
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
                        <form method="post" action="<?php echo base_url();?>Branch/Employee/updateEmployee/<?php echo $employee['0']['id']; ?>">                            
                            <div class="form-group">
                                <label for=""><h5 class="required font-weight-bold">Employee Name </h5></label>
                                <input type="text" class="form-control" name="employee_name"  
                                value = "<?php echo (isset($employee['0']['name'])) ? $employee['0']['name'] : '' ; ?>" required/>
                            </div>

                            <div class="form-group">
                                <label for=""><h5 class="required font-weight-bold">Address </h5></label>
                                <input type="text" class="form-control" name="address"  
                                value = "<?php echo (isset($employee['0']['address'])) ? $employee['0']['address'] : '' ; ?>" required/>
                            </div>

                            <div class="form-group">
                                <label for=""><h5 class="required font-weight-bold">Contact </h5></label>
                                <input type="text" class="form-control" name="contact_number"  
                                value = "<?php echo (isset($employee['0']['contact'])) ? $employee['0']['contact'] : '' ; ?>" required/>
                            </div>

                            <div class="form-group">
                                <label for=""><h5 class="required font-weight-bold">Email </h5></label>
                                <input type="text" class="form-control" name="email"  
                                value = "<?php echo (isset($employee['0']['email'])) ? $employee['0']['email'] : '' ; ?>" required/>
                            </div>

                            <div class="form-group">
                                <label for=""><h5 class="required font-weight-bold">Designation</h5></label>
                                <select class="form-control" name="designation" id="designation" required>
                                    <option value="Driver">Driver</option>
                                </select>
                            </div>
<!-- 
                            <div class="form-group">
                                <label for=""><h5 class="required font-weight-bold">Job Status</h5></label>
                                <select class="form-control" name="job_status" id="job_status" required>
                                    <option value="">Choose Job Status</option>
                                    <option value="0">Active</option>
                                    <option value="1">Left</option>
                                </select>
                            </div> -->

                            <div class="form-group">
                                <label for=""><h5 class="required font-weight-bold">Username </h5></label>
                                <input type="text" class="form-control" name="username"  
                                value = "<?php echo (isset($employee['0']['username'])) ? $employee['0']['username'] : '' ; ?>" required/>
                            </div>

                            <div class="form-group">
                                <label for=""><h5 class="required font-weight-bold">Password </h5></label>
                                <input type="text" class="form-control" name="password"  
                                value = "<?php echo (isset($employee['0']['password'])) ? $employee['0']['password'] : '' ; ?>" required/>
                            </div>

                            <div class="form-group">
                                <input type="submit" class="btn" style="background:#A0DAA9;" value="Update" />
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
