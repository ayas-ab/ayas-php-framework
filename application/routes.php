<?php
use Core\Route as Route;
//Do not change the 404 name & controller/function

//          name     url      controller/function
Route::add('home', 'home', 'static_page/home');
Route::add('404', '404', 'static_page/error');



Route::add('login', 'login', 'login');
Route::add('account', 'account/profile', 'account/profile');
Route::add('edit_account', 'account/edit', 'account/edit');
Route::add('register', 'account/create', 'account/create');
Route::add('profile_display', 'profile/view', 'static_page/view_user');
Route::add('api-valid_email', 'api/validemail', 'ajax/check_email_ajax');
Route::add('ajax_check_email', 'ajax/check_email_ajax', 'ajax/check_email_ajax');


?>