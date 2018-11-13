<?php
if(!$this->session->has_userdata('login_status'))
{
	redirect(base_url() . 'main/login');
	exit();
}
?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta content="width=device-width, initial-scale=1" name="viewport"/>
<link rel="shortcut icon" href=""/>
<link href="<?php echo base_url();?>resource/styling/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>resource/styling/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>resource/styling/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>resource/styling/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>resource/styling/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>resource/styling/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>resource/styling/layout2/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>resource/styling/layout2/css/themes/grey.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="<?php echo base_url();?>resource/styling/layout2/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url();?>resource/styling/profile.css" rel="stylesheet" type="text/css"/>