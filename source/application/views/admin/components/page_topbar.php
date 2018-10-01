<?php
$user_id = $this->session->userdata("loginuserID");
$user = '';
if( !empty( $user_id ) ){
    $user = $this->users_m->get_user( $user_id );
}
?>
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->

        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
            <span></span>
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <style>
            a:hover {
                color: #333 !important;
            }
        </style>
        <div class="top-menu">
            <?php if( !empty( $user_id ) ) : ?>
            <ul class="nav navbar-nav pull-right">
                <li>
                    <a style="color: #efefef;" href="<?= base_url('admin/settings/') ?>">
                        <span class="glyphicon glyphicon-user"></span><?=$this->lang->line('welcome');?>&nbsp;<?= $user->fullname ?>
                        <i class="icon-user"></i>  </a>
                </li>
                <li class="divider"> </li>
                <li>
                    <a style="color: #efefef;" href="<?= base_url('admin/signin/signout') ?>">
                        <i class="icon-key"></i><?=$this->lang->line('log_out');?> </a>
                </li>

            </ul>
            <?php endif; ?>
        </div>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
