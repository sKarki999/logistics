<?php $this->load->view('System/Setup/Header');?>
<?php if($this->session->flashdata('msg')) {?>
                <div class="mt-3" id="sessionMessage">    
                    <div class="card-header alert alert-danger">
                        <h6 class="d-inline-block card-title">
                            <?php echo $this->session->flashdata('msg');?>
                        </h6>
                    </div>
                </div>
            <?php } ?>
<body class="" style="background:#F5F5F5;">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header" style="background:#DEB887;"><h2 class="text-center my-4">Efficient Delivery 1.0</h2></div>
                                        <div class="card-body">
                                            <form method='post' action='<?php echo base_url()?>Account/Login'>
                                                <div class="form-group">
                                                    <label for=""><h6 class="required font-weight-bold text-muted">Username</h6></label>
                                                    <input class="form-control" type="text" name="user_name" 
                                                    value="" />
                                                    <div class="text-danger h6 mt-1">
                                                        <?php echo form_error('user_name', '<span class="color-red">', '</span>'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for=""><h6 class="required font-weight-bold text-muted">Password</h6></label>
                                                    <input class="form-control" type="password" name="user_password" />
                                                    <div class="text-danger h6 mt-1">
                                                    <?php echo form_error('user_password', '<span class="color-red">', '</span>'); ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                <input type="submit" class="btn float-right" style="background:#DEB887;" value="Log in" />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
<?php $this->load->view('System/Setup/Footer');?>