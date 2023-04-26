<?php $this->load->view('System/vendor/Header');?>
<!-- Left Panel -->
<?php $this->load->view('System/vendor/sidebar');?>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <?php $this->load->view('System/vendor/nav');?>
        <!-- Content -->
        <div class="content">
            <div class="card mt-3">
                <div class="card-header" style="background:#D8BFD8;">
                    <h1 class="d-inline-block card-title">Track Order&nbsp;&nbsp;</h1>
                    <h3.5 class="d-inline-block font-weight-bold" ><?php echo $this->session->userdata('customer_name');?>&nbsp;&nbsp;</h3.5>
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


            <section class="content" style="background: #F0F8FF;">
                <form method="post" id="podForm" action="<?php echo base_url(); ?>Vendor/Tracking/trackingResult">
                    <div class="form-row mb-5">
                        <div class="col-md-6 mb-3">
                            <!-- <label for="">Tracking Report</label> -->
                            <div class="input-group-prepend">
                                <input type="text" class="form-control" id="cnn" name = 'cnno' placeholder="Enter your CN number">
                                <button type="submit" name="search" class="btn btn-sm btn-primary" id="search"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- <hr style="border: 1px solid black;" /> -->
                </form>
            </section>
            
        <!-- /.content -->
        <div class="clearfix"></div>
    </div>
</div>
<!-- /#right-panel -->
<?php $this->load->view('System/vendor/Footer');?>

<script>

    $('#search').click(function(){
        var cnno = $('#cnn').val();
        // alert(cnno);
        if(!cnno) {
            alert('ENTER CN NUMBER FOR TRACKING');
            return false;
        }
    });

</script>