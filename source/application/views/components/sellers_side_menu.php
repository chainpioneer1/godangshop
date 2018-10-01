<?php

?>
    <div class="main-content">
        <div class="container itbh-container" style="margin-top: 15px; ">

            <div class="row">

                <div class="col-lg-3">
                    <h3 style="padding-left: 30px; margin-bottom: 15px;"><?=$this->lang->line('welcome')?> , <?=($this->session->userdata('username'));?></h3>
                    <ul class="itbh-myaccount-menu">
                        <li class="nav-item" >
                            <a href="<?= base_url('sellers/my_warehouse') ?>" class="nav-link ">
                                <span class="title"><?=$this->lang->line('my_warehouse')?> </span>
                            </a>
                        </li>
                        <li class="nav-item" >
                            <a href="<?= base_url('sellers/my_products') ?>" class="nav-link ">
                                <span class="title"><?=$this->lang->line('my_products')?> </span>
                            </a>
                        </li>
                        <li class="nav-item" >
                            <a href="<?= base_url('sellers/account_detail') ?>" class="nav-link ">
                                <span class="title"><?=$this->lang->line('account_detail')?> </span>
                            </a>
                        </li>
                        <li class="nav-item" >
                            <a href="<?= base_url('sellers/order_managements') ?>" class="nav-link ">
                                <span class="title"><?=$this->lang->line('order_management')?> </span>
                            </a>
                        </li>
                    </ul>
                </div>