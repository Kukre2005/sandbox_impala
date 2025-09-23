app.controller('BookingController', function ($rootScope,$scope, $filter, $state,$stateParams, $location, dataFactory, localStorageService,constantData) {

    var page = 1;
    var searchValue = '';
    var type = $stateParams.type;
    $scope.type = $stateParams.type;
    $scope.heading = $scope.type == 'private_transport'?"Private Transporation":"Cabo Shuttle";
    $scope.ids = [];
    $scope.deleteBtn = true;
    $scope.msg = "";
    // Declare the array for the selected items
    $scope.selected = [];
    $scope.itemsPerPageSelect = $scope.itemsPerPage = constantData.ITEMS_PER_PAGE;
    $scope.activeData = ["Inactive", "Active"];
    $scope.setIpp = function(newValue)
        {
        
        $scope.itemsPerPage = newValue;
        }
    // Function to get data for all selected items
    $scope.selectAll = function (collection) {

        // if there are no items in the 'selected' array, 
        // push all elements to 'selected'
        console.log("selected", $scope.selected);
        if ($scope.selected.length === 0) {

            angular.forEach(collection, function (val) {

                $scope.selected.push(val.id);

            });

            // if there are items in the 'selected' array, 
            // add only those that ar not
        } else if ($scope.selected.length > 0 && $scope.selected.length != $scope.bookings.length) {

            angular.forEach(collection, function (val) {

                var found = $scope.selected.indexOf(val.id);

                if (found == -1)
                    $scope.selected.push(val.id);

            });

            // Otherwise, remove all items
        } else {

            $scope.selected = [];

        }

    };
    // Function to get data by selecting a single row
    $scope.select = function (id) {

        var found = $scope.selected.indexOf(id);

        if (found == -1)
            $scope.selected.push(id);

        else
            $scope.selected.splice(found, 1);

        console.log("sel", $scope.selected);


    }

    $scope.init = function ()
    {


        $scope.bookStatusData = ['pending', 'booked', 'canceled'];
        $scope.bookServer = function (tableState) {
            console.log("tablestate", tableState);
            $scope.isLoading = true;
            $scope.tableState = tableState;
            var pagination = tableState.pagination;

            var start = pagination.start || 0;     // This is NOT the page number, but the index of item in the list that you want to use to display the table.
            var number = pagination.number || 10;  // Number of entries showed per page.
         
            var postParam = tableState;
            postParam.type = $scope.type;
            dataFactory.httpRequest('/admin/booking', 'POST', '', postParam).then(function (response) {
                $scope.bookings = response.dataList;
                tableState.pagination.numberOfPages = response.totalPages;//set the number of pages so the pagination can update
                $scope.isLoading = false;
            });
//        service.getPage(start, number, tableState).then(function (result) {
//            ctrl.displayed = result.data;
//            tableState.pagination.numberOfPages = result.numberOfPages;//set the number of pages so the pagination can update
//            ctrl.isLoading = false;
//        });
        };

    }
    $scope.deleteBook = function () {
        if ($scope.selected.length > 0)
        {
            if (confirm("Are you sure you want to delete?"))
            {
                $scope.isLoading = true;
                var pParam = {'ids': $scope.selected,type:$scope.type};
                dataFactory.httpRequest('/admin/booking/deleteBooking', 'POST', '', pParam).then(function (response) {
                   $scope.isLoading = false;
                   var respType = (response.status == 200)?"success":"error";
                    $rootScope.showMsg(respType,response.message,"#formRow");
                    $rootScope.selected = [];
                    $scope.bookServer($scope.tableState);
                });
            }
        } else {
            alert("Please select atleast one record to delete");
        }
    }
    $scope.bookings = {};


});


