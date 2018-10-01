

    <div class="main-content">
        <div class="container itbh-container" style="margin-top: 30px">
            <div class="row">
                <?php foreach($faq as $faq00):?>
                    <div class="col-lg-offset-1 col-lg-10">
                        <h2 class="faq_title" style="margin-bottom: 20px; color: #fc960d; "><?php $title = 'faq_title_'.$this->session->userdata('lang');  echo($faq00->$title);?></h2>
                        <p class="faq_description" style="font-size: 1.1rem; "><?php $tmp = 'faq_description_' .$this->session->userdata('lang');  echo($faq00->$tmp);?></p>
                    </div>
                <?php endforeach?>

            </div>
            <div style="margin-top: 30px;"></div>
        </div>
    </div>
</div>