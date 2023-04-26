<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <br/>
                <ul class="nav navbar-nav">
                    <li class="<?php if($this->uri->segment(2) == "Dashboard"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Admin/Dashboard"><i class="fa fa-laptop fa-fw"></i> DASHBOARD</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "Location"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Admin/Location"> <i class="fa fa-map-marker fa-fw"></i> LOCATION</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "Branch"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Admin/Branch"> <i class="fa fa-home fa-fw"></i> BRANCH</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "PriceSettings"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Admin/PriceSettings" > <i class="fa fa-users fa-fw"></i> PRICE SETTING</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "User"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Admin/User"> <i class="fa fa-user-md fa-fw"></i> USER</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "Settings"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Admin/Settings" > <i class="fa fa-wrench fa-fw"></i> SETTING</a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>