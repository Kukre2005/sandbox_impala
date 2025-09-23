<head>
        <meta charset="utf-8">
        <!-- Viewport Meta Tag -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $metaTitle;?></title>
        <meta name="keywords" content="<?php echo $metaKeywords;?>">
        <meta name="description" content="<?php echo $metaContent;?>">
        <link rel="icon" type="image/png" href="<?php echo base_url('assets/favicon.ico')?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome.min.css')?>">
        <!-- Bootstrap -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css')?>">
        <!-- Main Style -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/slick.css')?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/slick-theme.css')?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/main.css')?>">
        <!-- Responsive Style -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/custom.css')?>">
        <!--Fonts-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" media="screen" href="<?php echo base_url('assets/fonts/simple-line-icons.css')?>">    

        <!-- Extras -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/extras/owl/owl.carousel.css')?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/extras/owl/owl.theme.css')?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/extras/normalize.css')?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/extras/settings.css')?>">

        <!-- Color CSS Styles  -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/colors/green.css')?>" media="screen" />  
        <!-- jQuery Load -->
        <script src="<?php echo base_url('assets/js/jquery-min.js') ?>"></script>
        <!-- Bootstrap JS -->
        <?php if(isset($isHOME) && $isHOME == 'yes'){ ?>
            <script src="<?php echo base_url('assets/js/new-bs/bootstrap.min.js') ?>"></script>
        <?php }else{ ?>
            <script src="<?php echo base_url('assets/js/utils.js') ?>"></script>
            <script src="<?php echo base_url('assets/js/tether.min.js') ?>"></script>
            <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>
            <script src="<?php echo base_url('assets/js/lightbox.min.js') ?>"></script>
        <?php } ?>
    </head>
   