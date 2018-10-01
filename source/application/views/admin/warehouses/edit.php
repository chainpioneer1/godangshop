<script>
    var ajax_url = '<?= base_url('admin/warehouses/') ?>';
</script>

<!-- BEGIN CONTENT -->

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="min-height: 1305px;">

        <h1 class="page-title"> <?php echo($this->lang->line('edit_warehouse'));?>
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
            <form action="<?= base_url('admin/warehouses/edit/' . $warehouse->warehouse_id) ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                <input type="hidden" name="warehouse_id" id="warehouse_id" value="<?= $warehouse->warehouse_id ?>">
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
                                            <input type="text" class="form-control" name="name" id="name" value="<?= $warehouse->warehouse_name ?>" />
                                            <?php echo form_error('name', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="email"><?php echo($this->lang->line('email'));?></label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="email" id="email" value="<?= $warehouse->warehouse_email?>" />
                                            <?php echo form_error('email', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="description"><?php echo($this->lang->line('description'));?></label>
                                        <div class="col-md-10">
                                            <textarea name="description" class="form-control"  id="warehouse_description" rows="5"><?= $warehouse->warehouse_description ?></textarea>
                                            <?php echo form_error('description', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2" for="description"></label>
                                        <div class="col-md-10">
                                            <button type="submit" class="btn green" style="padding: 10px 20px"><?php echo($this->lang->line('save_change'));?></button>
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