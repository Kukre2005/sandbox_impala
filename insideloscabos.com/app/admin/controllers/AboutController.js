app.controller('AboutController', function (env,$window, $scope, $rootScope, $http, $filter, $state, $stateParams, $location, dataFactory, localStorageService, constantData) {

    var page = 1;
    var searchValue = '';
    $scope.ids = [];
    $scope.datas = {};
    $scope.deleteBtn = true;
    $scope.msg = "";
    $scope.btnName = "Save";
    $scope.cancelShow = false;
    $scope.formData = {};
    $scope.imgReq = true;
    // Declare the array for the selected items
    $scope.itemsPerPage = constantData.ITEMS_PER_PAGE;
    console.log("stateact", $state);
    console.log("stateParams", $stateParams);
    var actId = "";
   
    $scope.activeData = ["Inactive", "Active"];
    $scope.init = function ()
    {


        $scope.isLoading = true;
        var start = 0;     // This is NOT the page number, but the index of item in the list that you want to use to display the table.
        var number = 10;  // Number of entries showed per page.
        var page = (start == 0) ? 1 : number / start;
        var postParam = {
            start: start,
            limit: number,
            type:$stateParams.type

        };
        var u =  "airportInfo";
        console.log("u", u);
        dataFactory.httpRequest('/admin/about/' + u, 'POST', '', postParam).then(function (response) {
            $scope.datas = response.dataList;
            $scope.isLoading = false;
        }, function (error) {
            alert(error);
        });
    };

    $scope.deleteAirport = function () {
        if ($scope.selected.length > 0)
        {
            if (confirm("Are you sure you want to delete?"))
            {
                $scope.isLoading = true;
                var pParam = {'ids': $scope.selected,'type':$stateParams.type};
                dataFactory.httpRequest('/admin/about/deleteAirport', 'POST', '', pParam).then(function (response) {
                    $scope.isLoading = false;
                    var respType = (response.status == 200) ? "success" : "error";
                    $rootScope.showMsg(respType, response.message, "#formRow");
                    $scope.init();
                    $rootScope.selected = [];
                });
            }
        } else {
            alert("Please select atleast one record to delete");
        }
    }


    $scope.editAirport = function (myData)
    {

        if (myData)
        {
            var cData = {};
            angular.copy(myData, cData);
            $scope.formData = cData;
            if($scope.formData.image != '')
            {
                $scope.imgReq = false;
            }
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
         ignore: [],
          errorPlacement: function (error, element) {
            if (element[0].id == "description")
            {
                $("#cke_description").after(error);
            } else {
                $(element).after(error);
            }
        },
        rules: {
            name: {
                required: true,
                minlength: 3
            },
             image: {
                required: {
                    depends: function (element) {
                        return $scope.imgReq;
                    }
                },
                extension: "jpg|png|webp"
            },
            description: {
                required: function (textarea) {
                    console.log("text",textarea);
                    CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                    var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                    return editorcontent.length === 0;
                }
            }
        },
        messages: {
            name: {
                required: "Please enter name",
                minlength: "This input must have a minimum length of 6 characters"
            },
            image: {
                required: "Please select a image"
            },
            description: {
                required: "Please enter description"
            }

        }
    }
    $scope.successDiv = false;
    $scope.msg = "";
    $scope.formData.type=$stateParams.type;
    $scope.addEditAirport = function (form)
    {

        if (form.validate())
        {
            var postData = $scope.formData;
            console.log("postData", postData);
            $scope.isLoading = true;
            if($scope.myFile != undefined && $scope.myFile != '') { postData.image = $scope.myFile; }else{if(postData.image){ delete postData.image;} };
            postData.type == $stateParams.type;
            $http({
                method: 'POST',
                url: env.get("apiroot") + '/admin/about/addEditAirport',
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
                        $scope.isLoading = false;
                        if (response.status == 200)
                        {
                            console.log("response", response);
                            $scope.cancelShow = false;
                            $scope.btnName = "Save";
                            $scope.formData = {};
                            $scope.init();
                            $scope.myFile = "";
                            angular.element("input[type='file']").val(null);$scope.myFile = "";
                        }
                        $rootScope.showMsg(respType, response.message, "#formRow2");

                    })
                    .error(function (data, status) {
                        $scope.isLoading = true;
                    });

        }
    }
    
});


