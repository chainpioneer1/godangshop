<?php  ?>
<!--itbh comment : add style-->

<div class="main-content-wrap" xmlns="http://www.w3.org/1999/html">
    <div class="home-page-header">
        <div class="home-page-header-info">
            <div class="row">
                <img src="<?=site_url('assets/images/home_main.jpg')?>"
            </div>
            <div style="background-color:#fc960d ;">
                <form class="home-search-product-form container">
                    <div class="input-group" style="padding: 20px;">
                        <input type="text" id="myInput" required onchange="myFunction()" class="form-control home-input-border-left" style="height: 50px;" placeholder="<?=$this->lang->line('search_part_keyword')?>">
                        <span class="input-group-btn">
                        <button data-toggle="modal"  data-target="#exampleModal"  id="home-search-keyword-btn" class="btn btn-secondary home-input-border-right" type="button" style="height: 50px; width: 70px;">
                            <span class="glyphicon glyphicon-search" aria-hidden="true" style="color: #fff;"></span>
                        </button>
                    </div>
                </form>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?=$this->lang->line('search_result');?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 70px;">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="margin-top: 30px;">
                                <ul id="myUL">
                                    <?php
                                    if (!empty($warehouses)){
                                        foreach($warehouses as $warehouse){
                                            ?>
                                            <li><a href="<?=base_url('warehouses/view/'.$warehouse->warehouse_id)?>" class="header"><?=$warehouse->warehouse_name;?></a></li>
                                            <?php
                                        }
                                    }
                                    ?>
                                    <?php
                                    if (!empty($products)){
                                        foreach($products as $product){
                                            ?>
                                            <li><a href="<?=base_url('products/view/'.$product->product_id)?>" class="header"><?=$product->product_name;?></a></li>
                                            <?php
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        function myFunction() {
            var input, filter, ul, li, a, i;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            ul = document.getElementById("myUL");
            li = ul.getElementsByTagName("li");
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                    $('#myUL').show();

                } else {
                    li[i].style.display = "none";

                }
            }
        }

        $(document).ready(function(){

        });
    </script>


