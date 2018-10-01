
    <div class="main-content">
        <div class="container itbh-container" style="margin-top: 30px">
            <div class="row">

                <?php foreach($faqs as $faq):?>

                    <div class="col-lg-offset-1 col-lg-10">
                    <a class="faq_title" style="text-decoration: none; " href="<?= base_url('faqs/view/').'/'.$faq->faq_id?>">
                        <h2 style="margin-bottom: 20px;color: #fc960d; ">
                            <?php $title = 'faq_title_'.$this->session->userdata('lang');  echo($faq->$title);?>
                        </h2>
                    </a>
                    <p class="faq_description"><?php $tmp = 'faq_description_' .$this->session->userdata('lang');  echo($faq->$tmp);?></p>
                </div>
                <?php endforeach?>

            </div>
            <div style="margin-top: 30px;"></div>
        </div>
    </div>
</div>