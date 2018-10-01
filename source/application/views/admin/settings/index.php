<!-- BEGIN CONTENT -->




<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="row page-content" style="">
        <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
            <h1 class="page-title"> <?php echo($this->lang->line('admin_detail'));?>
                <small></small>
            </h1>
            <?php $success = $this->session->flashdata("success");?>
            <?php if( !empty( $success ) ) : ?>
                <div class="custom-alerts alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="font-size: 36px; width: 36px; height: 36px; color: red; ">&times;</button>
                    <?= $success.validation_errors();  ?>
                </div>
            <?php endif; ?>

            <?php echo form_open('admin/settings/edit/' .$user_data->user_id); ?>
            <h5><?php echo($this->lang->line('email_address'));?></h5>
            <input type="text" name="email_address" id="email_address" value="<?php echo($user_data->email);?>"  style="width:100%; height: 40px;" size="50" />


            <h1 class="page-title"> <?php echo($this->lang->line('change_password'));?>
                <small></small>
            </h1>
            <h5><?php echo($this->lang->line('current_password'));?></h5>
            <input type="password" name="current_password"  style="width:100%; height: 40px;" value="" size="50" />

            <h5><?php echo($this->lang->line('new_password'));?></h5>
            <input type="password" id="new_password" name="new_password" value="" style="width:100%; height: 40px;" size="50" />

            <h5><?php echo($this->lang->line('confirm_password'));?></h5>
            <input type="password" id="confirm_password" name="confirm_password"  value="" style="width:100%; height: 40px;" size="50" />

            <div><input type="submit" class="btn btn-warning" style="background-color: #fc960d; margin-top:30px;width:100%; height: 40px;" value="<?php echo($this->lang->line('save_change'));?>" /></div>

            </form>
        </div>

    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->