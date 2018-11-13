<!--Delete Model-->
<div class="modal fade" id="delete_confirmation" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></i>Do you really want to delete?</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form" action="" method="post" id="delete_confirmation_form">
                    <input type="hidden" value="" name="delete_id" id="delete_id">
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn red btn-sm">Yes</button>
                                <a href="javascript:;" class="btn default btn-sm" data-dismiss="modal"
                                   id="no_delete">No</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sys-alert" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="alert-title">Message</h4>
            </div>
            <div class="modal-body text-center" id="msg-box"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="sys-confirm" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="alert-title">Confirmation</h4>
            </div>
            <div class="modal-body text-center">
                <form id="confirm-form" action="" method="post">
                    <div id="confirm-html"></div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-action="yes" class="btn btn-success btn-sm confirm-btn">Yes</button>
                <button type="button" data-action="no" class="btn btn-danger btn-sm confirm-btn" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>
<div class="page-footer">
    <div class="page-footer-inner">
&copy; Copyrigth <?php echo date('Y'); ?> Zaheen Residency Lahore
    </div>
</div>
<script src="<?php echo base_url(); ?>resource/styling/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>resource/styling/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>resource/styling/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>resource/styling/metronic.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>resource/styling/layout2/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>resource/styling/validator.min.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        Metronic.init();
        Layout.init();
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).on('keydown','input[type="date"]',function (e) {
        e.preventDefault();
    });

    function open_delete_dialog(controller, del_id) {
        var uri = '<?php echo base_url();?>'+controller;
        $('#delete_id').val(del_id);
        $('#delete_confirmation_form').attr('action', uri);
        $('#delete_confirmation').modal('show');
    }

    $('#delete_confirmation').on('hidden.bs.modal', function () {
        $('#delete_id').val('');
        $('#delete_confirmation_form').attr('action', '');
    });

    function sysAlert(title, msg , color) {
        $('#alert-title').html(title);
        $('#alert-title').addClass(color);
        $('#msg-box').addClass(color);
        $('#msg-box').html(msg);
        $('#sys-alert').modal('show');
    }
    
    function sysConfirm(controller, html) {
        var redirect = '<?php echo base_url(); ?>'+controller;
        $('#confirm-form').attr('action', redirect);
        $('#confirm-html').html(html);
        $('#sys-confirm').modal('show');
    }

    $(document).on('click','.confirm-btn',function () {
        var action = $(this).attr('data-action');
        if (action == 'yes') {
            $('#sys-confirm').modal('hide');
            $('#confirm-form').submit();
        } else {
            $('#confirm-form').attr('action','');
            $('#confirm-html').html('');
        }
    });
    $(document).on('click','.hostel-switch',function () {
        var hostelId = $(this).attr('data-id');
        var uri = $(this).attr('data-uri');
        if (uri != '0') {
            $('#active-hostel-id').val(hostelId);
            $('#redirect-uri').val(uri);
            $('#form-switching').submit();
        } else {
            sysAlert('Stop','Hostel switching not allowed on this page','');
        }
    });

    $(document).on('click','.btn-entry-remove',function () {
        var redirect = $(this).attr('data-redirect');
        var del = $(this).attr('data-id');
        var tbl = $(this).attr('data-table');
        var col = $(this).attr('data-col');
        window.location.href = '<?php echo base_url();?>remove-entry/'+redirect + '/' + del + '/' + tbl + '/' + col;
    });
</script>