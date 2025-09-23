app.controller('HotelsController', function ($scope,$window, $rootScope, $filter, $state, $location, dataFactory, localStorageService, constantData) {

    var page = 1;
    var searchValue = '';
    
    $scope.ids = [];
    $scope.hotels = {};
    $scope.deleteBtn = true;
    $scope.msg = "";
    $scope.btnName = "Save";
    $scope.cancelShow = false;
    $scope.formData = {};
    // Declare the array for the selected items
    
    $scope.itemsPerPage = constantData.ITEMS_PER_PAGE;
    $scope.activeData = ["Inactive", "Active"];
    $scope.setIpp = function(newValue)
        {
        
        $scope.itemsPerPage = newValue;
        }
    $scope.init = function ()
    {


        $scope.isLoading = true;
        var start = 0;     // This is NOT the page number, but the index of item in the list that you want to use to display the table.
        var number = 10;  // Number of entries showed per page.
        var page = (start == 0) ? 1 : number / start;
        var postParam = {
            start: start,
            limit: number
        };
        dataFactory.httpRequest('/admin/hotels', 'POST', '', postParam).then(function (response) {
            $scope.hotels = response.dataList;
            $scope.isLoading = false;
        }, function (error) {
            $scope.isLoading = false;
            alert(error);
        });

    };

    $scope.deleteHotel = function () {
        if ($scope.selected.length > 0)
        {
            if (confirm("Are you sure you want to delete?"))
            {
                $scope.isLoading = true;
                var pParam = {'ids': $scope.selected};
                dataFactory.httpRequest('/admin/hotels/deleteHotel', 'POST', '', pParam).then(function (response) {
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

    $scope.editHotel = function (myData)
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
            name: {
                required: true,
                minlength: 5
            },
            code: {
                required: true,
                minlength: 3
            }
        },
        messages: {
            name: {
                required: "Please enter name",
                minlength: "This input must have a minimum length of 6 characters"
            },
            code: {
                required: "Please enter hotel code",
                minlength: "This input must have a minimum length of 3 characters"
            }
        }
    }
    $scope.successDiv = false;
    $scope.msg = "";
    $scope.addEditHotel = function (form)
    {

        if (form.validate())
        {

            var postData = $scope.formData;
            console.log("postData", postData);
            $scope.isLoading = true;
            dataFactory.httpRequest("/admin/hotels/addEditHotel", "POST", {}, postData).then(function (response) {
                console.log("response", response);
                $scope.isLoading = false;
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


