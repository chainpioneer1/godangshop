<?php
$usertype = $this->session->userdata("user_type");
?>
<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">

    <div class="page-sidebar navbar-collapse collapse">

        <ul class="page-sidebar-menu  page-header-fixed" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 40px">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>

            <?php if( !empty($usertype) && $usertype == 1 ) : ?>

                <li class="nav-item  ">
                    <a href="<?= base_url('admin/warehouses/index') ?>" class="nav-link ">
                        <span class="title"><?=$this->lang->line('warehouse_list');?></span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="<?= base_url('admin/users/index') ?>" class="nav-link ">
                        <span class="title"><?=$this->lang->line('users_list');?></span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="<?= base_url('admin/subscribers/index') ?>" class="nav-link ">
                        <span class="title"><?=$this->lang->line('subscriber_list');?></span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="<?= base_url('admin/categories/index') ?>" class="nav-link ">
                        <span class="title"><?=$this->lang->line('product_categories');?></span>
                    </a>
                </li>

                <li class="nav-item  ">
                    <a href="<?= base_url('admin/settings/index') ?>" class="nav-link ">
                        <span class="title"><?=$this->lang->line('admin_management');?></span>
                    </a>
                </li>

                <li class="nav-item  ">
                    <a href="<?= base_url('admin/faqs/index') ?>" class="nav-link ">
                        <span class="title"><?=$this->lang->line('faqs');?></span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="<?= base_url('admin/sitesettings/index') ?>" class="nav-link ">
                        <span class="title"><?=$this->lang->line('site_settings');?></span>
                    </a>
                </li>
                <li class="nav-item  ">
                    <a href="<?= base_url('admin/frontsettings/index') ?>" class="nav-link ">
                        <span class="title"><?=$this->lang->line('front_page_settings');?></span>
                    </a>
                </li>

            <?php else : ?>

            <?php endif; ?>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->


