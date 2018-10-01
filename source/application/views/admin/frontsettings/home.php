<!-- BEGIN CONTENT -->

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="min-height: 1305px;">

        <h1 class="page-title"> <?=$this->lang->line('edit_setting');?>
            <small></small>
        </h1>

        <?php $success = $this->session->flashdata("success");?>
        <?php if( !empty( $success ) ) : ?>
            <div class="custom-alerts alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                <?= $success ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <form action="<?= base_url('admin/settings/home') ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject font-dark sbold uppercase"><?=$this->lang->line('categories');?></span>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="form-group" style="margin-bottom: 0">
                                <?php foreach( $categories as $cat ) : ?>
                                    <?php
                                    if( $cat->slug == 'most-populer' || $cat->slug == 'most-new' )
                                        continue;
                                    ?>
                                    <div>
                                        <div class="col-md-12">
                                            <div class="col-md-3"><?= $cat->name ?></div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="mt-checkbox-list">
                                                        <label class="mt-checkbox">
                                                            <input type="checkbox" class="form-control" name="<?= $cat->slug ?>_feature_show" <?= ($cat->feature_show == 1)? 'checked' : '' ?>/>
                                                            Show Featured Items
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">No of Items</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="<?= $cat->slug ?>_feature_num" value="<?= $cat->feature_num ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <label class="mt-radio">
                                                            <input type="radio" class="form-control" name="<?= $cat->slug ?>_feature_theme" value="large" <?= ($cat->feature_theme == 'large')? 'checked' : '' ?> />
                                                            Theme large
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="mt-radio">
                                                            <input type="radio" class="form-control" name="<?= $cat->slug ?>_feature_theme" value="small" <?= ($cat->feature_theme == 'small')? 'checked' : '' ?>/>
                                                            Theme Small
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <div>
                                    <div class="col-md-12">
                                        <hr>
                                    </div>
                                </div>

                                <?php foreach( $categories as $cat ) : ?>
                                    <?php
                                    if( $cat->slug != 'most-populer' && $cat->slug != 'most-new' )
                                        continue;
                                    ?>
                                    <div>
                                        <div class="col-md-12">
                                            <div class="col-md-3"><?= $cat->name ?></div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <div class="mt-checkbox-list">
                                                        <label class="mt-checkbox">
                                                            <input type="checkbox" class="form-control" name="<?= $cat->slug ?>_feature_show" <?= ($cat->feature_show == 1)? 'checked' : '' ?>/>
                                                            Show Featured Items
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label col-md-4">No of Items</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" name="<?= $cat->slug ?>_feature_num" value="<?= $cat->feature_num ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <div class="col-md-6">
                                                        <label class="mt-radio">
                                                            <input type="radio" class="form-control" name="<?= $cat->slug ?>_feature_theme" value="large" <?= ($cat->feature_theme == 'large')? 'checked' : '' ?> />
                                                            Theme large
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="mt-radio">
                                                            <input type="radio" class="form-control" name="<?= $cat->slug ?>_feature_theme" value="small" <?= ($cat->feature_theme == 'small')? 'checked' : '' ?>/>
                                                            Theme Small
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                                <div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn green" style="padding: 10px 20px">Save</button>
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