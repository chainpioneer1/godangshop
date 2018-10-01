<?php

?>
<div class="second-menu-wrapper itbh-container" style="margin: 0px auto;">
    <div id="second-menu" style="margin: 0px auto;">
        <script>
            $(document).ready(function(){
                var width = $(window).width();
                if (width < 900){

                    $('.mobile-main-menu').show();
                    $('.desktop-menu-items').hide();
                    $('.desktop-menu-first').hide();
                    $('#desktop-menu-logo').hide();
                } else if (width >= 900) {
                    $('.mobile-main-menu').hide();
                    $('.desktop-menu-items').show();
                    $('.desktop-menu-first').show();
                }
            });
        </script>
        <style>
            .mobile-main-menu {
                position: absolute;
                top: 0; left: 0;
                width: 100%;
                z-index: 1000;
                background: #fff;

                .mainlink a {
                    font-size: 14px;

                }
            }
            .mobile-main-menu-toggle-btn {
                margin-left: 10px;margin-top:10px;  color: white; background-color: #fc960d;
            }

            #mobile-menu-logo {
                text-align: center;
                margin-top:10px; padding-right: 40px; float: right; width: 100px; height: 60px;
            }

            .itbh-mobile-topbar-menu {
                li a {
                    font-size: 1px;
                }
            }
        </style>
        <div class="nav-side-menu mobile-main-menu" style="display: none;" >
            <div class="row">
                <ul id="first-menu " class="itbh-navigation itbh-mobile-topbar-menu " style="float: right; padding-right: 15px;">
                    <li class="mainlink">
                        <form>
                            <div class="hidden-sm">
                                <div class="btn-group"> <a class="dropdown-toggle btn-select" data-toggle="dropdown" href="#" id="chooseLang"><i class="fa fa-language" aria-hidden="true" style="font-size: 14px;"><?= ($this->session->userdata('lang')) ? ucfirst($this->session->userdata('lang')) : 'English'; ?></i><span class="caret"></span></a>
                                    <ul class="dropdown-menu language-sub-menu">
                                        <li><a href="#" style="font-size: 14px;">English</a></li>
                                        <li><a href="#" style="font-size: 14px;">Thai</a></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                        <!-- Search box End -->
                    </li>

                    <li class="mainlink">
                        <a href="<?= base_url('signin/index') ?>" style="font-size: 14px;"><i class="fa fa-user" aria-hidden="true"><?=$this->lang->line('my_account')?></i></a>
                    </li>
                    <li class="mainlink">
                        <a href="<?= base_url('carts/index') ?>" style="font-size: 14px;"><i class="fa fa-shopping-cart" aria-hidden="true"><?=$this->lang->line('cart')?></i>(<span id="nCarts"><?php echo $this->session->userdata('cartNum')?></span>)</a>
                    </li>
                    <li class="mainlink">
                        <?php
                        $logged_status = $this->session->userdata('loggedin');
                        if ($logged_status == true) {
                            ?>
                            <a   style="font-size: 14px;" href="<?= base_url('signin/signout') ?>" style="font-size: 0.9rem;"><?=$this->lang->line('logout')?></a>
                            <?php
                        } else echo("<a   style='font-size: 14px;' href='".base_url('signin/index') ."' style='font-size: 0.9rem;'>".$this->lang->line('log_in')."</a>");
                        ?>
                    </li>

                </ul>

            </div>
            <i class="fa fa-bars fa-2x toggle-btn mobile-main-menu-toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
            <a style="text-decoration: none;" href="<?= base_url('site/index') ?>" id="mobile-menu-logo">
                <img src="<?= base_url('assets/images/logo.png')?>" width="171"/>
            </a>
            <div class="menu-list">

                <ul id="menu-content" class="menu-content collapse out">
                    <li><a style="text-decoration: none;" href="<?= base_url('site/index') ?>"><?=$this->lang->line('home');?></a></li>
                    <li  data-toggle="collapse" data-target="#products_cat" class="collapsed active">
                        <a  href="#"><?=$this->lang->line('products');?><span class="caret"></span></a>
                    </li>
                    <ul class="sub-menu collapse products-sub-menu" id="products_cat">
                        <li><a href="<?= base_url('products/index') ?>"><?=$this->lang->line('products');?></a></li>
                        <li><a href="<?= base_url('products/products_list') ?>"><?=$this->lang->line('products_list');?></a></li>
                        <li><a  href="<?= base_url('products/products_bank') ?>"><?=$this->lang->line('products_bank');?></a></li>
                    </ul>


                    <li><a href="<?= base_url('warehouses/index') ?>"><?=$this->lang->line('warehouses');?></a> </li>
                    <li  data-toggle="collapse" data-target="#aboutus_cat" class="collapsed active">
                        <a href="#"><?=$this->lang->line('about_us');?><span class="caret"></span></a>
                    </li>
                    <ul class="sub-menu collapse aboutus-sub-menu" id="aboutus_cat">
                        <li><a href="<?= base_url('aboutus/index') ?>"><?=$this->lang->line('about_us');?></a></li>
                        <li><a href="<?= base_url('contactus/index') ?>"><?=$this->lang->line('contact_us');?></a></li>
                        <li><a href="<?= base_url('faqs/index') ?>"><?=$this->lang->line('faqs');?></a></li>
                        <li><a href="<?= base_url('whatsgodang/index') ?>"><?=$this->lang->line('what_go_dang');?></a></li>
                    </ul>
                    <li><a href="<?= base_url('admin/signin/index') ?>"><?=$this->lang->line('dashboard');?></a></li>

                </ul>
            </div>





        </div>
        <a href="<?= base_url('site/index') ?>" id="desktop-menu-logo" style="padding-left: 50px;">
            <img src="<?= base_url('assets/images/logo.png')?>" style="padding-bottom: 20px;"/>
        </a>

        <ul id="navbar" class="itbh-navigation desktop-menu-items" style="padding-right: 30px;" >
            <li><a href="<?= base_url('site/index') ?>"><?=$this->lang->line('home');?></a></li>
            <li class="dropdown">
                <a class="dropdown-toggle"  href="#" data-toggle="dropdown"><?=$this->lang->line('products');?>
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="<?= base_url('products/index') ?>"><?=$this->lang->line('products');?></a></li>
                    <li><a href="<?= base_url('products/products_list') ?>"><?=$this->lang->line('products_list');?></a></li>
                    <li><a href="<?= base_url('products/products_bank') ?>"><?=$this->lang->line('products_bank');?></a></li>
                </ul>
            </li>
            <li><a href="<?= base_url('warehouses/index') ?>"><?=$this->lang->line('warehouses');?></a></li>
            <li><a href="<?= base_url('aboutus/index') ?>"><?=$this->lang->line('about_us');?></a></li>
            <li><a href="<?= base_url('contactus/index') ?>"><?=$this->lang->line('contact_us');?></a></li>
            <li><a href="<?= base_url('faqs/index') ?>"><?=$this->lang->line('faqs');?></a></li>
            <li><a href="<?= base_url('whatsgodang/index') ?>"><?=$this->lang->line('what_go_dang');?></a></li>


        </ul>
        <style>
            #navbar li a:hover {
                color: #fc660d;
            }
            #navbar li a:active {
                color: #fc960d;
            }
        </style>
    </div>
</div>
</div>
