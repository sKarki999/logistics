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
                    <h1 class="d-inline-block card-title">User Panel&nbsp;&nbsp;</h1>
                    <a href="<?php echo base_url();?>Admin/User/addUser" class="btn btn-sm btn-secondary mb-2"><span class='fa fa-plus-circle'> Add User</span></a>
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
                         <form action="<?php echo base_url();?>Admin/User/search" method="post">
                            <div class="input-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Search By Name" name="searchName" 
                                        value = "<?php echo isset($search) ? $search : ''; ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-btn">
                                            <button class="btn btn-secondary"  id="UsersPerPage" type="submit">Search</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- /Widgets -->
                <?php
                    if($result != null) {
                ?>
                <div class="clearfix"></div>
                <!-- Orders -->
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body--">
                                        <table class="table table-striped">
                                            <thead class='font-weight-bold' style="background:#9BB7D4;">
                                                <tr>
                                                    <th>Serial</th>
                                                    <th>User Name</th>
                                                    <th>User Type</th>
                                                    <th>Branch Name</th>
                                                    <th>Contact</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $i = (($currentPage - 1) * $perPage) + 1;
                                                    foreach($result as $user) {    
                                                    // print_r($users);
                                                    ?>
                                                <tr> 
                                                    <td class="serial"><?php echo $i; ?></td>
                                                    <td> <?php echo $user['user_name']; ?> </td>
                                                    <td> <?php echo $user['user_type']; ?> </td>
                                                    <td> <?php 
                                                                $branchName = $this->SetupModel->getBranchName($user['branch_id']);
                                                                echo ($branchName) ? $branchName['branch_name'] : 'System user'; ?> 
                                                    </td>
                                                    <td> <?php echo $user['contact']; ?> </td>
                                                    <td> 
                                                        <?php 
                                                            if($user['user_name'] == 'Sagun') {
                                                                echo 'Action Not Allowed';
                                                            } else {
                                                        ?> 
                                                        <a href="<?php echo base_url();?>Admin/User/getUser/<?php echo $user['user_id']?>" class="btn btn-secondary btn-sm">Edit</a> | 
                                                         <a href="<?php echo base_url();?>Admin/User/deleteUser/<?php echo $user['user_id']?>" onclick="if (!confirm('Are you sure?')) { return false }" class="btn btn-secondary btn-sm"> Del </a>
                                                         <?php } ?>
                                                    </td>
                                                </tr>
                                                <?php $i = $i + 1; } 
                                                } else { ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        User Not Found.
                                                    </div>  
                                                <?php
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                </div>
                            </div> <!-- /.card -->
                        </div>  <!-- /.col-lg-8 -->
                    </div>
                </div>
                
                <?php if (isset($pageCount) && $pageCount > 1 && !empty($result)) { ?>
                        
                        <ul class="pagination justify-content-end" style="margin-right:10px;">
                            <?php if ($currentPage > 1) { ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo base_url();?>Admin/User/search/<?php echo $currentPage-1;?>/<?php echo $perPage;?>/<?php echo $search;?>" >Previous</a>
                            </li>
                            <?php } ?>
                            <?php for ($i=1; $i<=$pageCount; $i++) {
                                $class = ($i == $currentPage) ? 'active' : ''; ?>
                                <li class="page-item <?php echo $class?>">
                                    <a class="page-link " href="<?php echo base_url(); ?>Admin/User/search/<?php echo $i; ?>/<?php echo $perPage;?>/<?php echo $search;?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php
                                 } ?>  
                            <?php if ($currentPage < $pageCount) { ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo base_url();?>Admin/User/search/<?php echo $currentPage+1; ?>/<?php echo $perPage;?>/<?php echo $search;?>">Next</a>
                            </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        
    </div>
    <!-- /#right-panel -->
    <?php $this->load->view('System/Setup/Footer');?>