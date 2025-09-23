<html lang="en">
    <head>
        <title>Admin Panel</title>

        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">

        <script src="<?php echo base_url('assets/js/jquery/jquery.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery/bootstrap.min.js') ?>"></script>

        <!-- Angular JS -->
        <script src="<?php echo base_url('assets/js/angular-js/angular.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/angular-js/angular-route.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/angular-js/angular-resource.js') ?>"></script>
        <script type='text/javascript' src="<?php echo base_url('assets/js/angular-js/angular-mocks.js') ?>"></script>

        <!-- contains the angularjs-crypt http interceptor named cryptoHttpInterceptor-->
        <script type='text/javascript' src="<?php echo base_url('app/packages/cryptojs/lib/plugins/CryptoJSCipher.js') ?>"></script>
        <script type='text/javascript' src="<?php echo base_url('app/packages/cryptojs/lib/angularjs-crypto.js') ?>"></script>
        <!-- cryptojs aes files -->
        <script type='text/javascript' src="<?php echo base_url('app/packages/cryptojs/cryptojs/rollups/aes.js') ?>"></script>
        <script type='text/javascript' src="<?php echo base_url('app/packages/cryptojs/cryptojs/components/mode-ecb.js') ?>"></script>

        <script src="<?php echo base_url('assets/js/ui-bootstrap-tpls-2.1.3.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/jquery/jquery.validate.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/angular-js/angular-validate.js') ?>"></script>
        <!-- MY App -->
        <script src="<?php echo base_url('app/packages/dirPagination.js') ?>"></script>
        <!-- concatenated flow.js + ng-flow libraries -->
        <script src="<?php echo base_url('assets/js/ng-flow/ng-flow-standalone.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/js/ng-flow/dist/ng-flow.min.js') ?>"></script>
        <script src="<?php echo base_url('app/admin-routes.js') ?>"></script>
<!--      <script src="<?php echo base_url('app/flow-config.js') ?>"></script>-->
       <script src="<?php echo base_url('app/services/cryptoServices.js') ?>"></script>
        <script src="<?php echo base_url('app/services/myServices.js') ?>"></script>
        

        <script src="<?php echo base_url('app/directive.js') ?>"></script>
        <script src="<?php echo base_url('app/helper/myHelper.js') ?>"></script>

        <!-- App Controller -->
        <script src="<?php echo base_url('app/controllers/admin/LoginController.js') ?>"></script>
        <script src="<?php echo base_url('app/controllers/admin/AdminController.js') ?>"></script>
        <script src="<?php echo base_url('app/controllers/admin/ItemController.js') ?>"></script>
        <script src="<?php echo base_url('app/controllers/admin/CatController.js') ?>"></script>
        <script src="<?php echo base_url('app/controllers/admin/ModalInstanceCtrl.js') ?>"></script>
        <script src="<?php echo base_url('app/controllers/admin/ProductController.js') ?>"></script>
    </head>
    <body ng-app="main-App">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#/">Admin Panel</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="#/" ng-show="authenticated">Home</a></li>
                        <li><a href="#/login" ng-hide="authenticated">Login</a></li>
                        <li><a href="#/categorys" ng-show="authenticated">Category</a></li>
                        <li><a href="#/products" ng-show="authenticated">Products</a></li>
                        <li><a href="" ng-show="authenticated" ng-controller="AdminController" ng-click="logOut()">Logout</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <div route-loader class="spinner" ng-show="loading"><img src="<?php echo base_url('assets/images/loading.gif') ?>"></div>
            <ng-view></ng-view>
        </div>

    </body>
</html>
