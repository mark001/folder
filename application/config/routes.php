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
$route['404_override'] = 'folder/error404';


//admin pages
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
$route['logout'] = "folder/logout";
$route['check/username/(:any)'] = "folder/check_user_username/$1";
$route['check/email/(:any)'] = "folder/check_user_email/$1";

//client functions
$route['encrypt'] = "folder_user/encryptPassword";
$route['reporting'] = "folder_user/report";
$route['folder/create'] = "folder_user/createNewFolder";
$route['edit/profile/(:any)'] = "folder_user/update_account_info/$1";
$route['change/password/(:any)'] = "folder_user/change_password/$1";
$route['push/(:any)'] = "folder_user/push/$1";
$route['folder/branch/create'] = "folder_user/createBranch";
$route['folder/branch/check'] = "folder_user/checkBranch";
$route['folder/check'] = "folder_user/checkFolder";
$route['folder/delete/(:any)'] = "folder_user/deleteFolder/$1";
$route['folder/access/change/(:any)'] = "folder_user/changeAccess/$1";
$route['folder/download/zip/(:any)/(:any)/(:any)'] = "folder_user/create_zip/$1/$2/$3";
$route['folder/download/(:any)'] = "folder_user/download_folder/$1";

//client pages
$route['home'] = "folder_user/index";
$route['profile/(:any)'] = "folder_user/profile/$1";
$route['feedback'] = "folder_user/feedback";
$route['folder/new'] = "folder_user/new_folder";
$route['folder/others'] = "folder_user/other_folders";
$route['folder/(:any)/push'] = "folder_user/push_page/$1";
$route['folder/(:any)/(:any)/(:any)'] = "folder_user/source/$1/$2/$3";
$route['folder/(:any)/(:any)'] = "folder_user/source_main/$1/$2";
$route['folder/(:any)'] = "folder_user/my_folders/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */