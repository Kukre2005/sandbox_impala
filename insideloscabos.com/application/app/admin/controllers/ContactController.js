app.controller('ContactController', function (env,$window, $scope, $rootScope, $http, $filter, $state, $stateParams, $location, dataFactory, localStorageService, constantData) {

    var page = 1;
    var searchValue = '';
    $scope.ids = [];
    $scope.deleteBtn = true;
    $scope.msg = "";

    $scope.contacts = {};
    $scope.btnName = "Save";
    $scope.coupons = {};
    $scope.hotels=[];
    $scope.init = function ()
    {
        var postParam = {
            start: 0,
            limit: 10
        };
        $scope.isLoading = true;
        dataFactory.httpRequest('/admin/hotels', 'POST', '', postParam).then(function (response) {
            $scope.hotels = response.dataList;
            $scope.isLoading = false;
        },function(error){
            alert(error);
        });
    
        $scope.contactServer = function (tableState) {
            console.log("tablestate", tableState);
            $scope.isLoading = true;
            $scope.tableState = tableState;
            var pagination = tableState.pagination;

            var start = pagination.start || 0;     // This is NOT the page number, but the index of item in the list that you want to use to display the table.
            var number = pagination.number || 10;  // Number of entries showed per page.

            var postParam = tableState;
            dataFactory.httpRequest('/admin/booking/getContact', 'POST', '', postParam).then(function (response) {
                $scope.contacts = response.dataList;
                tableState.pagination.numberOfPages = response.totalPages;//set the number of pages so the pagination can update
                $scope.isLoading = false;
            });

        };

    }

    $scope.typeData = ['price', 'percent'];
    $scope.editCoupon = function (myData)
    {

        if (myData)
        {
            var cData = {};
            angular.copy(myData, cData);
            $scope.formData = cData;
            $scope.btnName = "Update";
            $scope.cancelShow = true;
            $window.scrollTo(0, 0);
        }
    }
    $scope.cancelUpdate = function () {
        $scope.formData = {};
        $scope.btnName = "Save";
        $scope.cancelShow = false;
    }
    $scope.validationOptions = {
        rules: {
            code: {
                required: true,
                minlength: 3
            },
            type: {
                required: true,
            },
            discountCost: {
                required: true,
                number: true
            }
        },
        messages: {
            code: {
                required: "Please enter coupon code"
            },
            type: {
                required: "Please select type"
            },
            discountCost: {
                required: "Please enter coupon cost"
            }
        }
    }
    $scope.successDiv = false;
    $scope.msg = "";
    $scope.addEditCoupon = function (form)
    {

        if (form.validate())
        {

            var postData = $scope.formData;
            $scope.isLoading = true;
            dataFactory.httpRequest("/admin/booking/addEditCoupon", "POST", {}, postData).then(function (response) {
                console.log("response", response);
                $scope.isLoading = false;
                var respType = (response.status == 200) ? "success" : "error";
                if (response.status == 200)
                {
                    $scope.cancelShow = false;
                    $scope.btnName = "Save";
                    $scope.formData = {};
                    $scope.initCoupon();
                }
                $rootScope.showMsg(respType, response.message, "#formRow2");

            });

        }
    }



    $scope.deleteContact = function () {
        if ($scope.selected.length > 0)
        {
            if (confirm("Are you sure you want to delete?"))
            {
                $scope.isLoading = true;
                var pParam = {'ids': $scope.selected};
                dataFactory.httpRequest('/admin/booking/deleteContact', 'POST', '', pParam).then(function (response) {
                    $scope.isLoading = false;
                    var respType = (response.status == 200) ? "success" : "error";
                    $rootScope.showMsg(respType, response.message, "#formRow");
                    $rootScope.selected = [];
                    $scope.contactServer($scope.tableState);
                    
                });
            }
        } else {
            alert("Please select atleast one record to delete");
        }
    }
    $scope.contacts = {};


    $scope.activeData = ["Inactive", "Active"];
    $scope.initCoupon = function ()
    {


        $scope.isLoading = true;
        var start = 0;     // This is NOT the page number, but the index of item in the list that you want to use to display the table.
        var number = 1;  // Number of entries showed per page.
        var page = (start == 0) ? 1 : number / start;
        var postParam = {
            start: start,
            limit: number

        };
        if ($state.params.actId)
        {
            postParam.actId = actId;
        }
        var u = "booking/getCoupons";

        dataFactory.httpRequest('/admin/' + u, 'POST', '', postParam).then(function (response) {
            $scope.coupons = response.dataList;
            $scope.isLoading = false;
        }, function (error) {
            alert(error);
        });
//        service.getPage(start, number, tableState).then(function (result) {
//            ctrl.displayed = result.data;
//            tableState.pagination.numberOfPages = result.numberOfPages;//set the number of pages so the pagination can update
//            ctrl.isLoading = false;
//        });
    };
$scope.myselect = true;

    $scope.deleteCoupon = function () {
        if ($scope.selected.length > 0)
        {
            if (confirm("Are you sure you want to delete?"))
            {
                $scope.isLoading = true;
                var pParam = {'ids': $scope.selected};
                dataFactory.httpRequest('/admin/booking/deleteCoupons', 'POST', '', pParam).then(function (response) {
                    $scope.isLoading = false;
                    var respType = (response.status == 200) ? "success" : "error";
                    $rootScope.showMsg(respType, response.message, "#formRow");
                    $scope.initCoupon();
                    $rootScope.selected = [];
                    
                   
                });
            }
        } else {
            alert("Please select atleast one record to delete");
        }
    }
 $scope.initSubscribe = function ()
    {
  $scope.subscribeServer = function (tableState) {
            console.log("tablestate", tableState);
            $scope.isLoading = true;
            $scope.tableStateSubscribe = tableState;
            var pagination = tableState.pagination;

            var start = pagination.start || 0;     // This is NOT the page number, but the index of item in the list that you want to use to display the table.
            var number = pagination.number || 10;  // Number of entries showed per page.

            var postParam = tableState;
            dataFactory.httpRequest('/admin/blog/getSubscribe', 'POST', '', postParam).then(function (response) {
                $scope.subscribes = response.dataList;
                tableState.pagination.numberOfPages = response.totalPages;//set the number of pages so the pagination can update
                $scope.isLoading = false;
            });

        };
    }
  $scope.deleteSubscribe = function () {
        if ($scope.selected.length > 0)
        {
            if (confirm("Are you sure you want to delete?"))
            {
                $scope.isLoading = true;
                var pParam = {'ids': $scope.selected};
                dataFactory.httpRequest('/admin/blog/deleteSubscribe', 'POST', '', pParam).then(function (response) {
                    $scope.isLoading = false;
                    var respType = (response.status == 200) ? "success" : "error";
                    $rootScope.showMsg(respType, response.message, "#formRow");
                    $rootScope.selected = [];
                    $scope.subscribeServer($scope.tableStateSubscribe);
                });
            }
        } else {
            alert("Please select atleast one record to delete");
        }
    }
    $scope.subscribes = {};

});


