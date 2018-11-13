<?php require_once 'inc/header.php'; ?>
<title>
    <?php echo isset($relatedRoom->room_id) ? 'Update Room info' : 'Add New Room'; ?>
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
                            <a href="Javascript:;">
                                <?php echo isset($relatedRoom->room_id) ? 'Update Room information' : 'Add New Room'; ?>
                            </a>
                        </li>
                    </ul>
                    <ul class="page-breadcrumb pull-right">
                        <li>
                            <a href="<?php echo base_url();?>list-rooms" class="btn btn-primary btn-xs color-white">
                                <i class="fa fa-list"></i> List of Rooms
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
                                    <?php echo isset($relatedRoom->room_id) ? 'Update hostel information' : 'Add New Room'; ?>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <form class="form-horizontal" data-toggle="validator" role="form"
                                      action="<?php echo base_url(); ?>post/save_room_info" method="post">
                                    <input type="hidden" name="room_id" value="<?php echo isset($relatedRoom->room_id) ? $relatedRoom->room_id : '0'; ?>">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="heading">
                                                    <p>Room Information</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Room Title</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control input-sm"
                                                       placeholder="Room Title" name="room_title"
                                                       data-error="Room title is compulsory." value="<?php echo isset($relatedRoom->room_title) ? $relatedRoom->room_title : ''; ?>" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Seated</label>
                                            <div class="col-md-6">
                                                <input type="number" class="form-control input-sm" id="seated"
                                                       placeholder="Seated" name="seated"
                                                       data-error="Seated is compulsory. (Only numbers allowed)" value="<?php echo isset($relatedRoom->seated) ? $relatedRoom->seated : ''; ?>" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Rent / Head</label>
                                            <div class="col-md-6">
                                                <input type="number" class="form-control input-sm" placeholder="Rent / Head" id="rent"
                                                       name="rent_per_head"
                                                       data-error="Rent / Head is compulsory. (Only Numbers)" value="<?php echo isset($relatedRoom->rent_per_head) ? $relatedRoom->rent_per_head : ''; ?>" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="heading">
                                                    <p>Facilities</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Facility</label>
                                            <div class="col-md-6">
                                                <select name="facility_id" id="facility" class="form-control input-sm" data-error="Select room facility." required>
                                                    <option value="">---Select---</option>
                                                    <?php foreach ($allFacilities as $allFacility) { ?>
                                                        <option value="<?php echo $allFacility->facility_id;?>" <?php if(isset($relatedRoom->facility_id) && $relatedRoom->facility_id == $allFacility->facility_id){echo 'selected';}?>><?php echo $allFacility->facility_title;?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group" id="bill-type">
                                            <label class="col-md-3 control-label">Bill type</label>
                                            <div class="col-md-6">
                                                <select name="bill_type" class="form-control input-sm">
                                                    <option value="">---Select---</option>
                                                    <option value="1" <?php if(isset($relatedRoom->bill_type) && $relatedRoom->bill_type == '1'){ echo 'selected';}?>>Per Unit</option>
                                                    <option value="2" <?php if(isset($relatedRoom->bill_type) && $relatedRoom->bill_type == '2'){ echo 'selected';}?>>Fixed</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group" id="bill-amount">
                                            <label class="col-md-3 control-label">Amount</label>
                                            <div class="col-md-6">
                                                <input type="number" id="bill_amount" class="form-control input-sm" placeholder="Amount"
                                                       name="bill_amount" value="<?php echo isset($relatedRoom->bill_amount) ? $relatedRoom->bill_amount : ''; ?>">
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn blue btn-sm">
                                                        <?php echo isset($relatedRoom->room_id) ? 'Update' : 'Submit'; ?>
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
    $(document).on('change', '#facility', function () {
        var val = $('#facility').val();
        if (val == '3') {
            $('#bill-type').css('display', 'none');
            $('#bill-amount').css('display', 'none');
        } else {
            $('#bill-type').css('display', 'block');
            $('#bill-amount').css('display', 'block');
        }
    });
    $(document).ready(function () {
        $("#bill_amount").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });
    });
</script>
</body>
</html>