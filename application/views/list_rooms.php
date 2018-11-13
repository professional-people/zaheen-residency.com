<?php require_once 'inc/header.php'; ?>
<title>List Rooms</title>
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
							<a href="javascript:;">Hostel Setup</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="Javascript:;">List of Rooms</a>
						</li>
					</ul>
                    <ul class="page-breadcrumb pull-right">
                        <li>
                            <a href="<?php echo base_url();?>add-new-room" class="btn btn-primary btn-xs color-white">
                                <i class="fa fa-plus-square"></i> Add New Room
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
                                    List of Rooms
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="1">Sr.</th>
                                            <th>Room Title</th>
                                            <th class="text-center">Seated</th>
                                            <th class="text-center">General Rent / Head</th>
                                            <th>Facility</th>
                                            <th>Bill Type</th>
                                            <th class="text-center">Amount</th>
                                            <th width="180">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if(isset($listOfRooms) && count($listOfRooms) > 0) {
                                            $i=1;
                                            foreach ($listOfRooms as $listRooms) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td><a href="<?php echo base_url().'update-room-info/'.$listRooms->room_id;?>"><?php echo $listRooms->room_title; ?></a></td>
                                            <td class="text-center"><strong><?php echo $listRooms->seated; ?></strong></td>
                                            <td class="text-center"><strong>Rs. <?php echo $listRooms->rent_per_head; ?></strong></td>
                                            <td><?php echo $listRooms->facility_title; ?></td>
                                            <td>
                                                <?php
                                                    if ($listRooms->facility_id == '3') {
                                                        echo 'None';
                                                    } else {
                                                        if($listRooms->bill_type == '1') { echo 'Per Unit';} else { echo 'Fixed';}
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center"><strong>Rs. <?php echo $listRooms->bill_amount; ?></strong></td>
                                            <td>
                                                <a href="<?php echo base_url().'update-room-info/'.$listRooms->room_id;?>"
                                                   class="btn blue btn-xs" title="Edit room info" data-toggle="tooltip">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a href="#" class="btn red btn-xs" title="Delete">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                        <?php }} else { ?>
                                        <tr>
                                            <td colspan="6" align="center"><strong>Sorry! No Record Found.</strong></td>
                                        </tr>
                                        <?php }?>
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