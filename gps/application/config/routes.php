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
$route['default_controller'] = 'Gps';

//First


//gps tracking
$route['^(ru|hy)/gps_tracking$'] = "Gps/gps_tracking";
$route['^(ru|hy)/gps_tracking/(:num)$'] = "Gps/gps_tracking/$1";
$route['^(ru|hy)/speed'] = "Gps/speed";
$route['^(ru|hy)/fuel'] = "Gps/fuel";
$route['^(ru|hy)/geoferences'] = "Gps/geoferences";
$route['^(ru|hy)/trajectory'] = "Gps/trajectory";
$route['^(ru|hy)/sos'] = "Gps/sos";
$route['^(ru|hy)/load'] = "Gps/load";
$route['^(ru|hy)/event'] = "Gps/event";
$route['^(ru|hy)/event/(:any)/(:any)'] = "Gps/event/$1/$2";

$route['change_lang'] = "System_main/change_lang";
$route['access_denied'] = "User/access_denied";

//Second
$route['^(ru|hy)/(.+)$'] = "$2";
$route['^(ru|hy)$'] = $route['default_controller'];
//end
