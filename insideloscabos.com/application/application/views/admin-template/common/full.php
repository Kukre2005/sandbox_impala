<!-- Navbar -->
<!--<div ng-include="'common/navbar.html'"></div>-->
<?php  $this->load->view("admin-template/common/navbar.html");?>
<div class="app-body">
    <!-- Navigation -->
<!--    <div ng-include="common/sidebar-nav.html'"></div>-->
<?php  $this->load->view("admin-template/common/sidebar-nav.html");?>
    <!-- Main content -->
    <main class="main">

        <!-- Breadcrumb -->
        <ol class="breadcrumb" breadcrumb>
            <ncy-breadcrumb></ncy-breadcrumb>

            <!-- Breadcrumb Menu-->
<!--            <li class="breadcrumb-menu">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a class="btn btn-secondary" href="#"><i class="icon-speech"></i></a>
                    <a class="btn btn-secondary" ui-sref="app.main"><i class="icon-graph"></i> &nbsp;Dashboard</a>
                    <a class="btn btn-secondary" ui-sref="app.main"><i class="icon-settings"></i> &nbsp;Settings</a>
                </div>
            </li>-->

        </ol>

        <div class="container-fluid">
            <ui-view></ui-view>
        </div>
        <!-- /.conainer-fluid -->
    </main>


    <!-- Aside Menu -->
<!--    <div ng-include="'common/aside.html'"></div>-->

</div>

<!-- Footer -->
<!--<div ng-include="'common/footer.html'"></div>-->
<?php  $this->load->view("admin-template/common/footer.html");?>
