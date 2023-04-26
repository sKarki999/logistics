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
                    <h1 class="d-inline-block card-title">Booking Panel&nbsp;&nbsp;</h1>
                    <h3.5 class="d-inline-block font-weight-bold" >Update Invoice&nbsp;&nbsp;</h3.5>
                    <div class="col-md-2.1 float-right">
                        <a href="<?php echo base_url();?>Branch/Dashboard" class="btn btn-sm btn-secondary">Home</a>
                        <a href="<?php echo base_url();?>Branch/Booking" class="btn btn-sm btn-secondary" style="margin-left: 1em;color:white">Master Record</a>
                        <a href="<?php echo base_url();?>Branch/Booking/newBooking" class="btn btn-sm btn-secondary" style="margin-left: 1em;color:white">New Booking</a>
                    </div>
                </div>
            </div>

            <?php if($this->session->flashdata('msg')) {?>
                <div class="alert alert-success" role="alert" id="sessionMessage">
                    <h4 class="alert-heading"><?php echo $this->session->flashdata('msg');?></h4>
                </div> 
            <?php } ?>

            <section class="content" style="background: RGB(273, 267, 240);">	
                    <?php
                         if($invoice['0']['delivery_status'] != 'Reroute') {                   
                    ?>
                <form method="post" id="orderForm" action="<?php echo base_url(); ?>Branch/Booking/updateBillProcess/<?php echo $invoice['0']['invoice_id']?>">
                  <input type="hidden" name="prepared_on" value="<?php echo date("Y-m-d"); ?>" />
                    
                    
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                        <label for="validationDefault01">CN Number</label>
                        <input type="text" class="form-control" id="validationDefault01" placeholder="" value="" readonly>
                        </div>
                        <div class="col-md-3 mb-3">
                        <label for="validationDefault02">Cross Number</label>
                        <input type="text" class="form-control" name="cross_number" id="validationDefault02" placeholder="" 
                                value="<?php echo $invoice['0']['cross_number'];?>" >
                        </div>
                        <div class="col-md-3 mb-3">
                        <label for="validationDefault03">Date</label>
                        <input type="text" class="form-control" name="booking_updated_date" id="date" placeholder="" value="<?php echo $invoice['0']['booking_date'];?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault04">Category</label>
                            <select name="category" id="category" class="form-control" required>
                                <?php echo $invoice['0']['category']; ?>
                                <option value="Domestic">Domestic</option>
                                <option value="International">International</option>
                            </select>
                        </div>
                        <!-- <div class="col-md-3 mb-3">
                            <label for="date">Timezone</label>
                            <select name="time_zone" id="time_zone" class="form-control" required>
                                <option value='asia/kathmandu'>Asia/Kathmandu</option>
                                <?php 
                                    // if($timezones) {
                                    //     foreach($timezones as $timezone) {
                                ?>
                                    <option value="<?php //echo $timezone['timezone']?>"><?php //echo $timezone['timezone']; ?></option>
                                
                                <?php 
                                //     }
                                // }
                                ?>
                                    
                            </select>
                        </div> -->
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault05">Prepared By</label>
                            <input type="text" class="form-control" id="validationDefault05" name="prepared_by" value="<?php echo $this->session->userdata('fullname'); ?>" readonly>
                        </div>
                    </div>
                  
                    <div style="margin-top: 5px;">
                        <span class="font-weight-bold">Payment Mode</span>&nbsp;&nbsp;
                        <input type="radio" name="mode_of_payment" value="cod" checked />&nbsp;&nbsp;COD&nbsp;
                        <input type="radio" name="mode_of_payment" value="prepaid" />&nbsp;&nbsp;PREPAID&nbsp;
                    </div>
                    <hr />

                    <div class="row">
                        <div class="col-md-4">
                        <table>
                        <tr>
                          <td class="font-weight-bold">One Time Customer&nbsp;&nbsp;&nbsp;&nbsp;</td>
                          <td>
                            <input type="text" name="one_time_customer_name" class="form-control" id="one_time_customer_name" placeholder="" 
                                value="<?php echo $invoice['0']['one_time_customer'];?>" autofocus="true" />
                          </td>
                        </tr>
                        <tr>
                          <td class="font-weight-bold">Customer</td>
                          <td>
                            <select name="customer_id" id="customer" class="form-control" onChange="getCustomerAddress();">
                                <?php echo $invoice['0']['customer_name'];?>
                                <!-- <option value="">Choose Vendors</option> -->
                                <?php
                                if($customers){
                                    foreach($customers as $customer){
                                        ?>
                                        <option value="<?php echo $customer['customer_id']; ?>"> <?php echo $customer['customer_name']; ?></option>
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                          </td>
                          
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Customer Address</td>
                            <td>
                                <input type="text" name="customer_address" id="customer_address" class="form-control" 
                                    value="<?php echo $invoice['0']['customer_address'];?>" required/>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Customer Number</td>
                            <td>
                                <input type="text" name="customer_number" id="customer_number" class="form-control" 
                                    value="<?php echo $invoice['0']['customer_number'];?>" required/>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Origin Branch</td>
                            <td>
                            <input type="text" name="origin" value="<?php echo $this->session->userdata('branchName'); ?>" id="origin" class="form-control" readonly />
                            <input type="hidden" name="origin_name" value="<?php echo $this->session->userdata('branch_id'); ?>">
                            </td>
                        </tr>
                        
                        <tr>
                            <td class="font-weight-bold">Receiver Branch</td>
                            <td>
                                <select class="form-control" name="receiver_branch" id="receiver_branch" onChange="getBranchLocation();" required>
                                <?php echo $invoice['0']['receiver_branch'];?>
                                <?php
                                if($branches){
                                    foreach($branches as $branch){
                                        ?>
                                        <option value="<?php echo $branch['branch_id']; ?>"><?php echo $branch['branch_name']; ?></option>
                                    <?php
                                    }
                                }
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Branch Address</td>
                            <td>
                                <input type="text" name="branch_address" id="branch_address" class="form-control" value="<?php echo $invoice['0']['receiver_branch_address'];?>" required/>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Country</td>
                            <td>
                                <select class="form-control" name="receiver_country" id="receiver_country">
                                    <option value="">Receiver Country</option>
                                    <?php
                                        if($countries){
                                        foreach($countries as $country){
                                            ?>
                                            <option value="<?php echo $country['country_name']; ?>"><?php echo $country['country_name']; ?></option>
                                    <?php
                                    }
                                }
                                ?>
                                </select>
                            </td>
                        </tr>
                                <tr>
                                    <td class="font-weight-bold">City</td>
                                    <td>
                                        <input type="text" name="receiver_city" id="receiver_city" class="form-control" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Zip Code</td>
                                    <td>
                                        <input type="text" name="zip_code" id="zip_code" class="form-control" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">State</td>
                                    <td>
                                        <input type="text" name="receiver_state" id="receiver_state" class="form-control" required/>
                                    </td>
                                </tr>
                                <tr>
                                <td class="font-weight-bold">Receiver Name</td>
                                <td><input type="text" name="one_time_receiver_name" class="form-control" id="one_time_receiver" placeholder="Receiver Name" 
                                        value="<?php echo $invoice['0']['one_time_receiver'];?>" required/></td>
                                </tr>
                                <tr>
                                <td class="font-weight-bold">Dropoff Address</td>                            
                                <td>
                                    <input type="text" name="dropOff_address" id="dropOff_address" class="form-control" 
                                        value="<?php echo $invoice['0']['dropOff_address'];?>" required/>
                                </td>
                            </tr>
                                <tr>
                                <td class="font-weight-bold">Receiver Number</td>
                                
                                <td>
                                    <input type="text" name="receiver_number" id="receiver_number" class="form-control" 
                                        value="<?php echo $invoice['0']['receiver_number'];?>" required/>
                                </td>
                            </tr>

                        </table>
                            </div>
                            <div class="col-md-4 offset-md-4">
                                <table>
                                <tr>
                                    <td class="font-weight-bold">Type</td>
                                    <td>
                                        <input type="text" name="item_type" id="item_type" class="form-control" 
                                            value="<?php echo $invoice['0']['item_type'];?>" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Price</td>
                                    <td>
                                        <input type="text" name="item_price" value="<?php echo $invoice['0']['item_price'];?>" id="item_price" class="form-control" onChange="totalPrice();" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Quantity</td>
                                    <td>
                                        <input type="text" name="qty" value="<?php echo $invoice['0']['qty'];?>" id="qty" class="form-control" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Item Weight</td>
                                    <td>
                                        <input type="text" name="weight" value="<?php echo $invoice['0']['weight'];?>" id="weight" class="form-control" onChange="totalPrice();" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Rate/KG</td>    
                                    <td>
                                        <input type="text" name="rate" id="rate" value="<?php echo $invoice['0']['rate'];?>" class="form-control" onChange="totalPrice();" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Delivery Charge&nbsp;&nbsp;&nbsp;</td>
                                    <td>
                                        <input type="text" name="delivery_charge" id="delivery_charge" value="<?php echo $invoice['0']['delivery_charge'];?>" onChange="totalPrice();" class="form-control" onChange="totalPrice();" required/>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Total Amount</td>
                                    <td>
                                        <input type="text" name="total_amount" id="total" value="<?php echo $invoice['0']['total'];?>" class="form-control" />
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Mailing Mode</td>
                                    <td>
                                        <select name="mailing_mode" id="mailing_mode" class="form-control" >
                                        <option value="">Mailing Mode</option>
                                        <option value="Surface" selected>Surface</option>
                                        <option value="Air">By Air</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Delivery Status</td>
                                    <td>
                                        <select name="delivery_status" id="delivery_status" class="form-control" readonly>
                                            <option value="Pending">PENDING</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                       <div class="col-md-6 offset-md-3">
                            <i>Barcode generated by system automatically according to CN No.</i><br/><br/>
                            <button type="submit" id="confirm_save" class="btn btn-success" style="margin-left: 120px;"><i class="fa fa-save"></i>&nbsp;&nbsp;UPDATE ORDER</button>
                            <a href ="<?php echo base_url(); ?>Branch/Booking/newBooking" id="create_new" class="btn btn-info" style="margin-left: 15px;"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;CREATE NEW</a>
                        </div>
                    </div>
                    
                    
                </form>
                    <?php } else { ?>
                        <div class="alert alert-danger" role="alert">
                        This CN Number has already been routed to another address!
                        Please check the Routed Reference Code No: <span class="font-weight-bold"><?php echo '#' . $invoice['0']['refno'];?></span>
                      </div>    
                    <?php }?>
                <br /><br />
                <!-- print data dive -->
                
                <div id="p" style="display: none;">
                </div>
                <!-- end print data -->
                </section><!-- /.content -->


    
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        
    </div>
    <!-- /#right-panel -->
    <?php $this->load->view('System/branch/Footer');?>

    <script>

        function getCustomerAddress(){
            var customer_code = $("#customer").val();
            var url = "<?php echo base_url(); ?>Branch/Booking/getCustomerAddress";
                $.ajax({
                    type: "POST",
                    url: url,
                    async: true,
                    data: {customer_id : customer_code},
                    success : function(data) {
                        if(data){
                            var obj = JSON.parse(data);
                            $("#customer_address").val(obj.address);
                        }
                    }
                });
        }

        function getBranchLocation(){
            var receiver_branch = $("#receiver_branch").val();
            var url = "<?php echo base_url(); ?>Branch/Booking/getBranchLocation";
                $.ajax({
                    type: "POST",
                    url: url,
                    async: true,
                    data: {receiver_branch : receiver_branch},
                    //dataType: "json",
                    success : function(data) {
                        if(data){
                            var obj = JSON.parse(data);
                            $("#branch_address").val(obj.branch_address);

                        }
                    }
                }); 
        }

        $("#date").datepicker({ dateFormat: 'yy-mm-dd' });
        function preview(){
            var printContents = document.getElementById('p').innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            window.location = "<?php echo base_url(); ?>branch/booking/newBooking";
        }

        function totalPrice(){
            var itemPrice = $("#item_price").val();
            var weight = $("#weight").val();
            var rate = $("#rate").val();
            var deliveryCharge = parseInt(weight) * parseInt(rate);
            $("#delivery_charge").val(deliveryCharge);
            // console.log(deliveryCharge);
            var dc = $("#delivery_charge").val();
            total = parseInt(itemPrice) + parseInt(dc);
            $("#total").val(total);
        }

        $("#rate").keyup(function(){
            var itemPrice = $("#item_price").val();
            var weight = $("#weight").val();
            var rate = $("#rate").val();
            var deliveryCharge = parseInt(weight) * parseInt(rate);
            $("#delivery_charge").val(deliveryCharge);
            // console.log(deliveryCharge);
            var dc = $("#delivery_charge").val();
            total = parseInt(itemPrice) + parseInt(dc);
            $("#total").val(total);
        })

        $("#weight").keyup(function(){
            var itemPrice = $("#item_price").val();
            var weight = $("#weight").val();
            var rate = $("#rate").val();
            var deliveryCharge = parseInt(weight) * parseInt(rate);
            $("#delivery_charge").val(deliveryCharge);
            // console.log(deliveryCharge);
            var dc = $("#delivery_charge").val();
            total = parseInt(itemPrice) + parseInt(dc);
            $("#total").val(total);
        })

        $("#delivery_charge").keyup(function(){
            var itemPrice = $("#item_price").val();
            var weight = $("#weight").val();
            var rate = $("#rate").val();
            var deliveryCharge = parseInt(weight) * parseInt(rate);
            $("#delivery_charge").val(deliveryCharge);
            // console.log(deliveryCharge);
            var dc = $("#delivery_charge").val();
            total = parseInt(itemPrice) + parseInt(dc);
            $("#total").val(total);
        })

        // $("#rate,#weight,#delivery_charge").keyup(function(){
        //     var weight = $("#weight").val();
        //     var rate = $("#rate").val();
        //     var dc = $("#delivery_charge").val();
        //     total = parseInt(weight) * parseInt(rate) + parseInt(dc);
        //     $("#total").val(total);
        // })

        $("#one_time_customer_name").keyup(function(){
                var len = $(this).val();
                if(len.length > 0 ) {
                    $("#customer").prop('disabled', true);
                } else {
                    $("#customer").prop('disabled', false);
                }
        })

        $("#customer").blur(function(){
            if($(this).val()) {
                $("#one_time_customer_name").prop('disabled', true);
            } else {
                $("#one_time_customer_name").prop('disabled', false);
            }
        })

        $("#category").blur(function(){
            if( $(this).val() == 'Domestic' ) {
                $("#receiver_country").prop('disabled', true).val('');
                $("#receiver_city").prop('disabled', true).val('');
                $("#zip_code").prop('disabled', true).val('');
                $("#receiver_state").prop('disabled', true).val('');
            } else {
                $("#receiver_country").prop('disabled', false).val('');
                $("#receiver_city").prop('disabled', false).val('');
                $("#zip_code").prop('disabled', false).val('');
                $("#receiver_state").prop('disabled', false).val('');
            }
        })
        
    </script>