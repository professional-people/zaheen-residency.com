<?php require_once 'inc/header.php'; ?>
<title>
    <?php echo isset($mess->mess_id) ? 'Update Mess Member' : 'Add Mess Member'; ?>
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
                            <a href="javascript:;">Mess / Members</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="Javascript:;">
                                <?php echo isset($mess->mess_id) ? 'Update Mess Member' : 'Add Mess Member'; ?>
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
                                    <?php echo isset($mess->mess_id) ? 'Update Mess Member' : 'Add Mess Member'; ?>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <form class="form-horizontal" data-toggle="validator" role="form"
                                      action="<?php echo base_url(); ?>post/add_mess_data" method="post">
                                    <input type="hidden" name="mess_id"
                                           value="<?php echo isset($mess->mess_id) ? $mess->mess_id : '0'; ?>">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="heading">
                                                    <p>Mess Information</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Name</label>
                                            <div class="col-md-6">
                                                    <input type="text" class="form-control input-sm"
                                                           placeholder="Name" name="name"
                                                           data-error="Name is required."
                                                           value="<?php echo isset($mess->name) ? $mess->name : ''; ?>"
                                                           required>
                                                    <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Mobile No</label>
                                            <div class="col-md-6">
                                                    <input type="text" class="form-control input-sm input-num"
                                                           placeholder="Mobile No" name="mobile_no"
                                                           data-error="Mobile No is required."
                                                           value="<?php echo isset($mess->mobile_no) ? $mess->mobile_no : ''; ?>"
                                                           required>
                                                    <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Address</label>
                                            <div class="col-md-6">
                                                    <input type="text" class="form-control input-sm"
                                                           placeholder="Address" name="address"
                                                           value="<?php echo isset($mess->address) ? $mess->address : ''; ?>"
                                                    >
                                                    <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Mess Charges</label>
                                            <div class="col-md-6">
                                                    <input type="text" class="form-control input-sm input-num"
                                                           placeholder="Mess Charges" name="mess_charges"
                                                           value="<?php echo isset($mess->mess_charges) ? $mess->mess_charges : ''; ?>"
                                                    >
                                                    <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Start Date</label>
                                            <div class="col-md-6">
                                                <input type="date" class="form-control input-sm"
                                                        name="start_date"
                                                       data-error="Starting Date is required."
                                                       value="<?php echo isset($mess->start_date) ? $mess->start_date : date("Y-m-d"); ?>"
                                                       required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">End Date</label>
                                            <div class="col-md-6">
                                                <input type="date" class="form-control input-sm"
                                                        name="end_date"
                                                       data-error="Starting Date is required."
                                                       value="<?php echo isset($mess->end_date) ? $mess->end_date : date("Y-m-d"); ?>"
                                                       required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Mess Details</label>
                                            <div class="col-md-6">
                                                <textarea name="mess_details" class="form-control" placeholder="Mess Details"><?php echo isset($mess->mess_details) ? trim($mess->mess_details) : ''; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn blue btn-sm">
                                                        <?php echo isset($mess->mess_id) ? 'Update' : 'Submit'; ?>
                                                    </button>
                                                    <a href="<?php echo base_url(); ?>main/dashboard"
                                                       class="btn default btn-sm">Cancel</a>
                                                </div>
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
        $(".input-num").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
    });
</script>
</body>
</html>