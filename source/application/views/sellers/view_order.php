
                <div class="col-lg-9 itbh-sellers-view-order">
                    <div class="portlet light bordered">

                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3><?=$this->lang->line('order')?></h3>
                                    </div>
                                    <div class="col-md-3" style="margin: 15px;" >
                                        <div class="btn-group pull-right">
                                            <h4><?=$this->lang->line('status')?>:<span class="order-status"><?=$order_data->order_status;?></span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4><?=$this->lang->line('order_detail')?></h4>
                            <table class="table itbh-sellers-order-detail-tbl" style="border: none;" id="products_tbl">
                                <thead>
                                    <tr style="border-bottom: solid 1px #ddd;">
                                        <th> <?php echo($this->lang->line('product'));?> </th>
                                        <th> <?php echo($this->lang->line('quantity'));?> </th>
                                        <th> <?php echo($this->lang->line('total'));?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($order_products as $order_product):?>
                                        <tr style="border-bottom: solid 1px #ddd;">
                                            <td><a href="<?=base_url('products/view/'.$order_product['product_id'])?>"><?=$order_product['product_name'];?></a></td>
                                            <td><?= $order_product['product_qty'];?></td>
                                            <td><?= $order_product['product_subtotal'];?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr style="border-bottom: solid 1px #ddd;">
                                        <td><?=$this->lang->line('cart_sub_total')?></td>
                                        <td></td>
                                        <td><?=$order_data->total?></td>
                                    </tr>
                                    <tr style="border-bottom: solid 1px #ddd;">
                                        <td><?=$this->lang->line('shipping')?></td>
                                        <td></td>
                                        <td><?=$order_data->shipping?></td>
                                    </tr>
                                    <tr >
                                        <td><?=$this->lang->line('order_total')?></td>
                                        <td></td>
                                        <td style="color:#fc960d; "><?=$order_data->order_total?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr style="color: #000;">
                            <h4><?=$this->lang->line('customer_detail');?></h4>
                            <style>

                            </style>
                            <div class="row itbh-sellers-orders-customer-billing">
                                <div class="col-lg-4">
                                    <h4><?=$this->lang->line('billing_address')?></h4>
                                    <?php if(!empty($customer_data)):?>
                                    <li><?=$this->lang->line('billing_name');?>: &nbsp;<?= $customer_data->customer_first_name . $customer_data->customer_last_name; ?></li>
                                    <li><?=$this->lang->line('company_name');?>: &nbsp;<?= $customer_data->bill_company_name; ?></li>
                                    <li><?=$this->lang->line('country');?>: &nbsp;<?= $customer_data->bill_country; ?></li>
                                    <li><?=$this->lang->line('address');?>: &nbsp;<?= $customer_data->bill_address1 . $customer_data->bill_address2; ?></li>
                                    <li><?=$this->lang->line('town_city');?>: &nbsp;<?= $customer_data->bill_state; ?></li>
                                    <li><?=$this->lang->line('state_country');?>: &nbsp;<?= $customer_data->bill_postcode; ?></li>
                                    <?php
                                    endif;?>

                                </div>
                                <div class="col-lg-4">
                                    <h4><?=$this->lang->line('shipping_address')?></h4>
                                    <?php if(!empty($customer_data)):?>
                                    <li><?=$this->lang->line('shipping_name');?>: &nbsp;<?= $customer_data->shipping_first_name . $customer_data->shipping_last_name; ?></li>
                                    <li><?=$this->lang->line('company_name');?>: &nbsp;<?= $customer_data->shipping_company_name;?></li>
                                    <li><?=$this->lang->line('country');?>: &nbsp;<?= $customer_data->shipping_country;?></li>
                                    <li><?=$this->lang->line('address');?>: &nbsp;<?= $customer_data->shipping_address1 . $customer_data->shipping_address2; ?></li>
                                    <li><?=$this->lang->line('state_country');?>: &nbsp;<?= $customer_data->shipping_state; ?></li>
                                    <li><?=$this->lang->line('postcode_zip');?>: &nbsp;<?= $customer_data->shipping_postcode; ?></li>
                                    <li><?=$this->lang->line('email');?>: &nbsp;<?= $customer_data->shipping_email; ?></li>
                                    <li><?=$this->lang->line('phone');?>: &nbsp;<?= $customer_data->shipping_phone1 . '&nbsp;&nbsp;&nbsp;'.$customer_data->shipping_phone2; ?>Phone</li>
                                    <li><?=$this->lang->line('fax');?>: &nbsp;<?= $customer_data->shipping_fax; ?></li>
                                    <li><?=$this->lang->line('line_id');?>: &nbsp;<?= $customer_data->shipping_line; ?></li>
                                    <?php
                                    endif;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>