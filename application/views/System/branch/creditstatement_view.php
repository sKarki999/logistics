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
                    <h1 class="d-inline-block card-title">Credit Statement Panel&nbsp;&nbsp;</h1>
                    <h3.5 class="d-inline-block font-weight-bold" ><?php echo $this->session->userdata('branchName');?>&nbsp;&nbsp;</h3.5>
                    <div class="col-md-2.1 float-right">
                        <a href="<?php echo base_url();?>Branch/Dashboard" class="btn btn-sm btn-secondary" style="color:white;">Home</a>
                    </div>
                </div>
            </div>
            
            <section class="content" style="background: RGB(273, 267, 240);">	
                <form method="post" id="orderForm" action="<?php echo base_url(); ?>Branch/CreditStatement/process">
                  <input type="hidden" name="prepared_on" value="<?php echo date("Y-m-d"); ?>" />
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                        <label for="">Statement Number</label>
                        <input type="text" class="form-control" id="statementNumber" placeholder="" value="<?php echo rand(100, 1000); ?>" readonly>
                        </div>
                        <div class="col-md-3 mb-3">
                        <label for="">Date</label>
                        <input type="text" class="form-control" name="date_create" id="date_create" value="<?php echo date("Y-m-d"); ?>" readonly>
                        </div>
                        <div class="col-md-3 mb-3">
                        <label for="">Vendor</label>
                            <select type="text" class="form-control" name="customer" id="customer" placeholder="" required>
                                <option value="">Choose a Vendor</option>
                                <?php 
                                    if($customers) {
                                        foreach($customers as $customer) {
                                ?>
                                    <option value="<?php echo $customer['customer_id'];?>"><?php echo $customer['customer_name']; ?></option>
                                <?php            
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="date">From Date</label>
                            <input type="text" class="form-control" name="date_from" id="date_from" value="<?php echo date("Y-m-d"); ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                        <label for="date">To Date</label>
                        <input type="text" class="form-control" name="date_to" id="date_to" value="<?php echo date("Y-m-d"); ?>" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault05">Prepared By</label>
                            <input type="text" class="form-control" id="validationDefault05" name="prepared_by" value="<?php echo $this->session->userdata('fullname'); ?>" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mt-3">
                        <a href="javascript:void(0);" class="btn btn-warning" id="creditstatement"><i class="fa fa-list"></i>&nbsp;&nbsp;CREATE STATEMENT</a></td></tr>
                        </div>
                    </div>
                    <hr><br><br>
                    <div id="extend">
                    </div>
                    <button class="btn btn-success" id="credit" name="save" disabled><i class="fa fa-save"></i>&nbsp;&nbsp;SAVE STATEMENT</button>
                </form>
            </section>
        <div class="clearfix"></div>
    </div>
    <!-- /#right-panel -->
    <?php $this->load->view('System/branch/Footer');?>
    
<script type="text/javascript">
  $("#date_from").datepicker({ dateFormat: 'yy-mm-dd' });
  $("#date_to").datepicker({ dateFormat: 'yy-mm-dd' });
  
   $("#extend").load("<?php echo base_url(); ?>Branch/CreditStatement/extended");
    $("#creditstatement").click(function(){
        var customer = $("#customer").val();
        var date_from = $("#date_from").val();
        var date_to = $("#date_to").val();
        if(!customer){
            $.alert.open('Choose Customer !..');
            $("#customer").focus();
            return false;
        }
        
        $("#extend").load("<?php echo base_url(); ?>Branch/CreditStatement/extended/"+customer+"/"+date_from+"/"+date_to, function(responseTxt, statusTxt, jqXHR){
         });
    });

    $("#credit").click(function(){
        var customer = $("#customer").val();
        var totallen = $("#len").val();
        var flag = true;
        if(!customer){
            $.alert.open('Choose Customer !..');
            $("#customer").focus();
            return false;
            
        }
        for(i = 1; i<= totallen; i++){
          var tax = $("#total_"+i).val();
          if(!tax){
            alert("Total amount empty !");
            $("#total_"+i).focus();
            return false;
          }
        }
        if(flag == true){
          $("#statement_add").submit();
        }
    });



    // function taxBox(id){
    //     var taxamt = id.split("_");
    //     var amount = $("#"+id).val();
    //     vatamount = amount * 0.13;
    //     totalamount = Number(amount) + Number(vatamount);
    //     $("#total_"+taxamt[1]).val(totalamount);
    // }

// function totalclone(){
//   var total = $("#totallengthamount").val();
//   var firstValue = $("#total_1").val();
//   for(i = 1; i<= total; i++){
//     $("#total_"+i).val(firstValue);
//   }
// }

// function remarksclone(){
//  var total = $("#totallengthamount").val();
//   var firstValue = $("#remarks_1").val();
//   for(i = 1; i<= total; i++){
//     $("#remarks_"+i).val(firstValue);
//   } 
// }

</script>

    