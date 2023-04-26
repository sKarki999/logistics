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
                    <h1 class="d-inline-block card-title">Manifest Detail&nbsp;&nbsp;</h1>
                    <h3.5 class="d-inline-block font-weight-bold" ><?php echo $this->session->userdata('branchName');?>&nbsp;&nbsp;</h3.5>
                    <div class="col-md-2.1 float-right">
                        <a href="<?php echo base_url();?>Branch/Manifest" class="btn btn-sm btn-secondary"  style="margin-left: 1em;color:white;">Create</a>
                    </div>
                </div>
            </div>

            <?php if($this->session->flashdata('msg')) {?>
                <div class="alert alert-success" role="alert" id="sessionMessage">
                    <h4 class="alert-heading"><?php echo $this->session->flashdata('msg');?></h4>
                </div> 
            <?php } ?>

            <section class="content" style="background: RGB(273, 267, 240);">
            <div class="orders">
                        <div class="row">
                            <div class="col-xl">
                                <div class="card">
                                    <div class="card-body-- table-responsive">
                                            <table class="table table-striped table-bordered" id="requestTable">
                                                <thead class='font-weight-bold' style="background:#A0DAA9;" >
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>MANIFEST NUMBER</th>
                                                        <th>CN NUMBER</th>
                                                        <th>CREATED DATE</th>
                                                        <th>RECEIVER HUB</th>
                                                        <th>TOTAL CNNO</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $serial = 0;
                                                        if($manifests != null) {
                                                        foreach($manifests as $manifest) {
                                                            $serial++;
                                                    ?>
                                                    <tr> 
                                                        <td><?php echo $serial; ?></td>
                                                        <td>
                                                            <?php 
                                                                echo $manifest['manifest_number'];
                                                            ?>
                                                        </td>
                                                        <td><?php echo $manifest['cnno'];?></td>
                                                        <td><?php echo $manifest['booked_on'];?></td>
                                                        <td>
                                                            <?php 
                                                                $branchName = $this->BranchModel->getBranchById($manifest['receiver_branch']);
                                                                echo $branchName['0']['branch_name'];
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                $countCnn = $this->ManifestModel->getCnnCount($manifest['mfno']);
                                                                echo $countCnn;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php  } 
                                                        } else {
                                                    ?>
                                                    <div class="card-body">
                                                        No Manifest at the moment.
                                                        <script> $("#requestTable").hide();</script>
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
                
                
            </section>

        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        
    </div>
    <!-- /#right-panel -->
    <?php $this->load->view('System/branch/Footer');?>
