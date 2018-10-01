

    <div class="main-content">
        <div class="container itbh-container" style="margin-top: 30px">
            <?php if (!empty($warehouse)){
                ?>

                <div class="row">
                    <div class="col-lg-offset- col-lg-10 col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                        <div class="row">

                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <img  style="width: 160px; height: 90px; " alt="" src="<?php
                                if(!empty(site_url('uploads/warehouse_logo/').'/'.$warehouse->warehouse_logo)){
                                    echo site_url('uploads/warehouse_logo/'.'/'.$warehouse->warehouse_logo);
                                } else echo site_url('assets/images/blank/warehouselogo.png');

                                ?>">
                                <?php
                                $vistors =  $warehouse->visitors;
                                $warehouse_id = $warehouse->warehouse_id;
                                $warehouse_arr = array();
                                if(!isset($_SESSION)) session_start();
                                if(!isset($_SESSION['hasVisited'])){
                                    $_SESSION['hasVisited'] = "yes";
                                    $vistors++;
                                    $warehouse_arr['visitors'] = $vistors + 1 ;
                                    $this->warehouses_m->update_warehouse($warehouse_arr , $warehouse_id);
                                }

                                ?>
                            </div>
                            <div class="col-lg-offset-5 col-lg-4  col-md-offset-5 col-md-4 col-sm-6 col-xs-6">

                                <div class="review_rating">
                                    <?php
                                    $tt = $warehouse->warehouse_rating;
                                    if($review_cnt > 0) {
                                        $rating = (int)$tt;
                                        for($i = 0 ; $i < $rating; $i++){
                                            echo('<li style="display: inline-block;list-style: none;"><img src=');
                                            echo('"');
                                            echo(site_url('assets/images/full_star.png'));
                                            echo('"');
                                            echo('</li>');
                                        }
                                        if ($tt > $rating + 0.5) {
                                            echo('<li style="display: inline-block;list-style: none;"><img src=');
                                            echo('"');
                                            echo(site_url('assets/images/more_star.png'));
                                            echo('"');
                                            echo('</li>');
                                        } elseif( $rating <$tt) {
                                            echo('<li style="display: inline-block;list-style: none;"><img src=');
                                            echo('"');
                                            echo(site_url('assets/images/less_star.png'));
                                            echo('"');
                                            echo('</li>');
                                        }
                                        for($i = $rating+1  ; $i < 5; $i++){
                                            echo('<li style="display: inline-block;list-style: none;"><img src=');
                                            echo('"');
                                            echo(site_url('assets/images/empty_star.png'));
                                            echo('"');
                                            echo('</li>');
                                        }
                                    }

                                    ?>
                                </div>
                                <a style="color: #333; " href="<?= base_url('reviews/view/'.$warehouse->warehouse_id) ?>" <p>(<span class="warehouse-span-1" style="font-weight: 600; font-size: 1.1rem; color: #333; "><?=$review_cnt;?></span>&nbsp; <?=$this->lang->line('reviews');?>)</p></a>
                                <!--  itbh comment : add review to this warehouse          -->
                                <a  data-toggle="modal" data-target="#add_review" data-whatever="@mdo" style="color: #fc960d; "><?=$this->lang->line('add_your_review')?></a>
                                <div class="modal fade" id="add_review" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel" ><?=$this->lang->line('add_your_review')?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <?php

                                                $usertype = $this->session->userdata("user_type");
                                                if ($usertype != 3) {
                                                ?>

                                                <div class="form-group">
                                                    <label for="recipient-name" class="form-control-label"><?=$this->lang->line('login_first')?></label>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <a href="<?=base_url('signin/index/')?>" type="button" class="btn btn-secondary" data-dismiss="modal"><?=$this->lang->line('close')?></a>
                                            </div>

                                            <?php
                                            } else {
                                            ?>

                                            <form>
                                                <div class="form-group">
                                                    <label for="recipient-name" class="form-control-label"><?=$this->lang->line('title')?>:</label>
                                                    <input type="text" required class="form-control" id="your-review-title">
                                                </div>

                                                <div class="form-group">
                                                    <label for="message-text" class="form-control-label"><?=$this->lang->line('your_review')?>:</label>
                                                    <textarea required class="form-control" id="message-text"></textarea>
                                                </div>
                                                <input type="hidden" id="rating_value"/>
                                                <div class="form-group">
                                                    <div class="o-container">
                                                        <div class="o-section">
                                                            <div id="shop"></div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div id="add_review_feedback"></div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?=$this->lang->line('close')?></button>
                                            <button id="add_review_btn" type="button" class="btn btn-primary"><?=$this->lang->line('add_your_review')?></button>
                                        </div>
                                        <?php
                                        }

                                        ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row"><h3><?=$warehouse->warehouse_name?></h3></div>
                    <div class="row">
                        <h4><?=$this->lang->line('warehouse_slogan')?></h4>
                        <p><?=$warehouse->warehouse_slogan; ?></p>
                    </div>
                    <div class="row">
                        <h3><?=$this->lang->line('products');?></h3>
                        <ul>
                            <?php
                            for($i = 0 ;  $i < count($products); $i++) {
                                if (($this->session->userdata('lang')) == '' ){
                                    $lang_tmp = 'english';
                                } else {
                                    $lang_tmp = $this->session->userdata('lang');
                                }
                                $tmp = 'name_'.$lang_tmp;
                                $tmp2 = 'product_name_'.$lang_tmp;
                                ?>
                                <li>
                                    <a style="font-size: 1.1rem; color:#fc960d; " href="<?php echo (base_url('products/view').'/'.$products[$i]->product_id); ?>"><?=$products[$i]->$tmp2?> &nbsp; (<span class="warehouse-span-1" style="font-weight: 600; font-size: 1.1rem; color: #333; "><?=$products[$i]->quantity;?></span>)</a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>

                    <div class="row">
                        <h3><?=$this->lang->line('payment_method');?></h3>


                        <ul><?php
                            $payment_methods_tmp = $warehouse->payment_methods;
                            $payment_methods = array();
                            if(!empty($payment_methods_tmp)){
                                $payment_methods = json_decode($payment_methods_tmp);
                                for ($i = 0;$i < count($payment_methods); $i ++){
                                    echo '<li>';
                                    echo $payment_methods[$i]->payment_method;
                                    echo '</li>';
                                }
                            }

                            ?>

                        </ul>
                    </div>

                    <div class="row">
                        <h3>Contact Information</h3>
                        <ul>
                            <li><?=$this->lang->line('address');?>.&nbsp;</span><?=$warehouse->warehouse_address1; ?>&nbsp; <?php  echo $warehouse->warehouse_address2; ?></li>
                            <li><span><?=$this->lang->line('tel');?>.&nbsp;</span><?=$warehouse->warehouse_phone1; ?>&nbsp; <?php echo(','); echo $warehouse->warehouse_phone1; ?></li>
                            <li><span><?=$this->lang->line('fax');?>.&nbsp;</span><?=$warehouse->warehouse_fax; ?></li>
                            <li><span><?=$this->lang->line('email');?>.&nbsp;</span><?=$warehouse->warehouse_email; ?></li>
                            <li><span><?=$this->lang->line('line_id');?>.&nbsp;</span><?=$warehouse->warehouse_line; ?></li>
                            <li><span><?=$this->lang->line('facebook');?>.&nbsp;</span><?=$warehouse->warehouse_facebook; ?></li>
                            <li><span><?=$this->lang->line('google');?>.&nbsp;</span><?=$warehouse->warehouse_google; ?></li>

                        </ul>
                        <!--      itbh contact map // fix it's position                  -->
                        <div class="row">
                            <div id="map" style="width: 100% ; height: 300px; margin-bottom: 100px; "></div>
                            <script>
                                var x = '<?php $warehouse->warehouse_map_x?>';
                                x = parseFloat(x);
                                var y = '<?php $warehouse->warehouse_map_y?>';
                                y = parseFloat(y);
                                function initMap() {
                                    var uluru = {lat: x, lng: y};
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
            } else echo('<div><h2 style="text-align: center; color: #fc960d;">'.$this->lang->line('warehouse_not_found').'</h2></div>')?>

            </div>

            <div style="margin-top: 30px;"></div>
        </div>
    </div>
</div>



<!-- add rating javascript function -->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-34160351-1', 'auto');
        ga('send', 'pageview');
    </script>
    <script>

        /**
         * Demo in action!
         */
        (function() {

            'use strict';

            // SHOP ELEMENT
            var shop = document.querySelector('#shop');

            // DUMMY DATA
            var data = [
                {
                    rating: 0
                },

            ];

            // INITIALIZE
            (function init() {
                for (var i = 0; i < data.length; i++) {
                    addRatingWidget(buildShopItem(data[i]), data[i]);
                }
            })();

            // BUILD SHOP ITEM
            function buildShopItem(data) {
                var shopItem = document.createElement('div');

                var html =
                    '<ul class="c-rating"></ul>' +
                    '</div>';

                shopItem.classList.add('c-shop-item');
                shopItem.innerHTML = html;
                shop.appendChild(shopItem);

                return shopItem;
            }

            // ADD RATING WIDGET
            function addRatingWidget(shopItem, data) {
                var ratingElement = shopItem.querySelector('.c-rating');
                var currentRating = data.rating;
                var maxRating = 5;
                var callback = function(rating) {
                    document.getElementById('rating_value').value = rating;
                };
                var r = rating(ratingElement, currentRating, maxRating, callback);
            }

        })();

        $(document).ready(function(){
            $('#add_review_btn').click(function(){
                var warehouse_id = '<?php echo $warehouse->warehouse_id;?>';
                var warning = '<?php echo $this->lang->line('input_correctly');?>';
                var rating = $('#rating_value').val();
                var review_title = $('#your-review-title').val();
                var review_content = $('#message-text').val();
                if (rating == 0 || review_title == '' || review_content == '' ) {
                    alert(warning);
                } else {
                    $.ajax({
                        type: "POST",
                        url : "<?php echo base_url();?>/reviews/add",
                        data: {warehouse_id : warehouse_id , review_title : review_title , review_content : review_content ,rating: rating } ,
                        dataType: "text" ,
                        cache : false ,
                        success :
                            function(data){
                                $('#add_review_feedback').html(data);
                                window.location.reload();
                            }
                    });
                }


            });


        });

    </script>

    <style>
        #add_review_feedback {
            font-weight: 800;
            text-align: center;
            font-size: 1.2rem;
            color: #6986ef;
        }
        }
    </style>