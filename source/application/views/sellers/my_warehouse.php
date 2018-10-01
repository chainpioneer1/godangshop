
                <div class="col-lg-9">
                    <div class="portlet light bordered">

                        <div class="portlet-body">
                            <div class="table-toolbar">

                                <div class="row">
                                    <div class="col-lg-offset-1  col-lg-6  col-md-offset-1 col-md-6 col-sm-8 col-xs-8">
                                        <h3><?=$this->lang->line('my_warehouse');?></h3>
                                    </div>
                                <?php if (!empty($my_warehouse)):?>
                                    <div class="col-lg-offset-1 col-lg-3 col-md-offset-1 col-md-3 col-sm-4 col-xs-4" >
                                        <div class="btn-group pull-right">
                                            <a style="margin-top: 18px;" href="<?= base_url('sellers/edit_warehouse') ?>" class="btn sbold green"> <?php echo($this->lang->line('edit_warehouse'));?>
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-offset-1 col-lg-10 col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                                        <div class="itbh-my-warehouse-name">
                                             <a href="<?=base_url('warehouses/view/'.$my_warehouse->warehouse_id)?>">
                                                 <h3><?=$my_warehouse->warehouse_name;?></h3>
                                             </a>
                                        </div>
                                        <div class="itbh-my-warehouse-logo">
                                            <!-- itbh comment : fix this part : need to add warehouse image                                       -->
                                            <img alt="<?=$my_warehouse->warehouse_name. $this->lang->line('warehouse');?> " style="width: 50px; height: 50px;" src="<?=site_url('uploads/warehouse_logo/').'/'.$my_warehouse->warehouse_logo;?>">
                                        </div>
                                        <div class="itbh-my-warehouse-slogan">
                                            <h4><?=$this->lang->line('slogan')?></h4>
                                            <p><?=$my_warehouse->warehouse_slogan;?></p>
                                        </div>

                                        <div class="itbh-my-warehouse-payment_method">
                                            <h4><?=$this->lang->line('payment_method')?></h4>

                                            <p><?php
                                                $payment_methods_tmp = $my_warehouse->payment_methods;
                                                $payment_methods = array();
                                                if(!empty($payment_methods_tmp)){
                                                    $payment_methods = json_decode($payment_methods_tmp);
                                                    for ($i = 0;$i < count($payment_methods); $i ++){
                                                        echo $payment_methods[$i]->payment_method;
                                                        echo('<br/>');
                                                    }
                                                }

                                                ?></p>
                                        </div>
                                        <div class="itbh-my-warehouse-contact_information">
                                            <h4><?=$this->lang->line('contact_information')?></h4>
                                            <li><?=$my_warehouse->warehouse_address1.$my_warehouse->warehouse_address2;?></li>
                                            <li><?=$this->lang->line('tel') . ':&nbsp;&nbsp;&nbsp;'.$my_warehouse->warehouse_phone1.'&nbsp;&nbsp;&nbsp;' . $my_warehouse->warehouse_phone2;?></li>
                                            <li><?=$this->lang->line('fax') . ':&nbsp;&nbsp;&nbsp;'.$my_warehouse->warehouse_fax.'&nbsp;&nbsp;&nbsp;'?></li>
                                            <li><?=$this->lang->line('email') . ':&nbsp;&nbsp;&nbsp;'.$my_warehouse->warehouse_email?></li>
                                            <li><?=$this->lang->line('line_id') . ':&nbsp;&nbsp;&nbsp;'.$my_warehouse->warehouse_line;?></li>
                                            <li><?=$this->lang->line('facebook') . ':&nbsp;&nbsp;&nbsp;'.$my_warehouse->warehouse_facebook;?></li>
                                        </div>

                                        <div class="itbh-my-warehouse-contact_map">
                                            <div id="map" style="width: 100% ; height: 300px; margin-bottom: 100px; "></div>
                                            <script>
                                                function initMap() {
                                                    var uluru = {lat: -25.363, lng: 131.044};
                                                    var map = new google.maps.Map(document.getElementById('map'), {
                                                        zoom: 10,
                                                        center: uluru
                                                    });
                                                    var marker = new google.maps.Marker({
                                                        position: uluru,
                                                        map: map
                                                    });
                                                }
                                            </script>
                                            <script async defer
                                                    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbYtIgzEvPG2d3Q3OqFdMzkXUvDwCNsq0&callback=initMap">
                                            </script>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                    else:
                                        echo ('youhavenowarehouse_please_register');
                                 ?>
                                        <a href="<?= base_url('sellers/register_warehouse') ?>" class="btn sbold green"> <?php echo($this->lang->line('register_warehouse'));?>
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <?php
                                    endif;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>