app
        .directive('a', preventClickDirective)
        .directive('a', bootstrapCollapseDirective)
        .directive('a', navigationDirective)
// .directive('nav', sidebarNavDynamicResizeDirective)
        .directive('button', layoutToggleDirective)
        .directive('a', layoutToggleDirective)
        .directive('button', collapseMenuTogglerDirective)
        .directive('div', bootstrapCarouselDirective)
        .directive('toggle', bootstrapTooltipsPopoversDirective)
        .directive('tab', bootstrapTabsDirective)
        .directive('button', cardCollapseDirective).directive('rowSelect', rowSelect).directive('rowSelectAll', rowSelectAll)
        .directive('stSelectAll', function () {
            return {
                restrict: 'E',
                template: '<input type="checkbox" ng-model="isAllSelected" />',
                scope: {
                    all: '='
                },
                link: function (scope, element, attr) {
//                    console.log("al", scope.all);
                    scope.$watch('isAllSelected', function () {
                        scope.all.forEach(function (val) {
                            val.isSelected = scope.isAllSelected;
                        })
                    });

                    scope.$watch('all', function (newVal, oldVal) {
                        if (oldVal) {
                            oldVal.forEach(function (val) {
                                val.isSelected = false;
                            });
                        }

                        scope.isAllSelected = false;
                    });
                }
            }
        });
function rowSelectAll() {

    return {
        require: '^stTable',
        template: '<input type="checkbox" >',
        scope: {
            all: '=rowSelectAll',
            selected: '='
        },
        link: function (scope, element, attr) {

            scope.isAllSelected = false;

            element.bind('click', function (evt) {

                scope.$apply(function () {

                    scope.all.forEach(function (val) {

                        val.isSelected = scope.isAllSelected;

                    });

                });

            });

            scope.$watchCollection('selected', function (newVal) {

                var s = newVal.length;
                var a = scope.all.length;

                if ((s == a) && s > 0 && a > 0) {

                    element.find('input').prop('checked', true);
                    scope.isAllSelected = false;

                } else {

                    element.find('input').prop('checked', false);
                    scope.isAllSelected = true;

                }

            });
        }
    };
}

function rowSelect() {
    return {
        require: '^stTable',
        template: '<input type="checkbox">',
        scope: {
            row: '=rowSelect'
        },
        link: function (scope, element, attr, ctrl) {

            element.bind('click', function (evt) {

                scope.$apply(function () {

                    ctrl.select(scope.row, 'multiple');

                });

            });

            scope.$watch('row.isSelected', function (newValue) {

                if (newValue === true) {

                    element.parent().addClass('st-selected');
                    element.find('input').prop('checked', true);

                } else {

                    element.parent().removeClass('st-selected');
                    element.find('input').prop('checked', false);

                }
            });
        }
    };
}

app.directive('back', ['$window', function ($window) {
        return {
            restrict: 'A',
            link: function (scope, elem, attrs) {
                elem.bind('click', function () {
                    $window.history.back();
                });
            }
        };
    }]);


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
app.directive('fileModel', ['$parse', function ($parse) {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
//                console.log("attrs",attrs);
                var model = $parse(attrs.fileModel);
                var isMultiple = attrs.multiple;
                var modelSetter = model.assign;
                element.bind('change', function () {
                    var values = [];
                    angular.forEach(element[0].files, function (item) {
//                    var value = {
//                       // File Name 
//                        name: item.name,
//                        //File Size 
//                        size: item.size,
//                        //File URL to view 
//                        url: URL.createObjectURL(item),
//                        // File Input Value 
//                        _file: item
//                    };
                        values.push(item);
                    });
                    scope.$apply(function () {
                        if (isMultiple) {
                            modelSetter(scope, values);
                        } else {
                            modelSetter(scope, values[0]);
                        }
                    });
                });
            }
        };
    }]);


app.directive('fileUpload', function () {
    return {
        scope: true, //create a new scope
        link: function (scope, el, attrs) {
            el.bind('change', function (event) {
                var files = event.target.files;
                //iterate files since 'multiple' may be specified on the element
                for (var i = 0; i < files.length; i++) {
                    //emit event upward
                    scope.$emit("fileSelected", {file: files[i]});
                }
            });
        }
    };
});

app.directive('routeLoader', function () {
    return {
        restrict: 'EA',
        link: function (scope, element) {
            // Store original display mode of element
            var shownType = element.css('display');
            function hideElement() {
                element.css('display', 'none');
            }

            scope.$on('$routeChangeStart', function () {
                element.css('display', shownType);
            });
            scope.$on('$routeChangeSuccess', hideElement);
            scope.$on('$routeChangeError', hideElement);
            // Initially element is hidden
            hideElement();
        }
    }
});

app.directive('ngFileModel', ['$parse', function ($parse) {
        return {
            restrict: 'A',
            link: function (scope, element, attrs) {
                var model = $parse(attrs.ngFileModel);
                var isMultiple = attrs.multiple;
                var modelSetter = model.assign;
                element.bind('change', function () {
                    var values = [];
                    angular.forEach(element[0].files, function (item) {
                        var value = {
                            // File Name 
                            name: item.name,
                            //File Size 
                            size: item.size,
                            //File URL to view 
                            url: URL.createObjectURL(item),
                            // File Input Value 
                            _file: item
                        };
                        values.push(value);
                    });
                    scope.$apply(function () {
                        if (isMultiple) {
                            modelSetter(scope, values);
                        } else {
                            modelSetter(scope, values[0]);
                        }
                    });
                });
            }
        };
    }]);


