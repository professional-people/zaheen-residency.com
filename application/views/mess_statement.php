<?php require_once 'inc/header.php'; ?>
<title>Mess Statement</title>
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
							<a href="<?php echo base_url();?>main/dashboard">Dashboard</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="javascript:;">Mess</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="Javascript:;">Mess Statement</a>
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
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    Filters
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <?php $total_days = $number = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'))?>
                                            <form action="<?php echo base_url();?>mess-statement" method="POST">
                                            <td><input type="date" name="start_date" value="<?php echo isset($startDate) ? $startDate : date("Y-m").'-01';?>" class="form-control input-sm"></td>
                                            <td><input type="date" name="end_date" value="<?php echo isset($endDate) ? $endDate : date("Y-m").'-'.$total_days;?>" class="form-control input-sm"></td>
                                            <td><button type="submit" class="btn btn-success btn-sm">Get Report</button></td>
                                            </form>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-md-6">
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    Expense
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th class="text-center">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><a href="">Mess Expense</a></td>
                                            <td class="text-center">
                                                Rs. <?php echo empty($messExpense) ? '0' : $messExpense; ?>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td><strong>Amount</strong></td>
                                            <td class="text-center">
                                                <strong class="text-danger">Rs.
                                                    Rs. <?php echo empty($messExpense) ? '0' : $messExpense; ?>
                                                </strong>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="col-md-6">
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    Income
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th class="text-center">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><a href="">Mess Income</a></td>
                                            <td class="text-center">
                                                Rs. <?php echo empty($messIncome) ? '0' : $messIncome;?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Amount</strong></td>
                                            <td class="text-center">
                                                <strong class="text-success">Rs.
                                                    Rs. <?php echo empty($messIncome) ? '0' : $messIncome;?>
                                                </strong>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    Income Statement
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable">
                                    <table class="table table-bordered">
                                        <thead>
                                        <tr>
                                            <th class="text-center">Expense</th>
                                            <th class="text-center">Income</th>
                                            <th class="text-center">Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <tr>
                                            <td class="text-center">Rs. <?php echo $messExpense; ?></td>
                                            <td class="text-center">Rs. <?php echo $messIncome; ?></td>
                                            <td class="text-center">
                                                <?php
                                                    $profit = $messIncome - $messExpense;
                                                    if ($profit > 0) {
                                                        echo '<strong class="text-success">Rs. '. $profit.' Profit</strong>';
                                                    } else {
                                                        echo '<strong class="text-danger">Rs. '. $profit.' Loss</strong>';
                                                    }
                                                ?>
                                            </td>
                                        </tr>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
				<!-- END PAGE CONTENT-->
			</div>
		</div>
		<!-- END CONTENT -->
		<!-- BEGIN QUICK SIDEBAR -->
		<!--Cooming Soon...-->
		<!-- END QUICK SIDEBAR -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<!-- END FOOTER -->
</div>
<?php require_once 'inc/footer.php';?>
</body>
</html>