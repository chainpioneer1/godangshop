<?php

?>

<!--itbh comment : chang it's style-->
<script>
    $(document).ready(function(){
        var width = $(window).width();
        if (width <= 1030){
            $('.myaccount-top-menu').show();
            $('.myaccount-side-menu').hide();
        } else if (width > 1030) {
            $('.myaccount-top-menu').hide();
            $('.myaccount-side-menu').show();
        }
    });
</script>

<div class="main-content-wrap">
    <!--<img src="assets/images/dashboard-bg.png" width="100%" class="dashboard-banner"/>-->
    <div class="products-page-header">
        <div class="row" >
            <div style=" position: relative;">
                <img src="<?=site_url('assets/images/products-main-img.png')?>" style=" min-height: 144px !important;" >
                <h3 class="page-title-h2" style="color:white; position: absolute; top: 32px; width: 100%; text-align: center; "><?php echo $page_banner_title;?></h3>
            </div>
        </div>
    </div>

    <div class="main-content">
        <div class="container itbh-container" style="margin-top: 15px; ">
            <div class="row">
                <div class="col-sm-12 col-xs-12 myaccount-top-menu">

                    <h3 style="padding-left: 30px; margin-bottom: 15px;"><?=$this->lang->line('welcome')?> , <?=($this->session->userdata('username'));?></h3>

                    <ul id="navbar" class="itbh-navigation" >
                        <li style="padding:5px 2px !important;"><a style="font-size: 1.3rem;" href="<?= base_url('myaccount/orders') ?>"><span><?=$this->lang->line('orders')?></span></a></li>
                        <li style="padding:5px 2px !important;"><a style="font-size: 1.3rem;" href="<?= base_url('myaccount/address') ?>"><span><?=$this->lang->line('address')?></span></a></li>
                        <li style="padding:5px 2px !important;"><a style="font-size: 1.3rem;" href="<?= base_url('myaccount/accountdetail') ?>"><span><?=$this->lang->line('account_detail')?></span></a></li>
                    </ul>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-4 myaccount-side-menu">
                    <h3 style="padding-left: 30px; margin-bottom: 15px;"><?=$this->lang->line('welcome')?> , <?=($this->session->userdata('username'));?></h3>
                    <ul class="itbh-myaccount-menu">
                        <li class="nav-item itbh-customer-menu-item" >
                            <a href="<?= base_url('myaccount/orders') ?>" class="nav-link ">
                                <span class="title"><?=$this->lang->line('orders')?> </span>
                            </a>
                        </li>
                        <li class="nav-item itbh-customer-menu-item ">
                            <a href="<?= base_url('myaccount/address') ?>" class="nav-link ">
                                <span class="title"><?=$this->lang->line('address')?> </span>
                            </a>
                        </li>

                        <li class="nav-item itbh-customer-menu-item ">
                            <a href="<?= base_url('myaccount/accountdetail') ?>" class="nav-link ">
                                <span class="title"><?=$this->lang->line('account_detail')?> </span>
                            </a>
                        </li>
                    </ul>
                </div>