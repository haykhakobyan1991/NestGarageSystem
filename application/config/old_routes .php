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


//user
$route['admin/sysadmin/user'] = 'admin/Sysadmin/user/';
$route['admin/sysadmin/add_user'] = 'admin/Sysadmin/add_user/';
$route['admin/sysadmin/edit_user'] = 'admin/Sysadmin/edit_user/';
$route['admin/sysadmin/user_details'] = 'admin/Sysadmin/user_details/';

//permission
$route['admin/sysadmin/permission'] = 'admin/Sysadmin/permission/';
$route['admin/sysadmin/add_permission'] = 'admin/Sysadmin/add_permission/';
$route['admin/sysadmin/edit_permission'] = 'admin/Sysadmin/edit_permission/';
$route['admin/sysadmin/permission_details'] = 'admin/Sysadmin/permission_details/';

//role
$route['admin/sysadmin/role'] = 'admin/Sysadmin/role/';
$route['admin/sysadmin/add_role'] = 'admin/Sysadmin/add_role/';
$route['admin/sysadmin/edit_role'] = 'admin/Sysadmin/edit_role/';
$route['admin/sysadmin/role_details'] = 'admin/Sysadmin/role_details/';

//video
$route['admin/sysadmin/video'] = 'admin/Sysadmin/video/';
$route['admin/sysadmin/video/(:num)'] = 'admin/Sysadmin/video/$1';
$route['admin/sysadmin/add_video'] = 'admin/Sysadmin/add_video/';
$route['admin/sysadmin/edit_video'] = 'admin/Sysadmin/edit_video/';
$route['admin/sysadmin/edit_video/(:num)'] = 'admin/Sysadmin/edit_video/$1';
$route['admin/sysadmin/video_details'] = 'admin/Sysadmin/video_details/';

//video_list
$route['admin/sysadmin/video_list'] = 'admin/Sysadmin/video_list/';
$route['admin/sysadmin/add_video_list'] = 'admin/Sysadmin/add_video_list/';
$route['admin/sysadmin/edit_video_list'] = 'admin/Sysadmin/edit_video_list/$1';
$route['admin/sysadmin/video_list_details'] = 'admin/Sysadmin/video_list_details/';

//menu
$route['admin/sysadmin/edit_menu'] = 'admin/Sysadmin/edit_menu/';

//config
$route['admin/sysadmin/config'] = 'admin/Sysadmin/config/';


$route['admin/login'] = 'admin/User/login';


$route['admin/logout'] = 'admin/User/logout';


$route['default_controller'] = 'Main';

$route['(\w{2})/(.*)'] = '$2';
$route['(\w{2})'] = $route['default_controller'];


$route['/'] = 'Main/index/$1/$1';


$route['video/(:any)'] = 'Main/video/$1';


$route['video_list/(:any)'] = 'Main/video_list/$1';


$route['video_list'] = 'Main/video_list/';


$route['edit_user/(:num)'] = 'Sysadmin/edit_user';


$route['copy_user/(:num)'] = 'Sysadmin/copy_user';


$route['user_details/(:num)'] = 'Sysadmin/user_details';


$route['sysadmin/user/(:any)'] = 'Sysadmin/user/$1';


$route['sysadmin/user/(:any)/(:any)'] = 'Sysadmin/user/$1/$2';


$route['404_override'] = '';


$route['translate_uri_dashes'] = TRUE;


$route['form'] = 'sysadmin/add_gallery';


$route['upload'] = 'gallery';








//end