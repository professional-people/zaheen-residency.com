<?php require_once 'inc/header.php'; ?>
<title>List of Hostels</title>
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
                            <a href="Javascript:;">List of Hostels</a>
                        </li>
                    </ul>
                    <ul class="page-breadcrumb pull-right">
                        <li><a href="<?php echo base_url(); ?>add-new-hostel"
                               class="btn btn-primary btn-xs color-white"><i class="fa fa-plus-square"></i> Add New
                                Hostel</a></li>
                    </ul>
                </div>
                <?php if ($this->session->flashdata('msg')) { ?>
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
                                    List Hostels
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="1">Sr.</th>
                                            <th>Hostel Name</th>
                                            <th width="1" class="text-center">No of Rooms</th>
                                            <th>Address</th>
                                            <th width="210">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (isset($listOfHostels) && count($listOfHostels) > 0) {
                                            $i = 1;
                                            foreach ($listOfHostels as $listHostel) {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url() . 'update-hostel-info/' . $listHostel->hostel_id; ?>"
                                                           title="Edit Hostel Details"
                                                           data-toggle="tooltip"><?php echo $listHostel->hostel_name; ?></a>
                                                    </td>
                                                    <td class="text-center"><?php echo $listHostel->no_of_rooms; ?></td>
                                                    <td><?php echo $listHostel->hostel_address; ?></td>
                                                    <td>
                                                        <a href="<?php echo base_url() . 'update-hostel-info/' . $listHostel->hostel_id; ?>"
                                                           class="btn blue btn-xs" title="Edit Hostel Details"
                                                           data-toggle="tooltip">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                        <a href="javascript:;" class="btn green btn-xs view-hostel-info"
                                                           title="View Hostel Details" data-toggle="tooltip"
                                                           data-id="<?php echo $listHostel->hostel_id; ?>">
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
                                                <td colspan="5" align="center"><strong>Sorry! No Record Found.</strong>
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

<div class="modal fade" id="show-hostel-info" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h4 class="modal-title" id="alert-title">
                    Hostel information
                </h4>
            </div>
            <div class="modal-body" id="info-container"></div>
        </div>
    </div>
</div>

<?php require_once 'inc/footer.php'; ?>
<script type="text/javascript">
    var hostelJsonData = <?php echo $hostel_json; ?>;
    $(document).on('click', '.view-hostel-info', function () {
        $('#info-container').html('<span><i class="fa fa-spinner fa-spin"></i></span>');
        var html = '<table class="table table-bordered table-hover">';
        var hostelId = $(this).attr('data-id');
        $.ajax({
            url: "<?php echo base_url();?>post/get_hostel_expense/" + hostelId,
            cache: false,
            success: function (data) {
                $.each(hostelJsonData, function (index, value) {
                    if (hostelId == value.hostel_id) {
                        html += '<tr><th width="200">Hostel Name</th><td class="text-left">' + value.hostel_name + '</td></tr>';
                        html += '<tr><th>No of Rooms</th><td class="text-left">' + value.no_of_rooms + '</td></tr>';
                        html += '<tr><th>Address</th><td class="text-left">' + value.hostel_address + '</td></tr>';
                        html += '<tr><th>Other Description</th><td class="text-left">' + value.other_description + '</td></tr>';
                    }
                });
                html += '</table>';
                html += '<table class="table table-bordered table-hover">';
                html += '<thead><tr><th width="200">Expense</th><th>Details</th></tr></thead><tbody>';
                if (data.length > 0) {
                    $.each(data, function (index, value) {
                        html += '<tr><td>' + value.expense_title + '</td>';
                        html += '<td>' + value.expense_details + '</td></tr>';
                    });
                } else {
                    html += '<tr><td colspan="3">No Record Found</td></tr>';
                }
                html += '</tbody></table>';
                $('#info-container').html(html);
                $('#show-hostel-info').modal('show');
            },
            error: function () {
            }
        });
    });
</script>
</body>
</html>