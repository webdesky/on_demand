<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url()?>" style="color: maroon;">Welcome,
                <?php echo ucwords($this->session->userdata('first_name'));?>!</a>
        </div>
        <!-- /.navbar-header -->
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li style="font-size: 16px"><a href="<?php echo base_url('admin/profile')?>"><i class="fa fa-user fa-fw"></i> Update Profile</a>
                    </li>
                    <li style="font-size: 16px"><a href="<?php echo base_url('admin/change_password')?>"><i class="fa fa-gear fa-fw"></i> Change Password</a>
                    </li>
                    <li class="divider"></li>
                    <li style="font-size: 16px"><a href="<?php echo base_url('admin/logout')?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav sidebar-menu" id="side-menu" style="margin-top:50px">
                    <li>
                        <a href="<?php echo base_url('admin/index')?>"><i class="fa fa-dashboard fa-fw" style="font-size: 21px"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bitbucket fa-fw" style="font-size: 21px"></i> Categories<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url('admin/category')?>">Add Category</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/list_categories/')?>">View Categories</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-file-code-o fa-fw" style="font-size: 21px"></i> Sub Categories<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url('admin/sub_categories')?>">Add Sub Category</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/list_sub_categories/')?>">View Sub Category</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-edit fa-fw" style="font-size: 21px"></i> Company<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url('admin/companies')?>">Add Company</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/list_companies/')?>">View Company</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-star fa-fw" style="font-size: 21px"></i>Service Provider<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url('admin/service_provider')?>">Add Service Provider</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/list_service_provider/')?>">View Service Provider</a>
                            </li>
                        </ul>
                    </li>   
                    <li>
                        
                        <a href="#"><i class="fa fa-tags fa-fw" style="font-size: 21px"></i>PromoCode<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo base_url('admin/promocode')?>">Add PromoCode</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('admin/list_promocode/')?>">View PromoCode</a>
                            </li>
                        </ul>
                    </li>                     
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>