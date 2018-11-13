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
$route['default_controller'] = 'Main';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//------------------ Defining Custom Routes ------------------
$route['login'] = 'main/login';
$route['profile'] = 'main/profile';
$route['logout'] = 'main/logout';
$route['system-settings'] = 'main/system_settings';
$route['dashboard'] = 'main/dashboard';
$route['add-new-hostel'] = 'main/add_new_hostel';
$route['list-hostels'] = 'main/list_hostels';
$route['update-hostel-info/(:any)'] = 'main/update_hostel_info/$1';
$route['add-new-member'] = 'main/show_add_new_member_page';
$route['list-members'] = 'main/show_list_members_page';
$route['add-new-room'] = 'main/show_add_new_room_page';
$route['list-rooms'] = 'main/show_list_rooms_page';
$route['update-room-info/(:any)'] = 'main/show_update_room_page/$1';
$route['update-member-info/(:any)'] = 'main/show_update_member_info_page/$1';
$route['hostel-payment'] = 'main/show_hostel_payment_page';
$route['bill-payments'] = 'main/show_bill_payment_page';
$route['expense-list/(:any)'] = 'main/show_expense_list_page/$1';
$route['list-daily-expense'] = 'main/show_daily_expense_page';
$route['update-expense-list/(:any)/(:any)'] = 'main/show_update_expense_list_page/$1/$2';
$route['add-mess'] = 'main/show_add_mess_page';
$route['list-outside-mess'] = 'main/show_list_outside_mess';
$route['update-outside-mess/(:any)'] = 'main/show_update_outside_mess_page/$1';
$route['mess-payments'] = 'main/show_mess_payment_page';
$route['monthly-expense'] = 'main/show_monthly_expense_page';
$route['switch-hostel'] = 'main/switch_hostel';
$route['list-workers'] = 'main/show_list_worker_page';
$route['add-new-worker'] = 'main/show_add_new_worker_page';
$route['update-worker-info/(:any)'] = 'main/show_update_worker_page/$1';
$route['worker-expense'] = 'main/show_worker_expense_page';
$route['view-income-statement'] = 'main/view_income_statement';
$route['mess-expense'] = 'main/show_mess_expense_page';
$route['mess-statement'] = 'main/view_mess_statement';
$route['remove-entry/(:any)/(:any)/(:any)/(:any)'] = 'main/remove_entry/$1/$2/$3/$4';