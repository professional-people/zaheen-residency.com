<div class="page-header-inner container-flud">
    <div class="page-logo">
        <a href="<?php echo base_url(); ?>main/dashboard">
            <img src="<?php echo base_url(); ?>resource/img/dashboard-logo.png" alt="logo" class="logo-default"/>
        </a>
        <div class="menu-toggler sidebar-toggler"></div>
    </div>
    <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
       data-target=".navbar-collapse">
    </a>
    <div class="page-top">
        <div class="col-sm-6" style="margin-top: 15px;">
            <form id="form-switching" action="<?php echo base_url(); ?>switch-hostel" method="post">
                <input type="hidden" name="active_hostel_id" id="active-hostel-id" value="">
                <input type="hidden" name="redirect_uri" id="redirect-uri" value="">
            </form>
            <div class="col-md-10">
                <?php
                foreach ($top_hostels as $hostels) {
                    $hostelId = $hostels->hostel_id;
                    $hostelSession = $this->session->userdata('hostel_session_id');
                    if ($hostelId == $hostelSession) {
                        $class = 'btn btn-primary';
                        $label = '<i class="fa fa-check-square"></i> ';
                        $title = 'Activated Successfully.';
                    } else {
                        $class = 'hostel-switch btn btn-default';
                        $label = '<i class="fa fa-times-circle"></i> ';
                        $title = 'Click to switch';
                    }
                    ?>
                    <a href="javascript:;" data-toggle="tooltip" data-placement="bottom" class="<?php echo $class; ?>" title="<?php echo $title; ?>"
                       data-id="<?php echo $hostels->hostel_id; ?>" data-uri="<?php echo $current_uri; ?>">
                        <?php echo '<strong>' . $label . '</strong>' . $hostels->hostel_name; ?>
                    </a>
                <?php } ?>
                <a href="<?php echo base_url();?>list-hostels" class="btn btn-success" title="List of Hostels" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-list"></i></a>
            </div>
        </div>
        <div class="top-menu">
            <ul class="nav navbar-nav pull-right">
                <li class="dropdown-user notifications-panel">
                    <div class="dropdown">
                        <?php
                        $notify_html="";
                        $total_noti = 0;
                        if(isset($notifications) && count($notifications) > 0) {
                                foreach ($notifications as $notify) {
                                    $notify_html.='<li><a href="javascript:;" class="notify">Found ('.$notify->notification.') - ('.$notify->full_title.') - ('.date('M-Y',strtotime($notify->missing_date)).')</a></li>';
                                    $total_noti+=$notify->notification;
                                }
                                $noti_class = 'btn-danger';
                            } else {
                            $noti_class = 'btn-success';
                            $notify_html.='<li><a href="javascript:;" class="text-center">Empty</a></li>';
                        }
                        ?>
                        <button class="btn <?php echo $noti_class;?> dropdown-toggle" type="button" data-toggle="dropdown">
                            (<?php echo $total_noti;?>) Notifications <i class="fa fa-globe fa-2x"></i>
                            <span class="caret"></span></button>
                        <ul class="dropdown-menu">
                            <?php echo $notify_html;?>
                        </ul>
                    </div>
                </li>
                <li class="dropdown dropdown-user">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                       data-close-others="true">
                        <?php echo $this->session->userdata('member_name'); ?></span>
                        <i class="fa fa-arrow-circle-o-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-default">
                        <li>
                            <a href="<?php echo base_url(); ?>profile">
                                <i class="icon-user"></i> My Profile </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>logout">
                                <i class="icon-key"></i> Log Out </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>
</div>