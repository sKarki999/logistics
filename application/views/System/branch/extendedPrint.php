<?php $this->load->view('System/branch/Header');?>
<?php $this->load->view('System/branch/sidebar');?>
    <div id="right-panel" class="right-panel">
        <?php $this->load->view('System/branch/nav');?>
        <!-- Content -->
        <div class="content">
            <div class="card mt-3">
                <div class="card-header" style="background:#A0DAA9;">
                    <h1 class="d-inline-block card-title">Booking Panel&nbsp;&nbsp;</h1>
                    <h3.5 class="d-inline-block font-weight-bold" ><?php echo $this->session->userdata('branchName');?>&nbsp;&nbsp;</h3.5>
                    <div class="col-md-2.1 float-right">
                        <a href="<?php echo base_url();?>Branch/Dashboard" class="btn btn-sm btn-secondary">Home</a>
                        <a href="<?php echo base_url();?>Branch/Booking" class="btn btn-sm btn-secondary"  style="margin-left: 1em">Master Record</a>
                        <a href="<?php echo base_url();?>Branch/Booking/newBooking" class="btn btn-sm btn-secondary" style="margin-left: 1em">New Booking</a>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <section class="content">
                    <?php
                        if($invoiceDetails['0']['delivery_status'] != 'Reroute') {                   
                    ?>
                    <span>
                        <div class="row" id="shipPrint" style="height: auto;font-size: 13px;">  
                            <div id="cnbill" style="border:solid black;margin-bottom:20px;width:800px;height: 450px;margin-left: 10px;">
                                <div id="content" style="height: 396px;">
                                    <div style="margin-top: 50px;">
                                        <span style="margin-left: 20px;">
                                            <h3 style="margin-left: 75px;margin-top: -60px;"><b>Efficient Delivery Approach (SHIPPING)</b></h3>
                                            <hr style="border:1px dotted black;margin-top: 10px;width: 555px;margin-left: 0px;" />
                                            <p style="margin-left: 105px;margin-top: -15px;">
                                            <?php echo $branch_info['branch_address']; ?>
                                            , Nepal | Tel : <?php echo $branch_info['branch_contact']; ?> 
                                            </p>
                                        </span>
                                    </div>
                                    <hr style="border: 1px solid black;width: 558px;margin-left: -2px;margin-top: -3px;" />
                                    <div id="sr" style="width: 557px;height:170px;margin-top:-20px;border-bottom: 2px solid black;">
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    <span style="font-size: 13px;">
                                                    Origin : <?php echo $this->session->userdata("branchName"); ?><br />    
                                                    Vendor Name : 
                                                    <?php
                                                        if($invoiceDetails['0']['one_time_customer']){ 
                                                            echo strtoupper($invoiceDetails['0']['one_time_customer']); 
                                                        }else{
                                                            $customerName = $this->InvoiceModel->getColHead('tbl_customer','customer_id',$invoiceDetails['0']['customer_id'],'customer_name');
                                                            echo $customerName['customer_name'];
                                                        }
                                                        ?>
                                                    <br />
                                                    Number : <?php  echo $invoiceDetails['0']['customer_number']; ?><br />
                                                    Address : <?php echo $invoiceDetails['0']['customer_address']; ?><br />
                                                    </span>
                                                </td>
                                                <td>
                                                    Receiver Branch : <?php
                                                                            $branchName = $this->InvoiceModel->getColHead('tbl_branch','branch_id',$invoiceDetails['0']['receiver_branch_id'],'branch_name');
                                                                            echo $branchName['branch_name']; 
                                                                            
                                                                        ?><br />
                                                    <span style="font-size: 13px;">
                                                    Customer Name : 
                                                        <?php
                                                        if($invoiceDetails['0']['one_time_receiver']){ 
                                                            echo strtoupper($invoiceDetails['0']['one_time_receiver']); 
                                                        }
                                                        ?>
                                                    <br />
                                                    Number : <?php echo $invoiceDetails['0']['receiver_number']; ?><br />
                                                    Country : <?php echo ($invoiceDetails['0']['receiver_country']) ? $invoiceDetails['0']['receiver_country'] : 'XXX (Domestic)'; ?><br />
                                                    City : <?php echo ($invoiceDetails['0']['receiver_city']) ? $invoiceDetails['0']['receiver_city'] : 'XXX'; ?><br />
                                                    Zip Code : <?php echo ($invoiceDetails['0']['zip_code']) ? $invoiceDetails['0']['zip_code'] : 'XXX'; ?><br />
                                                    Address : <?php echo $invoiceDetails['0']['dropOff_address']; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <table border="1px solid black" style="margin-top: 20px;margin-left:18px;border: 1px solid black;width: 520px;">
                                        <tr>
                                            <td align="center"><b>Mailing Mode</b></td><td align="center"><?php echo $invoiceDetails['0']['mailing_mode']; ?></td><td align="center"><b>Payment Mode</b></td><td align="center"><?php echo $invoiceDetails['0']['payment_mode']; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="center"><b>Product Name</b></td><td align="center"><?php echo $invoiceDetails['0']['item_type']; ?></td><td align="center"><b>Quantity</b></td><td align="center"><?php echo $invoiceDetails['0']['qty']; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="center"><b>Booked On : </b>&nbsp;&nbsp;&nbsp;<?php echo $invoiceDetails['0']['booking_date']; ?> &nbsp;&nbsp;&nbsp;&nbsp;</td><td align="center"><b>Order Number : </b><?php echo $invoiceDetails['0']['bill_number']; ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- barside -->
                                <div id="navbar" style="border-left:solid black;width:30%;height:445px;margin-top: -446px;float: right">
                                    <div id="bcode" style="border-bottom:solid black; height: 200px;">
                                        <p align="center" style="margin-top:10px; margin-left:-15px; font-size: 25px;" class="mb-5">
                                            <b>CNN</b>
                                        </p> 
                                        <p>                                    
                                        <div id="shippingDemo_<?php echo $invoiceDetails['0']['bill_number']; ?>" style="margin-left: 15px;margin-top : 10px;"></div>
                                        <script type="text/javascript">
                                                var value = "<?php echo $invoiceDetails['0']['bill_number']; ?>";
                                                $("#shippingDemo_"+<?php echo $invoiceDetails['0']['bill_number']; ?>).barcode(value,"code128");
                                        </script>
                                        </p>
                                    </div>
                                    <div id="tc">
                                        <p align="center" style="margin-top: 5px;font-size: 12px;" class="mb-5">
                                        <b>Scan QR For Update:</b>
                                        </p>
                                        <p>
                                        <div id="qrcodeTable" style="margin-left: 17px;margin-top : 7px;"></div>
                                        <script type="text/javascript">
                                            jQuery('#qrcodeTable').qrcode({
                                                render  : "table",
                                                text    : "MasterThesis/LMS/<?php echo $invoiceDetails['0']['bill_number']; ?>",
                                                width   : 200,
                                                height  : 120
                                            });
                                        </script>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="" id="shipping" class="btn btn-primary" onClick="shippingPreview();"><i class="fa fa-print"></i>&nbsp;&nbsp;PRINT</a>
                        <br><br>
                        <p>******************************************************************************************</p>
                        <br>
                        <div class="row" id="podPrint" style="height: auto;font-size: 13px;">  
                            <div id="cnbill" style="border:solid black;margin-bottom:20px;width:800px;height: 450px;margin-left: 10px;">
                                <div id="content" style="height: 396px;">
                                    <div style="margin-top: 50px;">
                                        <span style="margin-left: 20px;">
                                            <h3 style="margin-left: 105px;margin-top: -60px;"><b>Efficient Delivery Approach (POD)</b></h3>
                                            <hr style="border:1px dotted black;margin-top: 10px;width: 555px;margin-left: 0px;" />
                                            <p style="margin-left: 105px;margin-top: -15px;">
                                            <?php echo $branch_info['branch_address']; ?>
                                            , Nepal | Tel : <?php echo $branch_info['branch_contact']; ?> 
                                            </p>
                                        </span>
                                    </div>
                                    <hr style="border: 1px solid black;width: 558px;margin-left: -2px;margin-top: -3px;" />
                                    <div id="sr" style="width: 557px;height:170px;margin-top:-20px;border-bottom: 2px solid black;">
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    <span style="font-size: 13px;">
                                                    Origin : <?php echo $this->session->userdata("branchName"); ?><br />    
                                                    Vendor Name : 
                                                    <?php
                                                        if($invoiceDetails['0']['one_time_customer']){ 
                                                            echo strtoupper($invoiceDetails['0']['one_time_customer']); 
                                                        }else{
                                                            $customerName = $this->InvoiceModel->getColHead('tbl_customer','customer_id',$invoiceDetails['0']['customer_id'],'customer_name');
                                                            echo $customerName['customer_name'];
                                                        }
                                                        ?>
                                                    <br />
                                                    Number : <?php  echo $invoiceDetails['0']['customer_number']; ?><br />
                                                    Address : <?php echo $invoiceDetails['0']['customer_address']; ?><br />
                                                    </span>
                                                </td>
                                                <td>
                                                    Receiver Branch : <?php
                                                                            $branchName = $this->InvoiceModel->getColHead('tbl_branch','branch_id',$invoiceDetails['0']['receiver_branch_id'],'branch_name');
                                                                            echo $branchName['branch_name']; 
                                                                            
                                                                        ?><br />
                                                    <span style="font-size: 13px;">
                                                    Customer Name : 
                                                        <?php
                                                        if($invoiceDetails['0']['one_time_receiver']){ 
                                                            echo strtoupper($invoiceDetails['0']['one_time_receiver']); 
                                                        }
                                                        ?>
                                                    <br />
                                                    Number : <?php echo $invoiceDetails['0']['receiver_number']; ?><br />
                                                    Country : <?php echo ($invoiceDetails['0']['receiver_country']) ? $invoiceDetails['0']['receiver_country'] : 'XXX (Domestic)'; ?><br />
                                                    City : <?php echo ($invoiceDetails['0']['receiver_city']) ? $invoiceDetails['0']['receiver_city'] : 'XXX'; ?><br />
                                                    Zip Code : <?php echo ($invoiceDetails['0']['zip_code']) ? $invoiceDetails['0']['zip_code'] : 'XXX'; ?><br />
                                                    Address : <?php echo $invoiceDetails['0']['dropOff_address']; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <table border="1px solid black" style="margin-top: 15px;margin-left:18px;border: 1px solid black;width: 520px;">
                                        <tr>
                                            <td align="center"><b>Mailing Mode</b></td><td align="center"><?php echo $invoiceDetails['0']['mailing_mode']; ?></td><td align="center"><b>Payment Mode</b></td><td align="center"><?php echo $invoiceDetails['0']['payment_mode']; ?></td>
                                        </tr>
                                        <tr>
                                        <td align="center"><b>Total Collectable Amount</b></td><td align="center"><b>NRs. <?php echo $invoiceDetails['0']['total']; ?></b></td><td align="center"><b>Quantity</b></td><td align="center"><?php echo $invoiceDetails['0']['qty']; ?></td>
                                        </tr>
                                        <tr>
                                        <td align="center"><b>Total Collectable Amount</b></td><td align="center"><b>NRs. </b></td></td><td align="center"><b>Weight</b></td><td align="center"><?php echo $invoiceDetails['0']['weight']; ?></td>
                                        </tr>
                                    </table>
                                    <p style="margin-left: 8px;font-size: 12px;margin-top: 10px;">
                                    POD Copy send to Origin<br />
                                    <?php echo $invoiceDetails['0']['prepared_by']; ?><br />
                                    <?php echo $invoiceDetails['0']['booking_date']; ?>
                                    </p>
                                </div>
                                <!-- barside -->
                                <div id="navbar" style="border-left:solid black;width:30%;height:445px;margin-top: -446px;float: right">
                                    <div id="bcode" style="border-bottom: solid black;height: 200px;">
                                        <p align="center" style="margin-top:10px; margin-left:-15px; font-size: 25px;" class="mb-5">
                                            <b>CNN</b>
                                        </p> 
                                        <p>                                    
                                        <div id="podDemo_<?php echo $invoiceDetails['0']['bill_number']; ?>" style="margin-left: 15px;margin-top : 10px;"></div>
                                        <script type="text/javascript">
                                                var value = "<?php echo $invoiceDetails['0']['bill_number']; ?>";
                                                $("#podDemo_"+<?php echo $invoiceDetails['0']['bill_number']; ?>).barcode(value,"code128");
                                        </script>
                                        </p>
                                    </div>
                                    <div id="tc">
                                        <p align="center" style="margin-top: 5px;font-size: 12px;">
                                        <b>Received in good condition:</b>
                                        </p>
                                        <p style="margin-left:8px;font-size: 11px;margin-top: 10PX;">
                                            Name : 
                                        </p>
                                        <p style="margin-left:8px;font-size: 11px;margin-top: 10PX;">
                                            Date : 
                                        </p>
                                        <p style="margin-left:8px;font-size: 11px;margin-top: 10PX;">
                                            Contact Number : 
                                        </p>
                                        <p style="margin-left:8px;font-size: 11px;margin-top: 10PX;">
                                            Signature | Stamp : 
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="" id="podPrint" class="btn btn-primary" onClick="podPreview();"><i class="fa fa-print"></i>&nbsp;&nbsp;PRINT</a>
                        <br><br>
                        <p>******************************************************************************************</p>
                        <br>
                        <div class="row" id="cnnPrint" style="height: auto;font-size: 13px;">  
                            <div id="cnbill" style="border:solid black;margin-bottom:20px;width:800px;height: 450px;margin-left: 10px;">
                                <div id="content" style="height: 396px;">
                                    <div style="margin-top: 50px;">
                                        <span style="margin-left: 20px;">
                                            <h3 style="margin-left: 105px;margin-top: -60px;"><b>Efficient Delivery Approach (CNN)</b></h3>
                                            <hr style="border:1px dotted black;margin-top: 10px;width: 555px;margin-left: 0px;" />
                                            <p style="margin-left: 105px;margin-top: -15px;">
                                            <?php echo $branch_info['branch_address']; ?>
                                            , Nepal | Tel : <?php echo $branch_info['branch_contact']; ?> 
                                            </p>
                                        </span>
                                    </div>
                                    <hr style="border: 1px solid black;width: 558px;margin-left: -2px;margin-top: -3px;" />
                                    <div id="sr" style="width: 557px;height:170px;margin-top:-20px;border-bottom: 2px solid black;">
                                        <table class="table">
                                            <tr>
                                                <td>
                                                    <span style="font-size: 13px;">
                                                    Origin : <?php echo $this->session->userdata("branchName"); ?><br />    
                                                    Vendor Name : 
                                                    <?php
                                                        if($invoiceDetails['0']['one_time_customer']){ 
                                                            echo strtoupper($invoiceDetails['0']['one_time_customer']); 
                                                        }else{
                                                            $customerName = $this->InvoiceModel->getColHead('tbl_customer','customer_id',$invoiceDetails['0']['customer_id'],'customer_name');
                                                            echo $customerName['customer_name'];
                                                        }
                                                        ?>
                                                    <br />
                                                    Number : <?php  echo $invoiceDetails['0']['customer_number']; ?><br />
                                                    Address : <?php echo $invoiceDetails['0']['customer_address']; ?><br />
                                                    </span>
                                                </td>
                                                <td>
                                                    Receiver Branch : <?php
                                                                            $branchName = $this->InvoiceModel->getColHead('tbl_branch','branch_id',$invoiceDetails['0']['receiver_branch_id'],'branch_name');
                                                                            echo $branchName['branch_name']; 
                                                                            
                                                                        ?><br />
                                                    <span style="font-size: 13px;">
                                                    Customer Name : 
                                                        <?php
                                                        if($invoiceDetails['0']['one_time_receiver']){ 
                                                            echo strtoupper($invoiceDetails['0']['one_time_receiver']); 
                                                        }
                                                        ?>
                                                    <br />
                                                    Number : <?php echo $invoiceDetails['0']['receiver_number']; ?><br />
                                                    Country : <?php echo ($invoiceDetails['0']['receiver_country']) ? $invoiceDetails['0']['receiver_country'] : 'XXX (Domestic)'; ?><br />
                                                    City : <?php echo ($invoiceDetails['0']['receiver_city']) ? $invoiceDetails['0']['receiver_city'] : 'XXX'; ?><br />
                                                    Zip Code : <?php echo ($invoiceDetails['0']['zip_code']) ? $invoiceDetails['0']['zip_code'] : 'XXX'; ?><br />
                                                    Address : <?php echo $invoiceDetails['0']['dropOff_address']; ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <table border="1px solid black" style="margin-top: 15px;margin-left:18px;border: 1px solid black;width: 520px;">
                                        <tr>
                                            <td align="center"><b>Mailing Mode</b></td><td align="center"><?php echo $invoiceDetails['0']['mailing_mode']; ?></td><td align="center"><b>Payment Mode</b></td><td align="center"><?php echo $invoiceDetails['0']['payment_mode']; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="center"><b>Product Name</b></td><td align="center"><?php echo $invoiceDetails['0']['item_type']; ?></td><td align="center"><b>Quantity</b></td><td align="center"><?php echo $invoiceDetails['0']['qty']; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="center"><b>Product Code</b></td><td align="center"><?php echo $invoiceDetails['0']['item_price']; ?></td><td align="center"><b>Weight</b></td><td align="center"><?php echo $invoiceDetails['0']['weight']; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="center"><b>Rate</b></td><td align="center">NRs. <?php echo $invoiceDetails['0']['rate']; ?></td><td align="center"><b>Delivery Charge</b></td><td align="center">NRs. <?php echo $invoiceDetails['0']['delivery_charge']; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="center"><b>Total Collectable Amount</b></td><td align="center"><b>NRs. <?php echo $invoiceDetails['0']['total']; ?></b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="center"><b>Booked On : </b>&nbsp;&nbsp;&nbsp;<?php echo $invoiceDetails['0']['booking_date']; ?> &nbsp;&nbsp;&nbsp;&nbsp;</td><td align="center"><b>Order Number : </b><?php echo $invoiceDetails['0']['bill_number']; ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <!-- barside -->
                                <div id="navbar" style="border-left:solid black;width:30%;height:445px;margin-top: -446px;float: right">
                                    <div id="bcode" style="border-bottom: solid black;height: 200px; ">
                                        <p align="center" style="margin-top:10px; margin-left:-15px; font-size: 25px;" class="mb-5">
                                            <b>CNN</b>
                                        </p> 
                                        <p>
                                        <div id="demo_<?php echo $invoiceDetails['0']['bill_number']; ?>" style="margin-left: 15px;"></div>
                                        <script type="text/javascript">
                                                var value = "<?php echo $invoiceDetails['0']['bill_number']; ?>";
                                                $("#demo_"+<?php echo $invoiceDetails['0']['bill_number']; ?>).barcode(value,"code128");
                                        </script>
                                        </p>
                                    </div>
                                    <div id="tc">
                                        <p align="center" style="margin-top: 5px;font-size: 12px;">
                                        <b>Prepared By:</b>
                                        </p>
                                        <p  align="center" style="margin-top: 10px;">
                                            <b><?php echo $invoiceDetails['0']['prepared_by']; ?></b><br />
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="" id="cnnPrint" class="btn btn-primary" onClick="cnnPreview();"><i class="fa fa-print"></i>&nbsp;&nbsp;PRINT</a>
                        <?php } else { ?>
                        <div class="alert alert-danger" role="alert">
                        This CN Number has already been routed to another address!
                        Please check the Routed Reference Code No: <span class="font-weight-bold"><?php echo '#' . $invoiceDetails['0']['refno'];?></span>
                    </div>    
                    <?php }?>
                </section>
            </div>  
        </div>
    <div class="clearfix"></div>
</div>
<?php $this->load->view('System/branch/Footer');?>

<script>

    function shippingPreview(){
        var printContents = document.getElementById('shipPrint').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }

    function podPreview(){
        var printContents = document.getElementById('podPrint').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
    
    function cnnPreview(){
        var printContents = document.getElementById('cnnPrint').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }


</script>