<style>
    .alert {
        padding: 20px;
        background-color: #f44336;
        color: white;
    }

    .closebtn {
        margin-left: 15px;
        color: white;
        font-weight: bold;
        float: right;
        font-size: 22px;
        line-height: 20px;
        cursor: pointer;
        transition: 0.3s;
    }

    .closebtn:hover {
        color: black;
    }
    th{
        font-size: larger;
    }
</style>

<div class="main-content">
    <div class="container itbh-container" style="margin-top: 30px">
        <!--<form action="<? /*= site_url('carts/checkout') */ ?>" method="post" enctype="multipart/form-data">-->
        <div class="col-md-3">
            <?php
            $loginId = $this->session->userdata('loginuserID');
            if ($loginId == '') {
                ?>
                <div class="alert" id="pwdAlert" style="display: none">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <strong>Danger!</strong> Passwords Dismatch!
                </div>
                <div class="alert" id="nameAlert" style="display: none">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <strong>Danger!</strong> Enter your full name and user name.
                </div>
                <div class="alert" id="emailAlert" style="display: none">
                    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    <strong>Danger!</strong> Please enter your email in the correct format.
                </div>
                <h3 class="form-heading" style="font-weight: 400;">
                    <?= $this->lang->line('please_register') ?></h3>
                <div class="form-group">

                    <input type="text" value="" name="fullname" class="form-control" id="fullname" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <input type="text" value="" name="username" class="form-control" id="usrename" placeholder="UserName" required>
                </div>
                <div class="form-group">
                    <input type="password" value="" name="password" class="form-control" id="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <input type="password" value="" name="confirm_password" class="form-control" id="confirm_password" placeholder="Confirm Password" required>
                </div>
                <div class="form-group">
                    <input type="email" value="" name="email" class="form-control" id="email" placeholder="Email" required>
                </div>
                <button style="width: 100%; background-color: #fc960d; " class="btn btn-warning myaccount-login-button"
                        id="registerBtn"><?= $this->lang->line('register'); ?>
                </button>
            <?php }  ?>

        </div>
        <?php if($loginId==''){?>
        <div class="col-md-9 col-lg-9 col-sm-9 col-xs-9"><?php }else{?>
            <div class="col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-lg-offset-1 col-lg-10 col-xs-offset-1 col-xs-10"><?php }?>
                <?php
                if (count($cartsInfo) > 0){
                ?>

                <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8 col-xs-12">

                    <table class="table table-responsive" id="carts_products_tbl">
                        <thead>
                        <tr>
                            <th style="padding: 20px;"><?php echo($this->lang->line('product')); ?></th>
                            <th style="padding: 20px;"> <?php echo($this->lang->line('quantity')); ?> </th>
                            <th style="padding: 20px;"> <?php echo($this->lang->line('total')); ?> </th>
                        </tr>
                        </thead>
                        <tbody id="itbh-seller-products-tbody">
                        <?php
                        echo $controller->print_checkout_products();
                        ?>

                        </tbody>
                    </table>
                </div>
                <div style="margin-top: 20px;">
                    <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8 col-xs-12"
                         style="font-size: large"><?php echo $this->lang->line('notes'); ?></div>
                    <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8 col-xs-12">
                        <textarea id="checkout_note" class="form-control" style="margin-bottom: 20px;"></textarea>
                    </div>
                    <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8 col-xs-12" style="text-align: center; ">
                        <button id="placeOrderBtn" class="btn btn-warning"
                                style="margin-bottom: 20px; font-size: large">
                            <strong><?php echo $this->lang->line('place_order'); ?></strong></button>
                    </div>


                </div>
            </div>

        <?php
        } else {
            ?>

            <p class="carts-empty-products"
               style="text-align: center; font-size: 1.5rem; margin-top: 25px;"><?= $this->lang->line('no_product_in_cart'); ?></p>
            <div style="text-align: center;">
                <a href="<?= base_url('products/index') ?>" class="carts-empty-products-shopping btn btn-primary"
                   style="text-align: center; font-size: 1.5rem; margin-top: 25px;"><?= $this->lang->line('let_shopping'); ?></a>

            </div>
            <?php
        }

        ?>
        </div>
    </div>
</div>

<script>

    $(function () {
        var loginuserID = '<?php echo $this->session->userdata('loginuserID')?>';
        if (loginuserID == '') {
            $('#placeOrderBtn').attr('disabled', true);
        }
    });

    function checkout() {
        var loginId = '<?php echo $this->session->userdata('loginuserID')?>';
        if (loginId == '') {

            location.href = '<?php echo site_url('/Signin/index')?>';
        }
        else {
            location.href = '<?php echo site_url('/Carts/checkout')?>'
        }
    }

    $('#placeOrderBtn').click(function () {

        var checkout_note = $('#checkout_note').val();
        location.href = '<?php echo site_url('/carts/placeorder')?>' + '?note=' + checkout_note;
    });

    $('#registerBtn').click(function () {
        var fname=$('#fullname').val();
        var uname = $('#username').val();
        var pwd = $('#password').val();
        var confirm_pwd=$('#confirm_password').val();
        var email=$('#email').val();
        var param=new Array;
        param.push(fname);
        param.push(uname);
        param.push(pwd);
        param.push(email);

        if(confirm_pwd!=pwd){
            $('#pwdAlert').show();
            setTimeout(function(){
                $('#pwdAlert').hide();
            },2000);
            return;
        }
        if(fname==''||uname=='')
        {
            $('#nameAlert').show();
            setTimeout(function(){
                $('#nameAlert').hide();
            },2000);
            return;
        }
        if(email.indexOf('@')<1){
            $('#emailAlert').show();
            setTimeout(function(){
                $('#emailAlert').hide();
            },2000);
            return;
        }
        var data=param.toString();
        $.ajax({
            url: '<?= site_url('Signin/checkout_register')?>',
            type: 'POST',
            dataType: 'text',
            data: {info: data},
            success:
                function(data){
                    $('#placeOrderBtn').attr('disabled', false);
                }
        });

    })
    ;
</script>
