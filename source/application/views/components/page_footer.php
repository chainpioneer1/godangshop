<div class="col-md-offset-4 col-md-4 loading" style="display: none;">
    <i class="fa fa-spinner fa-spin" style="font-size: 30px;text-align: center; margin-left:-2px;margin-right:8px;"></i>loading
</div>
</div>

</div>

</div>
<div style="margin-top: 30px;"></div>
</div>
</div>
</div>
</div>
</div>

<script>
    $('#sortBy').change(function () {

        var url = '<?= site_url("Products/getProductBySort") ?>';
        $.ajax({
            type: "POST",
            url: url,
            data: {sortBy:$(this).val()},
            dataType: "text",
            cache: false,
            success: function (data) {
                location.reload();
                addEffect();
            }
        });
    });
</script>
<!-- Secondary Section -->
<div id="footer">
    <div class="main-footer" style="padding: 0px 40px;">
        <div class="container itbh-container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-9 col-xs-12">
                    <h4><?= $this->lang->line('categories'); ?></h4>
                    <?php
                    $new_cateogry = array();
                    if (($this->session->userdata('lang')) == '' ){
                        $lang_tmp = 'english';
                    } else {
                        $lang_tmp = $this->session->userdata('lang');
                    }
                    $category_name = 'name_'.$lang_tmp;
                    $products_primary_categories = $this->categories_m->get_categories(array('parent_id'=>0));
                    $primary_categories_cnt= $this->categories_m->get_categories_cnt(array('parent_id'=>0));
                    ?>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <ul>
                                <li>
                                    <a href="<?php if (!empty($products_primary_categories[0])) echo(base_url('Products/getProductByCatId?curCartId=' . $products_primary_categories[0]->cat_id)) ?>"><?php if (!empty($products_primary_categories[0])) echo $products_primary_categories[0]->$category_name; ?></a>
                                </li>
                                <li>
                                    <a href="<?php if (!empty($products_primary_categories[1])) echo(base_url('Products/getProductByCatId?curCartId=' . $products_primary_categories[0]->cat_id)) ?>"><?php if (!empty($products_primary_categories[1])) echo $products_primary_categories[1]->$category_name; ?></a>
                                </li>
                                <li>
                                    <a href="<?php if (!empty($products_primary_categories[2])) echo(base_url('Products/getProductByCatId?curCartId=' . $products_primary_categories[0]->cat_id)) ?>"><?php if (!empty($products_primary_categories[2])) echo $products_primary_categories[2]->$category_name; ?></a>
                                </li>
                                <li>
                                    <a href="<?php if (!empty($products_primary_categories[3])) echo(base_url('Products/getProductByCatId?curCartId=' . $products_primary_categories[0]->cat_id)) ?>"><?php if (!empty($products_primary_categories[3])) echo $products_primary_categories[3]->$category_name; ?></a>
                                </li>
                                <li>
                                    <a href="<?php if (!empty($products_primary_categories[4])) echo(base_url('Products/getProductByCatId?curCartId=' . $products_primary_categories[0]->cat_id)) ?>"><?php if (!empty($products_primary_categories[4])) echo $products_primary_categories[4]->$category_name; ?></a>
                                </li>
                                <li>
                                    <a href="<?php if (!empty($products_primary_categories[5])) echo(base_url('Products/getProductByCatId?curCartId=' . $products_primary_categories[0]->cat_id)) ?>"><?php if (!empty($products_primary_categories[5])) echo $products_primary_categories[5]->$category_name; ?></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <ul>
                                <li>
                                    <a href="<?php if (!empty($products_primary_categories[6])) echo(base_url('Products/getProductByCatId?curCartId=' . $products_primary_categories[0]->cat_id)) ?>"><?php if (!empty($products_primary_categories[6])) echo $products_primary_categories[6]->$category_name; ?></a>
                                </li>
                                <li>
                                    <a href="<?php if (!empty($products_primary_categories[7])) echo(base_url('Products/getProductByCatId?curCartId=' . $products_primary_categories[0]->cat_id)) ?>"><?php if (!empty($products_primary_categories[7])) echo $products_primary_categories[7]->$category_name; ?></a>
                                </li>
                                <li>
                                    <a href="<?php if (!empty($products_primary_categories[8])) echo(base_url('Products/getProductByCatId?curCartId=' . $products_primary_categories[0]->cat_id)) ?>"><?php if (!empty($products_primary_categories[8])) echo $products_primary_categories[8]->$category_name; ?></a>
                                </li>
                                <li>
                                    <a href="<?php if (!empty($products_primary_categories[9])) echo(base_url('Products/getProductByCatId?curCartId=' . $products_primary_categories[0]->cat_id)) ?>"><?php if (!empty($products_primary_categories[9])) echo $products_primary_categories[9]->$category_name; ?></a>
                                </li>
                                <li>
                                    <a href="<?php if (!empty($products_primary_categories[10])) echo(base_url('Products/getProductByCatId?curCartId=' . $products_primary_categories[0]->cat_id)) ?>"><?php if (!empty($products_primary_categories[10])) echo $products_primary_categories[10]->$category_name; ?></a>
                                </li>
                                <li>
                                    <a href="<?php if (!empty($products_primary_categories[11])) echo(base_url('Products/getProductByCatId?curCartId=' . $products_primary_categories[0]->cat_id)) ?>"><?php if (!empty($products_primary_categories[11])) echo $products_primary_categories[11]->$category_name; ?></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <ul>
                                <li>
                                    <a href="<?php if (!empty($products_primary_categories[12])) echo(base_url('Products/getProductByCatId?curCartId=' . $products_primary_categories[0]->cat_id)) ?>"><?php if (!empty($products_primary_categories[12])) echo $products_primary_categories[12]->$category_name; ?></a>
                                </li>
                                <li>
                                    <a href="<?php if (!empty($products_primary_categories[13])) echo(base_url('Products/getProductByCatId?curCartId=' . $products_primary_categories[0]->cat_id)) ?>"><?php if (!empty($products_primary_categories[13])) echo $products_primary_categories[13]->$category_name; ?></a>
                                </li>
                                <li>
                                    <a href="<?php if (!empty($products_primary_categories[14])) echo(base_url('Products/getProductByCatId?curCartId=' . $products_primary_categories[0]->cat_id)) ?>"><?php if (!empty($products_primary_categories[14])) echo $products_primary_categories[14]->$category_name; ?></a>
                                </li>
                                <li>
                                    <a href="<?php if (!empty($products_primary_categories[15])) echo(base_url('Products/getProductByCatId?curCartId=' . $products_primary_categories[0]->cat_id)) ?>"><?php if (!empty($products_primary_categories[15])) echo $products_primary_categories[15]->$category_name; ?></a>
                                </li>
                                <li>
                                    <a href="<?php if (!empty($products_primary_categories[16])) echo(base_url('Products/getProductByCatId?curCartId=' . $products_primary_categories[0]->cat_id)) ?>"><?php if (!empty($products_primary_categories[16])) echo $products_primary_categories[16]->$category_name; ?></a>
                                </li>
                                <li>
                                    <a href="<?php if (!empty($products_primary_categories[17])) echo(base_url('Products/getProductByCatId?curCartId=' . $products_primary_categories[0]->cat_id)) ?>"><?php if (!empty($products_primary_categories[17])) echo $products_primary_categories[17]->$category_name; ?></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3  col-md-3 col-sm-9 col-xs-12">

                        <h4><?= $this->lang->line('my_account'); ?></h4>
                        <ul>
                            <li><a href="<?= base_url('signin/index') ?>"><?= $this->lang->line('my_account'); ?></a>
                            </li>
                            <li>
                                <a href="<?= base_url('myaccount/orders') ?>"><?= $this->lang->line('order_history'); ?></a>
                            </li>
                        </ul>


                </div>
                <div class="col-lg-3 col-md-3 col-sm-9 col-xs-12">
                    <a style="text-decoration: none; " href="<?= base_url('contactus/index') ?>"><h4
                            style=""><?= $this->lang->line('contact_us'); ?></h4>
                    </a>
                    <ul>
                        <li><?= $this->lang->line('address'); ?>: <?=$contactus_data->address1 .'&nbsp;&nbsp;&nbsp;'.$contactus_data->address2 ;?>
                        </li>
                        <li><?= $this->lang->line('tel'); ?>: <?=$contactus_data->tel;?></li>
                        <li><?= $this->lang->line('email'); ?>: <?=$contactus_data->email;?></li>
                        <li class="social-icons" style="margin-top: 10px;">
                            <i style="color:#fff; " class="fa fa-facebook" aria-hidden="true"></i>
                            <i class="fa fa-twitter" aria-hidden="true"></i>
                            <i class="fa fa-google" aria-hidden="true"></i>
                        </li>
                        <li><img src="<?=site_url('assets/images/icons/footer_bottom.png')?>"></li>
                    </ul>
                </div>
            </div>
            <div class="row">

            </div>
        </div>
    </div>
    <div class="copyright-section" style="height: 72px;">
        <div class="container itbh-container">
            <div class="row">
                <div style="margin-left: 50px; float: left;">
                    &copy;www.Go-Dang.com - <?= $this->lang->line('all_rights_reserved'); ?>
                </div>
            </div>
        </div>
    </div>

