<div class="main-content">
    <div class="container itbh-container" style="margin-top: 30px">
        <!--<form action="<? /*= site_url('carts/checkout') */ ?>" method="post" enctype="multipart/form-data">-->
        <div class="row">
            <?php
            if (count($cartsInfo) > 0){
            ?>
            <table style="width: 100%;" id="carts_products_tbl">
                <thead>
                <tr>
                    <th style="display: none;"></th>
                    <th><?php echo($this->lang->line('product')); ?></th>
                    <th style="padding-left: 45px"><?php echo($this->lang->line('title')); ?> </th>
                    <th style="padding-left: 45px"> <?php echo($this->lang->line('price')); ?> </th>
                    <th style="padding-left: 45px"> <?php echo($this->lang->line('quantity')); ?> </th>
                    <th style="padding-left: 45px"> <?php echo($this->lang->line('total')); ?> </th>
                    <th style="padding-left: 45px"></th>
                    <th style="display: none" class="carts-product-shipping"></th>
                    <th style="display: none" class="carts-product-shipping_total"></th>
                </tr>
                </thead>
                <tbody id="itbh-seller-products-tbody">
                <?php
                /*echo $controller->print_cart_products();*/
                $temps=$this->session->userdata['cartdata'];
                $index = 0;
                $total=0;
                $subtotal=0;
                $shippingtotal=0;
                foreach( $temps as $temp){
                    if (($this->session->userdata('lang')) == '' ){
                        $lang_tmp = 'english';
                    } else {
                        $lang_tmp = $this->session->userdata('lang');
                    }
                    $tmp1 = 'name_'.$lang_tmp;
                    $tmp2 = 'product_name_'.$lang_tmp;
                    $product_id = $temp['product_id'];
                    $product_qty = $temp['product_qty'];
                    $sql = array();
                    $sql['product_id'] = $product_id;
                    $product = $this->products_m->get_single_product($sql);
                    $tmp_id = $this->lang->line('not_found');
                    $tmp_img = $this->lang->line('not_found');
                    $tmp_name = $this->lang->line('not_found');
                    $tmp_price = $this->lang->line('not_found');
                    $tmp_total = $this->lang->line('not_found');
                    if(!empty($product)){
                        $tmp_id = $product->product_id;
                        $tmp_img = $product->img_url;
                        $tmp_name = $product->$tmp2;
                        $tmp_price = $product->regular_price;
                        $tmp_total = intval($tmp_price) * intval($product_qty);
                        $subtotal+=$tmp_total;
                        $tmp_shipping = intval($product->shipping);
                        $tmp_shipping_total = intval($tmp_price) * $tmp_shipping / 100 * intval($product_qty);
                        $shippingtotal+=$tmp_shipping_total;
                    }

                    ?>
                    <tr class="odd gradeX itbh-sellers-products-tbl" id="product-item-<?=$tmp_id;?>" style="border-bottom: 1px #ddd solid;">
                        <td style="display: none;"><?= $index?></td>
                        <td style="display: none;"><?= $tmp_id?></td>
                        <td><a href="<?= base_url('products/view/' . $tmp_id)?>" ><img class="itbh-sellers-products-singlie-item" src="<?=site_url('uploads/images/'.'/'.$tmp_img)?>"></a></td>
                        <td style="padding: 45px;"><?= $tmp_name?></td>
                        <td style="padding: 45px; color: #fc960d;"><?= $tmp_price?></td>
                        <td style="padding: 45px;"><input type="number" min="1" max="<?= $product->quantity?>" value="<?= $product_qty?>" ></td>
                        <td style="padding: 45px;"><?= $tmp_total?></td>
                        <td style="padding: 45px;">
                            <span style="font-size: 36px; color: #888;" class="glyphicon glyphicon-remove itbh-sellers-products-price-remove" ></span>
                        </td>
                        <td style="display: none"><?= $tmp_shipping?></td>
                        <td style="display: none"><?= $tmp_shipping_total?></td>

                    </tr>
                    <?php
                    $index++;
                    $total=$subtotal+$shippingtotal;
                }
                ?>
                </tbody>
            </table>
        </div>
        <div style="margin-top: 30px;"></div>
        <div style="float: right;">
            <a id="carts-update-cart" href="javascript: updateCartInfo()"
               class="btn btn-warning" style="background-color: #fc960d;"><?= $this->lang->line('update_cart'); ?></a>
        </div>
        <div class="row" style="padding-top: 80px;">
            <div class="col-lg-offset-7 col-lg-5 col-md-offset-7 col-md-5 col-sm-offset-5 col-sm-7 col-xs-12">
                <table class="table table-scrollable-borderless" id="carts-price-tdl">
                    <thead></thead>
                    <tbody>
                    <tr class="odd gradeX itbh-sellers-products-tbl">
                        <td style="font-weight: 700;"><?= $this->lang->line('sub_total'); ?></td>
                        <td id="carts-subtotal-price"><?= $subtotal?></td>
                    </tr>
                    <tr class="odd gradeX itbh-sellers-products-tbl">
                        <td style="font-weight: 700;"><?= $this->lang->line('shipping_and_handling'); ?></td>
                        <td id="carts-shipping-price"><?= $shippingtotal?></td>
                    </tr>
                    <tr class="odd gradeX itbh-sellers-products-tbl">
                        <td style="font-weight: 700;"><?= $this->lang->line('total'); ?></td>
                        <td id="carts-total-price"><?= $total?></td>
                    </tr>
                    </tbody>
                </table>
                <a style="width: 100%;margin-bottom: 30px; background-color: #fc960d;" href="javascript: checkout()"
                   class="btn btn-warning"><?= $this->lang->line('check_out'); ?></a>
            </div>
        </div>
        <!--</form>-->

        <?php } else {
            ?>

            <p class="carts-empty-products"
               style="text-align: center; font-size: 1.5rem; margin-top: 25px;"><?= $this->lang->line('no_product_in_cart'); ?></p>
            <div style="text-align: center;">
                <a href="<?= base_url('products/index') ?>" class="carts-empty-products-shopping btn btn-warning"
                   style="text-align: center; font-size: 1.5rem; margin-top: 25px; background-color:#fc960d; "><?= $this->lang->line('let_shopping'); ?></a>

            </div>
            <?php
        }

        ?>
    </div>
