<?php
require_once 'inc/header.php';
if ($type == 'mess' && isset($list_id)) {
    $list_title = 'Update Mess Expense List';
    $list_url = base_url().'mess-expense';
} else {
    if ($type == 'daily' && isset($list_id)) {
        $list_title = 'Update Daily Expense List';
        $list_url = base_url().'list-daily-expense';
    } else {
        if ($type == 'daily' && !isset($list_id)) {
            $list_title = 'Add Daily Expense List';
            $list_url = base_url().'list-daily-expense';
        } else {
            if ($type == 'mess' && !isset($list_id)) {
                $list_title = 'Add Mess Expense List';
                $list_url = base_url().'mess-expense';
            } else {
                $list_title = '';
                $list_url='';
            }
        }
    }
}
?>
<title>
    <?php echo $list_title; ?>
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
                            <a href="javascript:;">Expense</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="Javascript:;">
                                <?php echo $list_title; ?>
                            </a>
                        </li>
                    </ul>
                    <ul class="page-breadcrumb pull-right">
                        <li>
                            <a href="<?php echo $list_url;?>" class="btn btn-primary btn-xs color-white">
                                <i class="fa fa-list"></i> List Expense</a>
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
                                    <?php echo $list_title; ?>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                <form class="form-horizontal" data-toggle="validator" role="form"
                                      action="<?php echo base_url(); ?>post/save_expense_info" method="post">
                                    <input type="hidden" name="expense_list_id" value="<?php echo isset($expense->expense_list_id) ? $expense->expense_list_id : '0'; ?>">
                                    <input type="hidden" name="type" value="<?php echo $type;?>">
                                    <div class="form-body">
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <div class="heading">
                                                    <p>List Details</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Year</label>
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
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Month</label>
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
                                            <label class="col-md-3 control-label">Expense Type</label>
                                            <div class="col-md-6">
                                                <select name="expense_type_id" class="form-control input-sm" data-error="Expense Type is required." required>
                                                    <option value="">---Select---</option>
                                                    <?php
                                                        foreach ($expenseTypes as $types) {
                                                    ?>
                                                    <option value="<?php echo $types->expense_type_id;?>" <?php if (isset($expense->expense_type_id) && $expense->expense_type_id == $types->expense_type_id){ echo 'selected';}?>><?php echo $types->title;?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Expense Title</label>
                                            <div class="col-md-6">
                                                <input type="text" class="form-control input-sm"
                                                       placeholder="Expense Title" name="expense_title"
                                                       data-error="Expense Title is required."
                                                       value="<?php echo isset($expense->expense_title) ? $expense->expense_title : ''; ?>"
                                                       required>
                                                <div class="help-block with-errors"></div>
                                            </div>
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <button type="submit" class="btn blue btn-sm">
                                                        <?php echo isset($expense->expense_id) ? 'Update' : 'Submit'; ?>
                                                    </button>
                                                    <a href="<?php echo base_url(); ?>main/dashboard"
                                                       class="btn default btn-sm">Cancel</a>
                                                </div>
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
    $(document).on('click', '.row-del', function () {
        if($(this).attr('data-del') != '0') {
            var deleteId = $(this).attr('data-del');
            open_delete_dialog('main/delete_cooking_expense_item' , deleteId);
        } else {
            $(this).closest('tr').remove();
            $('#items-table tbody tr td:first-child').each(function (index, value) {
                $(this).html('<strong>' + (index + 1) + '</strong>');
            });
            var total = 0;
            $('.input-cash').each(function () {
                if ($(this).val() != '') {
                    total += parseInt($(this).val());
                }
            });
            $('#total-rupees').html('Total Rupees = Rs. ' + total);
        }
    });

    $(document).on('keypress', '.input-cash', function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });

    $(document).on('keyup', '.input-cash', function () {
        var total = 0;
        $('.input-cash').each(function () {
            if ($(this).val() != '') {
                total += parseInt($(this).val());
            }
        });
        $('#total-rupees').html('Total Rupees = Rs. ' + total);
    });
</script>
</body>
</html>