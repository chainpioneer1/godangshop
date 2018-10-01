
                <div class="col-lg-9">
                    <div class="itbh-sellers-rating col-lg-5" style="">
                        <h4 style="font-weight: 700;"><?=$this->lang->line('rating');?></h4>
                        <h4><?php
                           if(!empty($warehouse)){
                               $tt = $warehouse->warehouse_rating;
                               if($seller_reviews_cnt > 0) {
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
                           }


                            ?></h4>
                        <h5>(<?=$seller_reviews_cnt;?>&nbsp;<?=$this->lang->line('reviews');?>)</h5>
                        <?php if($seller_reviews_cnt > 0){
                            ?>
                            <a href="<?= base_url('reviews/view/'.$warehouse->warehouse_id) ?>"><?=$this->lang->line('view_reviews');?></a>
                            <?php

                        }?>
                    </div>
                    <div class="itbh-sellers-rating col-lg-5 col-lg-offset-1">
                        <h4 style="font-weight: 700;"><?=$this->lang->line('visitor');?></h4>
                        <?php
                        if(!empty($warehouse)){
                            ?>
                            <h4 style="color: #55aaff;"><?=$warehouse->visitors;?></h4>
                            <?php
                        }?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>