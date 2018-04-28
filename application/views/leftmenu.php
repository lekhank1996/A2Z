<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="<?php echo (($this->uri->segment(1) == 'dashboard') ? 'active' : ''); ?>">
                <a title="Dashboard" href="<?php echo base_url(); ?>dashboard">
                  <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            
            <li class="<?php echo (($this->uri->segment(1) == 'userslist') ? 'active' : ''); ?>">
                <a title="User" href="<?php echo base_url(); ?>user">
                  <i class="fa fa-list"></i> <span>User</span> 
                </a>
            </li>
            
            <li class="<?php echo (($this->uri->segment(1) == 'userslist') ? 'active' : ''); ?>">
                <a title="Category" href="<?php echo base_url(); ?>category">
                  <i class="fa fa-file"></i> <span>Category</span> 
                </a>
            </li>
            
            <li class="<?php echo (($this->uri->segment(1) == 'logout') ? 'active' : ''); ?>">
                <a title="Logout" href="<?php echo base_url();?>login/logout">
                  <i class="fa fa-power-off"></i> <span>Logout</span> 
                </a>
            </li>
        </ul>
    </section>
</aside>