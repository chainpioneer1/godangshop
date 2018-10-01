<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
    <meta name="viewport" content="initial-scale=1.0, width=device-width" />

    <!-- Style Sheets -->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/hover-min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/animate.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/css-menu.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/owl.carousel.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/loader.css') ?>" />

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/styles.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/responsive.css') ?>">

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/extra.css') ?>">
    <![endif]-->
    <style>
        .form-error{
            color: #f66;
        }
    </style>
</head>
<body>

<div id="wrapper toggled">
    <div>

        <?php $this->load->view($subview); ?>

    </div>
</div>

<script src="<?= base_url('assets/js/wow.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery-1.12.3.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/js/css-menu.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.validate.js') ?>"></script>
<script src="<?= base_url('assets/js/owl.carousel.min.js') ?>"></script>

</body>
</html>

