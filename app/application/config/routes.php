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
$route['default_controller'] = 'main';

$route['user/register'] = 'user/register';
$route['user/register/process']['post'] = 'user/register_process';
$route['user/login'] = 'user/login';
$route['user/login/process']['post'] = 'user/login_process';
$route['user/logout'] = 'user/logout';
$route['user/profile'] = 'user/profile';

$route['contingent/entry/number'] = 'entry/entry_number';
$route['contingent/entry/number/process'] = 'entry/number_process';
$route['contingent/entry/name/(:any)'] = 'entry/entry_name/$1';
$route['api/entry/name/process'] = 'entry/name_process';
$route['entry/name/delete/process'] = 'entry/name_delete_process';
$route['contingent/entry/official/(:any)'] = 'entry/entry_official/$1';
$route['api/entry/official/process'] = 'entry/official_process';
$route['entry/official/delete/process'] = 'entry/official_delete_process';

$route['admin/official/login'] = 'admin/admin_login';
$route['admin/official/login/process']['post'] = 'admin/admin_login_process';
$route['admin/official/dashboard'] = 'admin/admin_dashboard';
$route['admin/official/logout'] = 'admin/admin_logout';

$route['admin/official/entry/number/view'] = 'admin/view_entry_number';
$route['admin/official/entry/name/view'] = 'admin/view_entry_name';
$route['admin/official/entry/official/view'] = 'admin/view_entry_official';

$route['admin/official/pdf/download/entry/number'] = 'admin/download_entry_number';
$route['admin/official/pdf/download/entry/name'] = 'admin/download_entry_name';
$route['admin/official/pdf/download/entry/official'] = 'admin/download_entry_official';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
