<!-- BEGIN CONTENT -->




<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="row page-content" style="min-height: 1305px;">
        <div class="col-lg-6">
            <h1 class="page-title"> <?php echo($this->lang->line('site_settings'));?>
                <small></small>
            </h1>
            <?php $success = $this->session->flashdata("success");?>
            <?php if( !empty( $success ) ) : ?>
                <div class="custom-alerts alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="font-size: 36px; width: 36px; height: 36px; color: red; ">&times;</button>
                    <?= $success ?>
                </div>
                <?php $this->session->set_flashdata('success', null);?>
            <?php endif; ?>
            <h5><?php echo($this->lang->line('about_page_title'));?></h5>
            <input type="text" name="about_page_title"  value="<?php echo('about page title');?>"  style="width:540px; height: 40px;" size="50" />

            <?php echo validation_errors(); ?>

            <?php echo form_open('admin/settings/edit'); ?>
                <h1 class="page-title"> <?php echo($this->lang->line('change_password'));?>
                    <small></small>
                </h1>
                <h5><?php echo($this->lang->line('current_password'));?></h5>
                <input type="password" name="current_password"  style="width:540px; height: 40px;" value="" size="50" />

                <h5><?php echo($this->lang->line('new_password'));?></h5>
                <input type="password" id="new_password" name="new_password" value="" style="width:540px; height: 40px;" size="50" />

                <h5><?php echo($this->lang->line('confirm_password'));?></h5>
                <input type="password" id="confirm_password" name="confirm_password"  value="" style="width:540px; height: 40px;" size="50" />

                <div><input type="submit" class="btn btn-primary" style=" margin-top:30px;width:540px; height: 40px;" value="Submit" /></div>

            </form>
        </div>

    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->