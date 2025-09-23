app.controller('FestiveDiscountContentController', function (env,$window, $scope, $rootScope, $http, $filter, $state, $stateParams, $location, dataFactory, localStorageService, constantData) {

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
    var id = "";
    $scope.editorOptions = {
        language: 'en'
    };

    $scope.init = function ()
    {
        $scope.isLoading = true;
        var postParam = {};
        dataFactory.httpRequest('/admin/discounts/getFestiveDiscountContent', 'POST', '', postParam).then(function (response) {
            $scope.formData = response.dataList;
            console.log('1',response.dataList.description)
            console.log('2',$scope.formData)
            $scope.isLoading = false;
        }, function (error) {
            alert(error);
        });
    };

    $scope.cancelUpdate = function () {
        $scope.formData = {};
        $scope.btnName = "Save";
        $scope.cancelShow = false;
    }

    $scope.successDiv = false;
    $scope.msg = "";

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
            description: {
                required: function (textarea) {
                    CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                    var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                    return editorcontent.length === 0;
                }
            }
        },
        messages: {
            description: {
                required: "Please enter description"
            }
        }
    }
    $scope.addEditFestiveContent = function (form)
    {

        if (form.validate())
        {
            var postData = $scope.formData;
            console.log("postData", postData);
            $scope.isLoading = true;
            if($scope.myFile != undefined && $scope.myFile != '') { postData.image = $scope.myFile; }else{if(postData.image){ delete postData.image;} };
            $http({
                method: 'POST',
                url: env.get("apiroot") + '/admin/discounts/addEditFestiveContent',
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
                            $scope.btnName = "Save";
                            // $scope.formData = {};
                            
                        }
                        $rootScope.showMsg(respType, response.message, "#formRow");

                    })
                    .error(function (data, status) {

                    });
        }
    }
    
    
});


