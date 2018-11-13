<?php require_once 'inc/header.php'; ?>
<title>Monthly Expense</title>
<style type="text/css">
    .border-red {
        border: 1px solid palevioletred;
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
                            <a href="javascript:;">Expense</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="Javascript:;">Monthly Expense</a>
                        </li>
                    </ul>
                    <ul class="page-breadcrumb pull-right">
                        <li>
                            <a href="javascript:;" id="add-new-sheet"
                               class="btn btn-primary btn-xs color-white">
                                <i class="fa fa-plus-square"></i> Add New Sheet
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
                                    <i class="fa fa-user"></i> Monthly Expense
                                </div>
                            </div>
                            <div class="portlet-body">
                                <form class="form-horizontal" role="form" action="<?php echo base_url();?>monthly-expense" method="POST">
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
                                                    <th>Month</th>
                                                    <th>Year</th>
                                                    <th width="100" class="text-center">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        <select name="month" class="form-control input-sm">
                                                            <option value="">---Select---</option>
                                                            <?php for ($i=1; $i<=12; $i++) { ?>
                                                                <option value="<?php echo $i;?>" <?php if($i == $forMonth){echo 'selected';}?>><?php echo date("F", mktime(0, 0, 0, $i, 10));?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select name="year" class="form-control input-sm">
                                                            <option value="">---Select---</option>
                                                            <?php for ($i = date('Y'); $i >= 2016; $i--) { ?>
                                                                <option value="<?php echo $i;?>" <?php if($i == $forYear){echo 'selected';}?>><?php echo $i;?></option>
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
                                <div class="heading">
                                    <p>Monthly Expense Sheet</p>
                                </div>
                                <div class="table-scrollable">
                                    <table id="table-hostel-payments" class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="1">Sr.</th>
                                            <th>Bill</th>
                                            <th width="150" class="text-center">Amount</th>
                                            <th width="150" class="text-center">Paid</th>
                                            <th width="180">Date <a href="javascript:;" style="margin-left: 60%;" id="apply-dates" title="Apply to all"><i class="fa fa-calendar"></i></a></th>
                                            <th> Details</th>
                                            <th>Operation</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if (isset($monthlyExpense) && count($monthlyExpense) > 0) {
                                            $i = 0;
                                            foreach ($monthlyExpense as $expenseList) {
                                                $i++;
                                                ?>
                                            <tr>
                                                <form id="form-monthly-expense-<?php echo $i; ?>" method="POST">
                                                    <input type="hidden" name="id" value="<?php echo $i; ?>">
                                                    <input type="hidden" name="update_id" value="<?php echo $expenseList->id; ?>">
                                                    <input type="hidden" name="paid_amount" id="paid-amount-<?php echo $i;?>" value="<?php echo $expenseList->amount; ?>">
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $expenseList->expense_title; ?></td>
                                                    <td>
                                                        <input type="text" id="cash-received-<?php echo $i;?>" data-id="<?php echo $i;?>" name="cash_received" class="form-control input-sm text-center input-cash" placeholder="0">
                                                    </td>
                                                    <td class="text-center" id="paid-<?php echo $i;?>">Rs.<?php echo $expenseList->amount; ?></td>
                                                    <td>
                                                        <input type="date" id="payment-date-<?php echo $i;?>" name="submit_date" class="form-control input-sm" value="<?php echo !empty($expenseList->submit_date) ? $expenseList->submit_date : date("Y-m-d"); ?>">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="details" class="form-control input-sm" value="<?php echo $expenseList->details; ?>">
                                                    </td>
                                                    <td>
                                                        <select name="operation" class="form-control input-sm" id="operation-<?php echo $i;?>">
                                                            <option value="add">Add</option>
                                                            <option value="sub">Subtract</option>
                                                        </select>
                                                    </td>
                                                </form>
                                            </tr>
                                        <?php }} else { ?>
                                        <tr>
                                            <td class="text-center" colspan="7">
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
                    <i class="fa fa-plus-square"></i>&nbsp;Add New Sheet
                </h4>
            </div>
            <div class="modal-body text-center">
                <div class="portlet-body form">
                    <form class="form-horizontal" data-toggle="validator" role="form" action="<?php echo base_url();?>post/add_monthly_expense_sheet" method="post">
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
                                    <button type="submit" class="btn blue btn-sm">Submit</button>
                                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
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
                    submit_form($(this));
                }
            }
        });
    });

    function submit_form(target) {
        var id = target.attr('data-id');
        var value = target.val();
        if (value != '' && value != '0') {
            $('#paid-'+id).html('<span><i class="fa fa-spinner fa-spin"></i></span>');
            $.ajax({
                url: "<?php echo base_url();?>post/save_monthly_expense_info",
                type: "POST",
                data: $('#form-monthly-expense-' + id).serialize(),
                cache: false,
                success: function (data) {
                    var id          = data.id;
                    var paidAmount  = data.paid_amount;
                    $('#paid-amount-' + id).val(paidAmount);
                    $('#paid-' + id).html('Rs. ' + paidAmount);
                    $('#cash-received-' + id).val('');
                    $('#cash-received-' + (parseInt(id)+1)).focus();
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
</script>
</body>
</html>