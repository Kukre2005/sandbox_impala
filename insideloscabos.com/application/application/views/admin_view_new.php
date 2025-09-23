<html lang="en" >

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Admin Panel - <?php echo SITE_NAME; ?>">
        <meta name="author" content="Admin Panel - <?php echo SITE_NAME; ?>">
        <meta name="keyword" content="Admin Panel - <?php echo SITE_NAME; ?>">
        <link rel="shortcut icon" href="img/favicon.png">

        <title>Admin Panel - <?php echo SITE_NAME; ?></title>

        <!-- Main styles for this application -->
        <link href="<?php echo base_url('assets/admin/css/style.css') ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url('assets/admin/js/chosen/chosen.css') ?>" rel="stylesheet" type="text/css">
          <style type="text/css">
        .bs-example {
            position: relative;
            padding: 45px 15px 15px;
            margin: 0 -15px 15px;
            background-color: #fafafa;
            box-shadow: inset 0 3px 6px rgba(0, 0, 0, .05);
            border-color: #e5e5e5 #eee #eee;
            border-style: solid;
            border-width: 1px 0;
        }

        .bs-example:after {
            content: "Example";
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 12px;
            font-weight: 700;
            color: #bbb;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .highlight {
            padding: 9px 14px;
            margin-bottom: 14px;
            background-color: #f7f7f9;
            border: 1px solid #e1e1e8;
            border-radius: 4px;
        }

        .bs-example+.highlight {
            margin: -15px -15px 15px;
            border-radius: 0;
            border-width: 0 0 1px;
        }

        @media (min-width: 768px) {
            .bs-example {
                margin-left: 0;
                margin-right: 0;
                background-color: #fff;
                border-width: 1px;
                border-color: #ddd;
                border-radius: 4px 4px 0 0;
                box-shadow: none;
            }
            .bs-example+.highlight {
                margin-top: -16px;
                margin-left: 0;
                margin-right: 0;
                border-width: 1px;
                border-bottom-left-radius: 4px;
                border-bottom-right-radius: 4px;
            }
        }

        .dn-timepicker-popup {
            max-height: 300px;
            overflow-y: scroll;
        }
    </style>
    </head>


    <body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden" ng-app="myapp">

        <!-- User Interface -->
    <ui-view></ui-view>

    <!-- Bootstrap and necessary plugins -->
    <script src="<?php echo base_url('assets/admin/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/bower_components/tether/dist/js/tether.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    

    <!-- AngularJS -->
    <script src="<?php echo base_url('assets/admin/bower_components/angular/angular.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/angular-js/angular-animate.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/bower_components/angular-modal-service/dst/angular-modal-service.min.js'); ?>"></script>
    <!-- AngularJS plugins -->
    <script src="<?php echo base_url('assets/admin/bower_components/angular-ui-router/release/angular-ui-router.js'); ?>"></script>
<!--     <script src="<?php echo base_url('assets/admin/js/angular-js/angular-ui-router.js'); ?>"></script>-->
    <script src="<?php echo base_url('assets/admin/bower_components/oclazyload/dist/ocLazyLoad.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/bower_components/angular-breadcrumb/dist/angular-breadcrumb.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/bower_components/angular-loading-bar/build/loading-bar.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/bower_components/smart-table/smart-table.js'); ?>"></script>

  
    
    <script src="<?php echo base_url('assets/admin/js/chosen/chosen.jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/chosen/angular-chosen.js'); ?>"></script>

    <script src="<?php echo base_url('assets/admin/js/angular-js/angular-resource.js') ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/angular-js/angular-sanitize.js') ?>"></script>
    <script type='text/javascript' src="<?php echo base_url('assets/admin/js/angular-js/angular-mocks.js') ?>"></script>



    <script src="<?php echo base_url('assets/admin/js/jquery/jquery.validate.js') ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/jquery/additional-methods.js') ?>"></script>
    <script src="<?php echo base_url('assets/admin/js/angular-js/angular-validate.js') ?>"></script>
    <!-- AngularJS CoreUI App scripts -->

    <script src="<?php echo base_url('app/admin/app.js'); ?>"></script>
    <script src="<?php echo base_url('app/admin/config.js'); ?>"></script>
    <script src="<?php echo base_url('app/admin/routes.js'); ?>"></script>


    <!-- concatenated flow.js + ng-flow libraries -->

    <script src="<?php echo base_url('app/services/myServices.js') ?>"></script>
    <script src="<?php echo base_url('app/services/angular-sessionstorage.js') ?>"></script>
    <script src="<?php echo base_url('app/services/angular-local-storage.js') ?>"></script>
    <script src="<?php echo base_url('app/admin/directives.js'); ?>"></script>
    <script src="<?php echo base_url('app/helper/myHelper.js') ?>"></script>
    
    <script src="<?php echo base_url('assets/admin/js/ckeditor/ckeditor.js') ?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/admin/js/angular-js/ng-ckeditor/ng-ckeditor.js') ?>"  type="text/javascript"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/js/angular-js/ng-ckeditor/ng-ckeditor.css') ?>" type="text/css"/>
    <!-- App Controller -->
    <script src="<?php echo base_url('app/admin/controllers/ModalController.js') ?>"></script>
    <script src="<?php echo base_url('app/admin/controllers/LoginController.js') ?>"></script>
    <script src="<?php echo base_url('app/admin/controllers/AdminController.js') ?>"></script>
    <script src="<?php echo base_url('app/admin/controllers/HotelsController.js') ?>"></script>
    <script src="<?php echo base_url('app/admin/controllers/GroupsController.js') ?>"></script>
    <script src="<?php echo base_url('app/admin/controllers/ActivityController.js') ?>"></script>
    <script src="<?php echo base_url('app/admin/controllers/BookingController.js') ?>"></script>
    <script src="<?php echo base_url('app/admin/controllers/BlogController.js') ?>"></script>
    <script src="<?php echo base_url('app/admin/controllers/ContactController.js') ?>"></script>
    <script src="<?php echo base_url('app/admin/controllers/QuoteController.js') ?>"></script>
    <script src="<?php echo base_url('app/admin/controllers/AboutController.js') ?>"></script>
    <script src="<?php echo base_url('app/admin/controllers/qaController.js') ?>"></script>
    <script src="<?php echo base_url('app/admin/controllers/DiscountController.js') ?>"></script>
    <script src="<?php echo base_url('app/admin/controllers/FestiveDiscountController.js') ?>"></script>
    <script src="<?php echo base_url('app/admin/controllers/FestiveDiscountContentController.js') ?>"></script>
    <script src="<?php echo base_url('app/admin/controllers/GalleryController.js') ?>"></script>
    <script src="<?php echo base_url('app/admin/controllers/TestimonialController.js') ?>"></script>


    <!-- Include Required Prerequisites -->
    <script type="text/javascript" src="<?php echo base_url('assets/admin/js/daterangepicker/moment.min.js') ?>"></script>
     
    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="<?php echo base_url('assets/admin/js/daterangepicker/daterangepicker.js') ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/admin/js/daterangepicker/daterangepicker.css') ?>" />
 
</body>

</html>
