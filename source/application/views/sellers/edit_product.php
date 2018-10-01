



<div class="col-lg-9 itbh-sellers-products">
    <?php $success = $this->session->flashdata("success");
    if (($this->session->userdata('lang')) == '' ){
        $lang_tmp = 'english';
    } else {
        $lang_tmp = $this->session->userdata('lang');
    }
    $tmp1 = 'name_'.$lang_tmp;
    $tmp2 = 'product_name_'.$lang_tmp;
    ?>
    <?php if( !empty( $success ) ) : ?>
        <div class="custom-alerts alert alert-success fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="font-size: 36px; width: 36px; height: 36px; color: red; ">&times;</button>
            <?= $success ?>
        </div>
    <?php endif; ?>
    <div class="page-content" style="min-height: 1305px;">
        <h3 class="page-title"> <?php echo($this->lang->line('edit_product'));?>
            <small></small>
        </h3>
        <form action="<?= base_url('sellers/edit_product/' . $product_data->product_id) ?>" class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <div class="col-md-5">
                    <label class="control-label" for="parent_category"><?php echo($this->lang->line('categories'));?></label>
                    <select class="bs-select form-control" name="parent_category" id="parent_category">
                        <?php foreach( $products_primary_categories as $cat ) : ?>
                            <option value="<?= $cat->cat_id ?>"><?= $cat->$tmp1 ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('parent_category', '<span class="form-error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5">
                    <label class="control-label" for="sub_category"><?php echo($this->lang->line('sub_category'));?></label>
                    <select class="bs-select form-control" name="sub_category" id="sub_category">
                        <option ></option>
                    </select>
                    <?php echo form_error('sub_category', '<span class="form-error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5">
                    <label class="control-label" for="product_name_english"><?php echo($this->lang->line('product_name_english'));?><span style="color: red;">*</span></label>
                    <input type="text" required class="form-control" value="<?=$product_data->product_name_english;?>" name="product_name_english" id="product_name_english" />
                    <?php echo form_error('product_name_english', '<span class="form-error">', '</span>'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-5">
                    <label class="control-label" for="product_name_thai"><?php echo($this->lang->line('product_name_thai'));?><span style="color: red;">*</span></label>
                    <input type="text" required class="form-control" value="<?=$product_data->product_name_thai;?>" name="product_name_thai" id="product_name_thai" />
                    <?php echo form_error('product_name_thai', '<span class="form-error">', '</span>'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-5">
                    <label class="control-label" for="market_price"><?php echo($this->lang->line('market_price'));?><span style="color: red;">*</span></label>
                    <input type="number" required class="form-control" name="market_price" id="market_price" value="<?=$product_data->market_price;?>" />
                    <?php echo form_error('market_price', '<span class="form-error">', '</span>'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-5">
                    <label class="control-label" for="regular_price"><?php echo($this->lang->line('price'));?><span style="color: red;">*</span></label>
                    <input type="number" required class="form-control" name="regular_price" id="regular_price" value="<?=$product_data->regular_price;?>" />
                    <?php echo form_error('regular_price', '<span class="form-error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5">
                    <label class="control-label" for="sku"><?php echo($this->lang->line('sku'));?><span style="color: red;">*</span></label>
                    <input type="text" required class="form-control" name="sku" id="sku"  value="<?=$product_data->sku;?>" />
                    <?php echo form_error('sku', '<span class="form-error">', '</span>'); ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-5">
                    <label class="control-label" for="sku"><?php echo($this->lang->line('description'));?></label>
                    <textarea class="form-control" name="description" id="description"> <?=$product_data->description;?></textarea>
                    <?php echo form_error('sku', '<span class="form-error">', '</span>'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-5" class="product-specification">
                    <label class="control-label" for="specification"><?=$this->lang->line('specification');?></label>
                    <table class="itbh-sellers-products-specification" style="width: 100%;">
                        <tr style="padding: 20px;">
                            <td style="width:30%;"><input type="text" required name="specification_title[]" placeholder="title" class="product_specification_title"/></td>
                            <td style="width:60%;"><input type="text" required name="specification_content[]" placeholder="content" class="product_specification_content"/></td>
                            <td style="width:10%;"><span class="glyphicon glyphicon-remove itbh-sellers-products-description-remove" ></span></td>
                        </tr>

                    </table>
                    <a style="float:right;" id="itbh-sellers-products-description-add"><?php echo($this->lang->line('add_new'));?></a>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-5">
                    <label class="control-label" for="photo"><?php echo($this->lang->line('photo'));?></label>
                    <input type="file"  name="photo" class="form-control" id="photo" value="<?=$product_data->img_url;?>"/>
                    <?php echo form_error('photo', '<span class="form-error">', '</span>'); ?>
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-5">
                    <label class="control-label" for="documents"><?php echo($this->lang->line('upload_document'));?></label>
                    <input type="file" name="documents[]" multiple class="form-control" id="document" value="<?=$product_data->document_url;?>" />
                    <?php echo form_error('documents', '<span class="form-error">', '</span>'); ?>
                </div>
            </div>



            <div class="form-group">
                <div class="col-md-5" class="product-prices">
                    <label class="control-label" for="itbh-sellers-products-prices"><?=$this->lang->line('price');?></label>
                    <table class="itbh-sellers-products-prices" style="width: 100%;">
                        <tr style="padding: 20px;">
                            <td style="width:30%;"><input name="product_volume[]" type="number" required placeholder="volume" class="product_specification_title"/></td>
                            <td style="width:60%;"><input name="product_price[]" type="number" required placeholder="price" class="product_specification_content"/></td>
                            <td style="width:10%;"><span class="glyphicon glyphicon-remove itbh-sellers-products-price-remove" ></span></td>
                        </tr>
                    </table>
                    <a style="float:right;" id="itbh-sellers-products-price-add"><?php echo($this->lang->line('add_new'));?></a>
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-5">
                    <label class="control-label" for="stock"><?php echo($this->lang->line('stock'));?></label>
                    <input type="number" class="form-control" name="stock" id="stock" value="<?=$product_data->quantity;?>" />
                    <?php echo form_error('stock', '<span class="form-error">', '</span>'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-5" id="add_">
                    <button type="submit" class="btn green btn-primary" style="width:100%; padding: 10px 20px"><?php echo($this->lang->line('save_change'));?></button>
                </div>
            </div>
            <div class="clearfix"></div>
        </form>

        <script>
            function deleteItem(elem){
                var span = $(elem);
                var td = $(span).parent();
                var tr = $(td).parent();
                $(tr).remove();
//                                                $(this).parent().parent().remove();
            }
            $(document).ready(function(){

                $('.itbh-sellers-products-description-remove').click(function () {
                    $(this).parent().parent('tr').remove();
                });

                $('.itbh-sellers-products-price-remove').click(function () {
                    $(this).parent().parent('tr').remove();
                });
                $('#itbh-sellers-products-price-add').click(function () {

                    $('.itbh-sellers-products-prices').append('<tr style="padding: 20px;">' +
                        '<td style="width: 30%;"><input name="product_volume[]" required type="number" placeholder="volume" class="product_specification_title"/></td>' +
                        '<td style="width: 60%;"><input name="product_price[]" required type="number" placeholder="price" class="product_specification_content"/></td>' +
                        '<td style="width: 10%;"><span class="glyphicon glyphicon-remove itbh-sellers-products-price-remove" onclick="deleteItem(this)"></span></td>'  +
                        '</tr>');
                });


                $('#itbh-sellers-products-description-add').click(function () {
                    $('.itbh-sellers-products-specification').append('<tr style="padding: 20px;">' +
                        '<td style="width: 30%;"><input type="text" required name="specification_title[]" placeholder="title" class="product_specification_title"/></td>' +
                        '<td style="width: 60%;"><input type="text" required name="specification_content[]" placeholder="content" class="product_specification_content"/></td>' +
                        '<td style="width: 10%;"><span class="glyphicon glyphicon-remove itbh-sellers-products-price-remove" onclick="deleteItem(this)"></span></td>'  +
                        '</tr>');
                });
            });
        </script>
        <style>
            .product_specification_title {
                margin-bottom: 10px;
                height: 35px;
                margin-right: 10px;;

            }
            .product_specification_content {
                margin-bottom: 10px;
                height: 35px;

            }
            .itbh-sellers-products-description-remove {
                transform: scale(2);
                color:#dd4444;
            }
            .itbh-sellers-products-price-remove {
                transform: scale(2);
                color:#dd4444;
            }
        </style>
    </div>
</div>
</div>
</div>
</div>
</div>


<script>

    $(document).ready(function(){
        var product_sub_Cat = '<?php echo $product_data->sub_category_id; ?>';
        var productCat = '<?php echo $product_data->category_id; ?>';
        function getSubCategories(catId){
            $.ajax({
                type: "POST",
                url : "<?php echo base_url();?>/sellers/get_sub_categories",
                data: {category_id : catId } ,
                dataType: "text" ,
                cache : false ,
                success :
                    function(data){
                        $('#sub_category').html(data);
                        $('#sub_category').find('option').filter(function (){
                            return ( ($(this).val() == product_sub_Cat) || ($(this).text() == product_sub_Cat) )
                        }).prop('selected',true);

                    }
            });
        }
        $('#parent_category').change(function(){
            var category_id = $('#parent_category').val();
            getSubCategories(category_id);
            return false;
        });


        $('#parent_category').find('option').filter(function (){
            return ( ($(this).val() == productCat) || ($(this).text() == productCat) )
        }).prop('selected',true);

        getSubCategories(productCat);






    });


</script>