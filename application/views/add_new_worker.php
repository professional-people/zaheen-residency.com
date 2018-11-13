<?php require_once 'inc/header.php'; ?>
<title>
    <?php echo isset($relatedWorkers->worker_id) ? 'Update Worker Info' : 'Add New Worker'; ?>
</title>
</head>
<body class="page-boxed page-header-fixed page-container-bg-solid page-sidebar-closed-hide-logo ">
<div class="page-header navbar navbar-fixed-top">
    <?php require_once 'inc/nav.php'; ?>
</div>
<div class="clearfix">
</div>
<div class="container-flud">
    <div class="page-container">
        <?php require_once 'inc/sidebar.php'; ?>
        <div class="page-content-wrapper">
            <div class="page-content">
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="<?php echo base_url(); ?>main/dashboard">Dashboard</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="javascript:;">Hostel Setup</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="javascript:;">List of workers</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="Javascript:;">
                                <?php echo isset($relatedWorkers->worker_id) ? 'Update Worker Info' : 'Add New Worker'; ?>
                            </a>
                        </li>
                    </ul>
                    <ul class="page-breadcrumb pull-right">
                        <li>
                            <a href="<?php echo base_url();?>list-workers" class="btn btn-primary btn-xs color-white">
                                <i class="fa fa-list"></i> List of Workers
                            </a>
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
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <?php echo isset($relatedWorkers->worker_id) ? 'Update Worker Info' : 'Add New Worker'; ?>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <form class="form-horizontal" data-toggle="validator" role="form"
                                      action="<?php echo base_url(); ?>post/save_worker_info" method="post">
                                    <input type="hidden" name="worker_id"
                                           value="<?php echo isset($relatedWorkers->worker_id) ? $relatedWorkers->worker_id : '0'; ?>">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Worker Name</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control input-sm"
                                                       placeholder="Worker Name" name="worker_name"
                                                       data-error="Worker name is required."
                                                       value="<?php echo isset($relatedWorkers->worker_name) ? $relatedWorkers->worker_name : ''; ?>"
                                                       required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">CNIC</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control input-sm"
                                                       placeholder="CNIC" name="cnic"
                                                       data-error="CNIC is required."
                                                       value="<?php echo isset($relatedWorkers->cnic) ? $relatedWorkers->cnic : ''; ?>"
                                                       required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Mobile Number</label>
                                            <div class="col-md-6">
                                                    <input type="text" class="form-control input-sm input-cash"
                                                           placeholder="Mobile Number" name="mobile_no"
                                                           data-error="Mobile no is required."
                                                           value="<?php echo isset($relatedWorkers->mobile_no) ? $relatedWorkers->mobile_no : ''; ?>"
                                                           required>
                                                    <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Permanent Address</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control input-sm" placeholder="Permanent Address" name="permanent_address"
                                                       value="<?php echo isset($relatedWorkers->permanent_address) ? $relatedWorkers->permanent_address : ''; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Salary</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control input-sm input-cash"
                                                       placeholder="Salary"
                                                       name="salary"
                                                       data-error="Salary is required."
                                                       value="<?php echo isset($relatedWorkers->salary) ? $relatedWorkers->salary : ''; ?>"
                                                       required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn blue btn-sm">
                                                        <?php echo isset($relatedWorkers->worker_id) ? 'Update' : 'Submit'; ?>
                                                    </button>
                                                    <a href="<?php echo base_url(); ?>main/dashboard"
                                                       class="btn default btn-sm">Cancel</a>
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
<?php require_once 'inc/footer.php'; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $(".input-cash").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 13) {
                return false;
            }
        });
    });
</script>
</body>
</html>