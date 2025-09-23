app.controller('ModalInstanceCtrl', ['$scope', '$uibModalInstance', '$http', 'modalData', 'dataFactory', function ($scope, $uibModalInstance, $http, modalData, dataFactory) {
        $scope.type = modalData.type;
        $scope.data = [];
        var type = modalData.type;
        $scope.closeModal = function(){
       $uibModalInstance.close();
    }

        if (type == 'subcategory')
        {
            var catId = modalData.catId;
            $scope.catId = catId;
            $scope.pageNumberModal = 1;
            var limit = 2;
            $scope.limitModal = limit;
            $scope.libraryTemp = {};
            $scope.totalItemsTemp = {};
            $scope.searchValueModal = "";
            $scope.totalItemsModal = 0;
            var page = 1;
            var searchValue = '';
            getSubCats(catId, page, searchValue, limit);
            $scope.pageChanged2 = function (newPage) {
                getSubCats($scope.catId, newPage, '', limit);
            };
            $scope.reset = function ()
            {
                $scope.subcatform = {id: '', catId: $scope.catId, name: ''};
            }
            $scope.reset();

            function getSubCats(catId, page, searchValue, limit)
            {
                var postParam = {
                    catId: catId,
                    page: page,
                    limit: limit,
                    searchValue: searchValue
                }
//                console.log(postParam);

                dataFactory.httpRequest('/admin/items/subCategorys', 'POST', '', postParam).then(function (response) {
                    $scope.dataModal = response.dataList;
                    $scope.totalItemsModal = response.total;
                    $scope.pageNumberModal = postParam.page;
                });
            }



            $scope.subvalidationOptions = {
                rules: {
                    name: {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {
                    name: {
                        required: "Please enter sub category",
                        minlength: "This input must have a minimum length of 6 characters"
                    }
                }
            }
            $scope.addEditSub = function (form)
            {
                if (form.validate())
                {
                    var postData = $scope.subcatform;
                    console.log(form);
                    dataFactory.httpRequest('/admin/items/addEditSubCategory', 'POST', {}, postData).then(function (data) {
                        getSubCats($scope.catId, 1, '', $scope.limitModal);
                        $scope.reset();
                    });

                }
            }

            $scope.editSubCat = function (id)
            {
                var postData = {'id': id};
                console.log(postData);
                dataFactory.httpRequest('/admin/items/getSubCat', 'POST', {}, postData).then(function (data) {
                    $scope.subcatform = data;
                });
            }
            $scope.deleteSubCat = function (id)
            {
                var postData = {'id': id};
                console.log(postData);
                var result = confirm("Are you sure delete this item?");
                if (result) {
                    dataFactory.httpRequest('/admin/items/deleteSubCat', 'POST', {}, postData).then(function (data) {
                        getSubCats($scope.catId, 1, '', $scope.limitModal);

                    });
                }
            }

        }
        if (type == 'pimages')
        {
            var productId = modalData.productId;
            $scope.productId = productId;
            $scope.loading = false;
            $scope.imagesData = {}
            $scope.imageStrings = {};
            $scope.reset = function ()
            {
                $scope.imageform = {productId: $scope.productId};
            }

            $scope.init = function () {
                getProductImages(productId);
            }

            $scope.init();
            $scope.reset();

            function getProductImages(productId)
            {
                dataFactory.httpRequest('/admin/product/getProductImages', 'GET', {'productId': productId}).then(function (data) {
                    $scope.imagesData = data;
                    console.log(data);
                });
            }
            
            }
            $scope.processFiles = function (files) {
                console.log(files);
                angular.forEach(files, function (flowFile, i) {
                    var fileReader = new FileReader();
                    fileReader.onload = function (event) {
                        var uri = event.target.result;
                        $scope.imageStrings[i] = uri;
                    };
                    fileReader.readAsDataURL(flowFile.file);
                });
            };
            $scope.files = [];

            $scope.subvalidationOptions = {
                rules: {
                    images: {
                        required: true
                    }
                },
                messages: {
                    images: {
                        required: "Please select atleast one images",
                    }
                }
            }

            //listen for the file selected event
            $scope.$on("fileSelected", function (event, args) {
                $scope.$apply(function () {

                    //add the file object to the scope's files collection
                    $scope.files.push(args.file);

                });
            });

            $scope.addEditImages = function (form)
            {

                if (form.validate())
                {
                    console.log($scope);
                    var postData = $scope.imageform;

                    postData.images = ($scope.files == undefined) ? "" : $scope.files;
                    console.log(postData);

                    $http({
                        method: 'POST',
                        url: '/ci-angular/admin/product/addEditImages',
                        headers: {
                            'Content-Type': undefined
                        },
                        data: postData,
                        transformRequest: function (data, headersGetter) {
                            var formData = new FormData();

//                            formData.append("uploadedFile",JSON.stringify(data.images));
                            for (var i = 0; i < $scope.files.length; i++) {
                                //add each file to the form data and iteratively name them
                                console.log($scope.files[i]);
                                formData.append("file" + i, $scope.files[i]);
                            }
                            angular.forEach(data, function (value, key) {
                                formData.append(key, value);
                            });
                            console.log(formData);
                            var headers = headersGetter();
                            delete headers['Content-Type'];

                            return formData;
                        }
                    })
                            .success(function (data) {
                                alert(data.message);
                                if (data.status == 200)
                                {
                                    $scope.reset();
                                    getProductImages($scope.productId);
                                    //$location.path('/products');

                                } else {

                                }

                            })
                            .error(function (data, status) {

                            });

                }
            }
        }
        $scope.ok = function () {
            $uibModalInstance.close($scope.selected.item);
        };

        $scope.cancel = function () {
            $uibModalInstance.dismiss('cancel');
        };
    }]);