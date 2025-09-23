app.controller('FestiveDiscountController', function (env,$scope,$window, $rootScope,$stateParams,$http, $filter, $state, $location, dataFactory, localStorageService, constantData) {

    var page = 1;
    var searchValue = '';
    $scope.ids = [];
    var type = $stateParams.type;
    $scope.type = $stateParams.type;
    $scope.heading = 'Festive';
    $scope.discounts = {};
    $scope.deleteBtn = true;
    $scope.msg = "";
    $scope.btnName = "Save";
    $scope.cancelShow = false;
    $scope.couponImage = false;
    $scope.formData = {};
    // Declare the array for the selected items
    $scope.itemsPerPage = constantData.ITEMS_PER_PAGE;
    $scope.formData.coupon_type = '0';
    $scope.formData.transportation_type = '0';
    $scope.formData.is_public = '0';
    $scope.days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
    $scope.activeData = ["Inactive", "Active"];
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
        dataFactory.httpRequest('/admin/discounts/getFestiveDiscounts', 'POST', '', postParam).then(function (response) {
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
                dataFactory.httpRequest('/admin/discounts/deleteFestiveDiscount', 'POST', '', pParam).then(function (response) {
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

    $scope.logIt = function (value) {
        if(value != "" && value != undefined && value != null)
        {
            $scope.isLoading = true;
            var pParam = {'value':value};
            dataFactory.httpRequest('/admin/discounts/updateSliderCoupon', 'POST', '', pParam).then(function (response) {
                $scope.isLoading = false;
                var respType = (response.status == 200) ? "success" : "error";
            });
        }
    }

    $scope.editDiscount = function (myData)
    {

        if (myData)
        {
            var cData = {};
            angular.copy(myData, cData);
            cData.date_range = cData.start_date+" - "+cData.end_date;
            if(cData.discount_image){
                $scope.couponImage = true;
                cData.image = env.get("apiroot") + '/' + cData.discount_image;
            }else{
                $scope.couponImage = false;
                cData.image = '';
            }
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
        $scope.couponImage = false;
    }
    $scope.validationOptions = {
        rules: {
            coupon_code: {
                required: true,
                minlength:6,
                maxlength:6

            },
            title: {
                required: true

            },
            coupon_type: {
                required: true

            },
            transportation_type: {
                required: true

            },
            coupon_amount: {
                required: true,
                number: true

            },
            date_range: {
                required: true
            }
        },
        messages: {
            coupon_code: {
                required: "Please enter coupon code",
                minlength:"Coupon code minimum length should be 6 digit",
                maxlength:"Coupon code maximum length should be 6 digit"
            },
            title: {
                required: "Please enter coupon title"

            },
            coupon_type: {
                required: "Please select coupon type"

            },
            coupon_amount: {
                required: "Please enter coupon amount",
                number: "Coupon amount should be numeric"
            },
            date_range: {
                required: "Please select date range"

            }

        }
    }
    $scope.successDiv = false;
    $scope.msg = "";
    $scope.addEditFestiveDiscount = function (form)
    {
        if (form.validate())
        {
            var postData = $scope.formData;
            console.log("postData", postData);
            $scope.isLoading = true;
            if($scope.myFile != undefined && $scope.myFile != '') { postData.image = $scope.myFile; }else{if(postData.image){ delete postData.image;} };
            $http({
                method: 'POST',
                url: env.get("apiroot") + '/admin/discounts/addEditFestiveDiscount',
                headers: {
                    'Content-Type': undefined
                },
                data: postData,
                transformRequest: function (data, headersGetter) {
                    var formData = new FormData();
                    angular.forEach(data, function (value, key) {
                        formData.append(key, value);
                    });

                    var headers = headersGetter();
                    delete headers['Content-Type'];
                    return formData;
                }
            })
            .success(function (response) {
                var respType = (response.status == 200) ? "success" : "error";
                $scope.isLoading = true;
                if (response.status == 200)
                {
                    console.log("response", response);
                    $scope.cancelShow = false;
                    $scope.couponImage = false;
                    $scope.btnName = "Save";
                    $scope.formData = {};
                    $scope.init();
                }
                $rootScope.showMsg(respType, response.message, "#formRow");

            })
            .error(function (data, status) {

            });
        }
    }


});


