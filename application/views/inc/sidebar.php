<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu page-sidebar-menu-hover-submenu" data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200">
            <li <?php if (isset($active_menu) && $active_menu == 'dashboard'){ echo 'class="active"';}?>>
                <a href="<?php echo base_url();?>dashboard">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li <?php if (isset($active_menu) && $active_menu == 'hostel_setup'){ echo 'class="start active"';}?>>
                <a href="javascript:;">
                    <i class="fa fa-building"></i>
                    <span class="title">Hostel Setup</span>
                </a>
                <ul class="sub-menu">
                    <li><a href="<?php echo base_url();?>list-rooms"><i class="fa fa-building"></i> List of Rooms</a></li>
                    <li><a href="<?php echo base_url();?>list-workers"><i class="fa fa-building"></i> List of Workers</a></li>
                </ul>
            </li>
            <li <?php if (isset($active_menu) && $active_menu == 'hostel_members'){ echo 'class="active"';}?>>
                <a href="<?php echo base_url();?>list-members">
                    <i class="fa fa-users"></i>
                    <span class="title">Hostel Members</span>
                    <span class="arrow "></span>
                </a>
            </li>
            <li <?php if (isset($active_menu) && $active_menu == 'mess_members'){ echo 'class="active"';}?>>
                <a href="javascript:;">
                    <i class="fa fa-user-secret"></i>
                    <span class="title">Mess</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li><a href="<?php echo base_url();?>list-outside-mess"><i class="fa fa-user-secret"></i>Mess Members</a></li>
                    <li><a href="<?php echo base_url();?>mess-payments"><i class="fa fa-user-secret"></i> Mess Payments</a></li>
                    <li><a href="<?php echo base_url();?>mess-expense"><i class="fa fa-user-secret"></i> Mess Expense</a></li>
                    <li><a href="<?php echo base_url();?>mess-statement"><i class="fa fa-user-secret"></i> Mess Statement</a></li>
                </ul>
            </li>
            <li <?php if (isset($active_menu) && $active_menu == 'payments'){ echo 'class="active"';}?>>
                <a href="javascript:;">
                    <i class="fa fa-money"></i>
                    <span class="title">Payments</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li><a href="<?php echo base_url();?>hostel-payment"><i class="fa fa-money"></i> Rent Payments</a></li>
                    <li><a href="<?php echo base_url();?>bill-payments"><i class="fa fa-money"></i> Bill Payments</a></li>
                </ul>
            </li>
            <li <?php if (isset($active_menu) && $active_menu == 'expense'){ echo 'class="active"';}?>>
                <a href="javascript:;">
                    <i class="fa fa-exclamation-triangle"></i>
                    <span class="title">Expense</span>
                    <span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li><a href="<?php echo base_url();?>list-daily-expense"><i class="fa fa-exclamation-triangle"></i> Daily Expense</a></li>
                    <li><a href="<?php echo base_url();?>monthly-expense"><i class="fa fa-exclamation-triangle"></i> Monthly Expense</a></li>
                    <li><a href="<?php echo base_url();?>worker-expense"><i class="fa fa-exclamation-triangle"></i> Worker Expense</a></li>
                </ul>
            </li>
            <li <?php if (isset($active_menu) && $active_menu == 'income_statement'){ echo 'class="active"';}?>>
                <a href="<?php echo base_url();?>view-income-statement">
                    <i class="fa fa-file"></i>
                    <span class="title">Income Statement</span>
                    <span class="arrow"></span>
                </a>
            </li>
        </ul>
    </div>
</div>
