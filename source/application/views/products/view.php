<?php ?>

<link rel="stylesheet" href="<?= base_url('assets/css/custom_product_detail.css') ?>" type="text/css">
<link rel="stylesheet" href="<?= base_url('assets/css/custom_product_carousel.css') ?>" type="text/css">


<div class="col-lg-9">
    <div class="" style="margin: 0 0 10px 10px">
        <div style="padding: 10px 20px 10px 20px;"></div>
    </div>
    <div class="" style="margin: 0 0 20px 10px">
        <div class="product-elem-wrap" id="productContent">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 product-image">
                    <div class="row">
                        <div class="">
                            <img style="width: 100%; height: 355px;" id="curProduct" alt="<?php
                            if (($this->session->userdata('lang')) == '' ){
                                $lang_tmp = 'english';
                            } else {
                                $lang_tmp = $this->session->userdata('lang');
                            }
                            $tmp = 'name_'.$lang_tmp;
                            $tmp2 = 'product_name_'.$lang_tmp;
                            echo $product->$tmp2; ?>"
                                 src="<?= site_url('uploads/images/' . $product->img_url) ?> ">
                        </div>
                    </div>

                    <div id="myModal" class="modal">
                        <!--<span class="close">&times;</span>-->
                        <img class="modal-content" id="img01">

                        <div id="caption"></div>
                    </div>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 product-elem">
                    <div class="product_information">
                        <p><span style="font-size: 1.1rem;"><?= $this->lang->line('product_id'); ?>
                                :</span><?php
                                    if (($this->session->userdata('lang')) == '' ){
                                        $lang_tmp = 'english';
                                    } else {
                                        $lang_tmp = $this->session->userdata('lang');
                                    }
                                    $tmp = 'name_'.$lang_tmp;
                                    $tmp2 = 'product_name_'.$lang_tmp;
                                    echo $product->$tmp2; ?></p>

                        <p><span style="font-size: 1.1rem;"><?= $this->lang->line('sku'); ?>
                                :</span><?= $product->sku; ?> </p>

                        <p><span style="font-size: 1.1rem;"><?= $this->lang->line('seller'); ?>
                                :</span><?php if (!empty($seller)) {
                                $url = base_url('warehouses/view').'/'.$product->warehouse_id;
                                echo ('<a href="'.$url.'">'.$seller->fullname.'</a>');
                            } ?></p>
                    </div>
                    <div class="price_information">
                        <?php
                        $prices = array();
                        $prices = json_decode($product->prices);
                        for ($i = 0; $i < count($prices); $i++) {
                            ?>

                            <p><span
                                    style="font-size: 1.2rem; color: #fc960d;"><?= $prices[$i]->price ?><?= $this->lang->line('currency_thai'); ?></span>
                            </p>
                            <p style="color: #fc960d;"><?= $this->lang->line('per'); ?>
                                <span><?= $prices[$i]->volume ?></span><?= $this->lang->line('items'); ?></p>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="product_description">
                        <p><span style="font-size: 1.1rem;"><?= $this->lang->line('description'); ?>:</span></p>

                        <p><?= $product->description; ?></p>
                    </div>
                    <div class="product_cart_number">
                        <input type="number" id="add_to_cart_num" required name="add_to_cart_num"
                               placeholder="<?php if($product->quantity > 0) echo 1; else echo($this->lang->line('out_of_stock')) ?>" min="1" max="<?= $product->quantity; ?>">
                        <input type="hidden" name="product_id" id="product_id" value="<?= $product->product_id; ?>">
                        <input type="hidden" name="seller_id" id="seller_id" value="<?= $product->seller_id; ?>">
                        <button class="btn btn-warning" id="addCartBtn" style="background-color:#fc960d;"><?= $this->lang->line('add_to_cart') ?></button>
                    </div>
                    <div class="product_save_price">
                        <img src="<?= site_url('assets/images/icons/8_save_product.png') ?>"
                             style="width: 30px; height: 30px; display: inline-block;">

                        <p style="display: inline-block" )"><span>8</span> &percnt; Finance for 6 Month</p>
                        <div class="clearfix"></div>
                        <img src="<?= site_url('assets/images/icons/12_save_product.png') ?>"
                             style="width: 30px; height: 30px; display: inline-block;">

                        <p style="display: inline-block" )"><span>12</span> &percnt; Finance for 12 Month</p>
                    </div>

                </div>
            </div>
            <div class="row product-item-specification">
                <h3><?= $this->lang->line('specification'); ?></h3>
                <table class="table table-striped" style="border: none;">
                    <tbody>
                    <?php
                    $specifications = array();
                    $specifications = json_decode($product->specification);
                    for ($i = 0; $i < count($specifications); $i++) {
                        ?>
                        <tr>
                            <td><?= $specifications[$i]->title; ?></td>
                            <td><?= $specifications[$i]->content; ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="row product-item-document">
                <h3><?= $this->lang->line('document'); ?></h3>
                <table class="table table-responsive" style="width: 90%; border: none; ">
                    <tbody>

                    <?php
                    $documents = array();
                    $documents = json_decode($product->document_url);

                    for ($i = 0; $i < count($documents); $i++) {
                        ?>

                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6"><img src="<?= site_url('assets/images/icons/product-document-pdf.png') ?>"
                                 style="width: 30px; height: 30px; display: inline-block;">
                            <a href="<?= site_url('uploads/documents/') . '/' . $documents[$i]->file_name; ?>"><p
                                    style="display: inline-block" )"><?= $documents[$i]->file_name ?></p></a>
                        </div>

                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="row product-item-related-products">
                <h3><?= $this->lang->line('related_products'); ?></h3>

                <div class="row">
                    <div class="col-lg-offset-1 col-lg-10 col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                        <?php
                        for ($i = 0; $i < count($related_products); $i ++) {
                            if ($i == 0){
                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 start-related-product product-elem" id="related-product-item_<?=$i;?>">
                                    <a class="product-related-item-img" href="<?=base_url('products/view/').'/'.$related_products[$i]->product_id;?> "><img src="<?=site_url('uploads/images/'.$related_products[$i]->img_url)?>" ></a>

                                    <div style="height: 90px;">
                                        <a  style="color: #333;" href="<?=base_url('products/view/').'/'.$related_products[$i]->product_id;?> " >
                                            <p style="overflow: hidden;" class="product-related-item-name">
                                                <?php
                                                if (($this->session->userdata('lang')) == '' ){
                                                    $lang_tmp = 'english';
                                                } else {
                                                    $lang_tmp = $this->session->userdata('lang');
                                                }
                                                $tmp = 'name_'.$lang_tmp;
                                                $tmp2 = 'product_name_'.$lang_tmp;echo $related_products[$i]->$tmp2;?></p></a>
                                        <p style="text-align: center;color: #fc960d; "><?=$related_products[$i]->regular_price;?></p>
                                    </div>

                                </div>

                                <?php
                            }
                            elseif ($i < 4 &&  0 < $i) {
                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6 product-elem" id="related-product-item_<?=$i;?>">
                                    <a class="product-related-item-img" href="<?=base_url('products/view/').'/'.$related_products[$i]->product_id;?> "><img src="<?=site_url('uploads/images/'.$related_products[$i]->img_url)?>" ></a>
                                    <div style="height: 90px;">
                                        <a style="color: #333;" href="<?=base_url('products/view/').'/'.$related_products[$i]->product_id;?> " ><p style="overflow: hidden;" class="product-related-item-name"><?php
                                                if (($this->session->userdata('lang')) == '' ){
                                                    $lang_tmp = 'english';
                                                } else {
                                                    $lang_tmp = $this->session->userdata('lang');
                                                }
                                                $tmp = 'name_'.$lang_tmp;
                                                $tmp2 = 'product_name_'.$lang_tmp;
                                                echo $related_products[$i]->$tmp2;?></p></a>
                                        <p style="text-align: center; color: #fc960d;  "><?=$related_products[$i]->regular_price;?></p>
                                    </div>
                                </div>

                                <?php
                            }
                        }
                        ?>

                    </div>
                </div>
        </div>

    </div>

</div>
<div style="margin-top: 30px;"></div>
</div>
</div>
</div>

<script>
    $(document).ready(function () {
        $('#myCarousel').carousel({
            interval: 1000
        })

        $('#myCarousel').on('slid.bs.carousel', function() {
            //alert("slid");
        });


        var related_product_cnt = '<?php echo count($related_products); ?>';

        $('#product-item-page-related-next-btn').click(function () {

            $('.start-related-product').addClass('display-none');
            var start_item_id = $('.start-related-product').attr('id');
            var tmp = start_item_id.split('_')[1];
            var prefix = start_item_id.split('_')[0];
            var again_start = parseInt(tmp) + related_product_cnt;
            tmp = parseInt(tmp) + 1;
            tmp_4th = parseInt(tmp) + 4;
            var next_item_id = prefix + '_' + tmp;
            var tmp_4th_id = prefix + '_' + tmp_4th;
            var again_start_id = prefix + '_' + again_start;
            $('.start-related-product').attr('id', again_start_id);
            $('.start-related-product').addClass('display-none');
            $('#' + start_item_id).removeClass('start-related-product');
            $('#' + next_item_id).addClass('start-related-product');
            $('#' + tmp_4th_id).removeClass('display-none');

        });


        $('#addCartBtn').click(function () {
            var url = '<?php echo site_url('carts/add_to_cart')?>';
            var product_id = $('#product_id').val();
            var add_cart_num = $('#add_to_cart_num').val();
            var seller_id = $('#seller_id').val();
            var fd = new Array;
            fd.push(product_id);
            fd.push(add_cart_num);
            fd.push(seller_id);

            var info = fd.join(':');

            $.ajax({
                type: "POST",
                url: url,
                data: {info: info},
                dataType: "text",
                success: function (data) {
                    var nCarts = $('#nCarts').html();
                    $('#nCarts').html(Math.floor(nCarts) + Math.floor(add_cart_num));
                }
            });
        });
        var subtitle = '<?php echo $page_banner_title ?>'
        var product_detail_title = '<?php echo $this->lang->line('product_detail');?>';
        if (subtitle == product_detail_title) {
            $('#sortDiv').hide();
        }
    });

</script>
<!-- img-modal -->
<script>
    // Get the modal
    var modal = document.getElementById('myModal');

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById('curProduct');
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    img.onclick = function () {
        modal.style.display = "block";
        modalImg.src = this.src;
        captionText.innerHTML = this.alt;
    }

    // Get the <span> element that closes the modal
    /*var span = document.getElementsByClassName("close")[0];*/

    // When the user clicks on <span> (x), close the modal
    /*span.onclick = function () {
        modal.style.display = "none";
    }*/
    modalImg.onclick=function(){
        modal.style.display='none';
    }
</script>
