<?php $this->load->view('System/driver/Header');?>
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
                                    <div class="card-header" style="background:#EEE8AA;"><h2 class="text-center my-4">Driver Login</h2></div>
                                        <div class="card-body">
                                            <form method='post' action='<?php echo base_url()?>Driver/Account/Login'>
                                                <div class="form-group">
                                                    <label for=""><h6 class="required font-weight-bold text-muted">Username</h6></label>
                                                    <input class="form-control" type="text" name="username" value="" required/>
                                                </div>
                                                <div class="form-group">
                                                    <label for=""><h6 class="required font-weight-bold text-muted">Password</h6></label>
                                                    <input class="form-control" type="password" name="password" required />
                                                </div>
                                                <div class="form-group">
                                                    <label for=""><h6 class="required font-weight-bold text-muted">Branch</h6></label>
                                                    <select class="form-control" name="branch" id="branch" required>
                                                        <option value="">Choose Your Branch</option>
                                                        <?php 
                                                            foreach ($branches as $branch) {
                                                        ?>
                                                        <option value="<?php echo $branch['branch_id'];?>"><?php echo $branch['branch_name'];?></option>
                                                        <?php
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn float-right" style="background:#EEE8AA;">Log in </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
<?php $this->load->view('System/driver/Footer');?>