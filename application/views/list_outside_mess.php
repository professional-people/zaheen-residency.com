<?php require_once 'inc/header.php'; ?>
<title>Mess Members</title>
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
                            <a href="javascript:;">Mess</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="Javascript:;">Mess Members</a>
                        </li>
                    </ul>
                    <ul class="page-breadcrumb pull-right">
                        <li><a href="<?php echo base_url(); ?>add-mess" class="btn btn-primary btn-xs color-white"><i
                                        class="fa fa-plus-square"></i> Add Mess Member</a></li>
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
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    Mess Members
                                </div>
                            </div>
                            <div class="portlet-body">
                                <form class="form-horizontal" role="form" action="<?php echo base_url(); ?>list-outside-mess"
                                      method="POST">
                                    <div class="form-body">
                                        <div class="table-scrollable">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th width="300">Name</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="text" class="form-control input-sm" name="keyword"
                                                               value="<?php echo $keyword; ?>" placeholder="Search...">
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
                                        <th width="200">Name</th>
                                        <th width="1">Mobile No</th>
                                        <th width="100">Start Date</th>
                                        <th width="100">End Date</th>
                                        <th width="1">Mess Charges</th>
                                        <th>Mess Details</th>
                                        <th width="1">Status</th>
                                        <th width="150">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if (isset($mess) && count($mess) > 0) {
                                        $i = 1;
                                        foreach ($mess as $m) { ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url() . 'update-outside-mess/' . $m->mess_id; ?>" title="Edit Mess Info" data-toggle="tooltip">
                                                        <?php echo $m->name; ?>
                                                    </a>
                                                </td>
                                                <td><?php echo $m->mobile_no; ?></td>
                                                <td><?php echo $m->start_date; ?></td>
                                                <td><?php echo $m->end_date; ?></td>
                                                <td class="text-center">
                                                    <strong>Rs. <?php echo $m->mess_charges; ?></strong></td>
                                                <td><?php echo $m->mess_details; ?></td>
                                                <td>
                                                    <?php if ($m->status == '1') { ?>
                                                        <a href="javascript:;" id="status-btn-<?php echo $i; ?>"
                                                           class="status-btn btn btn-success btn-xs"
                                                           title="Member is active, Click to Deactive" data-toggle="tooltip"
                                                           data-id="<?php echo $i; ?>" col-value="0"
                                                           update-id="<?php echo $m->mess_id; ?>">
                                                            Active
                                                        </a>
                                                    <?php } else { ?>
                                                        <a href="javascript:;" id="status-btn-<?php echo $i; ?>"
                                                           class="status-btn btn btn-danger btn-xs"
                                                           title="Member is deactive, Click to Active" data-toggle="tooltip"
                                                           data-id="<?php echo $i; ?>" col-value="1"
                                                           update-id="<?php echo $m->mess_id; ?>">
                                                            Deactive
                                                        </a>
                                                    <?php } ?>

                                                </td>
                                                <td>
                                                    <a href="<?php echo base_url() . 'update-outside-mess/' . $m->mess_id; ?>"
                                                       class="btn blue btn-xs" title="Edit Mess Info" data-toggle="tooltip">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                    <a href="#" class="btn red btn-xs" title="Delete">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php }
                                    } else { ?>
                                        <tr>
                                            <td colspan="5" align="center"><strong>Sorry! No Record Found.</strong></td>
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
<?php require_once 'inc/footer.php'; ?>
<script type="text/javascript">
    $(document).on('click', '.status-btn', function () {
        var id = $(this).attr('data-id');
        var colValue = $(this).attr('col-value');
        var updateId = $(this).attr('update-id');
        status_request('mess_members', 'status', colValue, 'mess_id', updateId, id);
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
                    $('#status-btn-' + responseId).html('Active');
                    $('#status-btn-' + responseId).removeClass('btn-danger');
                    $('#status-btn-' + responseId).addClass('btn-success');
                    $('#status-btn-' + responseId).attr('col-value', '0');
                } else {
                    $('#status-btn-' + responseId).html('Deactive');
                    $('#status-btn-' + responseId).removeClass('btn-success');
                    $('#status-btn-' + responseId).addClass('btn-danger');
                    $('#status-btn-' + responseId).attr('col-value', '1');
                }
            },
            error: function () {
            }
        });
    }
</script>
</body>
</html>