<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//admin
$route['dashboard'] = 'user/dashboard';
$route['setting'] = 'setting/setting';
$route['login'] = 'auth/user_login';
$route['logout'] = 'auth/logout';
$route['registration'] = 'auth/user_registration';
$route['recover'] = 'auth/user_recover';
$route['recover_password'] = 'auth/user_recover_password';
// license_verification -> lv
$route['lv/(:any)'] = 'auth/license_verification/$1';

$route['add_user'] = 'user/add_user';
$route['view_user'] = 'user/view_user';
$route['pendency_report'] = 'common/pendency_report';

$route['view_role'] = 'role/view_role';
$route['view_district'] = 'district/view_district';

$route['view_emp_info'] = 'emp_info/view_emp_info';
$route['view_form_type'] = 'form_type/view_form_type';
$route['view_form_type_docs'] = 'form_type_docs/view_form_type_docs';
$route['view_institute'] = 'institute/view_institute';
$route['view_pharmacist_category'] = 'pharmacist_category/view_pharmacist_category';
$route['view_qualification'] = 'qualification/view_qualification';
$route['view_pharmacist'] = 'pharmacist/view_pharmacist';
$route['view_other_pharmacist'] = 'other_pharmacist/view_other_pharmacist';
$route['view_proprietor'] = 'proprietor/view_proprietor';
$route['add_proprietor'] = 'proprietor/add_proprietor';
$route['view_apply'] = 'apply/view_apply';
$route['add_apply'] = 'apply/add_apply';
$route['view_inspection'] = 'inspection/view_inspection';
$route['view_province'] = 'province/view_province';
$route['view_tehsil'] = 'tehsil/view_tehsil';

$route['form_reports'] = 'common/form_reports';

$route['view_form_8a'] = 'form_8a/view_form_8a';
$route['add_form_8a'] = 'form_8a/add_form_8a';

$route['view_form_8b'] = 'form_8b/view_form_8b';
$route['add_form_8b'] = 'form_8b/add_form_8b';

$route['view_form_8c'] = 'form_8c/view_form_8c';
$route['add_form_8c'] = 'form_8c/add_form_8c';

$route['view_form_8d'] = 'form_8d/view_form_8d';
$route['add_form_8d'] = 'form_8d/add_form_8d';

$route['view_banks'] = 'banks/view_banks';
$route['view_bank_branch'] = 'bank_branch/view_bank_branch';

$route['setting'] = 'common/setting';

$route['default_controller'] = 'site';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
