
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <style>
                        .itbh-display-none {
                            display: none;
                        }
                    </style>
                    <script>
                        $(document).ready(function() {
                            $("#myaccount-billing_address-detail-edit").click(function(){
                                $("#myaccount-billing_address-detail").show();
                                $("#myaccount-billing_address-detail-edit").hide();
                                $("#myaccount-billing_address-detail-close").show();
                                $(".myaccount-address-detail-shipping").hide();
                                $("#myaccount-billing-display").hide();
                            });

                            $("#myaccount-billing_address-detail-close").click(function(){
                                $("#myaccount-billing_address-detail").hide();
                                $("#myaccount-billing_address-detail-edit").show();
                                $("#myaccount-billing_address-detail-close").hide();
                                $(".myaccount-address-detail-shipping").show();
                                $("#myaccount-billing-display").hide();
                            });



                            $("#myaccount-shipping_address-detail-edit").click(function(){
                                $("#myaccount-shipping_address-detail").show();
                                $("#myaccount-shipping_address-detail-edit").hide();
                                $("#myaccount-shipping_address-detail-close").show();
                                $(".myaccount-address-detail-billing").hide();
                                $("#myaccount-shipping-display").hide();
                            });

                            $("#myaccount-shipping_address-detail-close").click(function(){
                                $("#myaccount-shipping_address-detail").hide();
                                $("#myaccount-shipping_address-detail-edit").show();
                                $("#myaccount-shipping_address-detail-close").hide();
                                $(".myaccount-address-detail-billing").show();
                                $("#myaccount-shipping-display").hide();
                            });

                        });
                    </script>
                    <?php $success = $this->session->flashdata("success");?>
                    <?php if( !empty( $success ) ) : ?>
                        <div class="custom-alerts alert alert-success fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="font-size: 36px; width: 36px; height: 36px; color: red; ">&times;</button>
                            <?= $success ?>
                        </div>
                    <?php endif; ?>
                    <div class="myaccount-address-detail-billing">
                        <h3><?=$this->lang->line('billing_address'); ?></h3>
                        <a  id="myaccount-billing_address-detail-edit"><?=$this->lang->line('edit'); ?></a>
                        <div class="row" id="myaccount-billing-display" style="padding-left: 30px; display: none;">
                           <p><?=$this->lang->line('first_name');?>&nbsp;&nbsp;<?=$customer_data->bill_first_name;?>&nbsp;&nbsp;<?=$this->lang->line('last_name');?>&nbsp;&nbsp;<?=$customer_data->bill_last_name;?></p>
                            <p><?=$this->lang->line('company_name');?>&nbsp;&nbsp;<?=$customer_data->bill_company_name;?></p>
                            <p><?=$this->lang->line('country');?>&nbsp;&nbsp;<?=$customer_data->bill_country;?></p>
                            <p><?=$this->lang->line('address');?>&nbsp;&nbsp;<?=$customer_data->bill_address1;?>&nbsp;&nbsp;<?=$customer_data->bill_address2;?></p>
                            <p><?=$this->lang->line('town_city');?>&nbsp;&nbsp;<?=$customer_data->bill_town;?></p>
                            <p><?=$this->lang->line('state_country');?>&nbsp;&nbsp;<?=$customer_data->bill_state;?></p>
                            <p><?=$this->lang->line('postcode_zip');?>&nbsp;&nbsp;<?=$customer_data->bill_postcode;?></p>
                            <p><?=$this->lang->line('email_address');?>&nbsp;&nbsp;<?=$customer_data->bill_email;?></p>
                            <p><?=$this->lang->line('phone');?>&nbsp;&nbsp;<?=$customer_data->bill_phone1;?>&nbsp;&nbsp;<?=$customer_data->bill_phone2;?>&nbsp;&nbsp;<?=$customer_data->bill_phone3;?></p>
                            <p><?=$this->lang->line('fax');?>&nbsp;&nbsp;<?=$customer_data->bill_fax;?></p>
                            <p><?=$this->lang->line('line_id');?>&nbsp;&nbsp;<?=$customer_data->bill_line;?>&nbsp;&nbsp;</p>

                        </div>
                        <a  style="display: none;" id="myaccount-billing_address-detail-close"><?=$this->lang->line('close'); ?></a>
                        <div id="myaccount-billing_address-detail" style="display: none;">
                            <form action="<?= base_url('myaccount/edit_billing_address') ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                                <div class="col-md-9">
                                    <div class="form-group" style="margin-bottom: 0">
                                        <div class="form-group">
                                            <label class="control-label col-lg-2 col-md-2" for="first_name"><?php echo($this->lang->line('first_name'));?><span>*</span></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="first_name" value="<?=$customer_data->bill_first_name;?>"  id="first_name" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="last_name"><?php echo($this->lang->line('last_name'));?><span>*</span></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="last_name" value="<?=$customer_data->bill_last_name;?>" id="last_name" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="company_name"><?php echo($this->lang->line('company_name'));?></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="company_name" value="<?=$customer_data->bill_company_name;?>" id="company_name" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="country"><?php echo($this->lang->line('country'));?><span>*</span></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="country" value="<?=$customer_data->bill_country;?>" id="country" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="address1"><?php echo($this->lang->line('address'));?><span>*</span></label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" name="address1" value="<?=$customer_data->bill_address1;?>" id="address1" />
                                                </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2"></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="address2" value="<?=$customer_data->bill_address2;?>" id="address2" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="town_city"><?php echo($this->lang->line('town_city'));?><span>*</span></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="town_city" value="<?=$customer_data->bill_town;?>"  id="town_city" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="state_country"><?php echo($this->lang->line('state_country'));?><span>*</span></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="state_country" value="<?=$customer_data->bill_state;?>" id="state_country" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="postcode_zip"><?php echo($this->lang->line('postcode_zip'));?><span>*</span></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="postcode_zip" value="<?=$customer_data->bill_postcode;?>" id="postcode_zip" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="email"><?php echo($this->lang->line('email_address'));?><span>*</span></label>
                                            <div class="col-md-10">
                                                <input type="email" class="form-control" name="email" value="<?=$customer_data->bill_email;?>" id="email" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="phone1"><?php echo($this->lang->line('phone1'));?><span>*</span></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="phone1"  value="<?=$customer_data->bill_phone1;?>" id="phone1" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="phone2"><?php echo($this->lang->line('phone2'));?></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="phone2" value="<?=$customer_data->bill_phone2;?>" id="phone2" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="phone3"><?php echo($this->lang->line('phone3'));?></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="phone3" value="<?=$customer_data->bill_phone3;?>" id="phone3" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="fax"><?php echo($this->lang->line('fax'));?></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="fax"  value="<?=$customer_data->bill_fax;?>" id="fax" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="line_id"><?php echo($this->lang->line('line_id'));?></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="line_id" value="<?=$customer_data->bill_line;?>" id="line_id" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2"></label>
                                            <div class="col-md-10">
                                                <button type="submit" class="btn btn-warning" style="background-color:#fc960d; padding: 10px 20px; width: 100%;"><?php echo($this->lang->line('save_change'));?></button>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="myaccount-address-detail-shipping">
                        <h3><?=$this->lang->line('shipping_address'); ?></h3>
                        <a  id="myaccount-shipping_address-detail-edit"><?=$this->lang->line('edit'); ?></a>
                        <a  style="display: none;" id="myaccount-shipping_address-detail-close"><?=$this->lang->line('close'); ?></a>
                        <div class="row" id="myaccount-shipping-display" style="padding-left: 30px;display: none;">
                            <p><?=$this->lang->line('first_name');?>&nbsp;&nbsp;<?=$customer_data->shipping_first_name;?>&nbsp;&nbsp;<?=$this->lang->line('last_name');?>&nbsp;&nbsp;<?=$customer_data->shipping_last_name;?></p>
                            <p><?=$this->lang->line('company_name');?>&nbsp;&nbsp;<?=$customer_data->shipping_company_name;?></p>
                            <p><?=$this->lang->line('country');?>&nbsp;&nbsp;<?=$customer_data->shipping_country;?></p>
                            <p><?=$this->lang->line('address');?>&nbsp;&nbsp;<?=$customer_data->shipping_address1;?>&nbsp;&nbsp;<?=$customer_data->shipping_address2;?></p>
                            <p><?=$this->lang->line('town_city');?>&nbsp;&nbsp;<?=$customer_data->shipping_town;?></p>
                            <p><?=$this->lang->line('state_country');?>&nbsp;&nbsp;<?=$customer_data->shipping_state;?></p>
                            <p><?=$this->lang->line('postcode_zip');?>&nbsp;&nbsp;<?=$customer_data->shipping_postcode;?></p>
                            <p><?=$this->lang->line('email_address');?>&nbsp;&nbsp;<?=$customer_data->shipping_email;?></p>
                            <p><?=$this->lang->line('phone');?>&nbsp;&nbsp;<?=$customer_data->shipping_phone1;?>&nbsp;&nbsp;<?=$customer_data->shipping_phone2;?>&nbsp;&nbsp;<?=$customer_data->shipping_phone3;?></p>
                            <p><?=$this->lang->line('fax');?>&nbsp;&nbsp;<?=$customer_data->shipping_fax;?></p>
                            <p><?=$this->lang->line('line_id');?>&nbsp;&nbsp;<?=$customer_data->shipping_line;?>&nbsp;&nbsp;</p>

                        </div>
                        <div id="myaccount-shipping_address-detail" class="itbh-display-none">
                            <form action="<?= base_url('myaccount/edit_shipping_address') ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                                <div class="col-md-9">

                                    <div class="form-group" style="margin-bottom: 0">
                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="first_name"><?php echo($this->lang->line('first_name'));?><span>*</span></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="first_name"  value="<?=$customer_data->shipping_first_name;?>" id="first_name" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="last_name"><?php echo($this->lang->line('last_name'));?><span>*</span></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="last_name" value="<?=$customer_data->shipping_last_name;?>" id="last_name" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="company_name"><?php echo($this->lang->line('company_name'));?></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="company_name" value="<?=$customer_data->shipping_company_name;?>" id="company_name" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="country"><?php echo($this->lang->line('country'));?><span>*</span></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="country" value="<?=$customer_data->shipping_country;?>"  id="country" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="address1"><?php echo($this->lang->line('address'));?><span>*</span></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="address1" value="<?=$customer_data->shipping_address1;?>" id="address1" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2"></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="address2" value="<?=$customer_data->shipping_address2;?>" id="address2" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="town_city"><?php echo($this->lang->line('town_city'));?><span>*</span></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="town_city" value="<?=$customer_data->shipping_town;?>" id="town_city" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="state_country"><?php echo($this->lang->line('state_country'));?><span>*</span></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="state_country" value="<?=$customer_data->shipping_state;?>" id="state_country" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="postcode_zip"><?php echo($this->lang->line('postcode_zip'));?><span>*</span></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="postcode_zip" value="<?=$customer_data->shipping_postcode;?>" id="postcode_zip" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="email"><?php echo($this->lang->line('email_address'));?><span>*</span></label>
                                            <div class="col-md-10">
                                                <input type="email" class="form-control" name="email" value="<?=$customer_data->shipping_email;?>" id="email" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="phone1"><?php echo($this->lang->line('phone1'));?><span>*</span></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="phone1" value="<?=$customer_data->shipping_phone1;?>" id="phone1" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="phone2"><?php echo($this->lang->line('phone2'));?></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="phone2" value="<?=$customer_data->shipping_phone2;?>" id="phone2" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="phone3"><?php echo($this->lang->line('phone3'));?></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="phone3" value="<?=$customer_data->shipping_phone3;?>" id="phone3" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="fax"><?php echo($this->lang->line('fax'));?></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="fax" value="<?=$customer_data->shipping_fax;?>" id="fax" />
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-2" for="line_id"><?php echo($this->lang->line('line_id'));?></label>
                                            <div class="col-md-10">
                                                <input type="text" class="form-control" name="line_id" value="<?=$customer_data->shipping_line;?>" id="line_id" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2"></label>
                                            <div class="col-md-10">
                                                <button type="submit" class="btn btn-warning" style="background-color:#fc960d; padding: 10px 20px; width: 100%;"><?php echo($this->lang->line('save_change'));?></button>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>