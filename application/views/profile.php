<?php require_once 'inc/header.php'; ?>
<title>User Profile</title>
</head>
<body class="page-boxed page-header-fixed page-container-bg-solid page-sidebar-closed-hide-logo">
<div class="page-header navbar navbar-fixed-top">
    <?php require_once 'inc/nav.php'; ?>
    <div class="clearfix">
    </div>
    <div class="container-flud">
        <div class="page-container">
            <?php require_once 'inc/sidebar.php'; ?>
            <div class="page-content-wrapper">
                <div class="page-content">

                    <h3 class="page-title">
                        Manage Profile
                    </h3>

                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="<?php echo base_url(); ?>main/dashboard">Dashboard</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                            <li>
                                <a href="javascript:;">User Account</a>
                            </li>
                        </ul>
                    </div>

                    <?php if ($this->session->flashdata('msg')) { ?>
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Success!</strong> <?php echo $this->session->flashdata('msg'); ?>
                        </div>
                    <?php } ?>

                    <?php if ($this->session->flashdata('error')) { ?>
                        <div class="alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php } ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-content">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet light">
                                            <div class="portlet-title tabbable-line">
                                                <div class="caption caption-md">
                                                    <i class="icon-globe theme-font hide"></i>
                                                    <span class="caption-subject font-blue-madison bold uppercase">Profile Account</span>
                                                </div>
                                                <ul class="nav nav-tabs">
                                                    <li class="active">
                                                        <a href="#tab_1_1" data-toggle="tab">Personal Info</a>
                                                    </li>
                                                    <li>
                                                        <a href="#tab_1_3" data-toggle="tab">Change Password</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="portlet-body">
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tab_1_1">
                                                        <form role="form"
                                                              action="<?php echo base_url(); ?>main/update_profile_details"
                                                              method="post" data-toggle="validator">
                                                            <div class="form-group">
                                                                <label class="control-label">Email</label>
                                                                <input type="email" placeholder="Email"
                                                                       class="form-control" data-error="Email is required"
                                                                       value="<?php echo $profile_data->email; ?>" name="email" required
                                                                />
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Username</label>
                                                                <input type="text" placeholder="Username"
                                                                       class="form-control"
                                                                       value="<?php echo $profile_data->username; ?>"
                                                                       name="username"
                                                                       data-error="Username is required" required/>
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">First Name</label>
                                                                <input type="text" placeholder="First Name"
                                                                       class="form-control"
                                                                       value="<?php echo $profile_data->first_name; ?>"
                                                                       name="first_name"
                                                                       data-error="First name is required" required/>
                                                                <div class="help-block with-errors"></div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Last Name</label>
                                                                <input type="text" placeholder="Last Name"
                                                                       class="form-control"
                                                                       value="<?php echo $profile_data->last_name; ?>"
                                                                       name="last_name"
                                                                       data-error="Last name is required" required/>
                                                                <div class="help-block with-errors"></div>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="control-label">Mobile Number</label>
                                                                <input type="text" placeholder="Mobile Number"
                                                                       class="form-control"
                                                                       value="<?php echo $profile_data->mobile_no; ?>"
                                                                       name="mobile_no"
                                                                       data-error="Mobile no is required" required/>
                                                                <div class="help-block with-errors"></div>
                                                            </div>

                                                            <div class="margiv-top-10">
                                                                <button type="submit" class="btn green-haze btn-sm">
                                                                    Save Changes
                                                                </button>
                                                                <a href="<?php echo base_url(); ?>main/dashboard"
                                                                   class="btn default btn-sm"> Cancel </a>
                                                            </div>

                                                        </form>
                                                    </div>

                                                    <div class="tab-pane" id="tab_1_3">
                                                        <form action="<?php echo base_url(); ?>post/change_password"
                                                              method="POST" data-toggle="validator">
                                                            <div class="form-group">
                                                                <label class="control-label">Current Password</label>
                                                                <input type="password" name="old" class="form-control"
                                                                       autocomplete="off" required/>
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">New Password</label>
                                                                <input type="password" name="new" id="new-password"
                                                                       autocomplete="off" class="form-control"
                                                                       required/>
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Confirm New
                                                                    Password</label>
                                                                <input type="password" data-match="#new-password"
                                                                       class="form-control" name="confirm"
                                                                       data-match-error="New and confirm password does not match"
                                                                       required/>
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                            <div class="margin-top-10">
                                                                <button type="submit" class="btn green-haze">
                                                                    Change Password
                                                                </button>
                                                                <a href="<?php echo base_url(); ?>dashboard"
                                                                   class="btn default">
                                                                    Cancel </a>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN FOOTER -->
    <?php require_once 'inc/footer.php'; ?>
</body>
<!-- END BODY -->
</html>