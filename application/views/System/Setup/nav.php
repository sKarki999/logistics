<!-- Header-->
<header id="header" class="header">
    <div class="top-left">
        <div class="navbar-header">
            <a class="navbar-brand" href="./"> <?php echo $this->session->userdata('fullname');?></a>
            <!-- <a class="navbar-brand hidden" href="./"><img src="images/logo2.png" alt="Logo"></a>
            <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a> -->
        </div>
    </div>
    <div class="top-right">
        <div class="header-menu">
            <div class="header-left">
            </div>
            <div class="user-area dropdown float-right">
                <a href="<?php echo base_url();?>Account/logout" class="btn btn-secondary btn-sm"> Logout </a>
            </div>
        </div>
    </div>
</header>
<!-- /#header -->