<?php require_once 'inc/header.php'; ?>
<title>Worker Expense</title>
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
                            <a href="javascript:;">Expense</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="Javascript:;">Worker Expense</a>
                        </li>
                    </ul>
                    <ul class="page-breadcrumb pull-right">
                        <li>
                            <a href="javascript:;" id="add-new-sheet"
                               class="btn btn-primary btn-xs color-white">
                                <i class="fa fa-upload"></i> Worker Sheet
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
                                    Workers Expense
                                </div>
                            </div>
                            <div class="portlet-body">
                                <form class="form-horizontal" role="form" action="<?php echo base_url();?>worker-expense" method="POST">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="heading">
                                                    <p>Filters</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="table-scrollable">
                                            <table class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th width="250">Month</th>
                                                    <th width="250">Year</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="month" id="month" class="form-control input-sm">
                                                            <option value="">---Select---</option>
                                                            <?php for ($i=1; $i<=12; $i++) { ?>
                                                                <option value="<?php echo $i;?>" <?php if($i == $forMonth){echo 'selected';}?>><?php echo date("F", mktime(0, 0, 0, $i, 10));?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="year" id="year" class="form-control input-sm">
                                                            <option value="">---Select---</option>
                                                            <?php for ($i = date('Y'); $i >= 2016; $i--) { ?>
                                                                <option value="<?php echo $i;?>" <?php if($i == $forYear){echo 'selected';}?>><?php echo $i;?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <button name="search" class="btn btn-primary btn-sm" value="1">Search</button>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                                <div class="heading">
                                    <p>Worker Expense Sheet</p>
                                </div>
                                <div class="table-scrollable">
                                    <table id="table-hostel-payments" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="1">Sr.</th>
                                            <th>Name</th>
                                            <th width="100" class="text-center">Salary</th>
                                            <th width="150" class="text-center">Amount</th>
                                            <th width="150" class="text-center">Paid</th>
                                            <th width="150" class="text-center">Due</th>
                                            <th width="180">Date <a href="javascript:;" style="margin-left: 60%;" id="apply-dates" title="Apply to all"><i class="fa fa-calendar"></i></a></th>
                                            <th>Operation</th>
                                            <th width="1">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (isset($workerExpense) && count($workerExpense) > 0) {
                                            $i = 0;
                                            foreach ($workerExpense as $expenseList) {
                                                $i++;
                                                ?>
                                            <tr>
                                                <form id="form-worker-expense-<?php echo $i; ?>" method="POST">
                                                    <input type="hidden" name="id" value="<?php echo $i; ?>">
                                                    <input type="hidden" name="update_id" value="<?php echo $expenseList->id; ?>">
                                                    <input type="hidden" name="paid_amount" id="paid-amount-<?php echo $i;?>" value="<?php echo $expenseList->paid_amount; ?>">
                                                    <input type="hidden" name="due_amount" id="due-amount-<?php echo $i;?>" value="<?php echo $expenseList->salary - $expenseList->paid_amount; ?>">
                                                    <td><?php echo $i; ?></td>
                                                    <td><a href="javascript:;" class="view-expense-log" data-toggle="tooltip" title="View Log" data-expense="<?php echo $expenseList->id;?>"><?php echo $expenseList->worker_name; ?></a></td>
                                                    <td class="text-center"><strong>Rs. <?php echo $expenseList->salary; ?></strong></td>
                                                    <td>
                                                        <input type="text" id="cash-paid-<?php echo $i;?>" data-id="<?php echo $i;?>" name="cash_paid" class="form-control input-sm text-center input-cash" placeholder="0">
                                                    </td>
                                                    <td class="text-center"><strong id="paid-<?php echo $i;?>">Rs. <?php echo $expenseList->paid_amount; ?></strong></td>
                                                    <td class="text-center"><strong id="due-amount-view-<?php echo $i;?>">Rs.<?php echo $expenseList->salary - $expenseList->paid_amount; ?></strong></td>
                                                    <td>
                                                        <input type="date" id="payment-date-<?php echo $i;?>" name="paid_date" class="form-control input-sm"
                                                               value="<?php echo !empty($expenseList->paid_date) ? $expenseList->paid_date : $expenseList->expense_month; ?>"
                                                               min="<?php echo $min_date;?>" max="<?php echo $max_date;?>"/>
                                                    </td>
                                                    <td>
                                                        <select name="operation" class="form-control input-sm" id="operation-<?php echo $i;?>">
                                                            <option value="add">Add</option>
                                                            <option value="sub">Subtract</option>
                                                        </select>
                                                    </td>
                                                    <td class="text-center" style="vertical-align: middle;" id="status-<?php echo $i;?>">
                                                        <?php if ($expenseList->status == '1') { ?>
                                                            <span style="color: green;">
                                                            <i class=" fa fa-circle fa-2x"></i>
                                                        </span>
                                                        <?php } else { if ($expenseList->status == '2') { ?>
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
                                            <td class="text-center" colspan="9">
                                                <strong>No Record Found!</strong>
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
<div class="modal fade" id="monthly-expense-new-sheet" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    Worker Sheet
                </h4>
            </div>
            <div class="modal-body text-center">
                <div class="portlet-body form">
                    <form class="form-horizontal" data-toggle="validator" role="form" action="<?php echo base_url();?>post/add_worker_expense_sheet" method="post">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Select Month</label>
                            <div class="col-md-6">
                                <select name="sheet_month" class="form-control input-sm" data-error="Month required." required>
                                    <option value="">---Select---</option>
                                    <?php for ($i=1; $i<=12; $i++) { ?>
                                        <option value="<?php echo $i;?>" <?php if($i == date("m")){echo 'selected';}?>><?php echo date("F", mktime(0, 0, 0, $i, 10));?></option>
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
                                        <option value="<?php echo $i;?>" <?php if($i == date("Y")){echo 'selected';}?>><?php echo $i;?></option>
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
<div class="modal fade" id="modal-worker-expense-log" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h4 class="modal-title">Worker Expense Log</h4>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Sr.No</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Operation</th>
                    </tr>
                    <tbody id="expense-log-area"></tbody>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require_once 'inc/footer.php'; ?>
<script type="text/javascript">
    $(document).ready(function () {
        $(".input-cash").keypress(function (e) {
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 13) {
                return false;
            } else {
                if (e.which == 13) {
                    e.preventDefault();
                    submit_form($(this));
                }
            }
        });
    });

    function submit_form(target) {
        var id = target.attr('data-id');
        var value = target.val();
        if (value != '' && value != '0') {
            $('#status-'+id).html('<span><i class="fa fa-spinner fa-spin"></i></span>');
            $.ajax({
                url: "<?php echo base_url();?>post/save_worker_expense_info",
                type: "POST",
                data: $('#form-worker-expense-' + id).serialize(),
                cache: false,
                success: function (data) {
                    var id          = data.id;
                    var paidAmount  = data.paid_amount;
                    var dueAmount   = data.due_amount;
                    var status      = data.status;
                    $('#paid-amount-' + id).val(paidAmount);
                    $('#due-amount-' + id).val(dueAmount);
                    $('#due-amount-view-' + id).html('Rs. ' + dueAmount);
                    $('#paid-' + id).html('Rs. ' + paidAmount);
                    if(status == '1') {
                        $('#status_'+id).html('<span style="color: green;"><i class=" fa fa-circle fa-2x"></i></span>');
                    } else {
                        if(status == '2') {
                            $('#status-'+id).html('<span style="color: yellow;"><i class=" fa fa-circle fa-2x"></i></span>');
                        } else {
                            $('#status-'+id).html('<span style="color: red;"><i class=" fa fa-circle fa-2x"></i></span>');
                        }
                    }
                    $('#cash-paid-' + id).val('');
                    $('#cash-paid-' + (parseInt(id)+1)).focus();
                },
                error: function () {
                }
            });
        } else {
            sysAlert('Error','Value can not be empty.','text-danger');
        }
    }

    $(document).on('click','#add-new-sheet',function () {
        $('#monthly-expense-new-sheet').modal('show');
    });

    $(document).on('click','#apply-dates',function () {
        var val = $('#table-hostel-payments tbody tr:first input[type=date]').val();
        $('#table-hostel-payments tbody tr input[type=date]').val(val);

    });

    $(document).on('click','.view-expense-log',function () {
        $('#expense-log-area').html('<tr><td colspan="4" class="text-center"><i class="fa fa-spinner fa-spin"></i></td></tr>');
        $('#modal-worker-expense-log').modal('show');
        var expense_id = $(this).attr('data-expense');
        var month = $('#month').val();
        var year = $('#year').val();
        var html='';
        var operation = '';
        var total = 0;
        $.ajax({
            url: "<?php echo base_url();?>main/get_worker_expense_log/"+expense_id+"/"+month+"/"+year,
            cache: false,
            success: function (data) {
                if (data.length > 0) {
                    $.each(data, function (index, value) {
                        if (value.operation == 'add') {
                            operation = '+ Add';
                        } else {
                            operation = '- Sub';
                        }
                        total+= parseInt(value.amount);

                        html += '<tr><td width="1">' + (index + 1) + '</td><td>Rs. ' + value.amount + '</td><td>' + value.paid_date + '</td><td>' + operation + '</td></tr>';
                    });
                    html += '<tr><td colspan="4" class="text-right"><strong>Total: Rs. '+ total +'</strong></td></tr>';
                    $('#expense-log-area').html(html);
                } else {
                    $('#expense-log-area').html('<tr><td colspan="4" class="text-center">Sorry! No record found.</td></tr>');
                }

                },
            error: function () {
            }
        });
    });
</script>
</body>
</html>