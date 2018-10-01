
<!-- BEGIN CONTENT -->

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="min-height: 1305px;">

        <h1 class="page-title"> <?php echo($this->lang->line('add_new_faq'));?>
            <small></small>
        </h1>

        <div class="row">
            <form action="<?= base_url('admin/faqs/add') ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="col-md-9">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-dark sbold uppercase"><?php echo($this->lang->line('main_information'));?></span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="faq_rank"><?php echo($this->lang->line('faq_rank'));?></label>
                                    <div class="col-md-10">
                                        <input type="number" class="form-control" name="faq_rank" id="slug" />
                                        <?php echo form_error('faq_rank', '<span class="form-error">', '</span>'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2" for="faq_title_english"><?php echo($this->lang->line('faq_title_english'));?></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="faq_title_english" id="faq_title_english" />
                                        <?php echo form_error('faq_title_english', '<span class="form-error">', '</span>'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2" for="faq_title_thai"><?php echo($this->lang->line('faq_title_thai'));?></label>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" name="faq_title_thai" id="faq_title_thai" />
                                        <?php echo form_error('faq_title_thai', '<span class="form-error">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="faq_description_english"><?php echo($this->lang->line('faq_description_english'));?></label>
                                    <div class="col-md-10">
                                        <textarea name="faq_description_english" class="form-control" id="faq_description_english" rows="5"></textarea>
                                        <?php echo form_error('faq_description_english', '<span class="form-error">', '</span>'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2" for="faq_description_thai"><?php echo($this->lang->line('faq_description_thai'));?></label>
                                    <div class="col-md-10">
                                        <textarea name="faq_description_thai" class="form-control" id="faq_description_thai" rows="5"></textarea>
                                        <?php echo form_error('faq_description_thai', '<span class="form-error">', '</span>'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2" for="description"></label>
                                    <div class="col-md-10">
                                        <button type="submit" class="btn btn-warning" style="background-color:#fc960d; padding: 10px 20px; width: 100%;"><?php echo($this->lang->line('add_new_faq'));?></button>
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