<div class="main-content">
    <div class="container itbh-container" style="margin-top: 30px">
        <div class="row">

            <div class="col-md-12">
                <p style="font-weight: bold; font-size: 24px"><?= $this->lang->line('thank_you') . ' ' . $this->lang->line('your_order_has_been_received') ?></p>
            </div>
            <div class="col-md-12">
                <table class="table table-responsive" id="carts_products_tbl">
                    <thead>
                    <tr>
                        <th style="padding: 45px;"><?php echo($this->lang->line('ordernumber')); ?></th>
                        <th style="padding: 45px;"> <?php echo($this->lang->line('date')); ?></th>
                        <th style="padding: 45px;"> <?php echo($this->lang->line('total')); ?></th>
                    </tr>
                    </thead>
                    <tbody id="itbh-seller-products-tbody">
                    <tr>
                        <td style="padding: 45px;"><?php echo $order_number ?></td>
                        <td style="padding: 45px;"> <?php echo $date?> </td>
                        <td style="padding: 45px;"> <?php echo $total?> </td>
                    </tr>


                    </tbody>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10">
                <p style="text-align: center">
                    <?php echo $this->lang->line('thank_you_msg')?>
                </p>
            </div>
        </div>
    </div>
</div>
</div>

<script>

</script>
