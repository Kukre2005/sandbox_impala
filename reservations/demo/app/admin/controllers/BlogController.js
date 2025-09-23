app.controller('BlogController', function (env,$window, $scope, $rootScope, $http, $filter, $state, $stateParams, $location, dataFactory, localStorageService, constantData) {

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
                // uiColor: '#000000'
    };
    if ($state.params.id)
    {

        id = $state.params.id;
        $scope.formData.id = id;
        $scope.btnName = "Update";
        $scope.imgReq = false;
        $scope.isLoading = true;
        dataFactory.httpRequest('/admin/blog/getBlog', 'POST', '', {id: id}).then(function (response) {
            $scope.isLoading = false;
            $scope.formData = response.data;
            $scope.blogName = response.data.name;
        }, function (error) {
            alert(error);
        });

    }

    $scope.activeData = ["Inactive", "Active"];

    $scope.init = function ()
    {


        $scope.callServer = function (tableState) {
            console.log("tablestate", tableState);
            $scope.isLoading = true;
            $scope.tableState = tableState;
            var pagination = tableState.pagination;

            var start = pagination.start || 0;     // This is NOT the page number, but the index of item in the list that you want to use to display the table.
            var number = pagination.number || 10;  // Number of entries showed per page.

            var postParam = tableState;
            dataFactory.httpRequest('/admin/blog', 'POST', '', postParam).then(function (response) {
                $scope.isLoading = false;
                $scope.blogList = response.dataList;
                tableState.pagination.numberOfPages = response.totalPages;//set the number of pages so the pagination can update
                
            });

        };

    }

    $scope.blogList = {};
    
    $scope.comments = {};


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
            name: {
                required: true,
                minlength: 3
            },
            shortDesc: {
                required: true
            },
            description: {
                required: function (textarea) {
                    CKEDITOR.instances[textarea.id].updateElement(); // update textarea
                    var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
                    return editorcontent.length === 0;
                }
            },
            image: {
                required: {
                    depends: function (element) {
                        return $scope.imgReq;
                    }
                },
                extension: "jpg|png"
            },
            tags: {
                CommaSepRegex: true
            }
//            ,
//            author: {
//                required: true
//            }
//            ,
//            blogDate: {
//                required: true
//            }
        },
        messages: {
            name: {
                required: "Please enter name",
                minlength: "This input must have a minimum length of 6 characters"
            },
            shortDesc: {
                required: "Please enter short description"
            },
            description: {
                required: "Please enter description"
            },
            image: {
                required: "Please select a image"
            }
//            ,
//            author: {
//                required: "Please enter author name"
//            }
//            ,
//            blogDate: {
//                required: "Please enter blog date"
//            }

        }
    }
    $scope.addEditBlog = function (form)
    {

        if (form.validate())
        {
            var postData = $scope.formData;
            console.log("postData", postData);
//            dataFactory.httpRequest("/admin/blog/addEditBlog", "POST", {}, postData).then(function (response) {
//                console.log("response", response);
//                var respType = (response.status == 200) ? "success" : "error";
//                $rootScope.showMsg(respType, response.message, "#formRow2");
//                $scope.cancelShow = false;
//                $scope.btnName = "Save";
//                $scope.formData = {};
//                $scope.init();
//            });
$scope.isLoading = true;
            if($scope.myFile != undefined && $scope.myFile != '') { postData.image = $scope.myFile; }else{if(postData.image){ delete postData.image;} };
            $http({
                method: 'POST',
                url: env.get("apiroot") + '/admin/blog/addEditBlog',
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
                            $scope.formData = {};
                            
                            $state.go("app.blogs");
                        }
                        $rootScope.showMsg(respType, response.message, "#formRow");

                    })
                    .error(function (data, status) {

                    });
        }
    }
    $scope.deleteBlog = function () {
        if ($scope.selected.length > 0)
        {
            if (confirm("Are you sure you want to delete?"))
            {
                $scope.isLoading = true;
                var pParam = {'ids': $scope.selected};
                dataFactory.httpRequest('/admin/blog/deleteBlog', 'POST', '', pParam).then(function (response) {
                    $scope.isLoading = false;
                    var respType = (response.status == 200) ? "success" : "error";
                    $rootScope.showMsg(respType, response.message, "#formRow");
                    $rootScope.selected = [];
                    $scope.callServer($scope.tableState);
                });
            }
        } else {
            alert("Please select atleast one record to delete");
        }
    }
    
    $scope.activeData = ["Inactive","Active"];
    $scope.initComments = function ()
    {


        $scope.isLoading = true;
        var start = 0;     // This is NOT the page number, but the index of item in the list that you want to use to display the table.
        var number = 10;  // Number of entries showed per page.
        var page = (start == 0) ? 1 : number / start;
        var postParam = {
            blogId: $state.params.id
        };
        dataFactory.httpRequest('/admin/blog/getComments', 'POST', '', postParam).then(function (response) {
            $scope.comments = response.dataList;
            $scope.isLoading = false;
        },function(error){
            $scope.isLoading = false;
            alert(error);
        });
};

$scope.deleteComments = function () {
        if ($scope.selected.length > 0)
        {
            if (confirm("Are you sure you want to delete?"))
            {
                $scope.isLoading = true;
                var pParam = {'ids': $scope.selected};
                dataFactory.httpRequest('/admin/blog/deleteComments', 'POST', '', pParam).then(function (response) {
                    $scope.isLoading = false;
                    var respType = (response.status == 200) ? "success" : "error";
                    $rootScope.showMsg(respType, response.message, "#formRow");
                    $rootScope.selected = [];
                    $scope.initComments();
                });
            }
        } else {
            alert("Please select atleast one record to delete");
        }
    }
    
});


