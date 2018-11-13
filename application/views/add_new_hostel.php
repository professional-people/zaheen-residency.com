<?php require_once 'inc/header.php'; ?>
<title>
    <?php echo isset($hostelInfo->hostel_id) ? 'Update hostel info' : 'Add New Hostel'; ?>
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
                            <a href="Javascript:;">
                                <?php echo isset($hostelInfo->hostel_id) ? 'Update hostel information' : 'Add New Hostel'; ?>
                            </a>
                        </li>
                    </ul>
                    <ul class="page-breadcrumb pull-right">
                        <li>
                            <a href="<?php echo base_url();?>list-hostels" class="btn btn-primary btn-xs color-white">
                                <i class="fa fa-list"></i> List Hostels</a>
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
                                    <i class="fa fa-user"></i>
                                    <?php echo isset($hostelInfo->hostel_id) ? 'Update hostel information' : 'Add New Hostel'; ?>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <form class="form-horizontal" data-toggle="validator" role="form"
                                      action="<?php echo base_url(); ?>post/add_new_hostel" method="post">
                                    <input type="hidden" name="hostel_id" value="<?php echo isset($hostelInfo->hostel_id) ? $hostelInfo->hostel_id : '0'; ?>">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="heading">
                                                    <p>Hostel Information</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Hostel Name</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control input-sm"
                                                       placeholder="Hostel Name" name="hostel_name"
                                                       data-error="Hostel name is compulsory." value="<?php echo isset($hostelInfo->hostel_name) ? $hostelInfo->hostel_name : ''; ?>" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">No of Rooms</label>
                                            <div class="col-md-6">
                                                <input type="number" class="form-control input-sm"
                                                       placeholder="No of Rooms" name="no_of_rooms"
                                                       data-error="Only numbers allowed." value="<?php echo isset($hostelInfo->no_of_rooms) ? $hostelInfo->no_of_rooms : ''; ?>" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Address</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control input-sm" placeholder="Address"
                                                       name="hostel_address"
                                                       data-error="Address name is compulsory." value="<?php echo isset($hostelInfo->hostel_address) ? $hostelInfo->hostel_address : ''; ?>" required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Other Description</label>
                                            <div class="col-md-6">
                                                <textarea name="other_description" class="form-control"
                                                          placeholder="Other Description"><?php echo isset($hostelInfo->other_description) ? $hostelInfo->other_description : ''; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="heading">
                                                    <p>Hostel Expense</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="table-scrollable">
                                                <table id="items-table" class="table table-bordered table-hover">
                                                    <thead>
                                                    <tr>
                                                        <th width="1">Sr.</th>
                                                        <th>Expense Title</th>
                                                        <th>Details</th>
                                                        <th width="1">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    if (isset($hostelExpense) && count($hostelExpense) > 0) {
                                                        $i = 0;
                                                        foreach ($hostelExpense as $items) {
                                                            $i++;
                                                            ?>
                                                            <tr>
                                                                <input type="hidden" name="hostel_expense_id[]" value="<?php echo isset($items->hostel_expense_id) ? $items->hostel_expense_id : '0'?>">
                                                                <td class="text-center"><strong><?php echo $i;?></strong></td>
                                                                <td>
                                                                    <input type="text" name="expense_title[]" value="<?php echo isset($items->expense_title) ? $items->expense_title : ''?>" class="form-control input-sm" placeholder="Expense Title"/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="expense_details[]" value="<?php echo isset($items->expense_details) ? $items->expense_details : ''?>" class="form-control input-sm" placeholder="Details">
                                                                </td>
                                                                <td class="text-center">
                                                                    <?php if ($i == 1) { ?>
                                                                        <a href="javascript:;" id="add-row" class="btn btn-primary btn-xs">+</a>
                                                                    <?php } else { ?>
                                                                        <a href="javascript:;" class="row-del btn btn-danger btn-xs" data-del="<?php echo $items->hostel_expense_id; ?>">
                                                                            <i class="fa fa-trash"></i>
                                                                        </a>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                        <?php }} else { ?>
                                                        <tr>
                                                            <input type="hidden" name="hostel_expense_id[]" value="0">
                                                            <td class="text-center"><strong>1</strong></td>
                                                            <td>
                                                                <input type="text" name="expense_title[]" class="form-control input-sm" placeholder="Expense Title"/>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="expense_details[]" class="form-control input-sm" placeholder="Details">
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="javascript:;" id="add-row" class="btn btn-primary btn-xs">+</a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn blue btn-sm">
                                                        <?php echo isset($hostelInfo->hostel_id) ? 'Update' : 'Submit'; ?>
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
    $(document).on('click', '#add-row', function () {
        var html = '';
        var length = parseInt($('#items-table tbody tr').length) + 1;
        html += '<tr><input type="hidden" name="hostel_expense_id[]" value="0">' +
            '<td class="text-center"><strong>' + length + '</strong></td>' +
            '<td><input type="text" name="expense_title[]" class="form-control input-sm" placeholder="Expense Title"></td>' +
            '<td><input type="text" name="expense_details[]" class="form-control input-sm" placeholder="Details"></td>' +
            '<td class="text-center"><a href="javascript:;" class="row-del btn btn-danger btn-xs" data-del="0"><i class="fa fa-trash"></i></a></td>' +
            '</tr>';
        $('#items-table tbody').append(html);
    });
    $(document).on('click', '.row-del', function () {
        if($(this).attr('data-del') != '0') {
            var deleteId = $(this).attr('data-del');
            open_delete_dialog('main/delete_hostel_expense_item' , deleteId);
        } else {
            $(this).closest('tr').remove();
            $('#items-table tbody tr td:first-child').each(function (index, value) {
                $(this).html('<strong>' + (index + 1) + '</strong>');
            });
        }
    });
</script>
</body>
</html>