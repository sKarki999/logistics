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
                    <h1 class="d-inline-block card-title">Tracking Panel&nbsp;&nbsp;</h1>
                    <h3.5 class="d-inline-block font-weight-bold" ><?php echo $this->session->userdata('branchName');?>&nbsp;&nbsp;</h3.5>
                </div>
            </div>

            <?php if($this->session->flashdata('msg')) {?>
                <div class="alert alert-success" role="alert" id="sessionMessage">
                    <h4 class="alert-heading"><?php echo $this->session->flashdata('msg');?></h4>
                </div> 
            <?php } ?>

            <section class="content" style="background: RGB(273, 267, 240);">
                <form method="post" id="podForm" action="<?php echo base_url(); ?>Branch/Tracking/trackingResult">
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
        </div>
        
    </div>
    <!-- /#right-panel -->
    <?php $this->load->view('System/branch/Footer');?>

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