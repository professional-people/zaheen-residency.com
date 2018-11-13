<?php require_once 'inc/header.php'; ?>
<title>Income Statement</title>
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
							<a href="javascript:;">Income Statement</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="Javascript:;">View Statement</a>
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
                                    <table class="table table-bordered table-hover">
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
                                            <form action="<?php echo base_url();?>view-income-statement" method="POST">
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
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th class="text-center">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><a href="">Daily Expense</a></td>
                                            <td class="text-center">
                                                Rs. <?php echo empty($dailyExpense) ? '0' : $dailyExpense; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="">Monthly Expense</a></td>
                                            <td class="text-center">
                                                Rs. <?php echo empty($monthlyExpense) ? '0' : $monthlyExpense; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="">Worker Expense</a></td>
                                            <td class="text-center">
                                                Rs. <?php echo empty($workerExpense) ? '0' : $workerExpense; ?>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td><strong>Amount</strong></td>
                                            <td class="text-center">
                                                <strong class="text-danger">Rs.
                                                    <?php
                                                        $totalExpense = $workerExpense + $monthlyExpense + $dailyExpense;
                                                        echo empty($totalExpense) ? '0' : $totalExpense;
                                                    ?>
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
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th class="text-center">Amount</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><a href="">Rent Income</a></td>
                                            <td class="text-center">
                                                Rs. <?php echo empty($rentIncome) ? '0' : $rentIncome;?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="">Bill Income</a></td>
                                            <td class="text-center">
                                                Rs. <?php echo empty($billIncome) ? '0' : $billIncome;?>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td class="text-center">-</td>
                                            <td class="text-center">-</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Amount</strong></td>
                                            <td class="text-center">
                                                <strong class="text-success">Rs.
                                                    <?php
                                                        $totalIncome = $billIncome + $rentIncome;
                                                        echo empty($totalIncome) ? '0' : $totalIncome;
                                                    ?>
                                                </strong>
                                            </td>
                                        </tr>
                                        </tfoot>
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
                                    <table class="table table-bordered table-hover">
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
                                            <td class="text-center">Rs. <?php echo $totalExpense; ?></td>
                                            <td class="text-center">Rs. <?php echo $totalIncome; ?></td>
                                            <td class="text-center">
                                                <?php
                                                    $profit = $totalIncome - $totalExpense;
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