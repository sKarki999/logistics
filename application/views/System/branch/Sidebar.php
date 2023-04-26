<aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <br>
                <ul class="nav navbar-nav">
                    <li class="<?php if($this->uri->segment(2) == "Dashboard"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Branch/Dashboard"><i class="fa fa-laptop fa-fw"></i>&nbsp;DASHBOARD </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "Booking"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Branch/Booking"><i class="glyphicon glyphicon-book"></i>&nbsp; BOOKING </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "Pickup"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Branch/Pickup"><i class="fa fa-truck"></i>&nbsp; PICKUP </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "Manifest"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Branch/Manifest"><i class="glyphicon glyphicon-hdd"></i>&nbsp; MANIFEST </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "ManifestReceived"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Branch/ManifestReceived"><i class="glyphicon glyphicon-hdd"></i>&nbsp; MANIFEST RECEIVED </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "DeliveryRunsheet"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Branch/DeliveryRunsheet"><i class="fa fa-table"></i> &nbsp;DELIVERY RUNSHEET </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "Pod"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Branch/Pod"><i class="fa fa-edit"></i>&nbsp; POD ENTRY </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "Tracking"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Branch/Tracking"><i class="fa fa-inbox"></i>&nbsp; TRACKING </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "Customer"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Branch/Customer"><i class="fa fa-truck"></i>&nbsp; CUSTOMER </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "Employee"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Branch/Employee"><i class="fa fa-male"></i>&nbsp; EMPLOYEE </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "CreditStatement"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Branch/CreditStatement"><i class="fa fa-book"></i> &nbsp;STATEMENT</a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "DailySales"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Branch/DailySales"><i class="fa fa-money"></i>&nbsp; DAILY SALES REPORT </a>
                    </li>
                    <li class="<?php if($this->uri->segment(2) == "Merchandise"){echo 'active';} ?>">
                        <a href="<?php echo base_url();?>Branch/Merchandise"><i class="fa fa-laptop"></i>&nbsp; Merchandise </a>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>