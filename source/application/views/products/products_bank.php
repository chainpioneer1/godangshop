
<div class="main-content">
    <div class="container itbh-container" style="margin-top: 30px">
        <div class="row">

            <div class="col-lg-offset-8 col-lg-3 col-md-offset-8 col-md-3 col-sm-offset-4 col-sm-6 col-xs-offset-1 col-xs-10" style="margin-bottom: 30px;">
                <select class="bs-select form-control" name="parent_category" id="parent_category">
                    <?php

                    if (($this->session->userdata('lang')) == '' ){
                        $lang_tmp = 'english';
                    } else {
                        $lang_tmp = $this->session->userdata('lang');
                    }
                    $tmp1 = 'name_'.$lang_tmp;
                    $tmp2 = 'product_name_'.$lang_tmp;
                    foreach( $categories as $cat ) : ?>
                        <option value="<?= $cat->cat_id ?>"><?= $cat->$tmp1 ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-offset-1 col-lg-10 col-md-offset-1 col-md-10 col-sm-offset-1 col-sm-10 col-xs-offset-1 col-xs-10">
                <table  id="list_products_tbl" style="border: none;width: 100%;">
                    <tbody>
                        <?php
                            $products = $this->products_m->get_product();
                            echo ($controller->print_products_bank($products));
                        ?>

                    </tbody>
                </table>
                <div class="row" style="padding-bottom: 12px;">
                    <div class="col-lg-offset-8 col-lg-4 products-pagination" id="productsPageNav"></div>
                </div>
            </div>
            <div style="margin-top: 30px;"></div>


        </div>


</div>
</div>


<script>
    var currentShowedPage = 1;
    var showedItems = 10;
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
    var pager = new Pager('list_products_tbl', showedItems);
    pager.init();
    pager.showPageNav('pager', 'productsPageNav');
    pager.showPage(currentShowedPage);
    function executionPageNation()
    {
        pager.showPageNav('pager', 'productsPageNav');
        pager.showPage(currentShowedPage);
    }
</script>

<script>
    $(document).ready(function(){
        $('#parent_category').change(function(){
            var category_id = $('#parent_category').val();
            $.ajax({
                type: "POST",
                url : "<?php echo base_url();?>/products/get_products_bank",
                data: {category_id : category_id } ,
                dataType: "text" ,
                cache : false ,
                success :
                    function(data){
                        $('#list_products_tbl').html(data);

                    }
            });
            return false;
        });
    });
</script>