
    <div class="main-content">
        <div class="container itbh-container" style="margin-top: 30px">
            <div class="row">
                <?php foreach($reviews as $review):?>
                <div class="col-lg-offset-1 col-lg-10">
                    <a class="faq_title" style="text-decoration: none;" href="<?= base_url('reviews/view/').'/'.$review->user_id?>"><h2 style="margin-bottom: 20px;"><?php echo($review->review_title);?></h2></a>
                    <p class="faq_description"><?php echo($review->review_content);?></p>
                </div>
                <?php endforeach?>

            </div>
            <div style="margin-top: 30px;"></div>
        </div>
    </div>
</div>