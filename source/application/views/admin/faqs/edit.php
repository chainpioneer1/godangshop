<script>
    var ajax_url = '<?= base_url('admin/faqs/') ?>';
</script>

<!-- BEGIN CONTENT -->

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="min-height: 1305px;">

        <h1 class="page-title"> <?php echo($this->lang->line('edit_faq'));?>
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
            <form action="<?= base_url('admin/faqs/edit/' . $faq->faq_id) ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                <input type="hidden" name="faq_id" id="faq_id" value="<?= $faq->faq_id ?>">
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
                                        <label class="control-label col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="faq_rank"><?php echo($this->lang->line('faq_rank'));?></label>
                                        <div class="col-md-offset-1  col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                            <input type="number" class="form-control" name="faq_rank" id="faq_rank" value="<?= $faq->faq_rank?>" />
                                            <?php echo form_error('faq_rank', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="faq_title_english"><?php echo($this->lang->line('faq_title_english'));?></label>
                                        <div class="col-md-offset-1  col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                            <input type="text" class="form-control" name="faq_title_english" id="faq_title" value="<?= $faq->faq_title_english ?>" />
                                            <?php echo form_error('faq_title_english', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="faq_title_thai"><?php echo($this->lang->line('faq_title_thai'));?></label>
                                        <div class="col-md-offset-1  col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                            <input type="text" class="form-control" name="faq_title_thai" id="faq_title" value="<?= $faq->faq_title_thai?>" />
                                            <?php echo form_error('faq_title_thai', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="faq_description_english"><?php echo($this->lang->line('faq_description_english'));?></label>
                                        <div class="col-md-offset-1  col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                            <textarea name="faq_description_english" class="form-control"  id="warehouse_description_english" rows="5"><?= $faq->faq_description_english ?></textarea>
                                            <?php echo form_error('faq_description_english', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="faq_description_thai"><?php echo($this->lang->line('faq_description_thai'));?></label>
                                        <div class="col-md-offset-1  col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                            <textarea name="faq_description_thai" class="form-control"  id="warehouse_description_thai" rows="5"><?= $faq->faq_description_thai?></textarea>
                                            <?php echo form_error('faq_description_thai', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="submit_button"></label>
                                        <div class="col-md-offset-1  col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                            <button type="submit" class="btn btn-warning" style="width:100%; background-color: #fc960d; padding: 10px 20px"><?php echo($this->lang->line('save_change'));?></button>
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