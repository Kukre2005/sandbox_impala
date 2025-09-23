var app = angular.module('myapp');

app.controller('ModalController', [ '$scope', '$element', 'modalData', 'close','dataFactory', function($scope, $element, modalData, close,dataFactory) {

  //  This close function doesn't need to use jQuery or bootstrap, because
  //  the button has the 'data-dismiss' attribute.
  $scope.close = function() {
 	  close({ }, 500); // close, but give 500ms for bootstrap to animate
  };

  //  This cancel function must use the bootstrap, 'modal' function because
  //  the doesn't have the 'data-dismiss' attribute.
  $scope.cancel = function() {

    //  Manually hide the modal.
    $element.modal('hide');
    
    //  Now call close, returning control to the caller.
    close({ }, 500); // close, but give 500ms for bootstrap to animate
  };

    $scope.successDiv=false;
    $scope.msg="";
    $scope.fp={};
    
   $scope.submitForgotPassword=function(fpform){
        if (fpform.validate())
        {
           $scope.loading = true;
            $scope.btLogin = 'loading...';
            try {
                dataFactory.httpRequest('/admin/auth/forgotPassword', 'POST', {}, $scope.fp).then(function (data) {
                    if (data.status != 200)
                    {
                        $scope.loading = false;
                        $scope.successDiv=false;
                    } else {
                         $scope.successDiv=true;
                    }
                    $scope.msg=data.message;

                    console.log(data);
                });
            } catch (ex)
            {
              $scope.isLoading = false;
                console.log(ex);
            }
        }
   }; 


    if(modalData.moduleName == 'bookingDetails')
    {
        $scope.bookData = modalData;
    }
    $scope.dbModalData = modalData;
}]);


