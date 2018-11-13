<?php require_once 'inc/header.php'; ?>
<title>Add New User</title>
</head>
<body class="page-boxed page-header-fixed page-container-bg-solid page-sidebar-closed-hide-logo ">
<div class="page-header navbar navbar-fixed-top">
<?php require_once 'inc/nav.php'; ?>
</div>
<div class="clearfix">
</div>
<div class="container-flud">
<div class="page-container">
<?php require_once 'inc/sidebar.php';?>

<div class="page-content-wrapper">
<div class="page-content">
<h3 class="page-title">
Add New User
</h3>
				<div class="page-bar">
					<ul class="page-breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo base_url();?>main/dashboard">Dashboard</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="javascript:;">Settings</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="Javascript:;">System Settings</a>
						</li>
					</ul>
				</div>
<?php if($this->session->flashdata('msg')) { ?>
    <div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Success!</strong> <?php echo $this->session->flashdata('msg'); ?>
    </div>
<?php } ?>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div class="row">
					<div class="col-md-12">
						<!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-gift"></i>System Settings
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="tabbable-line">
                                    <ul class="nav nav-tabs ">
                                        <li class="active">
                                            <a href="#tab_15_1" data-toggle="tab" aria-expanded="false">
                                                System Logo</a>
                                        </li>
                                        <li class="">
                                            <a href="#tab_15_2" data-toggle="tab" aria-expanded="false">
                                                Footer Content </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab_15_1">
                                            <div class="portlet-body form">
                                                <form class="form-horizontal" role="form" action="<?php echo base_url();?>main/add_user_db" method="post">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Select Logo</label>
                                                            <div class="col-md-9">
                                                                <input type="file" class="btn">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn blue btn-sm">Update</button>
                                                                <a href="<?php echo base_url();?>main/dashboard" class="btn default btn-sm">Cancel</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="tab_15_2">
                                            <div class="portlet-body form">
                                                <form class="form-horizontal" role="form" action="<?php echo base_url();?>main/update_footer" method="post">
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Footer Text</label>
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" name="footer" id="" cols="30" rows="5" placeholder="Text Here...">
                                                                    <?php echo $footer->setting_value;?>
                                                                </textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn blue btn-sm">Update</button>
                                                                <a href="<?php echo base_url();?>main/dashboard" class="btn default btn-sm">Cancel</a>
                                                            </div>
                                                        </div>
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
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->
		<!-- BEGIN QUICK SIDEBAR -->
		<!--Cooming Soon...-->
		<!-- END QUICK SIDEBAR -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<!-- END FOOTER -->
</div>
<?php require_once 'inc/footer.php';?>
</body>
</html>