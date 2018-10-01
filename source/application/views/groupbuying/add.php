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
                        <div class="caption">
                            <span class="caption-subject font-dark sbold uppercase"><?php echo($this->lang->line('main_information'));?></span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="form-group" style="margin-bottom: 0">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="name"><?php echo($this->lang->line('name'));?></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="name" id="name" />
                                        <?php echo form_error('name', '<span class="form-error">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="name"><?php echo($this->lang->line('slug'));?></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="slug" id="slug" />
                                        <?php echo form_error('slug', '<span class="form-error">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="description"><?php echo($this->lang->line('description'));?></label>
                                    <div class="col-md-10">
                                        <textarea name="description" class="form-control" id="catdescription" rows="5"></textarea>
                                        <?php echo form_error('description', '<span class="form-error">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="inputWarning"><?php echo($this->lang->line('parent_category'));?></label>
                                    <div class="col-md-10">
                                        <select class="bs-select form-control" name="parent_id">
                                            <option value=""></option>
                                            <?php foreach( $categories as $cat ) : ?>
                                            <option value="<?= $cat->cat_id ?>"><?= $cat->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?php echo form_error('parent_id', '<span class="form-error">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="description"></label>
                                    <div class="col-md-10">
                                        <button type="submit" class="btn green" style="padding: 10px 20px"><?php echo($this->lang->line('add_category'));?></button>
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