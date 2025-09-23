app
        .config(['$stateProvider', '$urlRouterProvider', '$ocLazyLoadProvider', '$breadcrumbProvider', 'localStorageServiceProvider', function ($stateProvider, $urlRouterProvider, $ocLazyLoadProvider, $breadcrumbProvider, localStorageServiceProvider) {
                localStorageServiceProvider
                        .setPrefix('myapp');
      
                $urlRouterProvider.otherwise('/dashboard');
                
                $ocLazyLoadProvider.config({
                    // Set to true if you want to see what and when is dynamically loaded
                    debug: true
                });

                $breadcrumbProvider.setOptions({
                    prefixStateName: 'app.main',
                    includeAbstract: true,
                    template: '<li class="breadcrumb-item" ng-repeat="step in steps" ng-class="{active: $last}" ng-switch="$last || !!step.abstract"><a ng-switch-when="false" href="{{step.ncyBreadcrumbLink}}">{{step.ncyBreadcrumbLabel}}</a><span ng-switch-when="true">{{step.ncyBreadcrumbLabel}}</span></li>'
                });

                $stateProvider
                        .state('app', {
                            abstract: true,
                            templateUrl: 'admin-template/common%7Cfull.php',
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Root',
                                skip: true
                            },
                            resolve: {
                                loadCSS: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load CSS files
                                        return $ocLazyLoad.load([{
                                                serie: true,
                                                name: 'Font Awesome',
                                                files: ['../assets/admin/css/font-awesome.min.css']
                                            }, {
                                                serie: true,
                                                name: 'Simple Line Icons',
                                                files: ['../assets/admin/css/simple-line-icons.css']
                                            }]);
                                    }],
                                
                            }
                        })
                        .state('app.main', {
                            url: '/dashboard',
                            templateUrl: 'admin-template/main.html',
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Home',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Welcome to ROOT powerfull Bootstrap & AngularJS UI Kit'},
                            resolve: {
                                loadPlugin: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load files for an existing module
                                        return $ocLazyLoad.load([
                                            
                                        ]);
                                    }],
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
                                        return $ocLazyLoad.load({
                                            files: ['../app/admin/controllers/AdminController.js']
                                        });
                                    }]
                            }
                        })
                        .state('app.bookings', {
                            url: '/bookings/:type',
                            templateUrl: 'admin-template/bookingList.php',
                            controller:"BookingController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Manage Bookings',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Bookings',type:null},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        })
                        .state('app.contacts', {
                            url: '/contacts',
                            templateUrl: 'admin-template/contactList.php',
                            controller:"ContactController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Manage Contacts',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Contacts'},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        })
                         .state('app.contacts2', {
                            url: '/contacts2',
                            templateUrl: 'admin-template/contactList.php',
                            controller:"ContactController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Manage Contacts',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Contacts'},
                            resolve: {
                                
                            }
                        })
                        .state('app.quotes', {
                            url: '/quotes',
                            templateUrl: 'admin-template/quoteList.php',
                            controller:"QuoteController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Manage Quotes',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Quotes'},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        })
                         .state('app.subscribers', {
                            url: '/subscribers',
                            templateUrl: 'admin-template/subscribeList.php',
                            controller:"ContactController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Manage Subscribers',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Subscribers'},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        })
                        .state('app.coupons', {
                            url: '/coupons',
                            templateUrl: 'admin-template/couponList.php',
                            controller:"ContactController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Manage Coupons',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Coupons'},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        })
                         .state('app.activities', {
                            url: '/activities',
                            templateUrl: 'admin-template/manageActivities.html',
                            controller:"ActivityController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Manage Activities',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Activities'},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        })
                          .state('app.subActivities', {
                            url: '/subActivities/:actId',
                            templateUrl: 'admin-template/subActivities.html',
                            controller:"ActivityController",
                            //page title goes here
                            ncyBreadcrumb: {
                                parent: 'app.activities',
                                label: 'Manage Sub Activities'
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Sub Activities'},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        }).state('app.airportInfo', {
                            url: '/airportInfo',
                            templateUrl: 'admin-template/manageAirport.html',
                            controller:"AboutController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Manage Airport',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Airport Info',type:'airport'},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        })
                        .state('app.services', {
                            url: '/services',
                            templateUrl: 'admin-template/manageServices.html',
                            controller:"AboutController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Manage Services',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Servcies',type:'service'},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        })

                         .state('app.gallery', {
                            url: '/gallery',
                            templateUrl: 'admin-template/manageGallery.html',
                            controller:"GalleryController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Manage Gallery',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Gallery',type:'gallery'},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        })

                          .state('app.testimonials', {
                            url: '/testimonials',
                            templateUrl: 'admin-template/manageTestimonials.html',
                            controller:"TestimonialController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Manage Testimonials',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Testimonials',type:'testimonials'},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        })
                             .state('app.blogs', {
                            url: '/blogs',
                            templateUrl: 'admin-template/manageBlogs.html',
                            controller:"BlogController",
                            //page title goes here
                            ncyBreadcrumb: {
                                
                                label: 'Manage Blogs',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Blogs'},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        })
                         .state('app.addEditBlog', {
                            url: '/addEditBlog/:id?',
                            templateUrl: 'admin-template/addEditBlog.html',
                            controller:"BlogController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Add / Edit Blogs',
                                parent: 'app.blogs'
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Add/Edit Blogs',id:null},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        })
                        .state('app.comments', {
                            url: '/comments/:id',
                            templateUrl: 'admin-template/comments.html',
                            controller:"BlogController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Manage Comments',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Comments',id:null},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        })
                         .state('app.hotels', {
                            url: '/hotels',
                            templateUrl: 'admin-template/manageHotels.html',
                            controller:"HotelsController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Manage Hotels',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Hotels'},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        })
                         
                         .state('app.qaHeadings', {
                            url: '/qaHeadings',
                            templateUrl: 'admin-template/manageQaHeadings.html',
                            controller:"QaController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Manage Question & Answers Headings',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Question & Answers Headings'},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        })
                         .state('app.qa', {
                            url: '/qa/:qaId',
                            templateUrl: 'admin-template/manageQa.html',
                            controller:"QaController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Manage Question & Answers',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Question & Answers',qaId:null},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        })
                        .state('app.groups', {
                            url: '/groups/:type',
                            templateUrl: 'admin-template/manageGroups.html',
                            controller:"GroupsController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Manage Hotels',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Hotels',type:null},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        })
                        .state('app.sociallinks', {
                            url: '/social-links',
                            templateUrl: 'admin-template/socialLinks.html',
                            controller:"AdminController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Social Links',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Welcome to ROOT powerfull Bootstrap & AngularJS UI Kit'},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
                                        return $ocLazyLoad.load({
                                            files: ['../app/admin/controllers/AdminController.js']
                                        });
                                    }]
                            }
                        })
                        .state('app.discounts', {
                            url: '/discounts/:type',
                            templateUrl: 'admin-template/manageDiscounts.html',
                            controller:"DiscountController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Manage Discounts',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Discounts',type:null},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        })
                        .state('app.festivediscounts', {
                            url: '/discount/festive',
                            templateUrl: 'admin-template/manageFestiveDiscounts.html',
                            controller:"FestiveDiscountController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Manage Coupons',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Coupons',type:null},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        })
                        .state('app.festivecontent', {
                            url: '/discount/content',
                            templateUrl: 'admin-template/manageFestiveContent.html',
                            controller:"FestiveDiscountContentController",
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Manage Content',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Manage Content',type:null},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
//                                        return $ocLazyLoad.load({
//                                            files: ['../app/admin/controllers/AdminController.js', '../app/admin/controllers/BookingController.js']
//                                        });
                                    }]
                            }
                        })
                        .state('app.profile', {
                            url: '/profile',
                            templateUrl: 'admin-template/profile.html',
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Profile',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Welcome to ROOT powerfull Bootstrap & AngularJS UI Kit'},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                       
                                    }]
                            }
                        })
                        .state('app.changePassword', {
                            url: '/change-password',
                            templateUrl: 'admin-template/change-password.html',
                            //page title goes here
                            ncyBreadcrumb: {
                                label: 'Change Password',
                            },
                            //page subtitle goes here
                            params: {subtitle: 'Change Password'},
                            resolve: {
                                loadMyCtrl: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load controllers
                                        return $ocLazyLoad.load({
                                            files: ['../app/admin/controllers/AdminController.js']
                                        });
                                    }]
                            }
                        })
                        .state('appSimple', {
                            abstract: true,
                            templateUrl: 'admin-template/common%7Csimple.html',
                            resolve: {
                                loadPlugin: ['$ocLazyLoad', function ($ocLazyLoad) {
                                        // you can lazy load files for an existing module
                                        return $ocLazyLoad.load([{
                                                serie: true,
                                                name: 'Font Awesome',
                                                files: ['../assets/admin/css/font-awesome.min.css']
                                            }, {
                                                serie: true,
                                                name: 'Simple Line Icons',
                                                files: ['../assets/admin/css/simple-line-icons.css']
                                            }]);
                                    }],
                            }
                        })

                        // Additional Pages
                        .state('appSimple.login', {
                            url: '/login',
                            controller: 'LoginController',
                            templateUrl: 'admin-template/login.html'
                        })
                        .state('appSimple.register', {
                            url: '/register',
                            templateUrl: 'admin-template/register.html'
                        })
                        .state('appSimple.404', {
                            url: '/404',
                            templateUrl: 'admin-template/404.html'
                        })
                        .state('appSimple.500', {
                            url: '/500',
                            templateUrl: 'admin-template/500.html'
                        })
            }])