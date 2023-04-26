<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <br>
                <ul class="nav navbar-nav">
                    <li class="<?php if($this->uri->segment(2) == "Dashboard"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Vendor/Dashboard"><i class="fa fa-laptop fa-fw"></i>&nbsp;DASHBOARD </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "Order"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Vendor/Order"><i class="fa fa-shopping-cart"></i>&nbsp; ORDER </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "Payment"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Vendor/Payment"><i class="fa fa-money"></i>&nbsp; PAYMENT </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "Tracking"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Vendor/Tracking"><i class="fa fa-clock-o"></i>&nbsp; TRACKING </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "Settings"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Vendor/Settings"><i class="fa fa-cogs"></i>&nbsp; SETTINGS </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>