<?php require_once 'inc/header.php'; ?>
<title>
    <?php echo isset($releatedMember->member_id) ? 'Update Member' : 'Add New Member'; ?>
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
                                <?php echo isset($releatedMember->member_id) ? 'Update Hostel Member information' : 'Add New Member'; ?>
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
                                    <?php echo isset($releatedMember->member_id) ? 'Update Member information' : 'Add New Member'; ?>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <form class="form-horizontal" data-toggle="validator" role="form"
                                      action="<?php echo base_url(); ?>post/save_new_member_info" method="post">
                                    <input type="hidden" name="member_id"
                                           value="<?php echo isset($releatedMember->member_id) ? $releatedMember->member_id : '0'; ?>">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="heading">
                                                    <p>Personal Information</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Member Type</label>
                                            <div class="col-md-6">
                                                <select name="member_type" class="form-control input-sm" data-error="Member Type is required." required>
                                                    <option value="">---Select---</option>
                                                    <option value="Student" <?php if (isset($releatedMember->member_type) && $releatedMember->member_type == "Student"){ echo 'selected';}?>>Student</option>
                                                    <option value="Job Holder" <?php if (isset($releatedMember->member_type) && $releatedMember->member_type == "Job Holder"){ echo 'selected';}?>>Job Holder</option>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Degree / Company</label>
                                            <div class="col-md-6">
                                                    <input type="text" class="form-control input-sm"
                                                           placeholder="Degree / Company" name="member_deg_comp"
                                                           data-error="Member name is required."
                                                           value="<?php echo isset($releatedMember->member_deg_comp) ? $releatedMember->member_deg_comp : ''; ?>"
                                                           required>
                                                    <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Member Name</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control input-sm"
                                                       placeholder="Member Name" name="member_name"
                                                       data-error="Member name is required."
                                                       value="<?php echo isset($releatedMember->member_name) ? $releatedMember->member_name : ''; ?>"
                                                       required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Member Phone No</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control input-sm"
                                                       placeholder="Member Phone No"
                                                       name="member_phone_no"
                                                       data-error="Phone No is required."
                                                       value="<?php echo isset($releatedMember->member_phone_no) ? $releatedMember->member_phone_no : ''; ?>"
                                                       required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Member CNIC</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control input-sm"
                                                       placeholder="CNIC" name="cnic"
                                                       data-error="CNIC is required."
                                                       value="<?php echo isset($releatedMember->cnic) ? $releatedMember->cnic : ''; ?>"
                                                       required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Father Name</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control input-sm"
                                                       placeholder="Father Name"
                                                       name="member_father_name"
                                                       data-error="Father name is required."
                                                       value="<?php echo isset($releatedMember->member_father_name) ? $releatedMember->member_father_name : ''; ?>"
                                                       required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Father Phone No</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control input-sm"
                                                       placeholder="Father Phone No"
                                                       name="member_father_phone_no"
                                                       data-error="Father phone no is required."
                                                       value="<?php echo isset($releatedMember->member_father_phone_no) ? $releatedMember->member_father_phone_no : ''; ?>"
                                                       required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Father Occupation</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control input-sm"
                                                       placeholder="Father Occupation"
                                                       name="father_occupation"
                                                       data-error="Father occupation is required."
                                                       value="<?php echo isset($releatedMember->father_occupation) ? $releatedMember->father_occupation : ''; ?>"
                                                       required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="heading">
                                                    <p>Hostel Information</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Select Room </label>
                                            <div class="col-md-6">
                                                <select name="room_id" id="room_id" class="form-control input-sm" data-error="Room selection is required." required>
                                                    <option value="">---Select---</option>
                                                    <?php
                                                    foreach ($rooms as $room) {
                                                        ?>
                                                        <option value="<?php echo $room->room_id; ?>" <?php if (isset($releatedMember->room_id) && $releatedMember->room_id == $room->room_id) {
                                                            echo 'selected';
                                                        } ?>><?php echo $room->room_title; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Rent / Month</label>
                                            <div class="col-md-6">
                                                <input type="number" id="rent" class="form-control input-sm"
                                                       placeholder="Rent / Month"
                                                       name="rent"
                                                       data-error="Rent is required."
                                                       value="<?php echo isset($releatedMember->rent) ? $releatedMember->rent : ''; ?>"
                                                       required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn blue btn-sm">
                                                        <?php echo isset($releatedMember->member_id) ? 'Update' : 'Submit'; ?>
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
    var room_data = <?php echo $rooms_json_date;?>;
    $(document).on('change', '#hostel_id', function () {
        var hostel_id = $('#hostel_id').val();
        var html = '<option value="">---Select---</option>';
        $.each(room_data, function (index, value) {
            if (value.hostel_id == hostel_id) {
                html += '<option value="' + value.room_id + '">' + value.room_title + '</option>';
            }
        });
        $('#room_id').html(html);
    });

    $(document).on('change', '#room_id', function () {
        var room_id = $('#room_id').val();
        var html = '';
        $.each(room_data, function (index, value) {
            if (value.room_id == room_id) {
                html = value.rent_per_head;
            }
        });
        $('#rent').val(html);
    });
</script>
</body>
</html>