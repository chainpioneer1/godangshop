<!-- BEGIN CONTENT -->

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="min-height: 1305px;">

        <h1 class="page-title"> <?=$this->lang->line('add_new_subscriber')?>
            <small></small>
        </h1>

        <div class="row">
            <form action="<?= base_url('admin/subscribers/add') ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="col-md-9">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-dark sbold uppercase"><?=$this->lang->line('main_information')?></span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="form-group" style="margin-bottom: 0">
                                <div class="form-group">
                                    <label class="control-label col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="email"><?=$this->lang->line('subscriber_email')?></label>
                                    <div class="col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                        <input type="email" class="form-control" name="subscriber_email" id="subscriber_email" />
                                        <?php echo form_error('subscriber_email', '<span class="form-error">', '</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="description"></label>
                                    <div class="col-md-offset-1 col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                        <button type="submit" class="btn warning" style="color:white; width:100%; background-color:#fc960d; padding: 10px 20px; "><?=$this->lang->line('add_new_subscriber');?></button>
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