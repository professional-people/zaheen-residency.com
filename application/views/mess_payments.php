<?php require_once 'inc/header.php'; ?>
<title>Mess Payments</title>
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
                            <a href="Javascript:;">Mess Payments</a>
                        </li>
                    </ul>
                    <ul class="page-breadcrumb pull-right">
                        <li>
                            <a href="javascript:;" id="setup-btn"
                               class="btn btn-primary btn-xs color-white">
                                <i class="fa fa-upload"></i> Mess Sheet
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
                                    Mess Payment
                                </div>
                            </div>
                            <div class="portlet-body">
                                <form class="form-horizontal" role="form" action="<?php echo base_url();?>mess-payments" method="POST">
                                    <div class="form-body">
                                        <div class="table-scrollable">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th width="282">Name</th>
                                                    <th>Status</th>
                                                    <th>Month</th>
                                                    <th>Year</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <input type="text" name="name" value="<?php echo $name;?>" class="form-control input-sm" placeholder="Search...">
                                                    </td>
                                                    <td>
                                                        <select name="status" class="form-control input-sm">
                                                            <option value="">---Select---</option>
                                                            <option value="0" <?php if($this->input->post('status') == '0'){ echo 'selected';}?>>Red</option>
                                                            <option value="1" <?php if($this->input->post('status') == '1'){ echo 'selected';}?>>Green</option>
                                                            <option value="2" <?php if($this->input->post('status') == '2'){ echo 'selected';}?>>Yellow</option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="month" class="form-control input-sm">
                                                            <option value="">---Select---</option>
                                                            <?php for ($i=1; $i<=12; $i++) { ?>
                                                                <option value="<?php echo $i;?>" <?php if($forMonth == $i){ echo 'selected';}?>><?php echo date("F", mktime(0, 0, 0, $i, 10));?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="year" class="form-control input-sm">
                                                            <option value="">---Select---</option>
                                                            <?php for ($i = date('Y'); $i >= 2016; $i--) { ?>
                                                                <option value="<?php echo $i;?>" <?php if($forYear == $i){ echo 'selected';}?>><?php echo $i;?></option>
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
                                    <table id="table-hostel-payments" class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="1">Sr.</th>
                                            <th width="200">Name</th>
                                            <th width="1" class="text-center">Mess Dates</th>
                                            <th width="1" class="text-center">Mess Charges</th>
                                            <th width="1" class="text-center">Cash Received</th>
                                            <th width="1" class="text-center">Due Amount</th>
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
                                                    $dueAmount = $payment->mess_charges - $payment->amount_paid;
                                                    if (strtotime($payment->end_date) < strtotime(date("Y-m-d"))) {
                                                        $class = 'text-danger';
                                                    } else {
                                                        $class = '';
                                                    }
                                        ?>
                                            <tr>
                                                <form id="form-mess-payment-<?php echo $i; ?>" method="POST">
                                                    <input type="hidden" name="id" value="<?php echo $i; ?>">
                                                    <input type="hidden" name="update_id" value="<?php echo $payment->id; ?>">
                                                    <input type="hidden" name="paid_amount" id="paid-<?php echo $i; ?>" value="<?php echo $payment->amount_paid; ?>">
                                                    <input type="hidden" name="due_amount" id="due-<?php echo $i;?>" value="<?php echo $dueAmount; ?>">
                                                    <td class="text-center"><?php echo $i; ?></td>
                                                    <td>
                                                        <a href="javascript:;" class="btn btn-danger btn-xs btn-entry-remove" title="Delete this entry" data-toggle="tooltip" data-redirect="mess-payments" data-id="<?php echo $payment->id;?>" data-table="mess_payment" data-col="id"><i class="fa fa-trash"></i></a>
                                                        <a href="<?php echo base_url().'update-outside-mess/'.$payment->mess_id;?>" class="btn btn-primary btn-xs" title="Edit Info" data-toggle="tooltip"><i class="fa fa-edit"></i></a>
                                                        <a class="<?php echo $class;?>" title="Mobile: <?php echo $payment->mobile_no;?>" data-toggle="tooltip">
                                                            <?php echo $payment->name; ?>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="<?php echo $class;?>" title="<?php echo $payment->mess_details;?>" data-toggle="tooltip">
                                                            <?php echo date("d-M-Y", strtotime($payment->start_date)) . '<br/> To ' . '<br/>' . date("d-M-Y", strtotime($payment->end_date)); ?>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <strong >Rs. <?php echo $payment->mess_charges?></strong></span>
                                                    </td>
                                                    <td>
                                                        <input type="text" id="cash-received-<?php echo $i;?>" name="cash_received" data-id="<?php echo $i;?>" class="form-control input-sm text-center input-cash" placeholder="0">
                                                    </td>
                                                    <td class="text-center">
                                                        <strong id="due-amount-<?php echo $i;?>" class="<?php echo $class;?>">Rs. <?php echo $dueAmount;?></strong>
                                                    </td>
                                                    <td>
                                                        <input type="date" id="payment-date-<?php echo $i;?>" name="payment_date" class="form-control input-sm" value="<?php echo !empty($payment->payment_date) ? $payment->payment_date : date("Y-m-d"); ?>">
                                                    </td>
                                                    <td>
                                                        <select name="operation" class="form-control input-sm" id="operation-<?php echo $i;?>">
                                                            <option value="add">Add</option>
                                                            <option value="sub">Subtract</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center" style="vertical-align: middle;" id="status-<?php echo $i;?>">
                                                        <?php if ($payment->pay_status == '1') { ?>
                                                            <span style="color: green;">
                                                            <i class=" fa fa-circle fa-2x"></i>
                                                        </span>
                                                        <?php } else { if ($payment->pay_status == '2') { ?>
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
                                            <td class="text-center" colspan="9"><strong>No Record Found!</strong></td>
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
                    Mess Sheet
                </h4>
            </div>
            <div class="modal-body text-center">
                <div class="portlet-body form">
                    <form class="form-horizontal" data-toggle="validator" role="form" action="<?php echo base_url();?>post/add_new_mess_sheet" method="post">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Select Month</label>
                            <div class="col-md-6">
                                <select name="sheet_month" class="form-control input-sm" data-error="Month required." required>
                                    <option value="">---Select---</option>
                                    <?php for ($i=1; $i<=12; $i++) { ?>
                                        <option value="<?php echo $i;?>" <?php if($forMonth == $i){ echo 'selected';}?>><?php echo date("F", mktime(0, 0, 0, $i, 10));?></option>
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
                                        <option value="<?php echo $i;?>" <?php if($forYear == $i){ echo 'selected';}?>><?php echo $i;?></option>
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
                    submit_mess_payments($(this));
                }
            }
        });
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).on('dblclick','.input-cash',function () {
        var id = $(this).attr('data-id');
        $(this).removeAttr('readonly');
        $(this).val('');
        $('#operation-'+id).removeAttr('readonly');
        $('#payment-date-'+id).removeAttr('readonly');
    });

    function submit_mess_payments(target) {
        var id = target.attr('data-id');
        var value = target.val();
        if (value != '' && value != '0') {
            $('#status-'+id).html('<span><i class="fa fa-spinner fa-spin"></i></span>');
            $('#cash-received-'+id).attr('readonly','');
            $('#operation-'+id).attr('readonly','');
            $('#payment-date-'+id).attr('readonly','');
            $('#cash-received-' + (parseInt(id)+1)).focus();
            $.ajax({
                url: "<?php echo base_url();?>post/save_mess_payment_info",
                type: "POST",
                data: $('#form-mess-payment-' + id).serialize(),
                cache: false,
                success: function (data) {
                    var responseId  = data.id;
                    var paidAmount  = data.paid_amount;
                    var dueAmount   = data.due_amount;
                    var status      = data.status;

                    $('#paid-'+responseId).val(paidAmount);
                    $('#due-'+responseId).val(dueAmount);

                    $('#due-amount-'+responseId).html('Rs. ' + dueAmount);
                    if(status == '1') {
                        $('#status-'+responseId).html('<span style="color: green;"><i class=" fa fa-circle fa-2x"></i></span>');
                    } else {
                        if(status == '2') {
                            $('#status-'+responseId).html('<span style="color: yellow;"><i class=" fa fa-circle fa-2x"></i></span>');
                        } else {
                            $('#status-'+responseId).html('<span style="color: red;"><i class=" fa fa-circle fa-2x"></i></span>');
                        }
                    }
                },
                error: function () {
                }
            });
        } else {
            sysAlert('Error','Value can not be empty.','text-danger');
        }
    }

    $(document).on('click','#setup-btn',function () {
        $('#setup').modal('show');
    });

    $(document).on('click','#apply-dates',function () {
        var val = $('#table-hostel-payments tbody tr:first input[type=date]').val();
        $('#table-hostel-payments tbody tr input[type=date]').val(val);
    });
</script>
</body>
</html>