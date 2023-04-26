<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="" class="nav-link font-weight-bold"><?php echo $this->session->userdata('name'). ',&nbsp;' .$this->session->userdata('branchName'); ?></a>
      </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li>
            <div class="user-area dropdown float-right">
                <a href="<?php echo base_url();?>Driver/Account/logout" class="btn btn-secondary btn-sm" style="color:white;"> Logout </a>
            </div>
        </li>
    </ul>
</nav>