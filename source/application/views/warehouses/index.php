

    <div class="main-content">
        <div class="container itbh-container" style="margin-top: 30px">

            <div class="row">
                <div class="col-lg-3">

                </div>
            </div>
            <?php
                foreach($warehouses as $warehouse){
                    ?>

                    <div class="row">
                        <div class="col-lg-offset-1 col-lg-3" style="text-align: center; margin-top: 20px; ">
                            <img  style="border: 1px solid #ddd; width: 260px; height: 180px; " alt="" src="<?php
                    if(!empty(site_url('uploads/warehouse_logo/').'/'.$warehouse->warehouse_logo)){
                        echo site_url('uploads/warehouse_logo/'.'/'.$warehouse->warehouse_logo);
                    } else echo site_url('assets/images/blank/warehouselogo.png');


                    ?>">
                        </div>
                        <div class="col-lg-7">
                            <h1><?= $warehouse->warehouse_name; ?></h1>
                            <p><?=$warehouse->warehouse_description; ?></p>
                            <a style="color: #fc960d;" href="<?=base_url('warehouses/view/').'/'.$warehouse->warehouse_id?>"><?=$this->lang->line('more_about').'&nbsp; '. $warehouse->warehouse_name?> </a>
                        </div>
                    </div>
                    <?php
                }
            ?>

            <div style="margin-top: 30px;"></div>
            <div class="row">
                <div class="col-lg-offset-8 col-lg-4 products-pagination" >
                    <ul >
                        <?php foreach ($links as $link) {
                            echo "<li>". $link."</li>";
                        } ?>
                   </ul>
                </div>
            </div>
            <div style="margin-top: 20px;"></div>
        </div>

    </div>
</div>