<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo base_url() . 'manager/dashboard'; ?>">
            <i class="fa fa-dashboard fa-fw"></i> ABS Bahamas
        </a> 
    </div>
    <!-- /.navbar-header -->
    <ul class="nav navbar-top-links navbar-right">
        <li>
            <small>
                <b><?php echo ucwords($this->session->userdata('role')); ?>: </b> <?php echo ucwords($this->session->userdata('scope_name')); ?>
            </small> 
        </li>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <?php echo $this->session->userdata('firstname') . ' ' . $this->session->userdata('lastname'); ?> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a href="<?php echo base_url() . 'manager/profile'; ?>">
                        <i class="fa fa-user fa-fw"></i>  Profile
                    </a>                   
                </li>
                <li class="divider"></li>
                <li>
                    <a href="<?php echo base_url() . 'manager/logout'; ?>">
                        <i class="fa fa-sign-out fa-fw"></i> Logout
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a class="dashboard" href="<?php echo base_url() . 'manager/dashboard'; ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>

                <li class="divider"></li>

                <li class="treeview">
                    <a href="#"><i class="fa fa-cogs"></i> <span> Settings</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <ul class="treeview-menu">                        
                        <li class="list-group-item"><a href="<?php echo base_url() . 'Manager/S_user/manage_user'; ?>">Users
                                <span class="fa fa-user-md"></span>
                            </a>
                        </li>
                        <li class="list-group-item"><a href="<?php echo base_url() . 'manager/facility'; ?>">Facilities
                                <span class="fa fa-building-o"></span>
                            </a>
                        </li>
                    </ul>

                </li>
            </ul>

        </div>
        <!--/.sidebar-collapse -->

    </div>
    <!--/.navbar-static-side -->
</nav>