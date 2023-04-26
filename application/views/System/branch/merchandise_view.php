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
                    <h1 class="d-inline-block card-title">Merchandise&nbsp;&nbsp;</h1>
                    <h3.5 class="d-inline-block font-weight-bold" ><?php echo $this->session->userdata('branchName') .', '. $this->session->userdata('branchAddress');?>&nbsp;&nbsp;</h3.5>
                </div>
            </div>

            <section class="content" style="background: RGB(273, 267, 240);">
                <div class="orders">
                    <div class="row">
                        <div class="col-xl-12">
                                Future Work....,
                        </div>  <!-- /.col-lg-8 -->
                    </div>
                </div>
            </section>
        
    </div>
    <!-- /#right-panel -->
    <?php $this->load->view('System/branch/Footer');?>

    