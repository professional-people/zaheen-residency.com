<?php require_once 'inc/header.php'; ?>
<title>Rent Payments</title>
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
                            <a href="javascript:;">Payments</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="Javascript:;">Rent Payments</a>
                        </li>
                    </ul>
                    <ul class="page-breadcrumb pull-right">
                        <li>
                            <a href="javascript:;" id="setup-btn"
                               class="btn btn-primary btn-xs color-white">
                                <i class="fa fa-upload"></i> Rent Sheet
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
                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->
                <div class="row">
                    <div class="col-md-12">
                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    Room Payments
                                </div>
                            </div>
                            <div class="portlet-body">
                                <form class="form-horizontal" role="form"
                                      action="<?php echo base_url(); ?>hostel-payment" method="POST">
                                    <div class="form-body">
                                        <div class="table-scrollable">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Room</th>
                                                    <th>Name</th>
                                                    <th>Status</th>
                                                    <th>Month</th>
                                                    <th>Year</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="room" class="form-control input-sm">
                                                            <option value="">---Select---</option>
                                                            <?php foreach ($rooms as $room) { ?>
                                                                <option value="<?php echo $room->room_id; ?>" <?php if ($this->input->post('room') == $room->room_id) {
                                                                    echo 'selected';
                                                                } ?>><?php echo $room->room_title; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="name" class="form-control input-sm"
                                                               placeholder="Name..."
                                                               value="<?php echo $this->input->post('name'); ?>">
                                                    </td>
                                                    <td>
                                                        <select name="status" class="form-control input-sm">
                                                            <option value="">---Select---</option>
                                                            <option value="0" <?php if ($this->input->post('status') == '0') {
                                                                echo 'selected';
                                                            } ?>>Red
                                                            </option>
                                                            <option value="1" <?php if ($this->input->post('status') == '1') {
                                                                echo 'selected';
                                                            } ?>>Green
                                                            </option>
                                                            <option value="2" <?php if ($this->input->post('status') == '2') {
                                                                echo 'selected';
                                                            } ?>>Yellow
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="month" id="sheet-month" class="form-control input-sm">
                                                            <option value="">---Select---</option>
                                                            <?php for ($i = 1; $i <= 12; $i++) { ?>
                                                                <option value="<?php echo $i; ?>" <?php if ($month == $i) {
                                                                    echo 'selected';
                                                                } ?>><?php echo date("F", mktime(0, 0, 0, $i, 10)); ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="year" id="sheet-year" class="form-control input-sm">
                                                            <option value="">---Select---</option>
                                                            <?php for ($i = date('Y'); $i >= 2016; $i--) { ?>
                                                                <option value="<?php echo $i; ?>" <?php if ($year == $i) {
                                                                    echo 'selected';
                                                                } ?>><?php echo $i; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
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
                                    <table id="table-hostel-payments" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="1">Sr.</th>
                                            <th>Name</th>
                                            <th>Room</th>
                                            <th width="1">Rent / Month</th>
                                            <th width="1">Cash Received</th>
                                            <th width="1">Paid Amount</th>
                                            <th width="1">Due Amount</th>
                                            <th width="180">Date <a href="javascript:;" style="margin-left: 60%;"
                                                                    id="apply-dates" title="Apply to all"><i
                                                            class="fa fa-calendar"></i></a></th>
                                            <th width="110">Operation</th>
                                            <th width="1">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (isset($payments) && count($payments) > 0) {
                                            $i = 0;
                                            foreach ($payments as $payment) {
                                                $i++;
                                                ?>
                                                <tr>
                                                    <form id="hostel-payment-form-<?php echo $i; ?>" method="POST">

                                                        <input type="hidden" name="id" value="<?php echo $i; ?>"/>
                                                        <input type="hidden" name="update_id" value="<?php echo $payment->id; ?>"/>
                                                        <input type="hidden" name="member_rent" value="<?php echo $payment->rent; ?>">
                                                        <input type="hidden" name="paid_amount" id="paid-amount-<?php echo $i; ?>" value="<?php echo $payment->paid_amount; ?>"/>
                                                        <input type="hidden" name="due_amount" id="due-amount-<?php echo $i; ?>"value="<?php echo $payment->rent - $payment->paid_amount; ?>"/>

                                                        <td><?php echo $i; ?></td>
                                                        <td>
                                                            <a href="javascript:;" class="btn btn-danger btn-xs btn-entry-remove" data-id="<?php echo $payment->id;?>" data-redirect="hostel-payment" data-table="rent_payments" data-col="id" title="Delete this member" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                                                            <a href="javascript:;" title="Click to view history" data-toggle="tooltip"
                                                               class="view-history" data-id="<?php echo $payment->member_id; ?>"><?php echo $payment->member_name; ?></a>
                                                        </td>
                                                        <td><?php echo $payment->room_title; ?></td>
                                                        <td class="text-center">Rs. <?php echo $payment->rent; ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="text" name="cash_received" id="cash-received-<?php echo $i; ?>"
                                                                   class="input-cash form-control input-sm text-center" placeholder="0"
                                                                   data-id="<?php echo $i; ?>" <?php if ($payment->rent == $payment->paid_amount) {
                                                                echo 'readonly';
                                                            } ?>>
                                                        </td>
                                                        <td class="text-center">
                                                            <strong id="paid-<?php echo $i; ?>">Rs. <?php echo !empty($payment->paid_amount) ? $payment->paid_amount : '0' ?></strong>
                                                        </td>
                                                        <td class="text-center">
                                                            <strong id="due-<?php echo $i; ?>">Rs. <?php echo $payment->rent - $payment->paid_amount; ?></strong>
                                                        </td>
                                                        <td>
                                                            <input type="date" name="cash_date" id="cash_date_<?php echo $i; ?>" class="form-control input-sm"
                                                                   value="<?php echo empty($payment->cash_date) ? $payment->rent_month : $payment->cash_date;?>"
                                                                   min="<?php echo $min_date;?>" max="<?php echo $max_date;?>"
                                                                <?php if ($payment->rent == $payment->paid_amount) { echo 'readonly'; } ?>/>
                                                        </td>
                                                        <td>
                                                            <select name="operation" class="form-control input-sm"
                                                                    id="operation_<?php echo $i; ?>" <?php if ($payment->rent == $payment->paid_amount) {
                                                                echo 'readonly';
                                                            } ?>>
                                                                <option value="add">Add</option>
                                                                <option value="sub">Subtract</option>
                                                            </select>
                                                        </td>
                                                        <td class="text-center" style="vertical-align: middle;"
                                                            id="status-<?php echo $i; ?>">
                                                            <?php if ($payment->status == '1') { ?>
                                                                <span style="color: green;">
                                                            <i class=" fa fa-circle fa-2x"></i>
                                                        </span>
                                                            <?php } else {
                                                                if ($payment->status == '2') { ?>
                                                                    <span style="color: yellow;">
                                                            <i class=" fa fa-circle fa-2x"></i>
                                                        </span>
                                                                <?php } else { ?>
                                                                    <span style="color: red;">
                                                            <i class=" fa fa-circle fa-2x"></i>
                                                        </span>
                                                                <?php }
                                                            } ?>
                                                        </td>
                                                    </form>
                                                </tr>
                                            <?php }
                                        } else { ?>
                                            <tr>
                                                <td class="text-center" colspan="11"><strong>No Record Found!</strong>
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
<!--Setup Model-->
<div class="modal fade" id="setup" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    Rent Sheet
                </h4>
            </div>
            <div class="modal-body text-center">
                <div class="portlet-body form">
                    <form class="form-horizontal" data-toggle="validator" role="form"
                          action="<?php echo base_url(); ?>post/add_rent_payment_sheet" method="post">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Select Month</label>
                            <div class="col-md-6">
                                <select name="month" class="form-control input-sm" data-error="Month required."
                                        required>
                                    <option value="">---Select---</option>
                                    <?php for ($i = 1; $i <= 12; $i++) { ?>
                                        <option value="<?php echo $i; ?>" <?php if ($month == $i) {
                                            echo 'selected';
                                        } ?>><?php echo date("F", mktime(0, 0, 0, $i, 10)); ?></option>
                                    <?php } ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Select Year</label>
                            <div class="col-md-6">
                                <select name="year" class="form-control input-sm" data-error="Year required." required>
                                    <option value="">---Select---</option>
                                    <?php for ($i = date('Y'); $i >= 2016; $i--) { ?>
                                        <option value="<?php echo $i; ?>" <?php if ($year == $i) {
                                            echo 'selected';
                                        } ?>><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn blue btn-sm">Create</button>
                                    <button type="submit" class="btn green btn-sm">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="view-history-model" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-blue">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h4 class="modal-title">
                    View History
                </h4>
            </div>
            <div class="modal-body">
                <div class="portlet-body form">
                    <div class="table-scrollable">
                        <table class="table table-bordered" id="view-history-table">
                            <thead>
                            <tr>
                                <th>Sr.No</th>
                                <th>Paid</th>
                                <th>Date</th>
                                <th>Operation</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center" colspan="6"><strong>No Record Found.</strong></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End -->
<?php require_once 'inc/footer.php'; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $(".input-cash").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 13) {
                return false;
            } else {
                if (e.which == 13) {
                    e.preventDefault();
                    if (check_amount($(this))) {
                        submit_hostel_payments($(this));
                    }
                }
            }
        });
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).on('dblclick', '.input-cash', function () {
        var id = $(this).attr('data-id');
        $(this).removeAttr('readonly');
        $(this).val('');
        $('#operation_' + id).removeAttr('readonly');
        $('#cash_date_' + id).removeAttr('readonly');
    });

    function check_amount(target) {
        var id = target.attr('data-id');
        var rent_amount = $('#member_rent_' + id).val();
        var operation = $('#operation_' + id).val();
        var value = parseInt(target.val());
        var paid_amount = parseInt($('#paid_amount_' + id).val());
        if (operation == 'add') {
            var total = paid_amount + value;
            if (total > rent_amount) {
                $('#msg-box').html("<h4>Cash Received + Total Paid should be less then Member Rent.</h4>");
                $('#msg-danger').modal('show');
                return false;
            } else {
                return true;
            }
        } else {
            if (operation == 'sub') {
                if (value > paid_amount) {
                    $('#msg-box').html("<h4>Cash Received should be less then paid.</h4>");
                    $('#msg-danger').modal('show');
                    return false;
                } else {
                    return true;
                }
            }
        }
    }

    function submit_hostel_payments(target) {
        var form_id = target.attr('data-id');
        var value = target.val();
        if (value != '') {
            $('#status-' + form_id).html('<span><i class="fa fa-spinner fa-spin"></i></span>');
            $('#cash-received-' + (parseInt(form_id) + 1)).focus();
            $('#cash-received-' + form_id).attr('readonly', '');
            $.ajax({
                url: "<?php echo base_url();?>post/save_rent_payment_info",
                type: "POST",
                data: $('#hostel-payment-form-' + form_id).serialize(),
                cache: false,
                success: function (data) {
                    var id = data.id;
                    var paidAmount = data.paid_amount;
                    var dueAmount = data.due_amount;
                    var status = data.status;
                    $('#paid-amount-' + id).val(paidAmount);
                    $('#paid-' + id).html('Rs. ' + paidAmount);
                    $('#due-' + id).html('Rs. ' + dueAmount);
                    if (status == '1') {
                        $('#status-' + id).html('<span style="color: green;"><i class=" fa fa-circle fa-2x"></i></span>');
                    } else {
                        if (status == '2') {
                            $('#status-' + id).html('<span style="color: yellow;"><i class=" fa fa-circle fa-2x"></i></span>');
                        } else {
                            $('#status-' + id).html('<span style="color: red;"><i class=" fa fa-circle fa-2x"></i></span>');
                        }
                    }
                },
                error: function () {
                }
            });
        } else {
            $('#msg-box').html("<h4>Value can't be empty.</h4>");
            $('#msg-danger').modal('show');
        }
    }

    $(document).on('click', '#setup-btn', function () {
        $('#setup').modal('show');
    });

    $(document).on('click', '.view-history', function () {
        var user_id = $(this).attr('data-id');
        var year = $('#sheet-year').val();
        var month = $('#sheet-month').val();
        $('#view-history-table tbody').html('<tr><td colspan="6" class="text-center"><i class="fa fa-spinner fa-spin"></i></td></tr>');
        $('#view-history-model').modal('show');
        var url = '<?php echo base_url();?>post/view_rent_history/' + year + '/' + month + '/' + user_id;
        var append = '';
        var total = 0;
        $.ajax({
            url: url,
            cache: false,
            success: function (data) {
                $.each(data, function (index, value) {
                    total+= parseInt(value.cash_received);
                    append += '<tr><td>' + (index + 1)+ '</td><td>' + value.cash_received + '</td><td>' + value.cash_date + '</td>';
                    append += '<td>' + value.opetaion + '</td>';
                    append += '</tr>';
                });
                append += '<tr><td colspan="4"><strong>Total: Rs. ' + total + '</strong></td></tr>';
                $('#view-history-table tbody').html(append);
            },
            error: function () {
            }
        });
    });

    $(document).on('click', '#apply-dates', function () {
        var val = $('#table-hostel-payments tbody tr:first input[type=date]').val();
        $('#table-hostel-payments tbody tr input[type=date]').val(val);

    });
</script>
</body>
</html>