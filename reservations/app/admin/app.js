// Default colors
var brandPrimary = "#20a8d8";
var brandSuccess = "#4dbd74";
var brandInfo = "#63c2de";
var brandWarning = "#f8cb00";
var brandDanger = "#f86c6b";

var grayDark = "#2a2c36";
var gray = "#55595c";
var grayLight = "#818a91";
var grayLighter = "#d1d4d7";
var grayLightest = "#f8f9fa";
var constantData = { item_per_page: 10 };
var app = angular
  .module("myapp", [
    "ui.router",
    "oc.lazyLoad",
    "smart-table",
    "ncy-angular-breadcrumb",
    "angular-loading-bar",
    "ngValidate",
    "ngCkeditor",
    "ngSanitize",
    "localytics.directives",
    "LocalStorageModule",
    "angularModalService",
  ])
  .constant(
    "constantData",
    (function () {
      // Define your variable
      var resource = "https://reservations.impalacabo.com";
      // Use the variable in your constants
      return {
        DOMAIN: resource,
        ADMIN: resource + "/admin",
        ITEMS_PER_PAGE: "10",
      };
    })()
  )
  .config([
    "cfpLoadingBarProvider",
    "stConfig",
    "$stateProvider",
    function (cfpLoadingBarProvider, stConfig, $stateProvider) {
      cfpLoadingBarProvider.includeSpinner = false;

      cfpLoadingBarProvider.latencyThreshold = 1;
    },
  ])
  .run([
    "$rootScope",
    "$state",
    "$stateParams",
    "dataFactory",
    "localStorageService",
    "$templateCache",
    "ModalService",
    "constantData",
    "env",
    function (
      $rootScope,
      $state,
      $stateParams,
      dataFactory,
      localStorageService,
      $templateCache,
      ModalService,
      constantData,
      env
    ) {
      $rootScope.miniPass = "0";
      $rootScope.SITE_NAME = "Impalacabo";
      $rootScope.SITE_URL = env.get("apiroot");
      $rootScope.itemsPerPageData = ["10", "25", "50", "100"];
      $rootScope.itemsPerPage = $rootScope.itemsPerPageSelect =
        constantData.ITEMS_PER_PAGE;

      $rootScope.$on("$stateChangeSuccess", function () {
        document.body.scrollTop = document.documentElement.scrollTop = 0;
      });
      $templateCache.put(
        "template/smart-table/pagination.html",
        '<nav ng-if="numPages && pages.length >= 2"><ul class="pagination">' +
          '<li ng-class="page-item"><a ng-click="selectPage(1)">First</a></li>' +
          '<li ng-class=""><a ng-click="selectPage(currentPage-1)"><i class="fa fa-fw fa-angle-double-left"></i></a></li>' +
          '<li ng-repeat="page in pages" ng-class="{active: page==currentPage}"><a ng-click="selectPage(page)">{{page}}</a></li>' +
          '<li ng-class=""><a ng-click="selectPage(currentPage+1)"><i class="fa fa-fw fa-angle-double-right"></i></a></li>' +
          '<li ng-class=""><a ng-click="selectPage(numPages)">Last</a></li>' +
          "</ul></nav>"
      );
      $rootScope.$state = $state;
      $rootScope.$stateParams = $stateParams;
      $rootScope.$on("$stateChangeStart", function (event, toState, fromState) {
        //            //console.log("event", event);
        //console.log("toState", toState.name);
        //            //console.log("fromState", fromState);
        // in case, that TO state is the one we want to redirect
        // get out of here
        var login = false;

        dataFactory
          .httpRequest("/admin/auth/checkLogin", "POST", {}, {})
          .then(function (response) {
            if (response.status != 200) {
              $state.go("appSimple.login");
            } else {
              login = true;
              $rootScope.miniPass = response.responseData.miniPass;
              localStorageService.set(
                "adminId",
                response.responseData.loginData.id
              );
            }
            if (
              (toState.name == "app.hotels" || toState.name == "app.groups") &&
              login == true &&
              $rootScope.miniPass == "0"
            ) {
              $state.go("app.main");
            }
          });
        if (toState.name == "appSimple.login" && login == true) {
          $state.go("app.main");
        }
      });
      //   $transitions.onStart({to:"app.*"},function(trans)
      //   {
      //       //console.log(localStorageService.get('adminUser'));
      //           dataFactory.httpRequest("/admin/auth/checkLogin","POST",{},{}).then(function (response) {
      //               if(response.status != 200)
      //               {
      //                   $state.go("appSimple.login");
      //               }else{
      //                   localStorageService.set("adminId",response.responseData.loginData.id);
      //               }
      //           });
      //
      ////       if(localStorageService.get('adminUser'))
      ////       {
      ////           return true;
      ////       }else{
      ////
      ////           return $state.target("appSimple.login");
      ////       }
      //
      //   });
      //
      //   $transitions.onStart({to:"appSimple.*"},function(trans)
      //   {
      ////       if(localStorageService.get('adminUser'))
      ////       {
      ////           return $state.target("app.main");
      ////
      ////       }else{
      ////           return true;
      ////
      ////       }
      //
      //   });
      $rootScope.showMsg = function (type, message, elementId) {
        angular.element(document.querySelector(".errorSuccess")).remove();
        var a = type == "success" ? "success" : "danger";
        var b = type == "success" ? "Success" : "Error";
        var successDiv =
          '<div class="alert alert-' +
          a +
          ' errorSuccess" id="my' +
          elementId +
          '" > <a href="javascript:void(0)" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>\
                        <strong>' +
          b +
          "!</strong>&nbsp;" +
          message +
          "</div>";
        angular.element(document.querySelector(elementId)).before(successDiv);
      };

      $rootScope.showModel = function (pageName, modalData) {
        //console.log(modalData);
        modalData.moduleName = pageName;
        ModalService.showModal({
          templateUrl: "admin-template/modelTemplate/" + pageName + ".html",
          controller: "ModalController",
          inputs: {
            modalData: modalData,
          },
        }).then(function (modal) {
          modal.element.modal();
          modal.close.then(function (result) {});
        });
      };

      $rootScope.selected = [];
      // Function to get data for all selected items
      $rootScope.selectAll = function (collection, itemsPerPage) {
        var itemsPerPage = itemsPerPage || constantData.ITEMS_PER_PAGE;
        // if there are no items in the 'selected' array,
        // push all elements to 'selected'
        console.log("selected", $rootScope.selected);
        console.log("selected length", $rootScope.selected.length);
        if ($rootScope.selected.length === 0) {
          angular.forEach(collection, function (val) {
            $rootScope.selected.push(val.id);
          });

          // if there are items in the 'selected' array,
          // add only those that ar not
        } else if ($rootScope.selected.length > 0) {
          angular.forEach(collection, function (val) {
            var found = $rootScope.selected.indexOf(val.id);
            if (found == -1) $rootScope.selected.push(val.id);
          });
          if ($rootScope.selected.length <= itemsPerPage) {
            $rootScope.selected = [];
          }

          // Otherwise, remove all items
        } else {
          $rootScope.selected = [];
        }
      };
      // Function to get data by selecting a single row
      $rootScope.select = function (id) {
        var found = $rootScope.selected.indexOf(id);

        if (found == -1) $rootScope.selected.push(id);
        else $rootScope.selected.splice(found, 1);

        //            //console.log("sel", $rootScope.selected);
      };

      $rootScope.changeStatus = function (
        table,
        field,
        value,
        id,
        elemId,
        alert
      ) {
        alert = alert && alert != undefined ? alert : false;
        var c =
          alert == true ? confirm("Are you sure you want to do this?") : true;
        if (c == true) {
          $rootScope.isLoading = true;
          var postParam = { table: table, field: field, value: value, id: id };
          //                //console.log("pp", postParam);
          dataFactory
            .httpRequest("/admin/auth/changeStatus", "POST", "", postParam)
            .then(function (response) {
              $rootScope.isLoading = false;
              var respType = response.status == 200 ? "success" : "error";
              var msg = response.message;
              $rootScope.showMsg(respType, response.message, elemId);
            });
        }
      };

      $rootScope.editorOptions = {
        language: "en",
        height: 200,
      };
      $rootScope.editorOptionsMain = function () {
        language: "en";
      };
      $rootScope.resetForm = function (form) {
        //Even when you use form = {} it does not work
        angular.copy({}, form);
      };
    },
  ]);
app.filter("capitalize", function () {
  return function (input) {
    return !!input
      ? input.charAt(0).toUpperCase() + input.substr(1).toLowerCase()
      : "";
  };
});
app.filter("ucwords", function () {
  return function (input) {
    if (input) {
      //when input is defined the apply filter
      input = input.toLowerCase().replace(/\b[a-z]/g, function (letter) {
        return letter.toUpperCase();
      });
    }
    return input;
  };
});
app.filter("formatText", function () {
  return function (input) {
    if (input) {
      input = input.replace("_", " ");
      input = input.toLowerCase().replace(/\b[a-z]/g, function (letter) {
        return letter.toUpperCase();
      });
    }
    return input;
  };
});
