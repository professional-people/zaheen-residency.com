<?php require_once 'inc/header.php'; ?>
<title>List of Workers</title>
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
							<a href="Javascript:;">List of Workers</a>
						</li>
					</ul>
                    <ul class="page-breadcrumb pull-right">
                        <li>
                            <a href="<?php echo base_url();?>add-new-worker" class="btn btn-primary btn-xs color-white">
                                <i class="fa fa-plus-square"></i> Add New Worker</a>
                        </li>
                    </ul>
				</div>
                <?php if ($this->session->flashdata('msg')) { ?>
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                <?php } ?>
				<div class="row">
					<div class="col-md-12">
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    List of Workers
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                        <tr>
                                            <th width="1">Sr.</th>
                                            <th>Name</th>
                                            <th>CNIC</th>
                                            <th>Mobile No</th>
                                            <th>Address</th>
                                            <th class="text-center">Salary</th>
                                            <th width="1">Status</th>
                                            <th width="180" class="text-center">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                            if(isset($listOfWorkers) && count($listOfWorkers) > 0) {
                                            $i=1;
                                            foreach ($listOfWorkers as $listWorkers) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i++;?></td>
                                            <td>
                                                <a href="<?php echo base_url().'update-worker-info/'.$listWorkers->worker_id;?>"
                                                   title="Edit Worker Info" data-toggle="tooltip">
                                                    <?php echo $listWorkers->worker_name; ?>
                                                </a>
                                            </td>
                                            <td><?php echo $listWorkers->cnic; ?></td>
                                            <td><?php echo $listWorkers->mobile_no; ?></td>
                                            <td><?php echo $listWorkers->permanent_address; ?></td>
                                            <td class="text-center"><strong>Rs. <?php echo $listWorkers->salary;?></strong></td>
                                            <td>
                                                <?php
                                                    if($listWorkers->status == '1') {
                                                ?>
                                                <a href="javascript:;" id="status-btn-<?php echo $i;?>" data-id="<?php echo $i;?>"
                                                   data-toggle="tooltip" title="Worker is Active, Click to Deactive"
                                                   class="status-btn btn btn-success btn-xs" col-value="0" update-id="<?php echo $listWorkers->worker_id?>">
                                                    <i class="fa fa-check-square"></i>&nbsp;Active
                                                </a>
                                                <?php } else { ?>
                                                <a href="javascript:;" id="status-btn-<?php echo $i;?>" data-id="<?php echo $i;?>"
                                                   data-toggle="tooltip" title="Worker is Deactive, Click to Active"
                                                   class="status-btn btn btn-danger btn-xs" col-value="1" update-id="<?php echo $listWorkers->worker_id?>">
                                                    <i class="fa fa-check-square"></i>&nbsp;Deactive
                                                </a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url().'update-worker-info/'.$listWorkers->worker_id;?>"
                                                   class="btn blue btn-xs" title="Edit Worker Info" data-toggle="tooltip">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>
                                                <a href="#" class="btn red btn-xs" title="Delete">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                            </td>
                                        </tr>
                                        <?php }} else { ?>
                                        <tr>
                                            <td colspan="9" align="center"><strong>Sorry! No Record Found.</strong></td>
                                        </tr>
                                        <?php }?>
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
<?php require_once 'inc/footer.php';?>
<script type="text/javascript">
    $(document).on('click', '.status-btn', function () {
        var id = $(this).attr('data-id');
        var colValue = $(this).attr('col-value');
        var updateId = $(this).attr('update-id');
        status_request('hostels_worker', 'status', colValue, 'worker_id', updateId, id);
    });
    function status_request(tbl, col, colValue, updateCol, updateId, id) {
        $('#status-btn-' + id).html('<span><i class="fa fa-spinner fa-spin"></i></span>');
        $.ajax({
            url: "<?php echo base_url();?>post/update_user_status/" + tbl + '/' + col + '/' + colValue + '/' + updateCol + '/' + updateId + '/' + id,
            cache: false,
            success: function (data) {
                var responseId = data.id;
                var set = data.set;
                if (set == '1') {
                    $('#status-btn-' + responseId).html('<i class="fa fa-check-square"></i>&nbsp;Active');
                    $('#status-btn-' + responseId).removeClass('btn-danger');
                    $('#status-btn-' + responseId).addClass('btn-success');
                    $('#status-btn-' + responseId).attr('col-value', '0');
                    $('#status-btn-' + responseId).attr('title', 'Worker is Active, Click to Deactive').tooltip('fixTitle').tooltip('show');
                } else {
                    $('#status-btn-' + responseId).html('<i class="fa fa-times-circle"></i>&nbsp;Deactive');
                    $('#status-btn-' + responseId).removeClass('btn-success');
                    $('#status-btn-' + responseId).addClass('btn-danger');
                    $('#status-btn-' + responseId).attr('col-value', '1');
                    $('#status-btn-' + responseId).attr('title', 'Worker is Deactive, Click to Active').tooltip('fixTitle').tooltip('show');
                }
            },
            error: function () {
            }
        });
    }
</script>
</body>
</html>