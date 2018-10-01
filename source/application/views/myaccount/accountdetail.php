

                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <?php $success = $this->session->flashdata("success");?>
                    <?php if( !empty( $success ) ) : ?>
                        <div class="custom-alerts alert alert-success fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="font-size: 36px; width: 36px; height: 36px; color: red; ">&times;</button>
                            <?= $success ?>
                        </div>
                    <?php endif; ?>
                    <div id="myaccount-detail-update" >
                        <form action="<?= base_url('myaccount/update_account') ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <div class="col-lg-8  col-md-8 col-sm-12 col-xs-12">
                                <h3><?=$this->lang->line('account_detail'); ?></h3>
                                <div class="form-group" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                                            <label class="control-label" for="first_name"><?php echo($this->lang->line('first_name'));?><span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="first_name" value="<?=$customer_data->customer_last_name;?>"  id="first_name" />
                                            <?php echo form_error('first_name', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                                            <label class="control-label" for="last_name"><?php echo($this->lang->line('last_name'));?><span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" name="last_name" value="<?=$customer_data->customer_last_name;?>" id="last_name" />
                                            <?php echo form_error('last_name', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                                            <label class="control-label" for="email"><?php echo($this->lang->line('email_address'));?><span style="color: red;">*</span></label>
                                            <input type="email" class="form-control" name="email" value="<?=$user_data->email;?>" id="email" />
                                            <?php echo form_error('email', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <h3><?=$this->lang->line('change_password'); ?></h3>
                                    <div class="form-group">
                                        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                                            <label class="control-label" for="current_password"><?php echo($this->lang->line('current_password'));?><span style="color: red;">*</span></label>
                                            <input required type="password" class="form-control" name="current_password"  id="current_password" placeholder="<?=$this->lang->line('you_must_input_password_first');?>" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                                            <label class="control-label" for="new_password"><?php echo($this->lang->line('new_password'));?><span style="color: red;">*</span></label>
                                            <input required type="password" class="form-control" name="new_password"  id="new_password" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                                            <label class="control-label" for="confirm_password"><?php echo($this->lang->line('confirm_password'));?><span style="color: red;">*</span></label>
                                            <input required type="password" class="form-control" name="confirm_password"  id="confirm_password" />
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-lg-8 col-md-8 col-sm-10 col-xs-12">
                                            <button type="submit" class="btn btn-warning" style="background-color:#fc960d;    padding: 10px 20px; width: 100%;"><?php echo($this->lang->line('save_change'));?></button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
