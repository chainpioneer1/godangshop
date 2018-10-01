<?php

?>

    <!-- Main Section -->
    <div id="main-section">
        <div class="container">
            <div class="row overflow-hidden home-header">

                <div class="col-xs-12">
                    <h1>
                        Download Chromium base Extensions, Themes and apps<br>
                        for Chrome, Opera, yandex Browsers
                    </h1>
                </div>

                <form action="<?= base_url('extensions/search')?>" method="post">
                    <div class="col-sm-8 col-sm-offset-2 col-xs-12">
                        <div id="imaginary_container">
                            <div class="input-group stylish-input-group">
                                <input type="text" name="search_str" class="form-control"  placeholder="Search" >
							<span class="input-group-addon">
								<button type="submit">
                                    <span class="fi ion-search"></span>
                                </button>
							</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-8 col-sm-offset-2 col-xs-12 select-category">
                        <input type="checkbox" name="category[]" value="EXTENSION">Extensions
                        <input type="checkbox" name="category[]" value="THEME" style="margin-left: 20px">Themes
                        <input type="checkbox" name="category[]" value="APPLICATION" style="margin-left: 20px">Apps
                        <input type="checkbox" name="category[]" value="GAME" style="margin-left: 20px">Games
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Main Section -->

    <!-- Secondary Section -->
    <div id="secondary-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="extensions secondary-vid">
                        <div class="vid-heading overflow-hidden">
                            <span class="wow fadeInUp" data-wow-duration="0.8s"><?= ucfirst($category->name) ?></span>
                            <div class="hding-bottm-line wow zoomIn" data-wow-duration="0.8s"></div>
<!--                            <a class="view-all" href="--><?//= base_url('extensions/all_ext') ?><!--">View All</a>-->
                        </div>
                        <div class="row">
                            <div class="vid-container">

                                <?php
                                $count = 0;
                                if( !empty( $extensions ) ) {
                                    foreach ($extensions as $ext) {

                                        $info = json_decode($ext->info);

                                        $img_url = $this->files_m->get_where(array('ext_id' => $ext->id, 'file_type' => 'feature'));

                                        if (count($img_url) != 0)
                                            $img_url = base_url($img_url[0]->filename);
                                        else
                                            $img_url = base_url('assets/images/no_image.jpg');

                                        $title = $ext->name;
                                        $views = $ext->users;
                                        $updated = $ext->updated;

                                        if ($count % 4 == 0)
                                            echo '<div class="row">';


                                        ?>
                                        <div class="col-md-3 col-sm-6">
                                            <div class="latest-vid-img-container">
                                                <div class="vid-img">
                                                    <img class="img-responsive" src="<?= $img_url ?>" alt="video image"
                                                         width="640">
                                                    <a href="<?= base_url('extensions/view/' . $ext->id) ?>"
                                                       class="play-icon play-small-icon">
                                                        <img class="img-responsive play-svg svg"
                                                             src="<?= base_url('assets/images/play-button.svg') ?>"
                                                             alt="play"
                                                             onerror="this.src='<?= base_url('assets/images/play-button.png') ?>'">
                                                    </a>

                                                    <div class="overlay-div"></div>
                                                </div>
                                                <div class="vid-text">
                                                    <p><span>By</span> <a href="#">Jhon Doe</a></p>

                                                    <h1><a href="<?= base_url('extensions/view/' . $ext->id) ?>"><?= $title ?></a></h1>

                                                    <p class="vid-info-text">
                                                        <span><?= $updated ?></span>
                                                        <span>&#47;</span>
                                                        <span><?= $views ?> views</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        if ($count % 4 == 3)
                                            echo '</div>';

                                        $count++;
                                    }
                                    if ($count % 4 != 0)
                                        echo '</div>';
                                } else {
                                    echo '<div class="col-md-12">There are no addons in this category.</div>';
                                }
                                ?>





                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Secondary Section -->

