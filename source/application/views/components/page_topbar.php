<?php

?>




<div id="header">
    <div class="main-menu-wrapper itbh-container">

        <ul id="first-menu desktop-menu-first" class="itbh-navigation desktop-menu-items" style="float: right; padding-right: 30px;">
            <li class="mainlink">
                <form>
                    <div class="hidden-sm">
                        <div class="btn-group"> <a class="dropdown-toggle btn-select" data-toggle="dropdown" href="#" id="chooseLang"><i class="fa fa-language" aria-hidden="true"><?= ($this->session->userdata('lang')) ? ucfirst($this->session->userdata('lang')) : 'English'; ?></i><span class="caret"></span></a>
                            <ul class="dropdown-menu language-sub-menu">
                                <li><a href="#">English</a></li>
                                <li><a href="#">Thai</a></li>
                            </ul>
                        </div>
                    </div>
                </form>
                <!-- Search box End -->
            </li>

            <li class="mainlink">
                <a href="<?= base_url('signin/index') ?>"><i class="fa fa-user" aria-hidden="true"><?=$this->lang->line('my_account')?></i></a>
            </li>
            <li class="mainlink">
                <a href="<?= base_url('carts/index') ?>" style="font-weight: bold"><i class="fa fa-shopping-cart" aria-hidden="true"><?=$this->lang->line('cart')?></i>(<span id="nCarts"><?php echo $this->session->userdata('cartNum')?></span>)</a>
            </li>
            <li class="mainlink">
                <?php
                    $logged_status = $this->session->userdata('loggedin');
                    if ($logged_status == true) {
                        ?>
                        <a   href="<?= base_url('signin/signout') ?>" style="font-size: 0.9rem;"><?=$this->lang->line('logout')?></a>
                        <?php
                    } else echo("<a   href='".base_url('signin/index') ."' style='font-size: 0.9rem;'>".$this->lang->line('log_in')."</a>");
                ?>
            </li>

        </ul>

    </div>
    <div class="clearfix"></div>
