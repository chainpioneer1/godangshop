<!-- BEGIN CONTENT -->

<!--itbh comment : sorting faqs-->

<script type="text/javascript">
    var people, asc1 = 1,
        asc2 = 1,
        asc3 = 1;
    window.onload = function () {
        people = document.getElementById("itbh-faqs-tbody");
    }

    function sort_table(tbody, col, asc) {
        var rows = tbody.rows,
            rlen = rows.length,
            arr = new Array(),
            i, j, cells, clen;
        // fill the array with values from the table
        for (i = 0; i < rlen; i++) {
            cells = rows[i].cells;
            clen = cells.length;
            arr[i] = new Array();
            for (j = 0; j < clen; j++) {
                arr[i][j] = cells[j].innerHTML;
            }
        }
        // sort the array by the specified column number (col) and order (asc)
        arr.sort(function (a, b) {
            return (a[col] == b[col]) ? 0 : ((a[col] > b[col]) ? asc : -1 * asc);
        });
        // replace existing rows with new rows created from the sorted array
        for (i = 0; i < rlen; i++) {
            rows[i].innerHTML = "<td>" + arr[i].join("</td><td>") + "</td>";
        }
    }
</script>

<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="min-height: 1305px;">

        <h1 class="page-title"> <?php echo($this->lang->line('faq_list'));?>
            <small></small>
        </h1>

        <?php $success = $this->session->flashdata("success");?>
        <?php if( !empty( $success ) ) : ?>
            <div class="custom-alerts alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="font-size: 36px; width: 36px; height: 36px; color: red; ">&times;</button>
                <?= $success ?>
            </div>

        <?php endif; ?>

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet light bordered">
                    
                    <div class="portlet-body">
                        <div class="table-toolbar">
                            <div class="row">
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-6" >
                                    <div class="btn-group pull-right" style="padding-right: 100px;">
                                        <a href="<?= base_url('admin/faqs/add') ?>"><i class="fa fa-plus"> </i><?php echo($this->lang->line('add_new'));?>
                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <table class="table table-responsive table-bordered table-hover" id="faqs_tbl">
                            <thead>
                            <tr>
                                <th onclick="sort_table(people, 0, asc1); asc1 *= -1; asc2 = 1; asc3 = 1;"> <?php echo($this->lang->line('faq_title_english'));?> </th>
                                <th onclick="sort_table(people, 0, asc1); asc1 *= -1; asc2 = 1; asc3 = 1;"> <?php echo($this->lang->line('faq_title_thai'));?> </th>
                                <th onclick="sort_table(people, 1, asc2); asc2 *= -1; asc1 = 1; asc3 = 1;"> <?php echo($this->lang->line('faq_rank'));?></th>
                                <th > <?php echo($this->lang->line('faq_description_english'));?></th>
                                <th > <?php echo($this->lang->line('faq_description_thai'));?></th>
                                <th onclick="sort_table(people, 2, asc3); asc3 *= -1; asc2 = 1; asc1 = 1;"> <?php echo($this->lang->line('registered_date'));?></th>
                                <th style="width: 20%;"> <?php echo($this->lang->line('action'));?></th>
                            </tr>
                            </thead>
                            <tbody id="itbh-faqs-tbody">
                            <?php
                            $root_faqs = $this->faqs_m->get_faq();
                            echo $controller->print_faqs( $root_faqs, 0 );
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

                <div class="row" style="padding-bottom: 12px;">
                    <div class="col-lg-offset-8 col-lg-4 products-pagination" id="ordersPageNav"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->


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
    var pager = new Pager('faqs_tbl', showedItems);
    pager.init();
    pager.showPageNav('pager', 'ordersPageNav');
    pager.showPage(currentShowedPage);
    function executionPageNation()
    {
        pager.showPageNav('pager', 'ordersPageNav');
        pager.showPage(currentShowedPage);
    }
</script>