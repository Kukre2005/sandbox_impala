app.controller('QaController', function ($scope,$window, env, $rootScope, $filter, $state, $http, $location, dataFactory, localStorageService, constantData) {

    var page = 1;
    var searchValue = '';
    $scope.ids = [];
    $scope.qaTitles = {};
    $scope.deleteBtn = true;
    $scope.msg = "";
    $scope.btnName = "Save";
    $scope.cancelShow = false;
    $scope.formData = {};
    // Declare the array for the selected items
    $scope.itemsPerPage = constantData.ITEMS_PER_PAGE;
    $scope.slugData = null;
    var qaId = "";
    if ($state.params.qaId)
    {

        qaId = $state.params.qaId;
        $scope.formData.qaId = qaId;
        $scope.isLoading = true;
        if ($scope.slugData == null)
        {
            dataFactory.httpRequest('/admin/about/getQaTitle', 'POST', '', {qaId: qaId}).then(function (response) {
                $scope.isLoading = false;
                $scope.slugData = response.data;
                console.log("slugData", $scope.slugData);
            }, function (error) {
                $scope.isLoading = false;
                alert(error);
            });
        }
    }


    $scope.activeData = ["Inactive", "Active"];
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
        if ($state.params.qaId)
        {
            postParam.qaId = qaId;
        }
        var u = ($state.params.qaId) ? "about/qa" : "about/qaTitles";
        console.log("u", u);
        dataFactory.httpRequest('/admin/' + u, 'POST', '', postParam).then(function (response) {
            $scope.qaTitles = response.dataList;
            console.log("qatitles", $scope.qaTitles);
            $scope.isLoading = false;
        }, function (error) {
            $scope.isLoading = false;
            alert(error);
        });

    };

    $scope.deleteQaTitle = function () {
        if ($scope.selected.length > 0)
        {
            if (confirm("Are you sure you want to delete?"))
            {
                $scope.isLoading = true;
                var pParam = {'ids': $scope.selected};
                dataFactory.httpRequest('/admin/about/deleteQaTitle', 'POST', '', pParam).then(function (response) {
                    $scope.isLoading = false;
                    var respType = (response.status == 200) ? "success" : "error";
                    $rootScope.showMsg(respType, response.message, "#formRow");
                    $rootScope.selected = [];
                    $scope.init();
                });
            }
        } else {
            alert("Please select atleast one record to delete");
            $scope.isLoading = false;
        }
    }

    $scope.deleteQa = function () {
        if ($scope.selected.length > 0)
        {
            if (confirm("Are you sure you want to delete?"))
            {
                $scope.isLoading = true;
                var pParam = {'ids': $scope.selected};
                dataFactory.httpRequest('/admin/about/deleteQa', 'POST', '', pParam).then(function (response) {
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

    $scope.editQaTitle = function (myData)
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
            }
        },
        messages: {
            name: {
                required: "Please enter qa heading",
                minlength: "This input must have a minimum length of 6 characters"
            }
        }
    }
    $scope.successDiv = false;
    $scope.msg = "";
    $scope.addEditQaTitle = function (form)
    {

        if (form.validate())
        {

            var postData = $scope.formData;
            console.log("postData", postData);
            $scope.isLoading = false;
            dataFactory.httpRequest("/admin/about/addEditQaTitle", "POST", {}, postData).then(function (response) {
                console.log("response", response);
                $scope.isLoading = false;
                var respType = (response.status == 200) ? "success" : "error";

                if (response.status == 200)
                {
                    $scope.cancelShow = false;
                    $scope.btnName = "Save";
                    $scope.formData = {};
                    $scope.init();
                }

                $rootScope.showMsg(respType, response.message, "#formRow2");
            });

        }
    }

    $scope.editQa = function (myData)
    {

        if (myData)
        {
            var cData = {};
            angular.copy(myData, cData);
            $scope.formData = cData;
            if ($scope.formData.image != '')
            {
                $scope.imgReq = false;
            }
            $scope.btnName = "Update";
            $scope.cancelShow = true;
            $window.scrollTo(0, 0);
        }
    }

    $scope.validationOptionsQa = {
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
                required: false,
                extension: "jpg|png"
            },
            description: {
                required: function (textarea) {
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
    $scope.addEditQa = function (form)
    {

        if (form.validate())
        {
            var postData = $scope.formData;
            console.log("postData", postData);
            $scope.isLoading = true;
            if($scope.myFile != undefined && $scope.myFile != '') { postData.image = $scope.myFile; }else{if(postData.image){ delete postData.image;} };
            $http({
                method: 'POST',
                url: env.get("apiroot") + '/admin/about/addEditQa',
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
                            angular.element("input[type='file']").val(null);$scope.myFile = "";
                            $scope.init();
                            
                        }
                        $rootScope.showMsg(respType, response.message, "#formRow2");

                    })
                    .error(function (data, status) {
                        $scope.isLoading = false;
                    });

        }
    }

});


