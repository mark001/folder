<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['translate_uri_dashes'] = TRUE;
$route['default_controller'] = "folder";
$route['404_override'] = '';

//client pages
$route['home'] = "folder_user/index";
$route['profile/(:any)'] = "";
$route['feedback'] = "folder_user/feedback";
$route['folder/myfolders'] = "folder_user/my_folders";
$route['folder/new'] = "folder_user/new_folder";
$route['folder/others'] = "folder/other_folders";

//admin pages
$route['administrator/logout'] = "folder_admin/logout";
$route['administrator'] = "folder_admin/index";
$route['administrator/reports'] = "folder_admin/reports";
$route['administrator/accounts/add'] = "folder_admin/setForm_user";
$route['administrator/accounts/edit/(:any)'] = "folder_admin/setForm_user/$1";
$route['administrator/accounts/manage'] = "folder_admin/manage_users";
$route['administrator/folders/manage'] = "folder_admin/manage_folders";

//admin functions
$route['administrator/accounts/create'] = "folder_admin/create_user";
$route['administrator/accounts/update/(:any)'] = "folder_admin/update_user/$1";
$route['administrator/accounts/delete/(:any)'] = "folder_admin/delete_user/$1";
$route['administrator/accounts/reset/password/(:any)'] = "folder_admin/reset_password/$1";
$route['administrator/accounts/ban/(:any)'] = "folder_admin/ban_user/$1";

//main page
$route['password/reset'] = "folder/password_reset";
$route['sign-up'] = "folder/sign_up";
$route['signing-up'] = "folder/create_user";
$route['logging-in'] = "folder/login";
$route['login'] = "folder/index";



/* End of file routes.php */
/* Location: ./application/config/routes.php */