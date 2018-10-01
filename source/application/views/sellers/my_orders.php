
                <div class="col-lg-9">
                    <?php $success = $this->session->flashdata("success");?>
                    <?php if( !empty( $success ) ) : ?>
                        <div class="custom-alerts alert alert-success fade in">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="font-size: 36px; width: 36px; height: 36px; color: red; ">&times;</button>
                            <?= $success ?>
                        </div>
                    <?php endif; ?>
                    <div class="portlet light bordered">
                        <div class="portlet-body">
                            <div class="table-toolbar">

                                <div class="row">
                                    <div class="col-md-6">
                                        <h3><?=$this->lang->line('order_management');?></h3>
                                    </div>
                                    <div class="col-md-6" >
                                        <div class="btn-group pull-right">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 row">
                                        <div class="col-lg-5">
                                            <input type="date" class="form-control" id="order_date" name="order_date">
                                            </input>
                                        </div>
                                        <div class="col-lg-offset-1 col-lg-5">
                                            <select class="form-control" name="order_status" id="order_status">
                                                <option value="waiting"><?=$this->lang->line('waiting');?></option>
                                                <option value="completed"><?=$this->lang->line('completed');?></option>
                                                <option value="cancelled"><?=$this->lang->line('cancelled');?></option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-md-3 col-lg-offset-1" >
                                        <div class="input-group">
                                            <input type="text" name="order_name" required id="order_name" class="form-control" placeholder="<?=$this->lang->line('search_for_...');?>">
                                              <span class="input-group-btn">
                                                <button class="btn btn-default" type="button" id="search_order_btn">Go!</button>
                                              </span>
                                        </div><!-- /input-group -->
                                    </div>
                                </div>
                            </div>
                            <table class="table table-responsive" id="orders_tbl">
                                <thead>
                                <tr>
                                    <th> <?php echo($this->lang->line('order_id'));?> </th>
                                    <th> <?php echo($this->lang->line('customer'));?> </th>
                                    <th> <?php echo($this->lang->line('amount'));?> </th>
                                    <th> <?php echo($this->lang->line('date_time'));?> </th>
                                    <th> <?php echo($this->lang->line('status'));?></th>
                                </tr>
                                </thead>
                                <tbody id="itbh-my-orders-tbody">
                                <?php
                                $root_orders = $this->seller_orders_m->get_where(array('seller_id'=>$seller_id));
                                echo $controller->print_orders( $root_orders);
                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php if(count($root_orders) > 0) {
                        ?>
                        <div class="row" style="padding-bottom: 12px;">
                            <div class="col-lg-offset-8 col-lg-4 products-pagination" id="ordersPageNav"></div>
                        </div>
                        <?php
                    }?>



                </div>
            </div>
        </div>
    </div>
</div>


<script>
                    $(document).ready(function(){

                        $('#search_order_btn').click(function(){
                            var order_date = ($('#order_date').val());
                            var order_status = ($('#order_status').val());
                            var order_name = $('#order_name').val();
                            $.ajax({
                                type: "POST",
                                url : "<?php echo base_url();?>/sellers/search_order",
                                data: {order_date : order_date , order_status:order_status ,order_name:order_name  } ,
                                dataType: "text" ,
                                cache : false ,
                                success :
                                    function(data){
                                        $('#itbh-my-orders-tbody').html(data);

                                    }
                            });
                            return false;
                        });

                    });
                </script>
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