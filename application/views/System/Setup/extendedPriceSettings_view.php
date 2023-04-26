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
                    <h1 class="d-inline-block card-title">Price Settings Panel&nbsp;&nbsp;</h1>
                    <h3.5 class="d-inline-block font-weight-bold" >
                        <?php 
                            $branchName = $this->BranchModel->getBranchById($branch_id); 
                            if($branchName != null) {
                                echo $branchName['0']['branch_name'];
                            }
                        ?>&nbsp;&nbsp;</h3.5>
                </div>
            </div>

            <?php if($this->session->flashdata('error')) {?>
                <div class="mt-3" id="sessionMessage">    
                    <div class="card-header alert alert-danger">
                        <h6 class="d-inline-block card-title">
                            <?php echo $this->session->flashdata('error');?>
                        </h6>
                    </div>
                </div>
            <?php } ?>
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <!-- <div class="row mb-5">
                    
                    <div class="col-lg-4 col-md-8">
                         <form action="<?php //echo base_url();?>Admin/Location/search" method="post">
                            <div class="input-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Search Location" name="searchLocation" 
                                        value = "<?php //echo isset($search) ? $search : ''; ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-btn">
                                            <button class="btn btn-secondary"  id="locationsPerPage" type="submit">Search</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> -->
                
                <!-- /Widgets -->
                
                <div class="clearfix"></div>
                <!-- Orders -->
                <form method="post" action="<?php echo base_url(); ?>Admin/PriceSettings/savePrice/<?php echo $branch_id;?>" id="savePirce">
                    <button type="submit" class="btn btn-secondary mb-3">Update Price</button>
                    <div class="orders">
                        <div class="row">
                            <div class="col-xl-8">
                                <div class="card">
                                    <div class="card-body--">
                                        
                                            <table class="table table-striped">
                                                <thead class='font-weight-bold' style="background:#9BB7D4;">
                                                    <tr>
                                                        <th style="width: 35px;"><input type="checkbox" id="checkall" /></th>
                                                        <!-- <th>Serial</th> -->
                                                        <th>Location Name</th>
                                                        <th>Price(KG)&nbsp;<a href="javascript:void(0);" onclick="priceClone();"><span class="badge" style="background: white;">clone</span></a></th></th>
                                                        <!-- <th>Action</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $i = 0;
                                                        $sn = 0;
                                                        foreach($locations as $location) {    
                                                        $sn = $sn + 1;
                                                        ?>
                                                    <tr> 
                                                        <td style="width: 35px;"><nobr><input type="checkbox" name="indexnum[]" value="<?php echo $i; ?>" class="checkboxcnn" />
                                                        <input type="hidden" name="location[]" value="<?php echo $location['location_id']; ?>" />
                                                        </nobr>
                                                        </td>
                                                        <!-- <td class="serial"><?php //echo $i; ?></td>                                                 -->
                                                        <td> <?php echo $location['location_name']; ?> </td>
                                                        <td> <input type="text" name="price[]" id="price_<?php echo $sn; ?>" style="width: 100px;"
                                                            value = "<?php
                                                                $price = $this->PriceSettingsModel->getLocationPrice($branch_id, $location['location_id']);
                                                                if($price != null) {
                                                                echo $price['0']['location_price'];
                                                                } else {
                                                                echo '';
                                                                }
                                                            ?>"> 
                                                        </td>
                                                    
                                                        <!-- <td> <button type="submit">submit</button> </td> -->
                                                        <!-- <td> <a href="<?php //echo base_url();?>Admin/PriceSettings/savePrice/<?php //echo $location['location_id'];?>" class="btn btn-secondary btn-sm">Save</a></td> -->
                                                    </tr>
                                                    <?php $i = $i + 1; } ?>
                                                </tbody>
                                            </table>
                                            <input type="hidden" id="totallengthamount" value="<?php echo $sn; ?>">
                                    </div>
                                </div> <!-- /.card -->
                            </div>  <!-- /.col-lg-8 -->
                        </div>
                    </div>
                </form>
            </div>
            <!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        
    </div>
    <!-- /#right-panel -->
    <?php $this->load->view('System/Setup/Footer');?>


    <script>

        $("#checkall").change(function(){
            var check = $(this).is(':checked');
            if(check){
            $(".checkboxcnn").each(function(){
                $(this).prop("checked",true);
                });  
            }else{
                $(".checkboxcnn").each(function(){
                $(this).prop("checked",false);
                });
            }
        });

        function priceClone(){
            var total = $("#totallengthamount").val();
            var firstValue = $("#price_1").val();
            for(i = 1; i<= total; i++){
                $("#price_"+i).val(firstValue);
            } 
        }



   </script>