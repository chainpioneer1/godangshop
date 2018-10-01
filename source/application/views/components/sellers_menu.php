<?php

?>
<div class="second-menu-wrapper">
    <div id="second-menu" class="container  second-menu-wrapper">
        <a href="<?= base_url('products/index') ?>" id="logo">
            <img src="<?= base_url('assets/images/logo.png')?> " style="padding-bottom: 20px;" />
        </a>
        <ul id="navbar" class="itbh-navigation">
            <li><a href="<?= base_url('sellers/index') ?>"><?=$this->lang->line('dashboard');?></a></li>
            <li><a href="<?= base_url('sellers/my_warehouse') ?>"><?=$this->lang->line('my_warehouse');?></a></li>
            <li><a href="<?= base_url('sellers/my_products') ?>"><?=$this->lang->line('my_products');?></a></li>
            <li><a href="<?= base_url('sellers/account_detail') ?>"><?=$this->lang->line('account_detail');?></a></li>
            <li><a href="<?= base_url('sellers/order_managements') ?>"><?=$this->lang->line('order_managements');?></a></li>
            <!---<li><a href="<?= base_url('sellers/group_buying') ?>"><?=$this->lang->line('group_buying');?></a></li>--->

        </ul>
    </div>
</div>
</div>