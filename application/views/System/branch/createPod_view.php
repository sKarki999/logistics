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
                    <h1 class="d-inline-block card-title">POD Entry&nbsp;&nbsp;</h1>
                    <h3.5 class="d-inline-block font-weight-bold" ><?php echo $this->session->userdata('branchName');?>&nbsp;&nbsp;</h3.5>
                    <div class="col-md-2.1 float-right">
                        <a href="<?php echo base_url();?>Branch/Pod/masterRecord" class="btn btn-sm btn-secondary"  style="margin-left: 1em;color:white;">Master Record</a>
                    </div>
                </div>
            </div>

            <?php if($this->session->flashdata('msg')) {?>
                <div class="alert alert-success" role="alert" id="sessionMessage">
                    <h4 class="alert-heading"><?php echo $this->session->flashdata('msg');?></h4>
                </div> 
            <?php } ?>

            <section class="content" style="background: RGB(273, 267, 240);">
                <!-- <h4 class="d-inline-block mb-5" style="text-color:gray;">CREATE DELIVERY RUNSHEET ACCORDING TO CN NUMBER&nbsp;&nbsp;</h4> -->
                <?php
                    $PodNo = 10000;
                    if($pod_number){
                    $PodNo = $pod_number['pod_number'] + 1;
                    }
                ?>
                <form method="post" id="podForm" action="<?php echo base_url(); ?>Branch/Pod/SavePod">
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="date">Date</label>
                            <input type="text" class="form-control" name="pod_entry_date" id="date" value="<?php echo date("Y-m-d"); ?>" required>
                        </div>
                        <div class="col-md-3 mb-5">
                            <label for="validationDefault02">POD NO</label>
                            <input type="text" class="form-control" name="pod_number" value ="<?php echo $PodNo; ?>" readonly>
                        </div>
                        <!-- <div class="col-md-3 mb-5">
                            <label for="validationDefault04">DELIVERY</label>
                            <select name="delivery_personnel" id="delivery" class="form-control">
                                <option value="1">Susan Pradhan</option>
                                <?php
                                    //foreach($branches as $branch) {
                                ?>
                                    <option value="<?php //echo $branch['branch_id'];?>"><?php //echo $branch['branch_name'];?></option>
                                <?php
                                    //}
                                ?>
                            </select>
                        </div> -->
                    </div>
                    <div class="form-row mb-5">
                        <div class="col-md-6 mb-3">
                            <label for="">SCAN CN NUMBERS</label>
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fa fa-barcode"></i></div>
                                <input type="text" class="form-control" id="cnn" placeholder="Scan your CN number" onChange="getCnDetails();">
                            </div>
                        </div>
                    </div>
                    <hr style="border: 1px solid black;" />
                    <div class="box-body table-responsive" style="margin-top: -10px;">
                        <table class="table table-bordered" id="mytable" style="background: #3c8dbc;color:white;">
                        <thead>
                            <tr style="background:#3c8dbc;color: white;">
                                <th>CN NO.</th><th>RECEIVER</th><th>DROPOFF ADDRESS</th><th>CONTACT</th><th>HANDED TO</th><th>SIGN/STAMP</th>
                            </tr>
                        </thead>
                            <tbody>
                            <tr id="scanhead">
                                <td colspan="7"><b>No Scanned Data Found !..</b></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
                <div style="margin-top: 5px;">
                    <input type="button" name="pod" id="pod" class="btn btn-primary" value="SAVE POD" />  
                </div>
            </section>

        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        
    </div>
    <!-- /#right-panel -->
    <?php $this->load->view('System/branch/Footer');?>

<script>

    $("#date").datepicker({ dateFormat: 'yy-mm-dd' });
    
    var scanheadFlag = 0;
    function getCnDetails(){
        var cnn = $("#cnn").val();
        var url = "<?php echo base_url(); ?>Branch/Pod/getRequiredCnn";
        $.ajax({
            type: "POST",
            url: url,
            async: true,
            data: {cn : cnn},
            dataType: "html",
            success : function(data) {
                    if(data == 0){
                            alert("CNN NOT MATCHED !!");
                            return false;
                    }
                    scanheadFlag = 1;
                    if(scanheadFlag == 1){
                        $("#scanhead").hide();
                    }
                var obj = JSON.parse(data);
                document.getElementById("mytable").insertRow(-1).innerHTML = '<td><input type="hidden" name="cnno[]" value="'+obj.bill_number+'" />'+obj.bill_number 
                +'</td><td><input type="hidden" name="receiver_name[]" value="'+obj.one_time_receiver+'" />'+obj.one_time_receiver 
                +'</td><td><input type="hidden" name="address[]" value="'+obj.dropOff_address+'" />'+obj.dropOff_address 
                +'</td><td><input type="hidden" name="contact[]" value="'+obj.receiver_number+'" />'+obj.receiver_number
                +'</td><td><input type="text" name="handedTo[]" class="form-control" id="received">'
                +'</td><td><select name="csig[]" id="csig" class="form-control"><option value="Pending">Signature</option><option value="Pending">Stamp</option></select></td>';
                $("#cnn").val("");
                $("#cnn").focus();
            }
        });    
    }
    $("#pod").click(function(){
        if(scanheadFlag == 1) {
            $("#podForm").submit();
        } else {
            alert('No scanned Data..!!')
        } 
    });
</script>