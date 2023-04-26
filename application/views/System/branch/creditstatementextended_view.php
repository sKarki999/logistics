<div class="box-body table-responsive" style="margin-top: -10px;">
                <table class="table table-bordered" id="mytable" style="background: #3c8dbc;color:white;">
                <thead>    
                    <tr style="background:#3c8dbc;">
                        <td>CNN</td>
                        <td>Destination</td>
                        <td>Receiver</td>
                        <td>Weight</td>
                        <td>COD Amount</td>
                        <td>Delivery Charge</td>
                        <td>Total</td>
                        <!-- <td><nobr>Remarks&nbsp;<a href="javascript:void(0);" onclick="remarksclone();"><small class="badge pull-center bg-red">clone</small></a></nobr></td> -->
                    </tr>
                </thead>
                    <?php
                    $i = 0;
                    if($creditStatement){
                        foreach($creditStatement as $cs){
                            $i++;
                    ?>
                    <tr style="background:white;">
                        <td>
                           <input type="text" name="cnno[]" class="form-control" readonly value="<?php echo $cs['bill_number']; ?>" id="cnno_1" style="height: 28px;" />
                        </td>
                        <td>
                            <input type="text" name="location[]" class="form-control" value="<?php echo $cs['dropOff_address']; ?>" id="location_1" readonly style="height: 28px;" />
                        </td>
                        <td>
                            <?php
                            
                                     ?>
                            <input type="text" name="consignee[]" class="form-control" value="<?php echo $cs['one_time_receiver']; ?>" id="consignee_1" style="width: 250px;height: 28px;" readonly />
                        </td>
                        <td>
                            <input type="text" name="weight[]" class="form-control" value="<?php echo $cs['weight']; ?>" id="weight_1" readonly style="width: 50px;height: 28px;" />
                        </td>
                        <td>
                            <input type="text" name="mailingmode[]" class="form-control" value="<?php echo $cs['item_price']; ?>" id="mailingmode_1" readonly />
                        </td>
                        <td>
                            <input type="text" name="deliveryCharge[]" class="form-control" value="<?php echo $cs['delivery_charge']; ?>" id="deliverycharge_1" readonly />
                        </td>
                        <td><input type="text" name="total[]" value="<?php echo $cs['total']; ?>" class="form-control" id="total_<?php echo $i; ?>" style="height: 28px;" /></td>
                        <!-- <td><input type="text" name="remarks[]" id="remarks_<?php echo $i; ?>" class="form-control" style="height: 28px;"></td> -->
                    </tr>
                    <?php
                            }
                        }else{

                    ?>
                    <tr style="background:white;font-size:12px;">
                        <td colspan="11">No Data Found !..</td>
                    </tr>
                    <tr style="background:white;font-size:12px;">
                        <td>
                           <input type="text" name="cnno[]" class="form-control" readonly value="" id="cnno_1" />
                        </td>
                        <td>
                            <input type="text" name="location[]" class="form-control" value="" id="location_1" readonly />
                        </td>
                        <td>
                            <input type="text" name="consignee[]" class="form-control" value="" id="consignee_1" readonly />
                        </td>
                        <td><input type="text" name="weight[]" class="form-control" id="weight_1" style="width: 50px;" readonly />
                        </td>    
                        <td>
                            <input type="text" name="mailingmode[]" class="form-control" value="" id="mailingmode_1" readonly />
                        </td>
                        <td>
                            <input type="text" name="deliveryCharge[]" class="form-control" value="" id="deliverycharge_1" readonly />
                        </td>
                        <td><input type="text" name="total[]" class="form-control" id="total_1" onChange="cnBox(this.id);"  /></td>
                        <!-- <td><input type="text" name="remarks[]" id="remarks_1" class="form-control" readonly></td> -->
                    </tr>
                    <?php
                        }
                    ?>
                </table>
                <input type="hidden" id="totallengthamount" value="<?php echo $i; ?>">
            </div><!-- /.box-body -->