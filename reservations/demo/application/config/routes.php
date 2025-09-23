<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Transportation';
$route['404_override'] = 'My404';
$route['translate_uri_dashes'] = FALSE;
$route['admin'] = "welcome/adminIndex";
//$route['admin'] = "admin/auth/index";
$route['admin/auth'] = 'admin/auth';
$route['admin/checkLogin'] = "admin/auth/checkLogin";
$route['templates/(:any)'] = "templates/view/$1";
$route['admin/admin-template/(:any)'] = "templates/adminview/$1";
$route['admin/admin-template/(:any)/(:any)'] = "templates/adminmodalview/$1/$2";



///front
$route['private-transportation'] = 'transportation/privateTransportation';
$route['transportation/login'] = "transportation/login";
$route['cabo-shuttle'] = 'transportation/caboShuttle';
$route['todos-santos'] = 'tours/todosSantos';
$route['city-tour'] = 'tours/cityTour';
$route['activities'] = 'activities/index';
$route['activities/saveQuote'] = 'activities/saveQuote';
$route['activities/(:any)'] = 'activities/index/$1';
$route['about-us'] = 'about/index';
$route['what-to-do'] = 'about/whatToDo';
$route['history'] = 'about/history';
$route['qa'] = 'about/qa';

$route['airport-info'] = 'about/airportInfo';
$route['services'] = 'about/services';
$route['blogs'] = 'blogs/index';
$route['blogs/saveComment'] = "blogs/saveComment";
$route['blogs/loadComments'] = "blogs/loadComments";
$route['blogs/sendFriend'] = "blogs/sendFriend";
$route['blogs/(:any)'] = "blogs/index/$1";
$route['terms-of-services'] = 'home/tos';
$route['createCaptcha'] = 'home/createCaptcha';
$route['home/saveBookit'] = 'home/saveBookit';
$route['privacy-policy'] = 'home/privacyPolicy';
$route['book-it'] = 'home/bookIt';
$route['gallery'] = 'home/gallery';
$route['testimonials'] = 'home/testimonials';
$route['sitemap'] = 'home/sitemap';
$route['book-it-done'] = 'home/bookItDone';
$route['contact-us'] = "Home/contact";
$route['offers'] = "Blogs/offers";



