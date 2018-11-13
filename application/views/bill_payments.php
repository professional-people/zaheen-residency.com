<?php require_once 'inc/header.php'; ?>
<title>Bill Payments</title>
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
                            <a href="Javascript:;">Bill Payments</a>
                        </li>
                    </ul>
                    <ul class="page-breadcrumb pull-right">
                        <li>
                            <a href="javascript:;" id="setup-btn"
                               class="btn btn-primary btn-xs color-white">
                                <i class="fa fa-upload"></i> Bill Sheet
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
                                    Bill Payments
                                </div>
                            </div>
                            <div class="portlet-body">
                                <form class="form-horizontal" role="form" action="<?php echo base_url();?>bill-payments" method="POST">
                                    <div class="form-body">
                                        <div class="table-scrollable">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Room</th>
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
                                                                <option value="<?php echo  $room->room_id; ?>" <?php if($room_id == $room->room_id){ echo 'selected';}?>><?php echo  $room->room_title; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="month" class="form-control input-sm">
                                                            <option value="">---Select---</option>
                                                            <?php for ($i=1; $i<=12; $i++) { ?>
                                                            <option value="<?php echo $i;?>" <?php if($month == $i){ echo 'selected';}?>><?php echo date("F", mktime(0, 0, 0, $i, 10));?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="year" class="form-control input-sm">
                                                            <option value="">---Select---</option>
                                                            <?php for ($i = date('Y'); $i >= 2016; $i--) { ?>
                                                                <option value="<?php echo $i;?>" <?php if($year == $i){ echo 'selected';}?>><?php echo $i;?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td class="text-center">
                                                        <button name="search" class="btn btn-primary btn-sm" value="1">Search</button>
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
                                            <th>Room</th>
                                            <th width="1">Electronics</th>
                                            <th width="1">Last M.R</th>
                                            <th width="1">Cur M.R</th>
                                            <th width="1">Units</th>
                                            <th width="1">Unit Price</th>
                                            <th width="1">Total Amount</th>
                                            <th width="1">Received</th>
                                            <th width="70" class="text-center">Due</th>
                                            <th width="110">Date <a href="javascript:;" style="margin-left: 60%;" id="apply-dates" title="Apply to all"><i class="fa fa-calendar"></i></a></th>
                                            <th width="1">Operation</th>
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
                                                <form id="form-bill-payment-<?php echo $i; ?>" method="POST">
                                                    <input type="hidden" name="id" value="<?php echo $i;?>">
                                                    <input type="hidden" name="update_id" value="<?php echo $payment->id;?>">
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $payment->room_title; ?></td>
                                                    <td class="text-center"><?php echo $payment->facility_title; ?></td>
                                                    <td class="text-center">
                                                        <?php if($payment->bill_type == '1') { ?>
                                                        <input type="text" id="last-month-reading-<?php echo $i;?>" data-id="<?php echo $i;?>" name="" class="meter-calculations form-control input-sm text-center" value="<?php echo $payment->last_reading;?>" placeholder="0" readonly>
                                                        <?php } else { echo '-'; }?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if($payment->bill_type == '1') { ?>
                                                        <input type="text" id="curr-month-reading-<?php echo $i;?>" data-id="<?php echo $i;?>" name="meeter_reading" class="meter-calculations form-control input-sm text-center" value="<?php echo $payment->meter_reading;?>" placeholder="0">
                                                        <?php } else { echo '-'; }?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if($payment->bill_type == '1') { ?>
                                                        <strong id="units-<?php echo $i;?>">
                                                            <?php
                                                                $units = $payment->meter_reading - $payment->last_reading;
                                                                if($units < 0) {
                                                                    $units = 0;
                                                                    echo $units;
                                                                } else {
                                                                    echo $units;
                                                                }
                                                            ?>
                                                        </strong>
                                                        <?php } else { echo '-'; }?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if($payment->bill_type == '1') { ?>
                                                            <input type="text" id="unit-price-<?php echo $i;?>" data-id="<?php echo $i;?>"
                                                                   name="unit_price" class="meter-calculations form-control input-sm text-center input-cash"
                                                                   value="<?php echo $payment->unit_amount;?>"/>
                                                        <?php } else { echo '-'; }?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                        if ($payment->bill_type == '1') {
                                                            $totalAmount = $units * $payment->unit_amount;
                                                        } else {
                                                            $totalAmount = $payment->bill_amount;
                                                        }
                                                        ?>
                                                        <input type="hidden" id="total-<?php echo $i;?>" value="<?php echo $totalAmount; ?>">
                                                        <strong id="total-amount-<?php echo $i;?>">Rs. <?php echo $totalAmount; ?> </strong>
                                                    </td>
                                                    <td class="text-center">
                                                        <input type="text" name="cash_received" id="cash-received-<?php echo $i;?>" data-id="<?php echo $i;?>" class="input-cash form-control input-sm text-center" placeholder="0">
                                                    </td>
                                                    <td class="text-center">
                                                        <?php
                                                            $due = $totalAmount - $payment->paid_amount;
                                                        ?>
                                                        <input type="hidden" id="paid-<?php echo $i;?>" name="amount_paid" value="<?php echo $payment->paid_amount; ?>">
                                                        <input type="hidden" id="due-<?php echo $i;?>" name="due_amount" value="<?php echo $due; ?>">
                                                        <strong id="due-amount-<?php echo $i;?>">Rs. <?php echo $due; ?> </strong>
                                                    </td>
                                                    <td>
                                                        <input type="date" name="paid_date" class="form-control input-sm" value="<?php echo !empty($payment->cash_date) ? $payment->cash_date : $payment->sheet_for_month;?>" min="<?php echo $min_date;?>" max="<?php echo $max_date;?>">
                                                    </td>
                                                    <td>
                                                        <select name="operation" class="form-control input-sm" id="">
                                                            <option value="add">Add</option>
                                                            <option value="sub">Subtract</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center" style="vertical-align: middle;" id="status-<?php echo $i;?>">
                                                        <?php if ($payment->bill_status == '1') { ?>
                                                            <span style="color: green;">
                                                            <i class=" fa fa-circle fa-2x"></i>
                                                        </span>
                                                        <?php } else { if ($payment->bill_status == '2') { ?>
                                                            <span style="color: yellow;">
                                                            <i class=" fa fa-circle fa-2x"></i>
                                                        </span>
                                                        <?php } else { ?>
                                                            <span style="color: red;">
                                                            <i class=" fa fa-circle fa-2x" title="No payment received."></i>
                                                        </span>
                                                        <?php }} ?>
                                                    </td>
                                                </form>
                                            </tr>
                                        <?php }} else { ?>
                                        <tr>
                                            <td class="text-center" colspan="13"><strong>No Record Found!</strong></td>
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
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h4 class="modal-title">Bill Sheet</h4>
            </div>
            <div class="modal-body text-center">
                <div class="portlet-body form">
                    <form class="form-horizontal" data-toggle="validator" role="form" action="<?php echo base_url();?>post/add_bill_payment_sheet" method="post">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Select Month</label>
                            <div class="col-md-6">
                                <select name="sheet_month" class="form-control input-sm" data-error="Month required." required>
                                    <option value="">---Select---</option>
                                    <?php for ($i=1; $i<=12; $i++) { ?>
                                        <option value="<?php echo $i;?>" <?php if($month == $i){ echo 'selected';}?>><?php echo date("F", mktime(0, 0, 0, $i, 10));?></option>
                                    <?php } ?>
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Select Year</label>
                            <div class="col-md-6">
                                <select name="sheet_year" class="form-control input-sm" data-error="Year required." required>
                                    <option value="">---Select---</option>
                                    <?php for ($i = date('Y'); $i >= 2016; $i--) { ?>
                                        <option value="<?php echo $i;?>" <?php if($year == $i){ echo 'selected';}?>><?php echo $i;?></option>
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
                    submit_bill_payments($(this));
                }
            }
        });
    });

    $(document).on('dblclick','.input-cash',function () {
        var id = $(this).attr('data-id');
        $(this).removeAttr('readonly');
        $(this).val('');
        $('#operation_'+id).removeAttr('readonly');
        $('#cash_date_'+id).removeAttr('readonly');
    });

    function check_amount(target) {
        var id              = target.attr('data-id');
        var rent_amount     = $('#member_rent_'+id).val();
        var operation       = $('#operation_'+id).val();
        var value           = parseInt(target.val());
        var paid_amount     = parseInt($('#paid_amount_'+id).val());
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
                if(value > paid_amount) {
                    $('#msg-box').html("<h4>Cash Received should be less then paid.</h4>");
                    $('#msg-danger').modal('show');
                    return false;
                } else {
                    return true;
                }
            }
        }
    }

    function submit_bill_payments(target) {
        var form_id = target.attr('data-id');
        var value = target.val();
        if (value != '') {
            $('#status-'+form_id).html('<span><i class="fa fa-spinner fa-spin"></i></span>');
            $('#cash-received-'+(parseInt(form_id)+1)).focus();
            $.ajax({
                url: "<?php echo base_url();?>post/save_bill_payment_info",
                type: "POST",
                data: $('#form-bill-payment-' + form_id).serialize(),
                cache: false,
                success: function (data) {
                    var id          = data.id;
                    var paidAmount  = data.paid_amount;
                    var dueAmount   = data.due_amount;
                    var status      = data.status;
                    $('#paid-'+id).val(paidAmount);
                    $('#due-'+id).val(dueAmount);
                    $('#due-amount-'+id).html('Rs. ' + dueAmount);
                    if(status == '1') {
                        $('#status-'+id).html('<span style="color: green;"><i class=" fa fa-circle fa-2x"></i></span>');
                    } else {
                        if(status == '2') {
                            $('#status-'+id).html('<span style="color: yellow;"><i class=" fa fa-circle fa-2x"></i></span>');
                        } else {
                            $('#status-'+id).html('<span style="color: red;"><i class=" fa fa-circle fa-2x"></i></span>');
                        }
                        $('#cash-received-'+form_id).val('');
                    }
                    $('#cash_received_'+id).attr('readonly','');
                    $('#operation_'+id).attr('readonly','');
                    $('#cash_date_'+id).attr('readonly','');
                },
                error: function () {
                }
            });
        } else {
            $('#msg-box').html("<h4>Value can't be empty.</h4>");
            $('#msg-danger').modal('show');
        }
    }

    $(document).on('click','#setup-btn',function () {
        $('#setup').modal('show');
    });

    $(document).on('click','#apply-dates',function () {
        var val = $('#table-hostel-payments tbody tr:first input[type=date]').val();
        $('#table-hostel-payments tbody tr input[type=date]').val(val);

    });

    $(document).on('keyup','.meter-calculations',function () {
        var id = $(this).attr('data-id');
        var lastReading = parseInt($('#last-month-reading-'+id).val());
        var curReading = parseInt($('#curr-month-reading-'+id).val());
        var units = curReading - lastReading;
        var unitPrice = parseInt($('#unit-price-'+id).val());
        var totalAmount = units * unitPrice;
        var paidAmount = parseInt($('#paid-'+id).val());
        var dueAmount = totalAmount - paidAmount;
        $('#units-'+id).html(units);
        $('#total-amount-'+id).html('Rs. ' + totalAmount);
        $('#due-amount-'+id).html('Rs. ' + dueAmount);
    });
</script>
</body>
</html>