
                <div class="col-lg-9">

                    <h3 class="page-title"> <?=$this->lang->line('my_warehouse')?>
                        <small></small>
                    </h3>

                    <?php $success = $this->session->flashdata("success");?>
                    <?php if( !empty( $success ) ) : ?>
                        <div class="custom-alerts alert alert-success fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                            <?= $success ?>
                        </div>
                    <?php endif; ?>
                    <?php if(!empty($my_warehouse)):?>
                    <div class="row itbh-warehouse-information">
                        <form action="<?= base_url('sellers/edit_warehouse/') ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="warehouse_id" id="warehouse_id" value="<?= $my_warehouse->warehouse_id?>">
                            <div class="col-md-9">
                                <div class="about-warehouse">
                                    <div class="caption">
                                        <h4 class="caption-subject"><?php echo($this->lang->line('about'));?></h4>
                                    </div>

                                    <div class="form-group">
                                        <label class="zcol-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="warehouse_name"><?php echo($this->lang->line('warehouse_name'));?><span class="required">*</span></label>
                                        <div class="col-md-offset-1  col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                            <input type="text" class="form-control" name="warehouse_name" id="warehouse_name"  value="<?= $my_warehouse->warehouse_name ?>" placeholder="<?= $my_warehouse->warehouse_name ?>" />
                                            <?php echo form_error('warehouse_name', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="name"><?php echo($this->lang->line('logo'));?></label>
                                        <div class="col-md-offset-1  col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                            <input type="file" style="background-color: transparent;" name="warehouse_logo" id="warehouse_logo" " />
                                            <div>
                                                <img id="logo-file-trigger" style="border: 1px solid #efefef;" src="<?=site_url('assets/images/icons/file.png')?>"
                                            </div>
                                            <?php echo form_error('warehouse_logo', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="warehouse_slogan"><?php echo($this->lang->line('slogan'));?></label>
                                        <div class="col-md-offset-1  col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                            <input type="text" class="form-control" name="warehouse_slogan" id="warehouse_slogan" value="<?= $my_warehouse->warehouse_slogan ?>" />
                                            <?php echo form_error('warehouse_slogan', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-offset-1 col-sm-6 col-xs-offset-1 col-xs-10" for="warehouse_description"><?php echo($this->lang->line('description'));?></label>
                                        <div class="col-md-offset-1  col-md-10 col-lg-offset-1 col-lg-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                            <textarea class="form-control" name="warehouse_description" id="warehouse_description" ><?= $my_warehouse->warehouse_description?></textarea>
                                            <?php echo form_error('warehouse_description', '<span class="form-error">', '</span>'); ?>
                                        </div>

                                    </div>
                                </div>
                                <div class="warehouse-address">
                                    <div class="caption">
                                        <h4 class="caption-subject"><?php echo($this->lang->line('address'));?></h4>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-8">
                                            <label class="control-label" for="warehouse_company"><?php echo($this->lang->line('country'));?><span class="required">*</span></label>
                                            <input type="text" class="form-control" name="warehouse_country" id="warehouse_country" value="<?= $my_warehouse->warehouse_country ?>" />
                                            <?php echo form_error('warehouse_country', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="control-label" for="warehouse_address1"><?php echo($this->lang->line('address'));?><span class="required">*</span></label>
                                            <input type="text" class="form-control" name="warehouse_address1" id="warehouse_address1" value="<?= $my_warehouse->warehouse_address1?>" />
                                            <?php echo form_error('name', '<span class="form-error">', '</span>'); ?>
                                            <label class="control-label" for="warehouse_address2"></label>
                                            <input type="text" class="form-control" name="warehouse_address2" id="warehouse_address2" value="<?= $my_warehouse->warehouse_address2?>" />
                                        </div>

                                        <div class="col-md-8">
                                            <label class="control-label" for="warehouse_town"><?php echo($this->lang->line('town_city'));?><span class="required">*</span></label>
                                            <input type="text" class="form-control" name="warehouse_town" id="warehouse_town" value="<?= $my_warehouse->warehouse_town?>" />
                                            <?php echo form_error('name', '<span class="form-error">', '</span>'); ?>
                                        </div>

                                        <div class="col-md-8">
                                            <label class="control-label" for="warehouse_state"><?php echo($this->lang->line('state_country'));?><span class="required">*</span></label>
                                            <input type="text" class="form-control" name="warehouse_state" id="warehouse_state" value="<?= $my_warehouse->warehouse_state?>" />
                                            <?php echo form_error('name', '<span class="form-error">', '</span>'); ?>
                                        </div>

                                        <div class="col-md-8">
                                            <label class="control-label" for="warehouse_email"><?php echo($this->lang->line('email_address'));?><span class="required">*</span></label>
                                            <input type="text" class="form-control" name="warehouse_email" id="warehouse_email" value="<?= $my_warehouse->warehouse_email?>" />
                                            <?php echo form_error('name', '<span class="form-error">', '</span>'); ?>
                                        </div>

                                        <div class="col-md-8">
                                            <label class="control-label" for="warehouse_phone1"><?php echo($this->lang->line('phone1'));?><span class="required">*</span></label>
                                            <input type="text" class="form-control" name="warehouse_phone1" id="warehouse_phone1" value="<?= $my_warehouse->warehouse_phone1?>" />
                                            <?php echo form_error('warehouse_phone1', '<span class="form-error">', '</span>'); ?>
                                            <label class="control-label" for="warehouse_address2"></label>
                                            <input type="text" class="form-control" name="warehouse_phone2" id="warehouse_phone2" value="<?= $my_warehouse->warehouse_phone2?>" />
                                        </div>

                                        <div class="col-md-8">
                                            <label class="control-label" for="warehouse_fax"><?php echo($this->lang->line('fax'));?></label>
                                            <input type="text" class="form-control" name="warehouse_fax" id="warehouse_fax" value="<?= $my_warehouse->warehouse_fax?>" />
                                            <?php echo form_error('warehouse_fax', '<span class="form-error">', '</span>'); ?>
                                        </div>

                                        <div class="col-md-8">
                                            <label class="control-label" for="warehouse_map"><?php echo($this->lang->line('map_google'));?><span class="required">*</span></label>
                                            <input type="text" class="form-control" name="warehouse_map_x" id="warehouse_map_x" value="<?= $my_warehouse->warehouse_map_x?>" />
                                            <input type="text" class="form-control" name="warehouse_map_y" id="warehouse_map_y" value="<?= $my_warehouse->warehouse_map_y?>" />
                                            <?php echo form_error('name', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="warehouse-social-connect">
                                    <div class="caption">
                                        <h4 class="caption-subject"><?php echo($this->lang->line('social_connect'));?></h4>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-8">
                                            <label class="control-label" for="warehouse_line"><?php echo($this->lang->line('line_id'));?></label>
                                            <input type="text" class="form-control" name="warehouse_line" id="warehouse_line" value="<?= $my_warehouse->warehouse_line?>" />
                                            <?php echo form_error('name', '<span class="form-error">', '</span>'); ?>
                                        </div>

                                        <div class="col-md-8">
                                            <label class="control-label" for="warehouse_facebook"><?php echo($this->lang->line('facebook'));?></label>
                                            <input type="text" class="form-control" name="warehouse_facebook" id="warehouse_state" value="<?= $my_warehouse->warehouse_facebook?>" />
                                            <?php echo form_error('name', '<span class="form-error">', '</span>'); ?>
                                        </div>

                                        <div class="col-md-8">
                                            <label class="control-label" for="warehouse_google"><?php echo($this->lang->line('google'));?></label>
                                            <input type="text" class="form-control" name="warehouse_google" id="warehouse_google" value="<?= $my_warehouse->warehouse_google?>" />
                                            <?php echo form_error('name', '<span class="form-error">', '</span>'); ?>
                                        </div>

                                        <div class="col-md-8">
                                            <label class="control-label" for="warehouse_twitter"><?php echo($this->lang->line('twitter'));?></label>
                                            <input type="text" class="form-control" name="warehouse_twitter" id="warehouse_twitter" value="<?= $my_warehouse->warehouse_twitter?>" />
                                            <?php echo form_error('name', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="control-label" for="warehouse_ig"><?php echo($this->lang->line('ig'));?></label>
                                            <input type="text" class="form-control" name="warehouse_ig" id="warehouse_twitter" value="<?= $my_warehouse->warehouse_ig?>" />
                                            <?php echo form_error('warehouse_ig', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="warehouse-contact-person">
                                    <div class="caption">
                                        <h4 class="caption-subject"><?php echo($this->lang->line('contact_person'));?></h4>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-8">
                                            <label class="control-label" for="warehouse_contact_first"><?php echo($this->lang->line('first_name'));?><span class="required">*</span> </label>
                                            <input type="text" class="form-control" name="warehouse_contact_first" id="warehouse_contact_first"  value="<?= $my_warehouse->warehouse_contact_first?>"/>
                                            <?php echo form_error('warehouse_contact_first', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                        <div class="col-md-8">
                                            <label class="control-label" for="warehouse_contact_last"><?php echo($this->lang->line('last_name'));?></label>
                                            <input type="text" class="form-control" name="warehouse_contact_last" id="warehouse_contact_last"  value="<?= $my_warehouse->warehouse_contact_last?>" />
                                            <?php echo form_error('warehouse_contact_last', '<span class="form-error">', '</span>'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="warehouse-payment-method">
                                    <div class="caption">
                                        <h4 class="caption-subject"><?php echo($this->lang->line('payment_method'));?></h4>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-8" class="product-specification">
                                            <table class="itbh-sellers-products-specification" style="width: 100%;">
                                                <tr style="padding: 20px;">
                                                    <td style="width:90%;"><textarea style="width: 100%;" required name="payment_methods_content[]" placeholder="payment method" class="payment_methods_content"></textarea></td>
                                                    <td style="width:10%;padding-left: 10px;"><span style="color: red;" class="glyphicon glyphicon-remove itbh-sellers-warehouse-payment-method-remove" ></span></td>
                                                </tr>

                                            </table>
                                            <a style="float:right;" id="itbh-sellers-products-description-add"><?php echo($this->lang->line('add_new'));?></a>
                                        </div>
                                    </div>
                                </div>
                                    <div class="form-group">
                                        <div class="col-md-8">
                                            <button type="submit" class="btn btn-warning" style="width:100%; padding: 10px 20px; background-color: #fc960d;"><?php echo($this->lang->line('save_change'));?></button>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>



                                </div>
                            </div>
                        </form>

                    </div>
                    <?php else: {?>
                        <div class="row itbh-warehouse-information">
                            <form action="<?= base_url('sellers/add_warehouse/') ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                                <div class="col-md-9">
                                    <div class="about-warehouse">
                                        <div class="caption">
                                            <h4 class="caption-subject"><?php echo($this->lang->line('about'));?></h4>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-8">
                                                <label class="control-label" for="warehouse_name"><?php echo($this->lang->line('warehouse_name'));?><span class="required">*</span></label>
                                                <input type="text" class="form-control" name="warehouse_name" id="warehouse_name"   placeholder="" />

                                                <?php echo form_error('warehouse_name', '<span class="form-error">', '</span>'); ?>
                                            </div>
                                            <div class="col-md-8">
                                                <label class="control-label" for="name"><?php echo($this->lang->line('logo'));?></label>
                                                <input type="file"  hidden style="display: none !important;" name="warehouse_logo" id="warehouse_logo" value="<?= $my_warehouse->warehouse_logo ?>" />
                                                <img src="<?=site_url('assets/images/icons/file.png')?>/"

                                            </div>
                                                <?php echo form_error('warehouse_logo', '<span class="form-error">', '</span>'); ?>
                                            </div>

                                            <div class="col-md-8">
                                                <label class="control-label" for="warehouse_slogan"><?php echo($this->lang->line('slogan'));?></label>
                                                <input type="text" class="form-control" name="warehouse_slogan" id="warehouse_slogan" value="itbh comment : fix this part" />
                                                <?php echo form_error('warehouse_slogan', '<span class="form-error">', '</span>'); ?>
                                            </div>

                                            <div class="col-md-8">
                                                <label class="control-label" for="warehouse_description"><?php echo($this->lang->line('description'));?></label>
                                                <textarea class="form-control" name="warehouse_description" id="warehouse_description" ></textarea>
                                                <?php echo form_error('warehouse_description', '<span class="form-error">', '</span>'); ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="warehouse-address">
                                        <div class="caption">
                                            <h4 class="caption-subject"><?php echo($this->lang->line('address'));?></h4>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-8">
                                                <label class="control-label" for="warehouse_company"><?php echo($this->lang->line('country'));?><span class="required">*</span></label>
                                                <input type="text" class="form-control" name="warehouse_country" id="warehouse_country" value=""" />
                                                <?php echo form_error('warehouse_country', '<span class="form-error">', '</span>'); ?>
                                            </div>
                                            <div class="col-md-8">
                                                <label class="control-label" for="warehouse_address1"><?php echo($this->lang->line('address'));?><span class="required">*</span></label>
                                                <input type="text" class="form-control" name="warehouse_address1" id="warehouse_address1" value="" />
                                                <?php echo form_error('name', '<span class="form-error">', '</span>'); ?>
                                                <label class="control-label" for="warehouse_address2"></label>
                                                <input type="text" class="form-control" name="warehouse_address2" id="warehouse_address2" value="" />
                                            </div>

                                            <div class="col-md-8">
                                                <label class="control-label" for="warehouse_town"><?php echo($this->lang->line('town_city'));?><span class="required">*</span></label>
                                                <input type="text" class="form-control" name="warehouse_town" id="warehouse_town" value="" />
                                                <?php echo form_error('name', '<span class="form-error">', '</span>'); ?>
                                            </div>

                                            <div class="col-md-8">
                                                <label class="control-label" for="warehouse_state"><?php echo($this->lang->line('state_country'));?><span class="required">*</span></label>
                                                <input type="text" class="form-control" name="warehouse_state" id="warehouse_state" value="" />
                                                <?php echo form_error('name', '<span class="form-error">', '</span>'); ?>
                                            </div>

                                            <div class="col-md-8">
                                                <label class="control-label" for="warehouse_email"><?php echo($this->lang->line('email_address'));?><span class="required">*</span></label>
                                                <input type="text" class="form-control" name="warehouse_email" id="warehouse_email" value="" />
                                                <?php echo form_error('name', '<span class="form-error">', '</span>'); ?>
                                            </div>

                                            <div class="col-md-8">
                                                <label class="control-label" for="warehouse_phone1"><?php echo($this->lang->line('phone1'));?><span class="required">*</span></label>
                                                <input type="text" class="form-control" name="warehouse_phone1" id="warehouse_phone1" value="" />
                                                <?php echo form_error('warehouse_phone1', '<span class="form-error">', '</span>'); ?>
                                                <label class="control-label" for="warehouse_address2"></label>
                                                <input type="text" class="form-control" name="warehouse_phone2" id="warehouse_phone2" value="" />
                                            </div>

                                            <div class="col-md-8">
                                                <label class="control-label" for="warehouse_fax"><?php echo($this->lang->line('fax'));?></label>
                                                <input type="text" class="form-control" name="warehouse_fax" id="warehouse_fax" value="" />
                                                <?php echo form_error('warehouse_fax', '<span class="form-error">', '</span>'); ?>
                                            </div>

                                            <div class="col-md-8">
                                                <label class="control-label" for="warehouse_map"><?php echo($this->lang->line('map_google'));?><span class="required">*</span></label>
                                                <input type="text" class="form-control" name="warehouse_map_x" id="warehouse_map_x" value="" />
                                                <input type="text" class="form-control" name="warehouse_map_y" id="warehouse_map_y" value="" />
                                                <?php echo form_error('name', '<span class="form-error">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="warehouse-social-connect">
                                        <div class="caption">
                                            <h4 class="caption-subject"><?php echo($this->lang->line('social_connect'));?></h4>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-8">
                                                <label class="control-label" for="warehouse_line"><?php echo($this->lang->line('line_id'));?></label>
                                                <input type="text" class="form-control" name="warehouse_line" id="warehouse_line" value="" />
                                                <?php echo form_error('name', '<span class="form-error">', '</span>'); ?>
                                            </div>

                                            <div class="col-md-8">
                                                <label class="control-label" for="warehouse_facebook"><?php echo($this->lang->line('facebook'));?></label>
                                                <input type="text" class="form-control" name="warehouse_facebook" id="warehouse_state" value="" />
                                                <?php echo form_error('name', '<span class="form-error">', '</span>'); ?>
                                            </div>

                                            <div class="col-md-8">
                                                <label class="control-label" for="warehouse_google"><?php echo($this->lang->line('google'));?></label>
                                                <input type="text" class="form-control" name="warehouse_google" id="warehouse_google" value="" />
                                                <?php echo form_error('name', '<span class="form-error">', '</span>'); ?>
                                            </div>

                                            <div class="col-md-8">
                                                <label class="control-label" for="warehouse_twitter"><?php echo($this->lang->line('twitter'));?></label>
                                                <input type="text" class="form-control" name="warehouse_twitter" id="warehouse_twitter" value="" />
                                                <?php echo form_error('name', '<span class="form-error">', '</span>'); ?>
                                            </div>

                                            <div class="col-md-8">
                                                <label class="control-label" for="warehouse_ig"><?php echo($this->lang->line('ig'));?></label>
                                                <input type="text" class="form-control" name="warehouse_ig" id="warehouse_twitter" value="" />
                                                <?php echo form_error('warehouse_ig', '<span class="form-error">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="warehouse-contact-person">
                                        <div class="caption">
                                            <h4 class="caption-subject"><?php echo($this->lang->line('contact_person'));?></h4>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-md-8">
                                                <label class="control-label" for="warehouse_contact_first"><?php echo($this->lang->line('first_name'));?><span class="required">*</span> </label>
                                                <input type="text" class="form-control" name="warehouse_contact_first" id="warehouse_contact_first"  value=""/>
                                                <?php echo form_error('warehouse_contact_first', '<span class="form-error">', '</span>'); ?>
                                            </div>
                                            <div class="col-md-8">
                                                <label class="control-label" for="warehouse_contact_last"><?php echo($this->lang->line('last_name'));?></label>
                                                <input type="text" class="form-control" name="warehouse_contact_last" id="warehouse_contact_last"  value="" />
                                                <?php echo form_error('warehouse_contact_last', '<span class="form-error">', '</span>'); ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="warehouse-payment-method">
                                    <div class="caption">
                                        <h4 class="caption-subject"><?php echo($this->lang->line('payment_method'));?></h4>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-8" class="product-specification">
                                            <table class="itbh-sellers-products-specification" style="width: 100%;">
                                                <tr style="padding: 20px;">
                                                    <td style="width:90%;"><textarea style="width: 100%;" required name="payment_methods_content[]" placeholder="payment method" class="payment_methods_content"></textarea></td>
                                                    <td style="width:10%;padding-left: 10px;"><span style="color: red;" class="glyphicon glyphicon-remove itbh-sellers-warehouse-payment-method-remove" ></span></td>
                                                </tr>

                                            </table>
                                            <a style="float:right;" id="itbh-sellers-products-description-add"><?php echo($this->lang->line('add_new'));?></a>
                                        </div>
                                    </div>
                                </div>
                                        <div class="form-group">
                                            <div class="col-md-8">
                                                <button type="submit" class="btn btn-primary" style="width:100%; padding: 10px 20px"><?php echo($this->lang->line('add_warehouse'));?></button>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>



                                    </div>
                                </div>
                            </form>

                        </div>
                    <?php } endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>


                <script>
                    function deleteItem(elem){
                        var span = $(elem);
                        var td = $(span).parent();
                        var tr = $(td).parent();
                        $(tr).remove();
//                                                $(this).parent().parent().remove();
                    }
                    $(document).ready(function(){
                        $('#itbh-sellers-products-description-add').click(function () {
                            $('.itbh-sellers-products-specification').append('<tr style="padding: 20px;">' +
                                '<td style="width: 90%;"><textarea style="width: 100%;" required name="payment_methods_content[]" placeholder="payment method" class="payment_methods_content"></textarea></td>' +
                                '<td style="width:10%;padding-left: 10px;"> <span style="color: red;" class="glyphicon glyphicon-remove itbh-sellers-warehouse-payment-method-remove" onclick="deleteItem(this)"></span></td>'  +
                                '</tr>');
                        });
                        $('.itbh-sellers-warehouse-payment-method-remove').click(function () {
                            $(this).parent().parent('tr').remove();
                        });

                        $('#logo-file-trigger').click(function(){
                            $('#warehouse_logo').trigger('click');

                        });

                    });
                </script>