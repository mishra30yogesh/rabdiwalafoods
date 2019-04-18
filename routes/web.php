<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home' , 'HomeController@index');

Auth::routes();
Route::post('/register-user', 'Auth\RegisterController@register_new_user');
Route::post('/update-password/{id}', 'Auth\ResetPasswordController@update_password');
Route::post('/update-user-details/{id}', 'Auth\RegisterController@update_user_details');

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/dashboard' , 'HomeController@dashboard');
Route::get('/users' , 'HomeController@users');
Route::get('/user-profile/{id}', 'HomeController@user_profile');
Route::post('/activate-user/{id}', 'HomeController@activate_user');
Route::post('/deactivate-user/{id}', 'HomeController@deactivate_user');

Route::any('/feedbacks', 'FeedbackController@feedbacks')->name('feedbacks');
Route::any('/my-feedbacks', 'FeedbackController@my_feedbacks')->name('feedbacks');
Route::get('/todays-feedbacks', 'FeedbackController@todays_feedback')->name('feedback-today');
Route::get('/add-feedback', 'FeedbackController@add_feedback_form')->name('feedbacks');
Route::post('/insert-feedback', 'FeedbackController@insert_feedback')->name('feedbacks');
Route::get('/view-feedback/{id}', 'FeedbackController@show_feedback')->name('feedbacks');
Route::post('/edit-feedback/{id}', 'FeedbackController@edit_feedback')->name('feedbacks');

Route::post('/get-restaurant-data/{id}', 'FeedbackController@get_restaurant_feedback')->name('feedbacks');

Route::any('/orders', 'OrderController@orders')->name('order');
Route::any('/my-orders', 'OrderController@my_orders')->name('order');
Route::get('/todays-orders', 'OrderController@todays_orders')->name('order-today');
Route::get('/add-order', 'OrderController@add_order_form')->name('order');
Route::post('/insert-order', 'OrderController@insert_order')->name('order');
Route::get('/view-order/{id}', 'OrderController@show_order')->name('order');
Route::get('/delete-order/{id}', 'OrderController@delete_order')->name('order');
Route::post('/update-delivery-status-order/{id}', 'OrderController@update_order_delivery_status')->name('order');
Route::any('/update-order/{id}', 'OrderController@update_order')->name('order');

Route::post('/get-order-data/{id}', 'OrderController@get_order_data')->name('order');

Route::get('/export-feedback-as-excel', 'HomeController@feedback_export');
Route::get('/export-orders-as-excel', 'HomeController@order_export');
Route::get('/export-users-as-excel', 'HomeController@user_export');

