<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>Login</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link href="<?php echo base_url(); ?>resource/styling/font-awesome/css/font-awesome.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url(); ?>resource/styling/simple-line-icons/simple-line-icons.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url(); ?>resource/styling/bootstrap/css/bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url(); ?>resource/styling/uniform/css/uniform.default.css" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url(); ?>resource/styling/login.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>resource/styling/components.css" id="style_components" rel="stylesheet"
          type="text/css"/>
    <link href="<?php echo base_url(); ?>resource/styling/plugins.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>resource/styling/layout2/css/layout.css" rel="stylesheet" type="text/css"/>
    <link href="<?php echo base_url(); ?>resource/styling/default.css" rel="stylesheet" type="text/css"
          id="style_color"/>
    <link href="<?php echo base_url(); ?>resource/styling/layout2/css/custom.css" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<body class="login">
<div class="menu-toggler sidebar-toggler">
</div>
<div class="logo">
    <a href="<?php echo base_url(); ?>main">
        <img src="<?php echo base_url(); ?>resource/img/logo.png" alt=""/>
    </a>
</div>
<div class="content">
    <form class="login-form" action="<?php echo base_url(); ?>main/login_check" method="post">
        <h3 class="form-title">Login to your account</h3>

        <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger">
                <button class="close" data-close="alert"></button>
                <span><?php echo $this->session->flashdata('error'); ?></span>
            </div>
        <?php } ?>
            <div class="form-group">
            <label class="control-label">Username</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off"
                   placeholder="Username" name="username" required/>
        </div>
        <div class="form-group">
            <label class="control-label">Password</label>
            <input class="form-control form-control-solid placeholder-no-fix" type="password" autocomplete="off"
                   placeholder="Password" name="password" required/>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-success uppercase">Login</button>
            <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
        </div>
    </form>
</div>
<div class="copyright">
    <?php echo date('Y'); ?> &copy Zaheen Residency Lahore
</div>
</body>
</html>