
                <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">


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
                                                <div class="btn-group pull-right">
                                                    <a class="btn sbold green"> <?php echo('&nbsp;');?>
                                                        <i ></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-responsive" style="border: none !important;" id="orders_tbl">
                                        <thead>
                                        <tr>
                                            <th><?php echo($this->lang->line('order_number'));?> </th>
                                            <th> <?php echo($this->lang->line('date'));?> </th>
                                            <th> <?php echo($this->lang->line('total'));?> </th>
                                            <th> <?php echo($this->lang->line('status'));?> </th>
                                            <th> </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        echo $controller->print_orders( $orders_data);
                                        ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <?php
                            if (!empty($orders_data) > 0) {
                                echo ('<div class="row" style="padding-bottom: 12px;">
                                    <div class="col-lg-offset-8 col-lg-4 products-pagination" id="ordersPageNav"></div>
                                </div>');
                            }
                            ?>


                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
                    var currentShowedPage = 1;
                    var showedItems = 22;
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
                    var pager = new Pager('orders_tbl', showedItems);
                    pager.init();
                    pager.showPageNav('pager', 'ordersPageNav');
                    pager.showPage(currentShowedPage);
                    function executionPageNation()
                    {
                        pager.showPageNav('pager', 'ordersPageNav');
                        pager.showPage(currentShowedPage);
                    }
                </script>