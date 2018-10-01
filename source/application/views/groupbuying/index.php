<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="min-height: 1305px;">

        <h1 class="page-title"> <?php echo($this->lang->line('product_category'));?>
            <small></small>
        </h1>

        <?php $success = $this->session->flashdata("success");?>
        <?php if( !empty( $success ) ) : ?>
            <div class="custom-alerts alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
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
                                        <a href="<?= base_url('admin/categories/add') ?>" class="btn sbold green"> <?php echo($this->lang->line('add_new'));?>
                                            <i class="fa fa-plus"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table class="table table-responsive table-bordered table-hover" id="categaories_tbl">
                            <thead>
                            <tr>
                                <th> <?php echo($this->lang->line('name'));?> </th>
                                <th> <?php echo($this->lang->line('slug'));?> </th>
                                <th> <?php echo($this->lang->line('description'));?> </th>
                                <th> <?php echo($this->lang->line('action'));?> </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $root_cats = $this->categories_m->get_where(array('parent_id'=>0));
                            echo $controller->print_cats( $root_cats, 0 );
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->