</div>
</div>

<script>

    $(document).ready(function () {
        $('#carts-update-cart').click(function () {
            // update cart result
            var table = document.getElementById('carts_products_tbl');
            var rowcnt = table.rows.length;
            var sub_total = 0.0;
            var all_total = 0.0;
            var shipping = 0.0;
            for (var i = 1; i < rowcnt; i += 1) {
                var row = table.rows[i];
                var tmp_id = parseInt(row.cells[0].innerHTML);
                var tmp_price = parseFloat(row.cells[3].innerHTML);
                var tmp111 = row.cells[4].innerHTML;
                var tt = tmp111.split('value=')[1];
                tt = tt.replace('"', '');
                tt = tt.replace('"', '');
                tt = tt.replace('>', '');
                var tmp_qty = parseInt(tt);
                var tmp_total = tmp_price * tmp_qty;
                parseFloat(row.cells[5].innerHTML);

                var tmp_shipping = parseInt(row.cells[7].innerHTML);
                var tmp_shipping_total = parseInt(row.cells[8].innerHTML);
                sub_total = sub_total + tmp_price * tmp_qty;
                shipping = shipping + tmp_shipping * tmp_qty * tmp_price / 100;
            }
            document.getElementById('carts-subtotal-price').innerHTML = sub_total;
            document.getElementById('carts-shipping-price').innerHTML = shipping;
            all_total = sub_total - shipping;
            document.getElementById('carts-total-price').innerHTML = all_total;

        });

        $('.itbh-sellers-products-price-remove').click(function () {
            // remove tr
            var tr = $(this).parent().parent(tr);
            var childs = tr.children();
            var index = Math.floor(childs[0].innerHTML);
            var url = '<?php echo site_url('carts/removeCart')?>';
            $.ajax({
                type: "POST",
                url: url,
                data: {index: index},
                dataType: "text",
                success: function (data) {
                    //tr.remove();
                    location.reload();
                }
            });

        });
    });
    function updateCartInfo() {
        var tbody = $('#itbh-seller-products-tbody');
        var trs = tbody.children();
        var qttys = new Array;
        if (trs.length > 0) {
            for (var i = 0; i < trs.length; i++) {
                var qty = trs[i].children[5].children[0].value;
                qttys.push(qty);
            }
            var qttyList = qttys.toString();
            console.log(qttyList);
            var url = '<?php echo site_url('carts/updataCartList')?>';
            $.ajax({
                type: "POST",
                url: url,
                data: {qttyList: qttyList},
                dataType: "text",
                success: function (data) {
                    location.reload();
                }
            });
        }
    }

    function checkout() {
        location.href = '<?php echo site_url('/Carts/checkout')?>'
    }
</script>