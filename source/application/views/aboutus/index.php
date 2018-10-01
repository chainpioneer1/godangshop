

    <div class="main-content">
        <div class="container itbh-container" style="margin-top: 30px">
            <div class="row">

            <div class="col-lg-offset- col-lg-10 col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                <h2 style="color: #333; margin-bottom: 20px;">
                    <?php
                    $lang = '';
                    if (!isset($_SESSION['lang'])){
                        $lang = 'english';
                    } else $lang = $_SESSION['lang'];
                    $tt = 'title_'.$lang;
                    echo($about_data->$tt);?>
                </h2>
                <p class="faq_description" style="font-size: 1.1rem;">
                    <?php
                    $ttt = 'content_'.$lang;
                    echo ($about_data->$ttt);
                    ?>
                </p>

            </div>


            </div>
            <div style="margin-top: 30px;"></div>
        </div>
    </div>
</div>