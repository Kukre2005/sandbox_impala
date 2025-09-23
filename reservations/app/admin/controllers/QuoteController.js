app.controller('QuoteController', function (env, $scope, $rootScope, $http, $filter, $state, $stateParams, $location, dataFactory, localStorageService, constantData) {

    var page = 1;
    var searchValue = '';
    $scope.ids = [];
    $scope.deleteBtn = true;
    $scope.msg = "";

    $scope.quotes = {};
    $scope.btnName = "Save";
    $scope.coupons = {};
    $scope.hotels=[];
    dataFactory.httpRequest('/admin/activity', 'POST', '',{}).then(function (response) {
            $scope.acts = response.dataList;
            $scope.isLoading = false;
        },function(error){
            alert(error);
        });
        $scope.itemsPerPageSelect = $scope.itemsPerPage = constantData.ITEMS_PER_PAGE;
    $scope.activeData = ["Inactive", "Active"];
    $scope.setIpp = function(newValue)
        {
        
        $scope.itemsPerPage = newValue;
        }
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
            $scope.isLoading = false;
            alert(error);
        });
    
        $scope.quoteServer = function (tableState) {
            console.log("tablestate", tableState);
            $scope.isLoading = true;
            $scope.tableState = tableState;
            var pagination = tableState.pagination;

            var start = pagination.start || 0;     // This is NOT the page number, but the index of item in the list that you want to use to display the table.
            var number = pagination.number || 10;  // Number of entries showed per page.

            var postParam = tableState;
            dataFactory.httpRequest('/admin/booking/getQuote', 'POST', '', postParam).then(function (response) {
                
                $scope.quotes = response.dataList;
                tableState.pagination.numberOfPages = response.totalPages;//set the number of pages so the pagination can update
                $scope.isLoading = false;
            });

        };

    }

    $scope.typeData = ['price', 'percent'];
   

    $scope.deleteQuote = function () {
        if ($scope.selected.length > 0)
        {
            if (confirm("Are you sure you want to delete?"))
            {
                $scope.isLoading = true;
                var pParam = {'ids': $scope.selected};
                dataFactory.httpRequest('/admin/booking/deleteQuote', 'POST', '', pParam).then(function (response) {
                    $scope.isLoading = false;
                    var respType = (response.status == 200) ? "success" : "error";
                    $rootScope.showMsg(respType, response.message, "#formRow");
                    $rootScope.selected = [];
                    $scope.quoteServer($scope.tableState);
                });
            }
        } else {
            alert("Please select atleast one record to delete");
        }
    }
    $scope.quotes = {};


    $scope.activeData = ["Inactive", "Active"];
    

});


