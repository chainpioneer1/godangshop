<style>
    .page-404 .number {
        top: 0px;
    }
</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content" style="min-height: 1305px;">

        <div class="row">
            <div class="col-md-12 page-404">
                <div class="number font-green"> 403 </div>
                <div class="details">
                    <h3><?=$this->lang->line('oops');?></h3>
                    <p> <?=$this->lang->line('can_not_access_login_with_admin');?>
                        <br/>
                        <a href="<?= base_url('site/index') ?>"> <?=$this->lang->line('return_home');?> </a> </p>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->


