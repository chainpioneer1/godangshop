<!-- BEGIN CONTENT -->




<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="row page-content" >
        <h1 class="page-title"> <?php echo($this->lang->line('site_settings'));?>
            <small></small>
        </h1>

        <?php $success = $this->session->flashdata("success");?>
        <?php if( !empty( $success ) ) : ?>

            <div class="custom-alerts alert alert-success fade in" style="width: 50%;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="font-size: 36px; width: 36px; height: 36px; color: red; ">&times;</button>
                <?= $success ?>
            </div>
            <?php $this->session->set_flashdata('success', null);?>
        <?php endif; ?>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?php echo form_open('admin/frontsettings/updategalleries'); ?>

            <h1 class="page-title"> <?php echo($this->lang->line('update_galleries'));?>
                <small></small>
            </h1>
            <div class="form-group">
            <h5><?php echo($this->lang->line('first_gallery').(':1440 X 150px '));?><span style="color: red;">*</span></h5>
            <input required class="form-control" class="form-control" type="file" name="about_page_title_english"  placeholder="image sizei will be adfadf" size="50" />
            </div>

            <div class="form-group">
                <h5><?php echo($this->lang->line('second_gallery').(':1440 X 150px '));?><span style="color: red;">*</span></h5>
              </div>

            <div class="form-group">
                <h5><?php echo($this->lang->line('third_gallery').(':1440 X 150px '));?><span style="color: red;">*</span></h5>
                <input class="form-control" class="form-control" type="file" name="about_page_title_english"  placeholder="image sizei will be adfadf" size="50" />
            </div>

            <div class="form-group">
                <h5><?php echo($this->lang->line('forth_gallery').(':1440 X 150px '));?><span style="color: red;">*</span></h5>
                <input class="form-control" class="form-control" type="file" name="about_page_title_english"  placeholder="image sizei will be adfadf" size="50" />
            </div>

            <div class="form-group">
                <h5><?php echo($this->lang->line('first_gallery').(':1440 X 150px '));?><span style="color: red;">*</span></h5>
                <input class="form-control" class="form-control" type="file" name="about_page_title_english"  placeholder="image sizei will be adfadf" size="50" />
            </div>

            <div class="form-group">
                <h5><?php echo($this->lang->line('first_gallery').(':1440 X 150px '));?><span style="color: red;">*</span></h5>
                <input class="form-control" class="form-control" type="file" name="about_page_title_english"  placeholder="image sizei will be adfadf" size="50" />
            </div>

            <div>
                <input type="submit" class="btn btn-warning" style=" background-color:#fc960d; margin-top:30px;width:100%; height: 40px;" value="<?php echo($this->lang->line('save_change'));?>" />
            </div>

            </form>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <?php echo form_open('admin/sitesettings/whats/'); ?>
            <h1 class="page-title"> <?php echo($this->lang->line('whats_go_dang'));?>
                <small></small>
            </h1>

            <div class="form-group">
            <h5><?php echo($this->lang->line('what_page_title_english'));?><span style="color: red;">*</span></h5>
            <input type="text" class="form-control" name="what_page_title_english"   value="<?=$whats_data->title_english?>" size="50" />
            </div>
            <div class="form-group">
            <h5><?php echo($this->lang->line('what_page_title_thai'));?><span style="color: red;">*</span></h5>
            <input type="text" class="form-control" name="what_page_title_thai"   value="<?=$whats_data->title_thai?>" size="50" />
            </div>
            <div class="form-group">
            <h5><?php echo($this->lang->line('what_page_content_english'));?><span style="color: red;">*</span></h5>
            <textarea id="about_page_content" style="width: 100%;"class="form-control" name="about_page_content"  size="50" ><?=$whats_data->content_english?></textarea>
            </div>
            <div class="form-group">
            <h5><?php echo($this->lang->line('what_page_content_thai'));?><span style="color: red;">*</span></h5>
            <textarea id="about_page_content" style="width: 100%;" class="form-control" name="about_page_content_thai"  size="50" ><?=$whats_data->content_thai?></textarea>
            </div>
                <div><input type="submit" class="btn btn-warning" style=" background-color:#fc960d; margin-top:30px;width:100%; height: 40px;" value="<?php echo($this->lang->line('save_change'));?>" /></div>
            </form>
        </div>
    </div>



    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->