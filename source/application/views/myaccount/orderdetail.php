
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                    <div class="row">
                        <h3 style="text-align: center;"><?=$this->lang->line('order_detail');?></h3>
                        <div class="col-lg-offset-2 col-lg-8" >


                            <table class="table table-responsive">

                                <tbody>
                                <tr>
                                    <th scope="row"></th>
                                    <td style="font-size: 1.1rem;"><?=$this->lang->line('product')?></td>
                                    <td style="font-size: 1.1rem;"><?=$this->lang->line('quantity')?></td>
                                    <td style="font-size: 1.1rem;"><?=$this->lang->line('total')?></td>
                                </tr>
                                <?php foreach($order_products as $order_product): ?>
                                    <tr>
                                        <th scope="row"></th>
                                        <td><?=$order_product['product_name']?></td>
                                        <td><?=$order_product['product_qty']?></td>
                                        <td><?=$order_product['product_subtotal']?></td>
                                    </tr>
                                <?php endforeach?>
                                <tr>
                                    <th scope="row"></th>
                                    <td><?=$this->lang->line('total')?></td>
                                    <td></td>
                                    <td><?=$order_data->total?></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td><?=$this->lang->line('shipping')?></td>
                                    <td></td>
                                    <td><?=$order_data->shipping?></td>
                                </tr>
                                <tr>
                                    <th scope="row"></th>
                                    <td><?=$this->lang->line('order_total')?></td>
                                    <td></td>
                                    <td><?=$order_data->order_total?></td>
                                </tr>

                                <tr>
                                    <th scope="row"></th>
                                    <td><?=$this->lang->line('notes')?></td>
                                    <td></td>
                                    <td><?=$order_data->notes?></td>
                                </tr>

                                <tr>
                                    <th scope="row"></th>
                                    <td><?=$this->lang->line('created_date')?></td>
                                    <td></td>
                                    <td><?=$order_data->registered_date?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>