<?php require_once 'inc/header.php'; ?>
<title>Daily Expense</title>
<style type="text/css">
    .modal-header {
        background: #3598dc;
        color: #ffffff;
    }

    .modal-max-height {
        max-height: 400px;
        overflow-y: auto;
    }
</style>
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
                            <a href="Javascript:;">Mess Expense</a>
                        </li>
                    </ul>
                    <ul class="page-breadcrumb pull-right">
                        <li>
                            <a href="<?php echo base_url(); ?>expense-list/mess" class="btn btn-primary btn-xs color-white">
                                <i class="fa fa-plus-square"></i> Add New List</a>
                        </li>
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
                                    Daily Expenses
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="250">Type</th>
                                            <th width="250">Month</th>
                                            <th width="250">Year</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <form action="<?php echo base_url(); ?>mess-expense" method="post">
                                            <tr>
                                                <td>
                                                    <select name="type" class="form-control input-sm">
                                                        <option value="">---Select---</option>
                                                        <?php foreach ($types as $type) { ?>
                                                            <option value="<?php echo $type->expense_type_id; ?>" <?php if($type_id == $type->expense_type_id) { echo 'selected';}?>><?php echo $type->title; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="month" class="form-control input-sm">
                                                        <option value="">---Select---</option>
                                                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                                                            <option value="<?php echo $i; ?>" <?php if ($month == $i) {
                                                                echo 'selected';
                                                            } ?>><?php echo date("F", mktime(0, 0, 0, $i, 10)); ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="year" class="form-control input-sm">
                                                        <option value="">---Select---</option>
                                                        <?php for ($i = date('Y'); $i >= 2016; $i--) { ?>
                                                            <option value="<?php echo $i; ?>" <?php if ($year == $i) {
                                                                echo 'selected';
                                                            } ?>><?php echo $i; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn blue btn-sm">View</button>
                                                </td>
                                            </tr>
                                        </form>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="table-scrollable">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="1">Sr.</th>
                                            <th>Expense Type</th>
                                            <th>Expense Title</th>
                                            <th>Total</th>
                                            <th>Dated</th>
                                            <th width="210">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            $total = 0;
                                            if (isset($expenses) && count($expenses) > 0) {
                                                $i = 1;
                                                foreach ($expenses as $expense) {
                                                    $total = $total + $expense->total;
                                        ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><strong><?php echo $expense->title; ?></strong></td>
                                                    <td>
                                                        <a href="<?php echo base_url() . 'update-expense-list/mess/' . $expense->expense_list_id; ?>"
                                                           data-toggle="tooltip" title="Edit Details">
                                                            <?php echo $expense->expense_title; ?>
                                                        </a>
                                                    </td>
                                                    <td>Rs. <?php echo !empty($expense->total) ? $expense->total : '0'; ?></td>
                                                    <td><?php echo $expense->expense_month; ?></td>
                                                    <td>
                                                        <a href="javascript:;" class="btn blue btn-xs add-btn"
                                                           title="Add daily expense to list" data-toggle="tooltip"
                                                           data-title="<?php echo $expense->expense_title; ?>" data-id="<?php echo $expense->expense_list_id; ?>">
                                                            <i class="fa fa-plus"></i> Add
                                                        </a>
                                                        <a href="javascript:;" class="view-expense btn green btn-xs"
                                                           title="View" data-id="<?php echo $expense->expense_list_id; ?>"
                                                           data-type="<?php echo $expense->expense_title; ?>">
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
                                                <td colspan="6" align="center"><strong>Sorry! No Record Found.</strong>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="6"><strong>Total: Rs. <?php echo $total;?></strong></td>
                                        </tr>
                                        </tfoot>
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

<div class="modal fade" id="view-expense-model" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="title" class="modal-title"></h4>
            </div>
            <div id="load-expense-data" class="modal-body">
                <div class="text-center">
                    <i class="color-blue fa fa-spinner fa-spin fa-2x"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="add-expense-model" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 id="add-expense-title" class="modal-title">Title</h4>
            </div>
            <div id="load-expense-data" class="modal-body">
                <form action="<?php echo base_url();?>post/save_daily_expense" method="POST">
                    <input type="hidden" name="expense_list_id" value="0" id="expense-list-id">
                    <input type="hidden" name="redirect" value="0">
                    <div class="portlet-body modal-max-height">
                        <div class="table-scrollable">
                            <table id="items-table" class="table table-bordered">
                                <thead>
                                <tr>
                                    <th width="1">Sr.</th>
                                    <th>Date</th>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Details</th>
                                    <th width="1">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">
                                        <strong>1</strong>
                                    </td>
                                    <td>
                                        <input type="date" name="item_date[]" class="form-control input-sm"
                                               value="<?php echo date("Y-m-d"); ?>">
                                    </td>
                                    <td>
                                        <input type="text" name="item[]"
                                               class="form-control input-sm" placeholder="Item">
                                    </td>
                                    <td>
                                        <input type="text" name="item_price[]"
                                               class="input-cash form-control input-sm"
                                               placeholder="0">
                                    </td>
                                    <td>
                                        <input type="text" name="item_detail[]"
                                               class="form-control input-sm"
                                               placeholder="Detail">
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:;" id="add-row"
                                           class="btn btn-primary btn-xs">+</a>
                                    </td>
                                </tr>
                                <?php for ($i = 2; $i <= 5; $i++) { ?>
                                    <tr>
                                        <td class="text-center">
                                            <strong><?php echo $i; ?></strong>
                                        </td>
                                        <td>
                                            <input type="date" name="item_date[]" class="form-control input-sm"
                                                   value="<?php echo date("Y-m-d"); ?>">
                                        </td>
                                        <td>
                                            <input type="text" name="item[]"
                                                   class="form-control input-sm" placeholder="Item">
                                        </td>
                                        <td>
                                            <input type="text" name="item_price[]"
                                                   class="input-cash form-control input-sm"
                                                   placeholder="0">
                                        </td>
                                        <td>
                                            <input type="text" name="item_detail[]"
                                                   class="form-control input-sm"
                                                   placeholder="Detail">
                                        </td>
                                        <td class="text-center">
                                            <a href="javascript:;" class="btn btn-danger btn-xs row-del"><i
                                                        class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-bordered">
                            <tfoot>
                            <tr>
                                <td colspan="6">
                                    <strong id="total-rupees">Total Rs. 0</strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="6" class="text-center">
                                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'inc/footer.php'; ?>
<script type="text/javascript">
    $(document).on('click', '.view-expense', function () {
        var expenseId = $(this).attr('data-id');
        if (expenseId == "") { return false;}
        var title = $(this).attr('data-type');
        var path = '<?php echo base_url();?>main/view_expense_list_items/' + expenseId;
        $('#title').html(title);
        $('#view-expense-model').modal('show');
        var total = 0;
        $.ajax({
            url: path,
            cache: false,
            success: function (data) {
                var html = '<table class="table table-bordered">' +
                    '<thead><tr><th width="1">Sr.</th><th width="115">Date</th><th>Item</th><th width="100">Price</th>' +
                    '<th>Details</th><th width="160">Action</th></tr></thead><tbody>';
                $.each(data, function (index, value) {
                    html += '<tr id="expense-view-row-' + (index + 1) + '">' +
                        '<td><strong>' + (index + 1) + '</strong></td>' +
                        '<td><input type="text" id="e-date-' + (index + 1) + '" class="form-control input-sm" value="' + value.item_date + '" readonly/></td>' +
                        '<td><input type="text" id="e-item-' + (index + 1) + '" class="form-control input-sm" value="' + value.item + '" readonly/></td>' +
                        '<td><input type="text" id="e-price-' + (index + 1) + '" class="form-control input-sm input-cash input-cash-edit" value="' + value.item_price + '" readonly/></td>' +
                        '<td><input type="text" id="e-detail-' + (index + 1) + '" class="form-control input-sm" value="' + value.item_detail + '" readonly/></td>' +
                        '<td><a href="javascript:;" id="e-btn-' + (index + 1) + '" class="btn btn-primary btn-xs view-btn" update-id="' + value.id + '" data-action="0" data-id="' + (index + 1) + '"><i class="fa fa-edit"></i> Edit</a><a href="javascript:;" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a></td>' +
                        '</tr>';
                    total += parseInt(value.item_price);
                });
                html += '<tr><td colspan="5"><strong id="total-expense-view">Total : Rs. ' + total + '</strong></td></tr>';
                html += '</tbody></table>';
                $('#load-expense-data').html(html);
            },
            error: function () {
            }
        });
    });

    $(document).on('click', '.view-btn', function () {
        var action = $(this).attr('data-action');
        var id = $(this).attr('data-id');
        if (action == '0') {
            $('#expense-view-row-'+id+' td input').removeAttr('readonly');
            $(this).attr('data-action','1');
            $(this).html('<i class="fa fa-edit"></i> Update');
        } else {
            var date = $('#e-date-'+id).val();
            var item = $('#e-item-'+id).val();
            var price = $('#e-price-'+id).val();
            var detail = $('#e-detail-'+id).val();
            var update_id = $(this).attr('update-id');
            $('#e-btn-'+id).html('<i class="fa fa-spin fa-spinner"></i> Update');
            var data = [{"update_id": update_id, "date": date, "item": item, "price": price, "detail": detail}];
            var path = '<?php echo base_url();?>post/update_daily_expense_item';
            $.ajax({
                url: path,
                type: "POST",
                data: { data: data },
                dataType: "JSON",
                cache: false,
                success: function (data) {
                    if (data == '1') {
                        $('#expense-view-row-'+id+' td input').attr('readonly','');
                        $('#e-btn-'+id).attr('data-action','0');
                        $('#e-btn-'+id).html('<i class="fa fa-edit"></i> Edit');
                    }
                },
                error: function () {
                }
            });
        }
    });

    $(document).on('click', '.add-btn', function () {
        if ($(this).attr('data-id') == "") { return false;}
        $('#add-expense-title').html($(this).attr('data-title'));
        $('#expense-list-id').val($(this).attr('data-id'));
        $('#add-expense-model').modal('show');
    });

    $(document).on('click', '#add-row', function () {
        var html = '';
        var length = parseInt($('#items-table tbody tr').length) + 1;
        html += '<tr><input type="hidden" name="expense_details_id[]" value="0">' +
            '<td class="text-center"><strong>' + length + '</strong></td>' +
            '<td><input type="date" name="item_date[]" value="<?php echo date("Y-m-d");?>" class="form-control input-sm"></td>' +
            '<td><input type="text" name="item[]" class="form-control input-sm" placeholder="Item"></td>' +
            '<td><input type="text" name="item_price[]" class="form-control input-sm input-cash" placeholder="0"></td>' +
            '<td><input type="text" name="item_detail[]" class="form-control input-sm" placeholder="Detail"></td>' +
            '<td class="text-center"><a href="javascript:;" class="row-del btn btn-danger btn-xs" data-del="0"><i class="fa fa-trash"></i></a></td>' +
            '</tr>';
        $('#items-table tbody').append(html);
    });

    $(document).on('click', '.row-del', function () {
        $(this).closest('tr').remove();
        $('#items-table tbody tr td:first-child').each(function (index, value) {
            $(this).html('<strong>' + (index + 1) + '</strong>');
            var total = 0;
            $('.input-cash').each(function () {
                if ($(this).val() != '') {
                    total += parseInt($(this).val());
                }
            });
            $('#total-rupees').html('Total Rs. ' + total);
        });
    });

    $(document).on('keyup', '.input-cash', function () {
        var total = 0;
        $('.input-cash').each(function () {
            if ($(this).val() != '') {
                total += parseInt($(this).val());
            }
        });
        $('#total-rupees').html('Total Rs. ' + total);
    });

    $(document).on('keyup', '.input-cash-edit', function () {
        var total = 0;
        $('.input-cash-edit').each(function () {
            if ($(this).val() != '') {
                total += parseInt($(this).val());
            }
        });
        $('#total-expense-view').html('Total Rs. ' + total);
    });

    $(document).on('keypress', '.input-cash', function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
</script>
</body>
</html>