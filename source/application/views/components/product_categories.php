<script>
    $(document).ready(function(){
        // get windows width
        var width = $(window).width();
        if (width < 1030 ) {
            // this is tablet

            $('.products-categories'). addClass('display-none-class ');
            $('.products-details').removeClass('col-lg-9');
            $('.products-details').addClass('col-lg-12 col-md-12 col-sm-12 col-xs-12');
            $('.select-category-button'). removeClass('display-none-class ');

        }
    });
</script>

<style>
    .display-none-class {
        display: none;

    }
</style>

<div class="main-content">
    <div class="container itbh-container" style="margin-top: 30px">
        <div class="row">
            <div class="col-lg-3 col-md-3 products-categories" style="padding-left: 20px;">
                <h3><?php echo $this->lang->line('products')?></h3>

                <div class="navbar-default sidebar" style="background-color: #fff; " role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <?php echo $categoryView ?>

                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 products-details">
                <div class="row" style="margin: 0 0 10px 10px; " id="sortDiv">
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <select id="sortBy" class="custom-select form-control" style="height: 35px;">
                                <option value="regular_price" id="regular_price"><?= $this->lang->line('price') ?></option>
                                <option value="quantity" id="quantity"><?= $this->lang->line('quantity') ?></option>
                                <option value="registered_date" id="registered_date"><?= $this->lang->line('registered_date') ?></option>
                                <option value="sold_qty" id="sold_qty"><?= $this->lang->line('sold_qty') ?></option>
                            </select>
                        </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <div class="btn-group select-category-button display-none-class">
                            <button type="button" style="height: 40px;" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?=$this->lang->line('categories');?>
                            </button>
                            <div class="dropdown-menu">
                                <?php
                                    foreach($categories  as $category){
                                        if (($this->session->userdata('lang')) == '' ){
                                            $lang_tmp = 'english';
                                        } else {
                                            $lang_tmp = $this->session->userdata('lang');
                                        }
                                        $tmp = 'name_'.$lang_tmp;
                                        ?>
                                        <a style="display: block; color: #333; text-decoration: none; padding-left: 20px;" class="dropdown-item" href="<?=base_url('Products/getProductByCatId?curCartId=' . $category->cat_id); ?>"><?php echo $category->$tmp. ($this->products_m->get_products_cnt(array('category_id' => $category->cat_id)));?></a>
                                        <?php
                                    }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">

                </script>
                <div class="" style="margin: 0 0 10px 5px">

<script type="text/javascript">
    $(function(){
        var sortby='<?php echo $sortby?>';
        document.getElementById(sortby).selected=true;

    });
</script>

