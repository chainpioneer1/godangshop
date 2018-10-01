

    <div class="main-content">
        <div class="container itbh-container" style="margin-top: 30px">
            <div class="row">
                <?php foreach($warehouse as $warehouse00):?>
                    <div class="col-lg-offset-1 col-lg-10">
                        <h2 class="faq_title" style="margin-bottom: 20px;"><?php echo($warehouse00->warehouse_name);?></h2>
                        <p class="faq_description" style="font-size: 1.1rem; "><?php echo($warehouse00->warehouse_description);?></p>
                    </div>
                <?php endforeach?>

            </div>
            <div style="margin-top: 30px;"></div>
        </div>
    </div>
</div>