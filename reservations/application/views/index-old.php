<html>
    <head>
        <title>Eshop a Flat E-Commerce Bootstrap Responsive Website Template | Home :: w3layouts</title>

        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url('assets/front/css/bootstrap.css') ?>">

        <script src="<?php echo base_url('assets/front/js/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/front/js/bootstrap.min.js') ?>"></script>

        <!-- Angular JS -->
        <script src="<?php echo base_url('assets/js/angular.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/angular-route.min.js') ?>"></script>

        <script src="<?php echo base_url('assets/js/ui-bootstrap-tpls-2.1.3.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery/jquery.validate.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/angular-validate.js') ?>"></script>
        <link href="<?php echo base_url('assets/front/css/bootstrap.css') ?>" rel='stylesheet' type='text/css' />
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

        <!-- Custom Theme files -->
        <link href="<?php echo base_url('assets/front/css/style.css'); ?>" rel="stylesheet" type="text/css" media="all" />
        <!-- Custom Theme files -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="keywords" content="Eshop Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
              Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!--webfont-->
        <!-- for bootstrap working -->
        <script type="text/javascript" src="<?php echo base_url('/assets/front/js/bootstrap-3.1.1.min.js') ?>"></script>
        <!-- //for bootstrap working -->
        <!-- cart -->
        <script src="<?php echo base_url('/assets/front/js/simpleCart.min.js') ?>"></script>
        <!-- cart -->
        <link rel="stylesheet" href="<?php echo base_url('/assets/front/css/flexslider.css') ?>" type="text/css" media="screen" />
        <!-- MY App -->
        <script src="app/packages/dirPagination.js"></script>
        <script src="app/routes.js"></script>
        <script src="app/services/myServices.js"></script>
        <script src="app/directive.js"></script>
        <script src="app/helper/myHelper.js"></script>

        <!-- App Controller -->

        <script src="app/controllers/FrontController.js"></script>
        <script src="app/controllers/LoginController.js"></script>

    </head>
    <body ng-app="main-App">
        <div ng-include="'templates/header.html'"></div>

        <div class="container" id="loadPage">
            <ng-view></ng-view>
        </div>
        <div ng-include="'templates/footer.html'"></div>      
    </body>
</html>
