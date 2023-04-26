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
                    <h1 class="d-inline-block card-title">Location Panel&nbsp;&nbsp;</h1>
                    <a href="<?php echo base_url();?>Admin/Location/addLocation" class="btn btn-sm btn-secondary mb-2"><span class='fa fa-plus-circle'> Add Location</span></a>
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
                    <div class="col-lg-3 col-md-6">
                        <!-- <a href="<?php echo base_url();?>Admin/User/addUser" class="btn mb-5" style="background:#9BB7D4;color:black;"><span class='fa fa-plus-circle'> Add User</span></a> -->
                        <form action="<?php echo base_url();?>Admin/Location" method="post">
                            <div class="input-group">
                                
                                <select class="form-control" name="selectPerPage" id="selectUsersPerPage">
                                    <option value="0">Records per page</option>
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                </select>
                                
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary"  id="UsersPerPage" type="submit">Apply</button>
                                </span>
                            </div>
                        </form>
                        <?php if ($pageCount > 0) {?>
                        <h6 class="text-dark mt-3 ml-1">
                        <span class="card-title text-muted">Showing '<?php if (isset($perPage)) { echo $perPage; } ?>' records per Page 
                        </span></h6>
                        <?php } ?>
                    </div>

                    <div class="col-lg-4 col-md-8">
                         <form action="<?php echo base_url();?>Admin/Location/search" method="post">
                            <div class="input-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Search Location" name="searchLocation" 
                                        value = "<?php echo isset($search) ? $search : ''; ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-btn">
                                            <button class="btn btn-secondary"  id="locationsPerPage" type="submit">Search</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- /Widgets -->
                
                <div class="clearfix"></div>
                <!-- Orders -->
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-9">
                            <div class="card">
                                <div class="card-body--">
                                        <table class="table table-striped">
                                            <thead class='font-weight-bold' style="background:#9BB7D4;">
                                                <tr>
                                                    <th>Serial</th>
                                                    <th>Location Name</th>
                                                    <th>Category</th>
                                                    <th>Location Type</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $i = (($currentPage - 1) * $perPage) + 1;
                                                    foreach($result as $location) {    
                                                    // print_r($users);
                                                    ?>
                                                <tr> 
                                                    <td class="serial"><?php echo $i; ?></td>
                                                    <td> <?php echo $location['location_name']; ?> </td>
                                                    <td> 
                                                        <?php if($location['category'] == '0') echo 'Domestic';
                                                              if($location['category'] == '1') echo 'International'; ?>      
                                                    </td>
                                                    <td> <?php echo $location['location_type']; ?> </td>
                                                    <td> <a href="<?php echo base_url();?>Admin/Location/getLocation/<?php echo $location['location_id'];?>" class="btn btn-secondary btn-sm">Edit</a> | 
                                                         <a href="<?php echo base_url();?>Admin/Location/deleteLocation/<?php echo $location['location_id'];?>" class="btn btn-secondary btn-sm" onclick="if (!confirm('Are you sure?')) { return false }"> Del </a>
                                                    </td>
                                                </tr>
                                                <?php $i = $i + 1; } ?>
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
                                <a class="page-link" href="<?php echo base_url();?>Admin/Location/index/<?php echo $currentPage-1;?>/<?php echo $perPage;?>" >Previous</a>
                            </li>
                            <?php } ?>
                            <?php for ($i=1; $i<=$pageCount; $i++) {
                                $class = ($i == $currentPage) ? 'active' : ''; ?>
                                <li class="page-item <?php echo $class?>">
                                    <a class="page-link " href="<?php echo base_url(); ?>Admin/Location/index/<?php echo $i; ?>/<?php echo $perPage;?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php
                                 } ?>  
                            <?php if ($currentPage < $pageCount) { ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo base_url();?>Admin/Location/index/<?php echo $currentPage+1; ?>/<?php echo $perPage;?>">Next</a>
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