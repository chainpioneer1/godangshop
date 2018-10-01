
    <div class="main-content">
        <div class="container itbh-container" style="margin-top: 30px">
            <div class="row">
                <div class="col-lg-offset-1 col-lg-4 col-md-offset-1 col-md-3  col-sm-3 col-xs-offset-1 col-xs-10">
                    <?php if( !empty( $login_result ) ) : ?>
                        <div class="custom-alerts alert alert-success fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="font-size: 36px; width: 36px; height: 36px; color: red; ">&times;</button>
                            <?= $login_result ?>
                        </div>
                    <?php endif; ?>
                    <form class="itbh-login-form" method="post" action="<?= base_url('signin/index') ?>">
                        <h3 class="form-heading" style="font-weight: 400; "><?= $this->lang->line('login');?></h3>
                        <div class="form-group">
                            <label for="userename"><?= $this->lang->line('username_email');?><span style="color: red;">&nbsp;*</span></label>
                            <input type="text" name="username" class="form-control" id="userename" required>
                        </div>
                        <?php echo form_error('username', '<span class="form-error">', '</span>'); ?>
                        <div class="form-group">
                            <label for="password"><?= $this->lang->line('password');?><span style="color: red;">&nbsp;*</span></label>
                            <input type="password" name="password" class="form-control" id="password" required>
                        </div>
                        <?php echo form_error('password', '<span class="form-error">', '</span>'); ?>
                        <input style="transform:scale(1.5);" type="checkbox" value="<?= $this->lang->line('remeber_me');?>"/>&nbsp;&nbsp;<?=$this->lang->line('remember_me');?>
                        <button type="submit" value="login" class="btn btn-warning myaccount-login-button" style="background-color:#fc960d; ">
                            <?= $this->lang->line('login');?>
                        </button>
                    </form>
                </div>


                <div class="col-lg-offset-1 col-lg-4 col-md-offset-1 col-md-3 col-sm-offset-1 col-sm-3 col-xs-offset-1 col-xs-10">

                    <?php if( !empty( $form_validation ) ) : ?>
                        <div class="custom-alerts alert alert-success fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="font-size: 36px; width: 36px; height: 36px; color: red; ">&times;</button>
                            <?= $form_validation ?>
                        </div>
                    <?php endif; ?>

                    <form class="itbh-login-form" method="post" action="<?= base_url('signin/signup') ?>">
                        <h3 class="form-heading" style="font-weight: 400; "><?=$this->lang->line('register');?></h3>
                        <div class="form-group">
                            <label for="useremail"><?= $this->lang->line('useremail');?><span style="color: red;">&nbsp;*</span></label>
                            <input type="email" name="useremail" class="form-control" id="useremail" placeholder="Email" required>
                        </div>
                        <?php echo form_error('useremail', '<span class="form-error">', '</span>'); ?>
                        <div class="form-group">
                            <label for="userename"><?= $this->lang->line('username');?><span style="color: red;">&nbsp;*</span></label>
                            <input type="text" name="username" class="form-control" id="usrename" placeholder="User name"required>
                        </div>
                        <?php echo form_error('username', '<span class="form-error">', '</span>'); ?>
                        <div class="form-group">
                            <label for="password"><?= $this->lang->line('password');?><span style="color: red;">&nbsp;*</span></label>
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                        </div>
                        <?php echo form_error('password', '<span class="form-error">', '</span>'); ?>
                        <div class="form-group">
                            <label for="user_role"><?= $this->lang->line('user_role');?><span style="color: red;">&nbsp;*</span></label>
                            <select name="user_role" class="form-control" id="user_role" required>
                                <option value="2"><?= $this->lang->line('seller');?></option>
                                <option value="3"><?= $this->lang->line('customer');?></option>
                            </select>
                        </div>
                        <button type="submit" value="login" class="btn btn-warning myaccount-login-button" style="background-color:#fc960d; "><?=$this->lang->line('register');?>

                        </button>
                    </form>

                    <form class="itbh-login-form" method="post" action="<?= base_url('signin/signup') ?>">
                        <label style="margin-top: 30px;" for="send-request-button"><?=$this->lang->line('warehouse_register_send_request');?></label>
                        <button type="submit" value="login" id="send-request-button" class="btn btn-success send-request-button" >
                            <?= $this->lang->line('send_request');?>
                        </button>
                    </form>
                </div>

            </div>
            <div style="margin-top: 30px;"></div>
        </div>
    </div>
</div>