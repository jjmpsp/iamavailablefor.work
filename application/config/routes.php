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

$route['default_controller'] = "app";
$route['404_override'] = 'app/_404';
$route['404'] = 'app/_404';

// All the reserved routes
$route['register/(:any)'] = "app/register/$1";
$route['register'] = "app/register";
$route['login'] = "app/login";
$route['logout'] = "app/logout";
$route['account'] = "app/account";
$route['profiles'] = "app/profiles";
$route['api'] = "app/api";
$route['contact'] = "app/contact";

$route['ajax/checkUsername'] = "api/ajax/checkUsername";
$route['ajax/editAccountSettings'] = "api/ajax/editAccountSettings";
$route['ajax/editProfileSettings'] = "api/ajax/editProfileSettings";
$route['ajax/editProfileInformation'] = "api/ajax/editProfileInformation";
$route['ajax/addEducation'] = "api/ajax/addEducation";
$route['ajax/deleteEducation'] = "api/ajax/deleteEducation";
$route['ajax/addSkill'] = "api/ajax/addSkill";
$route['ajax/deleteSkill'] = "api/ajax/deleteSkill";
$route['ajax/addPortfolioItem'] = "api/ajax/addPortfolioItem";
$route['ajax/deletePortfolioItem'] = "api/ajax/deletePortfolioItem";
$route['ajax/addSocialMedia'] = "api/ajax/addSocialMedia";
$route['ajax/checkUsername(:any)'] = "api/ajax/checkUsername/$1";

$route['test'] = "app/test";
$route['test2'] = "app/test2";
$route['api/example/users/(:num)'] = 'api/ajax/users/id/$1'; // Example 4
$route['api/example/users/(:num)(\.)([a-zA-Z0-9_-]+)(.*)'] = 'api/example/ajax/id/$1/format/$3$4'; // Example 8

// A custom route which will redirect all other requests
$route['(:any)'] = "app/handleProfile/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */