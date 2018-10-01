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
            <?php echo form_open('admin/sitesettings/aboutus/'); ?>

            <h1 class="page-title"> <?php echo($this->lang->line('about_us'));?>
                <small></small>
            </h1>
            <div class="form-group">
            <h5><?php echo($this->lang->line('about_page_title_english'));?><span style="color: red;">*</span></h5>
            <input class="form-control" class="form-control" type="text" name="about_page_title_english"  value="<?=$about_data->title_english?>" size="50" />
            </div>

            <div class="form-group">
            <h5><?php echo($this->lang->line('about_page_title_thai'));?><span style="color: red;">*</span></h5>
            <input type="text" name="about_page_title_thai"  class="form-control"  value="<?=$about_data->title_thai?>" size="50" />
            </div>

            <div class="form-group">
            <h5><?php echo($this->lang->line('about_page_content_english'));?><span style="color: red;">*</span></h5>
            <textarea id="about_page_content" class="form-control" style="width: 100%;" name="about_page_content_english" value="" size="50" ><?=$about_data->content_english?></textarea>
            </div>
            <div class="form-group">
            <h5><?php echo($this->lang->line('about_page_content_thai'));?><span style="color: red;">*</span></h5>
            <textarea id="about_page_content" class="form-control" style="width: 100%;" name="about_page_content_thai" value="" size="50" ><?=$about_data->content_thai?></textarea>
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
        <?php echo form_open('admin/sitesettings/contactus/'); ?>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <h1 class="page-title"> <?php echo($this->lang->line('contact_us'));?>
                    <small></small>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 form-group">
                <div class="form-group">
                <h5><?php echo($this->lang->line('address1'));?><span style="color: red;">*</span></h5>
                <input type="text" name="address1"  class="form-control"  value="<?=$contactus_data->address1;?>"  size="50" />
                </div>
                <div class="form-group">
                <h5><?php echo($this->lang->line('address2'));?></h5>
                <input type="text" name="address2"  class="form-control" value="<?=$contactus_data->address2;?>" size="50" />
                </div>
                <div class="form-group">
                <h5><?php echo($this->lang->line('fax'));?></h5>
                <input type="text" name="fax"  class="form-control" value="<?=$contactus_data->fax;?>" size="50" />
                </div>
                <div class="form-group">
                <h5><?php echo($this->lang->line('tel'));?><span style="color: red;">*</span></h5>
                <input type="text" name="tel"  class="form-control" value="<?=$contactus_data->tel;?>" size="50" />
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">

                <div class="form-group">
                <h5><?php echo($this->lang->line('email'));?><span style="color: red;">*</span></h5>
                <input required type="email" name="email"  class="form-control" value="<?=$contactus_data->email;?>" size="50" />
                </div>
                <div class="form-group">
                <h5><?php echo($this->lang->line('google'));?></h5>
                <input type="email" name="google"  class="form-control" value="<?=$contactus_data->google;?>" size="50" />
                </div>
                <div class="form-group">
                <h5><?php echo($this->lang->line('facebook'));?></h5>
                <input type="email" name="facebook"  class="form-control"  value="<?=$contactus_data->facebook;?>" size="50" />
                </div>
                <div class="form-group">
                <h5><?php echo($this->lang->line('twitter'));?></h5>
                <input type="email" name="twitter"  class="form-control"  value="<?=$contactus_data->twitter;?>" size="50" />
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                <h5><?php echo($this->lang->line('line_id'));?></h5>
                <input type="text" name="line_id"  class="form-control" value="<?=$contactus_data->line_id;?>" size="50" />
                </div>
                <div class="form-group">
                <h5><?php echo($this->lang->line('location'));?></h5>
                <input type="text" name="location_x"  class="form-control" value="<?=$contactus_data->location_x;?>" size="50" />
                <h5>&nbsp;</h5>
                <input type="text" name="location_y"  class="form-control" value="<?=$contactus_data->location_y;?>" size="50" />
                <h5>&nbsp;</h5>
                </div>
                <div><input type="submit" class="btn btn-warning" style=" background-color:#fc960d; width:100%; height: 40px;" value="<?php echo($this->lang->line('save_change'));?>" /></div>
            </div>
        </div>
        </form>
    </div>



    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->