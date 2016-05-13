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
$route['default_controller']   = 'welcome';
$route['admin_login/(:num)']   = "admin_login/index/$1";
$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;
$route['page/(:num)']          = "welcome/page/$1";
$route['contact_us']           = "welcome/contact_us";
$route['category/(:num)']      = "welcome/category/$1";
$route['food/(:num)']          = "welcome/food/$1";
$route['part/(:num)']          = "welcome/part/$1";
$route['part/(:num)/(:num)']   = "welcome/part/$1/$2";
$route['(:num)']               = "welcome/post/$1";
$route['categories']           = "welcome/categories";
$route['parts']                = "welcome/parts";
$route['search']               = "welcome/search";
$route['register']             = "welcome/register";
$route['logout']               = "welcome/logout";
$route['login']                = "welcome/login";
$route['add_comment']          = "welcome/add_comment";
$route['rss']                  = "welcome/rss";
$route['BMI']                  = "welcome/BMI";
$route['active_page']          = "welcome/active_page";
$route['active/(:num)']        = "welcome/active/$1";
/*
$route['search/(:any)']        = "welcome/search/$1";
$route['search/(:any)/(:any)'] = "welcome/search/$1/$2";
*/
