<!-- BEGIN CONTENT -->

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="min-height: 1305px;">

        <h1 class="page-title"> <?php echo($this->lang->line('edit_user'));?>
            <small></small>
        </h1>

        <?php $success = $this->session->flashdata("success");?>
        <?php if( !empty( $success ) ) : ?>
        <div class="custom-alerts alert alert-success fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="font-size: 36px; width: 36px; height: 36px; color: red; ">&times;</button>
            <?= $success ?>
        </div>
        <?php endif; ?>

        <div class="row">
            <form action="<?= base_url('admin/users/edit/' . $user->user_id) ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                <div class="col-md-9">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-dark sbold uppercase"><?php echo($this->lang->line('main_information'));?></span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="form-group" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <label class="col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="fullname"><?php echo($this->lang->line('full_name'));?></label>
                                        <div class="col-md-offset-1  col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                            <input type="text" class="form-control" name="fullname" id="fullname" value="<?= $user->fullname ?>"/>
                                            <?php echo form_error('fullname', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="username"><?php echo($this->lang->line('user_name'));?></label>
                                        <div class="col-md-offset-1  col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                            <input type="text" class="form-control" name="username" id="username" value="<?= $user->username ?>"/>
                                            <?php echo form_error('username', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="email"><?php echo($this->lang->line('email'));?></label>
                                        <div class="col-md-offset-1  col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                            <input type="email" class="form-control" name="email" id="email" value="<?= $user->email ?>" />
                                            <?php echo form_error('email', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group" style="display: none;">
                                        <label class="col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="user_type"><?php echo($this->lang->line('user_type'));?></label>
                                        <div class="col-md-offset-1  col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                            <input type="text" class="form-control" name="user_type" id="user_type" value="<?= $user->user_type ?>" />
                                            <?php echo form_error('user_type', '<span class="form-error">', '</span>'); ?>
                                            <select class="bs-select form-control" name="user_type">
                                                <?php foreach( $roles as $role ) : ?>
                                                    <option value="<?= $role->role_id ?>" <?= ( $role->role_id == $user->user_type )? 'selected' : '' ?>><?= $role->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?php echo form_error('user_type', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class=" col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="description"></label>
                                        <div class="col-md-offset-1  col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                            <button type="submit" class="btn btn-warning" style="background-color:#fc960d;padding: 10px 20px; color: white;"><?php echo($this->lang->line('save_change'));?></button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="row">
            <form action="<?= base_url('admin/users/change_pwd/' . $user->user_id) ?>" class="form-horizontal" method="post">
                <div class="col-md-9">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-dark sbold uppercase"><?php echo($this->lang->line('change_password'));?></span>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <div class="form-body">
                                <div class="form-group" style="margin-bottom: 0">
                                    <div class="form-group">
                                        <label class="col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="fullname"><?php echo($this->lang->line('password'));?></label>
                                        <div class="col-md-offset-1  col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                            <input type="password" class="form-control" name="password" id="password"/>
                                            <?php echo form_error('password', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="username"><?php echo($this->lang->line('confirm_password'));?></label>
                                        <div class="col-md-offset-1  col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                            <input type="password" class="form-control" name="confirm_pwd" id="confirm_pwd""/>
                                            <?php echo form_error('confirm_pwd', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="description"></label>
                                        <div class="col-md-offset-1  col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                            <button type="submit" class="btn btn-danger" style="background-color:#fc960d; padding: 10px 20px"><?php echo($this->lang->line('change_password'));?></button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->