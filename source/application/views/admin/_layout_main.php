<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">

<?php $this->load->view("admin/components/page_header"); ?>
<?php $this->load->view($subcss); ?>

<body class="page-header-fixed page-sidebar-closed-hide-logo page-content-white">
<div class="page-wrapper">
    <?php $this->load->view("admin/components/page_topbar"); ?>

    <!-- BEGIN HEADER & CONTENT DIVIDER -->
    <div class="clearfix"> </div>
    <!-- END HEADER & CONTENT DIVIDER -->
    <!-- BEGIN CONTAINER -->
    <div class="page-container">

        <?php $this->load->view("admin/components/page_menu"); ?>

        <?php $this->load->view($subview); ?>

<!--        --><?php //$this->load->view("admin/components/page_quickside"); ?>

    </div>
    <!-- END CONTAINER -->

    <?php $this->load->view("admin/components/page_footer"); ?>
</div>

<?php $this->load->view("admin/components/page_endscript"); ?>
<?php $this->load->view($subscript); ?>
</body>
</html>










