app.controller('DiscountController', function ($scope,$window, $rootScope,$stateParams, $filter, $state, $location, dataFactory, localStorageService, constantData) {

    var page = 1;
    var searchValue = '';
    $scope.ids = [];
    var type = $stateParams.type;
    $scope.type = $stateParams.type;
    if($scope.type == 'private_transport'){
        $scope.heading = 'Private Transporation';
    }else if($scope.type == 'cabo_shuttle'){
        $scope.heading = 'Cabo Shuttle';
    }else if($scope.type == 'festive_discount'){
        $scope.heading = 'Festive';
    }
    // $scope.heading = $scope.type == 'private_transport'?"Private Transporation":"Cabo Shuttle";
    $scope.discounts = {};
    $scope.deleteBtn = true;
    $scope.msg = "";
    $scope.btnName = "Save";
    $scope.cancelShow = false;
    $scope.formData = {};
    // Declare the array for the selected items
    $scope.itemsPerPage = constantData.ITEMS_PER_PAGE;
    $scope.formData.day = 'Sunday';
    $scope.days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    $scope.activeData = ["Inactive", "Active"];
    $scope.formData.fromTime = "";
    $scope.formData.toTime = "";
    console.log("scope.data", $scope.formData);

    $scope.init = function ()
    {


        $scope.isLoading = true;
        var start = 0;     // This is NOT the page number, but the index of item in the list that you want to use to display the table.
        var number = 10;  // Number of entries showed per page.
        var page = (start == 0) ? 1 : number / start;
        var postParam = {
            start: start,
            limit: number,
            type:$scope.type
        };
        dataFactory.httpRequest('/admin/discounts', 'POST', '', postParam).then(function (response) {
            $scope.discounts = response.dataList;
            $scope.isLoading = false;
        }, function (error) {
            alert(error);
        });

    };

    $scope.deleteDiscount = function () {
        if ($scope.selected.length > 0)
        {
            if (confirm("Are you sure you want to delete?"))
            {
                $scope.isLoading = true;
                var pParam = {'ids': $scope.selected,"type":$scope.type};
                dataFactory.httpRequest('/admin/discounts/deleteDiscount', 'POST', '', pParam).then(function (response) {
                    $scope.isLoading = false;
                    var respType = (response.status == 200) ? "success" : "error";
                    $rootScope.showMsg(respType, response.message, "#formRow");
                    $rootScope.selected = [];
                    $scope.init();
                });
            }
        } else {
            alert("Please select atleast one record to delete");
        }
    }

    $scope.editDiscount = function (myData)
    {

        if (myData)
        {
            var cData = {};
            angular.copy(myData, cData);
            cData.fromTime = new Date("2015-03-25 " + cData.fromTime);
            cData.toTime = new Date("2015-03-25 " + cData.toTime);

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
            day: {
                required: true

            },
            fromTime: {
                required: true

            },
            toTime: {
                required: true

            },
            discount: {
                required: true,
                number: true
            }
        },
        messages: {
            day: {
                required: "Please select day"
            },
            fromTime: {
                required: "Please enter from time"

            },
            toTime: {
                required: "Please enter to time"

            },
            discount: {
                required: "Please enter from discount"

            }

        }
    }
    $scope.successDiv = false;
    $scope.msg = "";
    $scope.addEditDiscount = function (form)
    {

        if (form.validate())
        {

            var postData = $scope.formData;
            postData.type = $scope.type;
            postData.fromTime = $filter('date')(postData.fromTime, 'h:mm a');
            postData.toTime = $filter('date')(postData.toTime, 'h:mm a');
            console.log("postData", postData);
            $scope.isLoading = true;
            dataFactory.httpRequest("/admin/discounts/addEditDiscount", "POST", {}, postData).then(function (response) {
                $scope.isLoading = false;
                console.log("response", response);
                var respType = (response.status == 200) ? "success" : "error";
                if (response.status == 200) {
                    $scope.cancelShow = false;
                    $scope.btnName = "Save";
                    $scope.formData = {};
                    $scope.init();
                }
                $rootScope.showMsg(respType, response.message, "#formRow2");
            });

        }
    }


});


