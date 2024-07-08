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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'padang/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

$route['login'] = 'login/index';
$route['login/actionlogin'] = 'login/actionlogin';
$route['login/logout'] = 'login/logout';
$route['login/(:any)'] = 'view/$1';
$route['home'] = 'home/index';

$route['register'] = 'register/index'; 
$route['register/add'] = 'register/add';
$route['register/edit/(:num)'] = 'register/edit/$1'; 
$route['register/delete/(:num)'] = 'register/delete/$1'; 
$route['register/index'] = 'register/index'; 

$route['news'] = 'news/index'; 
$route['news/add'] = 'news/add';
$route['news/edit/(:num)'] = 'news/edit/$1'; 
$route['news/delete/(:num)'] = 'news/delete/$1'; 
$route['news/index'] = 'news/index'; 
$route['news/view'] = 'news/view';

$route['padang'] = 'padang/index'; 
$route['padang/add'] = 'padang/add';
$route['padang/edit/(:num)'] = 'padang/edit/$1'; 
$route['padang/delete/(:num)'] = 'padang/delete/$1'; 
$route['padang/index'] = 'padang/index'; 
$route['padang/view'] = 'padang/view';

$route['taluak'] = 'taluak/index'; 
$route['taluak/add'] = 'taluak/add';
$route['taluak/edit/(:num)'] = 'taluak/edit/$1'; 
$route['taluak/delete/(:num)'] = 'taluak/delete/$1'; 
$route['taluak/index'] = 'taluak/index'; 
$route['taluak/view'] = 'taluak/view';

$route['painan'] = 'painan/index'; 
$route['painan/add'] = 'painan/add';
$route['painan/edit/(:num)'] = 'painan/edit/$1'; 
$route['painan/delete/(:num)'] = 'painan/delete/$1'; 
$route['painan/index'] = 'painan/index'; 
$route['painan/view'] = 'painan/view';
