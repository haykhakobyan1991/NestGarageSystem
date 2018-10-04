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
//start


//index
$route['admin'] = 'admin/User/index';
$route['admin/dashboard'] = 'admin/User/dashboard';


//web
$route['admin/web'] = 'admin/Sysadmin/web/';

//main
$route['admin/main'] = 'admin/Sysadmin/main/';


//solution challenge
$route['admin/solution_challenge'] = 'admin/Sysadmin/solution_challenge/';

//functional
$route['admin/functional'] = 'admin/Sysadmin/functional/';

//functional_2
$route['admin/functional_2'] = 'admin/Sysadmin/functional_2/';

//faq
$route['admin/faq'] = 'admin/Sysadmin/faq/';

//footer
$route['admin/footer_section'] = 'admin/Sysadmin/footer_section/';

//subscribe
$route['admin/subscribe'] = 'admin/Sysadmin/subscribe/';



$route['switchLanguage/(:any)'] = 'Main/switchLanguage/$1';



$route['admin/login'] = 'admin/User/login';


$route['admin/logout'] = 'admin/User/logout';


$route['default_controller'] = 'Main';


$route['/'] = 'Main/index/$1/$1';

$route['create_company'] = 'Main/create_company';







//end
