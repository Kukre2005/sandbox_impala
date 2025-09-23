
app.controller('LoginController', function ($scope, $state, $rootScope, ModalService, $timeout, $location, localStorageService, dataFactory) {
    $scope.data = [];
    $scope.login = {
        username: '',
        password: ''
    };
    $scope.loading = false;
    $scope.alerts = [];
    $scope.btLogin = 'Log In';
    $scope.validationOptions = {
        rules: {
            username: {
                required: true
            },
            password: {
                required: true,
                minlength: 5
            }
        },
        messages: {
            username: {
                required: "Please enter username"
            },
            password: {
                required: "You must enter a password",
                minlength: "Your password must have a minimum length of 6 characters"
            }
        }
    }
    $scope.submitLogin = function (form)
    {
        if (form.validate())
        {

            console.log($scope.datastr);
            $scope.loading = true;
            $scope.btLogin = 'loading...';
            try {
                dataFactory.httpRequest('/admin/auth/login', 'POST', {}, $scope.login).then(function (data) {
                    if (data.status != 200)
                    {
                        $scope.loading = false;
                        alert(data.message);
                    } else {
                        localStorageService.set("adminUser", data.responseData.loginData);
                        $state.go('app.main');

                    }


                    console.log(data);
                });
            } catch (ex)
            {
                console.log(ex);
            }
        }

    };

  $scope.showForgotPassword = function() {

    ModalService.showModal({
      templateUrl: "admin-template/forgot-password.html",
      controller: "ModalController",
      inputs: {
        modalData:{}
      }
    }).then(function(modal) {
      modal.element.modal();
      modal.close.then(function(result) {
        
      });
    });

  };
  
  
 
  
  $scope.validationOptionsFP = {
        rules: {
            fpemail: {
                required: true,
                email:true
            }
        },
        messages: {
            fpemail: {
                required: "Please enter email",
                email:"Invalid Email"
            }
        }
    };
    
$scope.miniPassModel= {miniPassword: ""};
  $scope.validationOptionsMiniPass = {
        rules: {
            miniPassword: {
                required: true,
                minlength:5
            }
        },
        messages: {
            miniPassword: {
                required: "Please enter mini password"
            }
        }
    };
$scope.submitMiniPass = function (form)
    {
        if (form.validate())
        {

            console.log($scope.datastr);
            $scope.loading = true;
            $scope.btLogin = 'loading...';
            try {
                dataFactory.httpRequest('/admin/auth/miniPass', 'POST', {}, $scope.miniPassModel).then(function (data) {
                    if (data.status != 200)
                    {
                        $scope.loading = false;
                        alert(data.message);
                    } else {
                       $rootScope.miniPass = '1';
                    }

                });
            } catch (ex)
            {
                console.log(ex);
            }
        }

    };

});

