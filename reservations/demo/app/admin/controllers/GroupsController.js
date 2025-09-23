app.controller('GroupsController', function ($scope,$window, $rootScope, $filter, $state,$stateParams, $location, dataFactory, localStorageService, constantData, $timeout) {

    var page = 1;
    var searchValue = '';
    $scope.ids = [];
    var type = $stateParams.type;
    $scope.type = $stateParams.type;
    $scope.heading = $scope.type == 'private_transport'?"Private Transporation":"Cabo Shuttle";
    $scope.groups = {};
    $scope.deleteBtn = true;
    $scope.msg = "";
    $scope.btnName = "Save";
    $scope.cancelShow = false;
    $scope.formData = {};
    // Declare the array for the selected items
    $scope.itemsPerPage = constantData.ITEMS_PER_PAGE;

    $scope.activeData = ["Inactive", "Active"];
    $scope.getHotels = function ()
    {
        var postParam = {
            "groupId": $scope.formData.id,
            "type":$scope.type
        };
         $scope.isLoading = true;   
        dataFactory.httpRequest('/admin/hotels/getGroupHotels', 'POST', '', postParam).then(function (response) {
            $scope.hotels = response.dataList;
            $scope.isLoading = false;
        }, function (error) {
            alert(error);
        });
    }
    $scope.getHotels();
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
        $scope.isLoading = true;
        dataFactory.httpRequest('/admin/hotels/getGroups', 'POST', '', postParam).then(function (response) {
            $scope.groups = response.dataList;
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

    $scope.deleteGroup = function () {
        if ($scope.selected.length > 0)
        {
            if (confirm("Are you sure you want to delete?"))
            {
                $scope.isLoading = true;
                var pParam = {'ids': $scope.selected,type:$scope.type};
                dataFactory.httpRequest('/admin/hotels/deleteGroup', 'POST', '', pParam).then(function (response) {
                    $scope.isLoading = false;
                    var respType = (response.status == 200) ? "success" : "error";
                    $rootScope.showMsg(respType, response.message, "#formRow");
                    $scope.formData={};
                    $rootScope.selected = [];
                    $scope.init();
                    
                });
            }
        } else {
            alert("Please select atleast one record to delete");
        }
    }

    $scope.editGroup = function (myData)
    {
        console.log("myData", myData);
        if (myData)
        {
            var cData = {};
            angular.copy(myData, cData);
            $scope.formData = cData;
            $scope.getHotels();
            cData.hotels = cData.hotels.split(",");
            $scope.formData = cData;
            console.log("scope formdata", $scope.formData);

            $scope.btnName = "Update";
            $scope.cancelShow = true;

            $window.scrollTo(0, 0);
        }
    }
    $scope.cancelUpdate = function () {
        $scope.formData = {};
        $scope.getHotels();
        $scope.btnName = "Save";
        $scope.btnName = 'Save';
        $scope.cancelShow = false;
    }
    $scope.validationOptions = {
        rules: {
            name: {
                required: true,
                minlength: 5
            },
            cost_one_way_1_5: {
                required: true,
                number: true
            },
            cost_round_trip_1_5: {
                required: true,
                number: true
            },
            cost_one_way_6_10: {
                required: ($scope.type == 'private_transport')?true:false,
                number: ($scope.type == 'private_transport')?true:false
            },
            cost_round_trip_6_10: {
                required: ($scope.type == 'private_transport')?true:false,
                number: ($scope.type == 'private_transport')?true:false
            },
            cost_one_way_11_15: {
                required: ($scope.type == 'private_transport')?true:false,
                number: ($scope.type == 'private_transport')?true:false
            },
            cost_round_trip_11_15: {
                required: ($scope.type == 'private_transport')?true:false,
                number: ($scope.type == 'private_transport')?true:false
            },
            "hotels[]": {
                required: true
            }

        },
        messages: {
            name: {
                required: "Please enter name",
                minlength: "This input must have a minimum length of 6 characters"
            },
            cost_one_way_1_5: {
                required: "Please enter cost"
            },
            cost_round_trip_1_5: {
                required: "Please enter cost"
            },
            cost_one_way_6_10: {
                required: "Please enter cost"
            },
            cost_round_trip_6_10: {
                required: "Please enter cost"
            },
            cost_one_way_11_15: {
                required: "Please enter cost"
            },
            cost_round_trip_11_15: {
                required: "Please enter cost"
            },
            "hotels[]": {
                required: "Please select atleast one hotel"
            }

        }
    }
    $scope.successDiv = false;
    $scope.msg = "";
    $scope.addEditGroup = function (form)
    {

        if (form.validate())
        {

            var postData = $scope.formData;
            postData.type = $scope.type;
            $scope.isLoading = true;
            console.log("postData", postData);
            dataFactory.httpRequest("/admin/hotels/addEditGroup", "POST", {}, postData).then(function (response) {
                $scope.isLoading = false;
                console.log("response", response);
                var respType = (response.status == 200) ? "success" : "error";
                $rootScope.showMsg(respType, response.message, "#formRow2");
                $scope.cancelShow = false;
                $scope.btnName = "Save";
                $scope.formData = {};
                $scope.getHotels();
                $scope.init();
            });

        }
    }


});


