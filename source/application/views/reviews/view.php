
    <div class="main-content">
        <div class="container itbh-container" style="margin-top: 30px">
            <div class="row">
                <?php foreach($reviews as $review):?>
                    <div class="col-lg-offset- col-lg-10 col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                        <h2 class="review_title" style="margin-bottom: 20px;"><?php echo($review->review_title);?></h2>
                        <div class="review_rating">
                            <?php
                                $rating = (int)$review->rating;
                                for($i = 0 ; $i < $rating; $i++){
                                    echo('<li style="display: inline-block;list-style: none;"><img src=');
                                    echo('"');
                                    echo(site_url('assets/images/full_star.png'));
                                    echo('"');
                                    echo('</li>');
                                }

                                for($i = $rating ; $i < 5; $i++){
                                    echo('<li style="display: inline-block;list-style: none;"><img src=');
                                    echo('"');
                                    echo(site_url('assets/images/empty_star.png'));
                                    echo('"');
                                    echo('</li>');
                                }
                            ?>
                        </div>
                        <p class="review_content" style="font-size: 1.1rem; "><?php echo($review->review_content);?></p>
                        <p class="review_from" style=" color: #ccc; margin-right: 60px;  text-align: right;  font-weight: 600;  font-size: 1.1rem;"><?php
                            $user_id = $review ->user_id;
                            $user_sql = array();
                            $user_sql['user_id'] = $user_id;
                            $user = $this->users_m->get_single_user($user_sql);
                            if(!empty($user)){
                                echo $user->fullname;
                            } else echo($this->lang->line('not_found'));
                            ?></p>
                    </div>
                <?php endforeach?>


            </div>
            <div style="margin-top: 30px;"></div>
        </div>
    </div>
</div>