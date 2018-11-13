<?php require_once 'inc/header.php'; ?>
<title>Hostel Members</title>
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
                            <a href="Javascript:;">Hostel Members</a>
                        </li>
                    </ul>
                    <ul class="page-breadcrumb pull-right">
                        <li>
                            <a href="<?php echo base_url(); ?>add-new-member"
                               class="btn btn-primary btn-xs color-white">
                                <i class="fa fa-plus-square"></i> Add New Member</a>
                        </li>
                    </ul>
                </div>
                <?php if ($this->session->flashdata('msg')) { ?>
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    Hostel Members
                                </div>
                            </div>
                            <div class="portlet-body">
                                <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>list-members"
                                      method="POST">
                                    <div class="form-body">
                                        <div class="table-scrollable">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th width="300">Name</th>
                                                    <th width="300">Rooms</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control input-sm"
                                                               name="member_name" value="<?php echo $member_name; ?>"
                                                               placeholder="Search...">
                                                    </td>
                                                    <td>
                                                        <select name="room_no" class="form-control input-sm">
                                                            <option value="">---Select---</option>
                                                            <?php
                                                            foreach ($rooms as $room) {
                                                                ?>
                                                                <option value="<?php echo $room->room_id; ?>" <?php if ($room_no == $room->room_id) {
                                                                    echo 'selected';
                                                                } ?>><?php echo $room->room_title; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button name="search" class="btn btn-primary btn-sm" value="1">
                                                            Search
                                                        </button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-scrollable">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="1">Sr.</th>
                                            <th>Member Name</th>
                                            <th>Member Phone</th>
                                            <th>CNIC</th>
                                            <th>Room No</th>
                                            <th>Father Name</th>
                                            <th>Father Phone</th>
                                            <th width="1">Status</th>
                                            <th width="210">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (isset($members) && count($members) > 0) {
                                            $i = 1;
                                            foreach ($members as $member) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url() . 'update-member-info/' . $member->member_id; ?>"
                                                           title="Click to edit member info">
                                                            <?php echo $member->member_name; ?>
                                                        </a>
                                                    </td>
                                                    <td><?php echo $member->member_phone_no; ?></td>
                                                    <td><?php echo $member->cnic; ?></td>
                                                    <td><?php echo $member->room_title; ?></td>
                                                    <td><?php echo $member->member_father_name; ?></td>
                                                    <td><?php echo $member->member_father_phone_no; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($member->status == '1') {
                                                            ?>
                                                            <a href="javascript:;" id="status-btn-<?php echo $i; ?>" title="Member is Active, Click to Deactive"
                                                               data-id="<?php echo $i; ?>" data-toggle="tooltip"
                                                               class="status-btn btn btn-success btn-xs" col-value="0"
                                                               update-id="<?php echo $member->member_id; ?>">
                                                                <i class="fa fa-check-square"></i>&nbsp;Active
                                                            </a>
                                                        <?php } else { ?>
                                                            <a href="javascript:;" id="status-btn-<?php echo $i; ?>" title="Member is Deactive, Click to Active"
                                                               data-id="<?php echo $i; ?>" data-toggle="tooltip"
                                                               class="status-btn btn btn-danger btn-xs" col-value="1"
                                                               update-id="<?php echo $member->member_id; ?>">
                                                                <i class="fa fa-check-square"></i>&nbsp;Deactive
                                                            </a>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?php echo base_url() . 'update-member-info/' . $member->member_id; ?>"
                                                           class="btn blue btn-xs" title="Edit member info" data-toggle="tooltip">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                        <a href="javascript:;" class="btn green btn-xs view-member-info"
                                                           title="View member information" data-toggle="tooltip"
                                                           data-id="<?php echo $member->member_id; ?>">
                                                            <i class="fa fa-eye"></i> View
                                                        </a>
                                                        <a href="#" class="btn red btn-xs" title="Delete">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </a>
                                                    </td>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr>
                                                <td colspan="9" align="center"><strong>Sorry! No Record Found.</strong>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Model to show member information -->
<div class="modal fade" id="show-member-info" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h4 class="modal-title" id="alert-title">
                    Member information
                </h4>
            </div>
            <div class="modal-body text-center" id="info-container"></div>
        </div>
    </div>
</div>
<!-- End -->
<?php require_once 'inc/footer.php'; ?>
<script type="text/javascript">
    var memberJsonData = <?php echo $membersJsonData; ?>;
    $(document).on('click', '.view-member-info', function () {
        var html = '<table class="table table-bordered table-hover">';
        var memberId = $(this).attr('data-id');
        $.each(memberJsonData, function (index, value) {
            if (memberId == value.member_id) {
                html += '<tr><th width="200">Member Type</th><td class="text-left">' + value.member_type + '</td></tr>';
                html += '<tr><th>Degree / Company</th><td class="text-left">' + value.member_deg_comp + '</td></tr>';
                html += '<tr><th>Member Name</th><td class="text-left">' + value.member_name + '</td></tr>';
                html += '<tr><th>CNIC</th><td class="text-left">' + value.cnic + '</td></tr>';
                html += '<tr><th>Member Phone No</th><td class="text-left">' + value.member_phone_no + '</td></tr>';
                html += '<tr><th>Father Name</th><td class="text-left">' + value.member_father_name + '</td></tr>';
                html += '<tr><th>Father Phone No</th><td class="text-left">' + value.member_father_phone_no + '</td></tr>';
                html += '<tr><th>Father Occupation</th><td class="text-left">' + value.father_occupation + '</td></tr>';
                html += '<tr><th>Room No</th><td class="text-left">' + value.room_title + '</td></tr>';
                html += '<tr><th>Rent</th><td class="text-left">Rs. ' + value.rent + '</td></tr>';
            }
        });
        html += '</table>';
        $('#info-container').html(html);
        $('#show-member-info').modal('show');
    });

    $(document).on('click', '.status-btn', function () {
        var id = $(this).attr('data-id');
        var colValue = $(this).attr('col-value');
        var updateId = $(this).attr('update-id');
        status_request('member_info', 'status', colValue, 'member_id', updateId, id);
    });

    function status_request(tbl, col, colValue, updateCol, updateId, id) {
        $('#status-btn-' + id).html('<span><i class="fa fa-spinner fa-spin"></i></span>');
        $.ajax({
            url: "<?php echo base_url();?>post/update_user_status/" + tbl + '/' + col + '/' + colValue + '/' + updateCol + '/' + updateId + '/' + id,
            cache: false,
            success: function (data) {
                var responseId = data.id;
                var set = data.set;
                if (set == '1') {
                    $('#status-btn-' + responseId).html('<i class="fa fa-check-square"></i>&nbsp;Active');
                    $('#status-btn-' + responseId).removeClass('btn-danger');
                    $('#status-btn-' + responseId).addClass('btn-success');
                    $('#status-btn-' + responseId).attr('col-value', '0');
                    $('#status-btn-' + responseId).attr('title', 'Member is Active, Click to Deactive').tooltip('fixTitle').tooltip('show');
                } else {
                    $('#status-btn-' + responseId).html('<i class="fa fa-times-circle"></i>&nbsp;Deactive');
                    $('#status-btn-' + responseId).removeClass('btn-success');
                    $('#status-btn-' + responseId).addClass('btn-danger');
                    $('#status-btn-' + responseId).attr('col-value', '1');
                    $('#status-btn-' + responseId).attr('title', 'Member is Deactive, Click to Active').tooltip('fixTitle').tooltip('show');
                }
            },
            error: function () {
            }
        });
    }
</script>
</body>
</html>