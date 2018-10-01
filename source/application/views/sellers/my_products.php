<script>
    $(document).ready(function(){
        $('#parent_category').change(function(){
            var category_id = $('#parent_category').val();
            $.ajax({
                type: "POST",
                url : "<?php echo base_url();?>/sellers/get_sub_categories",
                data: {category_id : category_id } ,
                dataType: "text" ,
                cache : false ,
                success :
                    function(data){
                        $('#sub_category').html(data);

                    }
            });
            return false;
        });

        $('#search_product_btn').click(function(){
            var category_id = ($('#parent_category').val());
            var sub_category_id = ($('#sub_category').val());
            var search_product_name = $('#search_product_name').val();
            $.ajax({
                type: "POST",
                url : "<?php echo base_url();?>/sellers/search_product",
                data: {category_id : category_id , sub_category_id:sub_category_id ,search_product_name:search_product_name  } ,
                dataType: "text" ,
                cache : false ,
                success :
                    function(data){
                        $('#itbh-seller-products-tbody').html(data);

                    }
            });
            return false;
        });

    });
</script>
                <div class="col-lg-9">
                    <div class="portlet light bordered">

                        <div class="portlet-body">
                            <div class="table-toolbar">

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6  col-xs-6">
                                        <h3><?=$this->lang->line('my_products');?></h3>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6  col-xs-6" >
                                        <div class="btn-group pull-right">
                                            <a href="<?= base_url('sellers/add_product') ?>" class="btn sbold green"> <?php echo($this->lang->line('add_new'));?>
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8 col-md-8  col-sm-8 col-xs-12 row">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                                            <select class="bs-select form-control" name="parent_category" id="parent_category" style="padding:5px;">
                                                <?php
                                                if (($this->session->userdata('lang')) == '' ){
                                                    $lang_tmp = 'english';
                                                } else {
                                                    $lang_tmp = $this->session->userdata('lang');
                                                }
                                                $tmp = 'name_'.$lang_tmp;
                                                $tmp2 = 'product_name_'.$lang_tmp;
                                                foreach( $products_primary_categories as $cat ) : ?>
                                                    <option value="<?= $cat->cat_id ?>"><?= $cat->$tmp ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-offset-1 col-lg-5  col-md-offset-1 col-md-5  col-sm-offset-1 col-sm-5  col-xs-12 ">
                                            <select class="bs-select form-control" name="sub_category" id="sub_category" style="padding:5px;">
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-md-offset-1 col-md-3 col-lg-offset-1 col-lg-3 col-sm-3 col-sm-offset-1 col-xs-12" >
                                        <div class="input-group">
                                            <input type="text" name="product_name" class="form-control"id="search_product_name" placeholder="<?=$this->lang->line('search_for_...');?>">
                                              <span class="input-group-btn">
                                                <button class="btn btn-default" id="search_product_btn">Go!</button>
                                              </span>
                                        </div><!-- /input-group -->
                                    </div>
                                </div>
                            </div>
                            <?php $success = $this->session->flashdata("success");?>
                            <?php if( !empty( $success ) ) : ?>
                                <div class="custom-alerts alert alert-success fade in">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="font-size: 36px; width: 36px; height: 36px; color: red; ">&times;</button>
                                    <?= $success ?>
                                </div>
                            <?php endif; ?>
                            <?php
                            $root_products = $this->products_m->get_where(array('seller_id'=>$seller_id));
                            if (count($root_products) > 0 ){
                                ?>
                                <table class="table table-responsive" id="products_tbl" style="margin-top: 20px; border: none;">
                                    <thead>
                                    <tr>
                                        <th style="display: none;"></th>
                                        <th></th>
                                        <th> <?php echo($this->lang->line('product_name'));?> </th>
                                        <th> <?php echo($this->lang->line('price'));?> </th>
                                        <th> <?php echo($this->lang->line('stock'));?> </th>
                                        <th>  </th>
                                    </tr>
                                    </thead>
                                    <tbody id="itbh-seller-products-tbody">
                                    <?php
                                    echo $controller->print_products( $root_products, 0 );
                                    ?>

                                    </tbody>
                                </table>
                                <?php
                            } else {
                                echo ('<div><h2 style="text-align: center;">'.$this->lang->line('thereisnoproduct').'</h2></div>');
                            }
                            ?>

                        </div>
                    </div>

                    <?php if(count($root_products) > 0) {
                        ?>
                        <div class="row" style="padding-bottom: 12px;">
                            <div class="col-lg-offset-8 col-lg-4 products-pagination" id="productsPageNav"></div>
                        </div>
                        <?php
                    }?>

                </div>
            </div>

        </div>

    </div>

</div>
<script>
    var currentShowedPage = 1;
    var showedItems = 5;
    function Pager(tableName, itemsPerPage) {

        this.tableName = tableName;
        this.itemsPerPage = itemsPerPage;
        this.currentPage = 1;
        this.pages = 0;
        this.inited = false;

        this.showRecords = function(from, to) {
            var rows = document.getElementById(tableName).rows;
            // i starts from 1 to skip table header row
            for (var i = 1; i < rows.length; i++) {
                if (i < from || i > to)
                    rows[i].style.display = 'none';
                else
                    rows[i].style.display = '';
            }
        }

        this.showPage = function(pageNumber) {
            if (! this.inited) {
                alert("not inited");
                return;
            }
            var oldPageAnchor = document.getElementById('pg'+this.currentPage);
            oldPageAnchor.className = 'pg-normal';

            this.currentPage = pageNumber;
            var newPageAnchor = document.getElementById('pg'+this.currentPage);
            newPageAnchor.className = 'pg-selected';

            var from = (pageNumber - 1) * itemsPerPage + 1;
            var to = from + itemsPerPage - 1;
            this.showRecords(from, to);
        }

        this.prev = function() {
            if (this.currentPage > 1){

                currentShowedPage = this.currentPage - 1;
                this.showPage(this.currentPage - 1);
            }

        }

        this.next = function() {
            if (this.currentPage < this.pages) {

                currentShowedPage = this.currentPage + 1;
                this.showPage(this.currentPage + 1);
            }
        }

        this.init = function() {
            var rows = document.getElementById(tableName).rows;
            var records = (rows.length - 1);
            this.pages = Math.ceil(records / itemsPerPage);
            this.inited = true;
        }
        this.showPageNav = function(pagerName, positionId) {
            if (! this.inited) {
                alert("not inited");
                return;
            }
            var element = document.getElementById(positionId);
            var pagerHtml = '<ul ><a style="border: 1px solid #e2e2e2;" onclick="' + pagerName + '.prev();" class="pg-normal">'+'<b>&lt;</b></a></li> ';
            for (var page = 1; page <= this.pages; page++)
                pagerHtml += '<li ><a  id="pg' + page + '" class="pg-normal" onclick="' + pagerName + '.showPage(' + page + ');">' + page + '</a></li>';
            pagerHtml += '<li><a style="border: 1px solid #e2e2e2;" onclick="'+pagerName+'.next();" class="pg-normal">'+'<b>&gt;</b></a></li></ul>';

            element.innerHTML = pagerHtml;
        }
    }
    var pager = new Pager('products_tbl', showedItems);
    pager.init();
    pager.showPageNav('pager', 'productsPageNav');
    pager.showPage(currentShowedPage);
    function executionPageNation()
    {
        pager.showPageNav('pager', 'productsPageNav');
        pager.showPage(currentShowedPage);
    }
</script>