//Prevent click if href="#"
function preventClickDirective() {
    var directive = {
        restrict: 'E',
        link: link
    }
    return directive;

    function link(scope, element, attrs) {
        if (attrs.href === '#') {
            element.on('click', function (event) {
                event.preventDefault();
            });
        }
    }
}

//Bootstrap Collapse
function bootstrapCollapseDirective() {
    var directive = {
        restrict: 'E',
        link: link
    }
    return directive;

    function link(scope, element, attrs) {
        if (attrs.toggle == 'collapse') {
            element.attr('href', 'javascript;;').attr('data-target', attrs.href.replace('index.html', ''));
        }
    }
}

/**
 * @desc Genesis main navigation - Siedebar menu
 * @example <li class="nav-item nav-dropdown"></li>
 */
function navigationDirective() {
    var directive = {
        restrict: 'E',
        link: link
    }
    return directive;

    function link(scope, element, attrs) {
        if (element.hasClass('nav-dropdown-toggle') && angular.element('body').width() > 782) {
            element.on('click', function () {
                if (!angular.element('body').hasClass('compact-nav')) {
                    element.parent().toggleClass('open').find('.open').removeClass('open');
                }
            });
        } else if (element.hasClass('nav-dropdown-toggle') && angular.element('body').width() < 783) {
            element.on('click', function () {
                element.parent().toggleClass('open').find('.open').removeClass('open');
            });
        }
    }
}

//Dynamic resize .sidebar-nav
sidebarNavDynamicResizeDirective.$inject = ['$window', '$timeout'];
function sidebarNavDynamicResizeDirective($window, $timeout) {
    var directive = {
        restrict: 'E',
        link: link
    }
    return directive;

    function link(scope, element, attrs) {

        if (element.hasClass('sidebar-nav') && angular.element('body').hasClass('fixed-nav')) {
            var bodyHeight = angular.element(window).height();
            scope.$watch(function () {
                var headerHeight = angular.element('header').outerHeight();

                if (angular.element('body').hasClass('sidebar-off-canvas')) {
                    element.css('height', bodyHeight);
                } else {
                    element.css('height', bodyHeight - headerHeight);
                }
            })

            angular.element($window).bind('resize', function () {
                var bodyHeight = angular.element(window).height();
                var headerHeight = angular.element('header').outerHeight();
                var sidebarHeaderHeight = angular.element('.sidebar-header').outerHeight();
                var sidebarFooterHeight = angular.element('.sidebar-footer').outerHeight();

                if (angular.element('body').hasClass('sidebar-off-canvas')) {
                    element.css('height', bodyHeight - sidebarHeaderHeight - sidebarFooterHeight);
                } else {
                    element.css('height', bodyHeight - headerHeight - sidebarHeaderHeight - sidebarFooterHeight);
                }
            });
        }
    }
}

//LayoutToggle
layoutToggleDirective.$inject = ['$interval'];
function layoutToggleDirective($interval) {
    var directive = {
        restrict: 'E',
        link: link
    }
    return directive;

    function link(scope, element, attrs) {
        element.on('click', function () {

            if (element.hasClass('sidebar-toggler')) {
                angular.element('body').toggleClass('sidebar-hidden');
            }

            if (element.hasClass('aside-menu-toggler')) {
                angular.element('body').toggleClass('aside-menu-hidden');
            }
        });
    }
}

//Collapse menu toggler
function collapseMenuTogglerDirective() {
    var directive = {
        restrict: 'E',
        link: link
    }
    return directive;

    function link(scope, element, attrs) {
        element.on('click', function () {
            if (element.hasClass('navbar-toggler') && !element.hasClass('layout-toggler')) {
                angular.element('body').toggleClass('mobile-open')
            }
        })
    }
}

//Bootstrap Carousel
function bootstrapCarouselDirective() {
    var directive = {
        restrict: 'E',
        link: link
    }
    return directive;

    function link(scope, element, attrs) {
        if (attrs.ride == 'carousel') {
            element.find('a').each(function () {
                $(this).attr('data-target', $(this).attr('href').replace('index.html', '')).attr('href', 'javascript;;')
            });
        }
    }
}

//Bootstrap Tooltips & Popovers
function bootstrapTooltipsPopoversDirective() {
    var directive = {
        restrict: 'A',
        link: link
    }
    return directive;

    function link(scope, element, attrs) {
        if (attrs.toggle == 'tooltip') {
            angular.element(element).tooltip();
        }
        if (attrs.toggle == 'popover') {
            angular.element(element).popover();
        }
    }
}

//Bootstrap Tabs
function bootstrapTabsDirective() {
    var directive = {
        restrict: 'A',
        link: link
    }
    return directive;

    function link(scope, element, attrs) {
        element.click(function (e) {
            e.preventDefault();
            angular.element(element).tab('show');
        });
    }
}

//Card Collapse
function cardCollapseDirective() {
    var directive = {
        restrict: 'E',
        link: link
    }
    return directive;

    function link(scope, element, attrs) {
        if (attrs.toggle == 'collapse' && element.parent().hasClass('card-actions')) {

            if (element.parent().parent().parent().find('.card-block').hasClass('in')) {
                element.find('i').addClass('r180');
            }

            var id = 'collapse-' + Math.floor((Math.random() * 1000000000) + 1);
            element.attr('data-target', '#' + id)
            element.parent().parent().parent().find('.card-block').attr('id', id);

            element.on('click', function () {
                element.find('i').toggleClass('r180');
            })
        }
    }
}