</div>
</div>


<script>

    $(document).ready(function(){


        var width = $(window).height();

        $(".language-sub-menu li a").click(function(){
            var selText = $(this).text();
            var lang = selText.toLowerCase();
            //$(this).parents('.btn-group').find('.dropdown-toggle').html('<i class="fa fa-language" aria-hidden="true">' + selText +'</i>'+' <span class="caret"></span>');
            $.ajax({
                type: "POST",
                url: "<?php echo base_url();?>/site/language/",
                data: {lang: lang},
                dataType: "text",
                cache:false,
                success:
                    function(data){
                        window.location.reload();
                    }
            });// you have missed this bracket
            return false;
        });
    });


</script>
<script>
    $(function(){
        setInterval(function(){
            var nCarts='';
            <?php
            $nCarts=$this->session->userdata('cartNum');
            if(isset($nCarts)){if($nCarts==''){$nCarts='';}?>
            nCarts='<?= $nCarts?>';<?php }else{?>
            nCarts='';<?php }?>
            $('#nCarts').val(nCarts);
        },1000);
    });
</script>

<script type="text/javascript">

        $(document).ready(function() {
           addEffect();
        });
        function addEffect()
        {
            $(".product-elem .thumbnail").hover(function() {

                // $("#orderedlist li:last").hover(function() {

                $(this).addClass("over");

            }, function() {

                $(this).removeClass("over");

            });

            $(".itbh-sellers-products-singlie-item").hover(function() {

                // $("#orderedlist li:last").hover(function() {

                $(this).addClass("over");

            }, function() {

                $(this).removeClass("over");

            });
        }

    function getProduct(catId) {

        var url='<?= site_url("Products/getProductByCatId") ?>'+'?curCartId='+catId;

        location.href=url;
    }
</script>


<script src="<?= base_url('assets/js/itbh-main.js') ?>"></script>
<script src="<?= base_url('assets/js/itbh-products.js') ?>"></script>
<script src="<?= base_url('assets/js/dropzone.js') ?>"></script>
</body>
</html>