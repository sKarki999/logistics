<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <span class="brand-text font-weight-light">Efficient Delivery</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="<?php echo base_url();?>Driver/Dashboard" class="nav-link <?php if($this->uri->segment(2) == "Dashboard"){echo 'active';}?>">
                <i class="fa fa-laptop fa-fw"></i>&nbsp;
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url();?>Driver/Profile" class="nav-link <?php if($this->uri->segment(2) == "Profile"){echo 'active';}?>">
                    <i class="fa fa-user"></i>&nbsp;
                    <p>PROFILE</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url();?>Driver/PickupList" class="nav-link <?php if($this->uri->segment(2) == "PickupList"){echo 'active';}?>">
                <i class="fa fa-truck"></i>&nbsp;
                    <p>PICKUP LIST</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo base_url();?>Driver/Runsheet" class="nav-link <?php if($this->uri->segment(2) == "Runsheet"){echo 'active';}?>">
                    <i class="fa fa-list"></i>&nbsp;
                    <p>RUNSHEET</p>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a href="<?php echo base_url();?>Driver/Pod" class="nav-link <?php if($this->uri->segment(2) == "Pod"){echo 'active';}?>">
                    <i class="fa fa-check"></i>&nbsp;
                    <p>POD</p>
                </a>
            </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>