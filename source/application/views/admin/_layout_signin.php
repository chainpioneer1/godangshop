<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8" />
    <title>GoDang Admin page signin</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="" />
    <meta content="" name="mingxiao2008" />
    <link rel="stylesheet" type="text/css" href="<?=  base_url('assets/rating/css/font-awesome.min.css')?>"/>
    <link href="<?= base_url('assets/admin/css/basic.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/admin/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?= base_url('assets/admin/css/components.css')?>" rel="stylesheet" id="style_components" type="text/css" />
    <link href="<?= base_url('assets/admin/css/login.min.css')?>" rel="stylesheet" type="text/css" />
<!-- END HEAD -->

<body class=" login">
<!-- BEGIN LOGO -->
<div class="logo">

</div>
<!-- END LOGO -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <form class="login-form" action="<?= base_url('admin/signin/index')?>" method="post">
        <h3 class="form-title font-green"><a href="<?=base_url()?>">
                <img src="<?= base_url('assets/images/logo_with_register_trade_icon.png') ?>" alt="" /> </a></h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span> <?=$this->lang->line('enter_any_username_and_password');?></span>
        </div>
        <div class="form-group" style="text-align: center;">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label for="username" class=""><?=$this->lang->line('username');?></label>
            <input  class="form-control form-control-solid placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" id="username" /> </div>
        <div class="form-group" style="text-align: center;">
            <label for="userpassword" class=""><?=$this->lang->line('password');?></label>
            <input class="form-control placeholder-no-fix" type="password" id="userpassword" autocomplete="off" placeholder="Password" name="password" /> </div>
        <div class="form-actions" style="text-align: center;">
            <label class="rememberme check mt-checkbox mt-checkbox-outline">
                <input type="checkbox" name="remember" value="1" /><?=$this->lang->line('remember');?>
                <span></span>
            </label>
            <button type="submit" class="btn btn-primary" style="width: 60%;"><?=$this->lang->line('login');?></button>

        </div>

    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" action="<?= base_url('admin/signin/register')?>" method="post">
        <h3 class="font-green"><?=$this->lang->line('forget_password');?></h3>
        <p> <?=$this->lang->line('enter_your_email_to_reset');?></p>
        <div class="form-group">
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="email" /> </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn green btn-outline"><?=$this->lang->line('back');?></button>
            <button type="submit" class="btn btn-success uppercase pull-right"><?=$this->lang->line('submit');?></button>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
    <!-- BEGIN REGISTRATION FORM -->
    <form class="register-form" action="index.html" method="post">
        <h3 class="font-green"><?=$this->lang->line('sign_up');?></h3>
        <p class="hint"> <?=$this->lang->line('enter_your_personal_detail');?>: </p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9"><?=$this->lang->line('full_name');?></label>
            <input class="form-control placeholder-no-fix" type="text" placeholder="Full Name" name="fullname" /> </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9"><?=$this->lang->line('email');?></label>
            <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="email" /> </div>

        <p class="hint"> <?=$this->lang->line('enter_your_personal_detail');?></p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9"><?=$this->lang->line('user_name');?></label>
            <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Username" name="username" /> </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9"><?=$this->lang->line('password');?></label>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password" placeholder="Password" name="password" /> </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9"><?=$this->lang->line('retype_password');?></label>
            <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword" /> </div>
        <div class="form-group margin-top-20 margin-bottom-20">
            <label class="mt-checkbox mt-checkbox-outline">
                <input type="checkbox" name="tnc" /> <?=$this->lang->line('i_agree_to');?>
                <a href="javascript:;"><?=$this->lang->line('terms_of_service');?> </a> &
                <a href="javascript:;"><?=$this->lang->line('privacy_policy');?></a>
                <span></span>
            </label>
            <div id="register_tnc_error"> </div>
        </div>
        <div class="form-actions">
            <button type="button" id="register-back-btn" class="btn green btn-outline"><?=$this->lang->line('back');?></button>
            <button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right"><?=$this->lang->line('submit');?></button>
        </div>
    </form>
    <!-- END REGISTRATION FORM -->
</div>
<div class="copyright"> 2017 &copy; Go-Dang.com <?=$this->lang->line('all_rights_reserved');?> </div>
<script src="<?= base_url('assets/admin/js/jquery.min.js')?>"></script>
<script src="<?= base_url('assets/admin/js/bootstrap.min.js')?>" type="text/javascript"></script>

<script>
    $(document).ready(function()
    {
        $('#clickmewow').click(function()
        {
            $('#radio1003').attr('checked', 'checked');
        });
    })
</script>
</body>

</html>