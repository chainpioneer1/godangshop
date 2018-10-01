<!-- BEGIN CONTENT -->

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="min-height: 1305px;">

        <h1 class="page-title"> <?php echo($this->lang->line('add_category'));?>
            <small></small>
        </h1>

        <div class="row">
            <form action="<?= base_url('admin/categories/add') ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="col-md-9">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption ">
                            <span class="caption-subject font-dark sbold uppercase"><?php echo($this->lang->line('main_information'));?></span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="form-group" style="margin-bottom: 0">
                                <div class="form-group">
                                    <label class="control-label col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="name_english"><?php echo($this->lang->line('name_english'));?></label>
                                    <div class="col-md-offset-1  col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                        <input type="text" class="form-control" name="name_english" id="name_english" />
                                        <?php echo form_error('name_english', '<span class="form-error">', '</span>'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="name"><?php echo($this->lang->line('name_thai'));?></label>
                                    <div class="col-md-offset-1  col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                        <input type="text" class="form-control" name="name_thai" id="name_thai" />
                                        <?php echo form_error('name_thai', '<span class="form-error">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="name"><?php echo($this->lang->line('slug'));?></label>
                                    <div class="col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10">
                                        <input type="text" class="form-control" name="slug" id="slug" />
                                        <?php echo form_error('slug', '<span class="form-error">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="description"><?php echo($this->lang->line('description'));?></label>
                                    <div class="col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10">
                                        <textarea name="description" class="form-control" id="catdescription" rows="5"></textarea>
                                        <?php echo form_error('description', '<span class="form-error">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="inputWarning"><?php echo($this->lang->line('parent_category'));?></label>
                                    <div class="col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10">
                                        <select class="bs-select form-control" name="parent_id">
                                            <option value=""></option>
                                            <?php foreach( $categories as $cat ) : ?>
                                            <option value="<?= $cat->cat_id ?>"><?php
                                                $tmp = 'name_'.($this->session->userdata('lang'));
                                                echo $cat->slug;?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('parent_id', '<span class="form-error">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="description"></label>
                                    <div class="col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10">
                                        <button type="submit" class="btn btn-warning" style="background-color:#fc960d; width:100%; padding: 10px 20px"><?php echo($this->lang->line('add_category'));?></button>
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