<div class="main-content">
    <div class="row" style="padding-top: 25px">
        <div class="container itbh-container">
                <div style="text-align: center; margin-bottom: 20px;  opacity: 0.7;" id="myCarousel" class="carousel slide" data-ride="carousel">
                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <img src="<?=base_url('assets/images/slidebar/slide1.png')?>" alt="There is no image" style="width:1145px; height: 153px;">
                            <div class="carousel-caption">
                                <h1 style="color: #222; ">Embedded
                                    Solutions</h1>
                                <p></p>
                            </div>
                        </div>

                        <div class="item">
                            <img src="<?=base_url('assets/images/slidebar/slide2.png')?>" alt="There is no image" style="width:1145px; height: 153px;">
                            <div class="carousel-caption" >
                                <h1 style="color: #222; ">Connectors</h1>
                                <p></p>
                            </div>
                        </div>

                        <div class="item">
                            <img src="<?=base_url('assets/images/slidebar/slide1.png')?>" alt="There is no image" style="width:1145px; height: 153px;">
                            <div class="carousel-caption">
                                <h1 style="color: #222; ">Embedded
                                    Solutions</h1>
                                <p></p>
                            </div>
                        </div>
                        <div class="item">
                            <img src="<?=base_url('assets/images/slidebar/slide1.png')?>" alt="There is no image" style="width:1145px; height: 153px;">
                            <div class="carousel-caption">
                                <h1 style="color: #222; ">Embedded
                                    Solutions</h1>
                                <p></p>
                            </div>
                        </div>

                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev" style="opacity: 1 ; width: 20px; color: #fff; font-weight: 100; background-color: #fc960d; ">
                        <span class="glyphicon glyphicon-chevron-left" style="font-size: 20px;"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next" style="opacity: 1 ; width: 20px; color: #fff; font-weight: 100; background-color: #fc960d; ">
                        <span class="glyphicon glyphicon-chevron-right" style="font-size: 20px;"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <!-- itbh comment : add products list page -->
                <div class="row home-products-list">
                    <table style="text-align: center; border: none; width: 100%;  ">
                        <thead>
                            <tr>
                                <th style="text-align: center;"><h4><?=$this->lang->line('product_name');?></h4></th>
                                <th style="text-align: center;"><h4><?=$this->lang->line('market_price');?></h4></th>
                                <th style="text-align: center;"><h4><?=$this->lang->line('our_price');?></h4></th>
                                <th style="text-align: center;"><h4><?=$this->lang->line('you_save');?></h4></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for($i = 0; $i < 3; $i++){
                                if (($this->session->userdata('lang')) == '' ){
                                    $lang_tmp = 'english';
                                } else {
                                    $lang_tmp = $this->session->userdata('lang');
                                }
                                $tmp2 = 'product_name_'.$lang_tmp;
                              ?>

                                <tr>
                                    <td style="text-align: center;"><a style="color: #333;" href="<?=base_url('products/view/').'/'.$latest_products[$i]->product_id;?>"><p><span class="home-product-tbl-span" ><?=$latest_products[$i]->$tmp2; ?></span></p></a></td>
                                    <td style="text-align: center;"><p><span class="home-product-tbl-span"><?=$latest_products[$i]->market_price; ?></span></p></td>
                                    <td style="text-align: center;"><p><span class="home-product-tbl-span" style="color: #2969d3; "><?=$latest_products[$i]->regular_price; ?></span></p></td>
                                    <td style="text-align: center;"><p><span class="home-product-tbl-span" style="color: #67b20d; "><?php
                                                $regular = $latest_products[$i]->regular_price;
                                                $market = $latest_products[$i]->market_price;
                                                if ($market > 0){
                                                    $pp = ($market - $regular) / $market * 100;
                                                    echo (round($pp));
                                                    echo('<span>&percnt;</span>');
                                                } else echo ($this->lang->line('not_found'));

                                                ?></span></p></td>
                                </tr>
                                <?php
                            } ?>
                        </tbody>
                    </table>
                    <a href="<?=base_url('products/products_list')?>" class="btn btn-warning" style="background-color: #fc960d;  float: right; font-size: 1.1rem; padding: 10px 25px; margin-right: 40px;"><?=$this->lang->line('see_more')?></a>
                </div>
                <!-- itbh comment : add latest products into page -->
                <div class="clearfx" style="min-height: 25px;"></div>
                <div class="home-latest-products">
                    <div class="row" style="text-align: center;"><h1 style="color: #fc960d; "><?=$this->lang->line('lasted_stock')?></h1></div>
                    <div class="row" style="margin-bottom: 15px;">
                        <?php
                            for($i = 0; $i < 4; $i++){
                                if (($this->session->userdata('lang')) == '' ){
                                    $lang_tmp = 'english';
                                } else {
                                    $lang_tmp = $this->session->userdata('lang');
                                }
                                $tmp = 'name_'.$lang_tmp;
                                $tmp2 = 'product_name_'.$lang_tmp;
                                ?>
                                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                    <div class="home-lastest-product-item product-elem">
                                        <a class="thumbnail" href="<?=base_url('products/view/').'/'.$latest_products[$i]->product_id;?> ">
                                            <img class="home-lastest-product-item-img" style="width: 256px; height: 256px; border-bottom: solid 1px #efefef;" src="<?=site_url("uploads/images/").'/'.$latest_products[$i]->img_url?>"></a>
                                        <p  class="product-category-name"  style="text-align: center; font-size: 1.2rem;"><span><?=$latest_products[$i]->$tmp2; ?></span></p>
                                        <p  class="product-category-name"  style="text-align: center;"><span><?php

                                                $catgory_id = $latest_products[$i]->sub_category_id;
                                                $sql = array();
                                                $sql['cat_id'] = $catgory_id;
                                                $category =  $this->categories_m->get_single_category($sql);
                                                if(!empty($category)){
                                                    echo $category->$tmp;
                                                } else echo $this->lang->line('not_found');
                                                ?></span></p>
                                        <p  class="product-category-name"  style="text-align: center;color: #fc960d; font-size: 1.5rem;"><span><?=$latest_products[$i]->regular_price; ?>&nbsp; <?=$this->lang->line('currency');?></span></p>
                                    </div>
                                </div>

                                <?php
                            }

                        ?>

                    </div>
                </div>
                <div class="home-best-sellers">
                    <div class="row" style="text-align: center;"><h1 style="color: #fc960d; "><?=$this->lang->line('best_Sellers')?></h1></div>
                    <div class="row" style="margin-bottom: 15px;">
                        <?php
                        for($i = 0; $i < 6; $i++){
                            if (($this->session->userdata('lang')) == '' ){
                                $lang_tmp = 'english';
                            } else {
                                $lang_tmp = $this->session->userdata('lang');
                            }
                            $tmp = 'name_'.$lang_tmp;
                            $tmp2 = 'product_name_'.$lang_tmp;
                            ?>
                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-6">
                                <div class="home-best-sellers product-elem">
                                    <a class="thumbnail" href="<?=base_url('products/view/').'/'.$best_sellers[$i]->product_id;?> ">
                                        <img class="home-lastest-product-item-img" style="width: 160px; height: 160px; border: solid 1px #dfdfdf; " src="<?=site_url("uploads/images/").'/'.$best_sellers[$i]->img_url?>">
                                    </a>
                                    <div style="height: 200px;">
                                    <p  class="best-seller-name"  style="text-align: center; font-size: 1rem;font-weight: 600;"><span><?=$best_sellers[$i]->$tmp2;?></span></p>
                                    <p  class="product-category-name"  style="text-align: center;"><span><?php
                                            $catgory_id = $best_sellers[$i]->sub_category_id;
                                            $sql = array();
                                            $sql['cat_id'] = $catgory_id;
                                            $category =  $this->categories_m->get_single_category($sql);
                                            if(!empty($category)){
                                                echo $category->$tmp;
                                            } else {
                                                $catgory_id = $best_sellers[$i]->category_id;
                                                $sql = array();
                                                $sql['cat_id'] = $catgory_id;
                                                $category =  $this->categories_m->get_single_category($sql);
                                                if(!empty($category)){
                                                    if (($this->session->userdata('lang')) == '' ){
                                                        $lang_tmp = 'english';
                                                    } else {
                                                        $lang_tmp = $this->session->userdata('lang');
                                                    }
                                                    $tmp = 'name_'.$this->session->userdata('lang');
                                                    echo $category->$tmp;
                                                } else echo $this->lang->line('not_found');
                                            }
                                            ?></span></p>
                                    <p  class="product-category-name"  style="text-align: center;color: #fc960d; font-size: 1.2rem;"><span><?=$best_sellers[$i]->regular_price?>&nbsp; <?=$this->lang->line('currency');?></span></p>
                                    </div>
                                </div>
                            </div>

                            <?php
                        }

                        ?>


                    </div>
                </div>
        </div>
        <div class="row">
                <div class="home-subscribe" style="height: 200px; background-color:#fc960d;">
                    <div class="row" style="text-align: center; "><h2 style="color: #eee; font-size: 27px; "><?=$this->lang->line('subscribe_to_your_news_letter')?></h2></div>
                    <div class="col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8 col-sm-offset-2 col-sm-8 col-xs-offset-1 col-xs-10">

                        <div class="input-group" style="padding-top: 20px;">
                            <input type="email" id="your_mail" name="your_mail" class="form-control home-input-border-left" placeholder="<?=$this->lang->line('email_address')?>" >
                            <span class="input-group-btn">
                            <button class="btn btn-secondary home-input-border-right" type="submit" id="subscribe_btn" style="width:150px;background-color: #000000; ">
                                <span aria-hidden="true" style="color: #fff; font-size: 1.1rem; "><?=$this->lang->line('subscribe');?></span>
                            </button>
                        </div>

                    </div>
                </div>
        </div>
        <div class="container itbh-container">
            <div class="home-warehouses" style="margin-top: 48px;">
                <div class="row" style="text-align: center;"><h1><?=$this->lang->line('warehouses')?></h1></div>
                <div class="row" style="margin-bottom: 50px;">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4 ">
                        <div class="home-warehouses-item">
                            <img class="home-best-sellers-item-img" src="<?=site_url('assets/images/home/new_1.png')?>" />
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                        <div class="home-warehouses-item">
                            <img class="home-best-sellers-item-img" src="<?=site_url('assets/images/home/new_2.png')?>" />
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                        <div class="home-warehouses-item">
                            <img class="home-best-sellers-item-img" src="<?=site_url('assets/images/home/new_3.png')?>" />
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                        <div class="home-warehouses-item">
                            <img class="home-best-sellers-item-img" src="<?=site_url('assets/images/home/new_4.png')?>" />
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                        <div class="home-warehouses-item">
                            <img class="home-best-sellers-item-img" src="<?=site_url('assets/images/home/new_5.png')?>" />
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-4">
                        <div class="home-warehouses-item">
                            <img  class="home-best-sellers-item-img" src="<?=site_url('assets/images/home/new_6.png')?>" />
                        </div>
                    </div>

                </div>
            </div>

            <div class="home-banks" style="margin-top: 50px; border: 1px solid #dfdfdf; text-align: center; ">
                <img src="<?=site_url('assets/images/home_banks.png')?>" class="home-banks-img">
            </div>
            <div class="clearfx" style="margin-top: 50px;"></div>
        </div>
        </div>
    </div>
</div>


<style>
    .home-lastest-product-item {
        border: solid 1px #e4e4e4; text-align: center; padding: 10px
    }
    .home-product-tbl-span {
        font-size: 1.1rem;font-weight: 400;
        vertical-align: middle;
    }

    .home-best-sellers-item-img {
        height: 180px; width: 180px; border: solid #e1e1e1 1px; text-align: center;
    }

    .home-input-border-left {
        border-bottom-left-radius: 30px;border-top-left-radius:30px;height:50px;
    }

    .home-input-border-right {
        height:50px;  background-color: #fc960d;border-top-right-radius: 30px;    border-bottom-right-radius: 30px;
    }
    .home-best-sellers {
        text-align: center;
    }

</style>

<script>
    $(document).ready(function(){
        $('#subscribe_btn').click(function(){
            var url = '<?=base_url('signin/subscribe')?>';
            var your_mail = $('#your_mail').val();
            $.ajax({
                type: "POST",
                url: url,
                data: {your_mail: your_mail},
                dataType: "text",
                success: function (data) {
                    $('#your_mail').val('');
                    alert(data);
                }
            });
        });
    });
</script>