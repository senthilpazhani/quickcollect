<?php

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes(); //Just for Login

Auth::routes(['verify' => true]);

Route::get('profile',function(){
    return 'this is profile';
})->middleware('verified');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);

Route::get('user', 'UserController@list')->name('user');
Route::get('user/getdata', 'UserController@getdata')->name('user.getdata');
Route::post('user/postdata', 'UserController@postdata')->name('user.postdata');
Route::get('user/fetchdata/', 'UserController@fetchdata')->name('user.fetchdata');
Route::get('user/deletedata/', 'UserController@deletedata')->name('user.deletedata');

Route::get('followup', 'FollowupController@followup')->name('followup');
Route::get('followup/getdata', 'FollowupController@getdata')->name('followup.getdata');
Route::post('followup/postdata', 'FollowupController@postdata')->name('followup.postdata');
Route::get('followup/fetchdata/', 'FollowupController@fetchdata')->name('followup.fetchdata');
Route::get('followup/deletedata/', 'FollowupController@deletedata')->name('followup.deletedata');

Route::get('receipt', 'ReceiptController@list')->name('receipt');

Route::get('emailtemplate', 'EmailtemplateController@list')->name('emailtemplate');
Route::get('emailtemplate/getdata', 'EmailtemplateController@getdata')->name('emailtemplate.getdata');
Route::post('emailtemplate/postdata', 'EmailtemplateController@postdata')->name('emailtemplate.postdata');
Route::get('emailtemplate/fetchdata/', 'EmailtemplateController@fetchdata')->name('emailtemplate.fetchdata');
Route::get('emailtemplate/deletedata/', 'EmailtemplateController@deletedata')->name('emailtemplate.deletedata');
Route::get('smtp', 'EmailtemplateController@smtp')->name('smtp');
Route::post('smtp/postsmtp', 'EmailtemplateController@postsmtp')->name('smtp.postsmtp');
Route::get('systemsetting', 'EmailtemplateController@systemsetting')->name('systemsetting');
Route::post('systemsetting/postsystemsetting', 'EmailtemplateController@postsystemsetting')->name('systemsetting.postsystemsetting');

Route::get('smstemplate', 'SmstemplateController@list')->name('smstemplate');
Route::get('smstemplate/getdata', 'SmstemplateController@getdata')->name('smstemplate.getdata');
Route::post('smstemplate/postdata', 'SmstemplateController@postdata')->name('smstemplate.postdata');
Route::get('smstemplate/fetchdata/', 'SmstemplateController@fetchdata')->name('smstemplate.fetchdata');
Route::get('smstemplate/deletedata/', 'SmstemplateController@deletedata')->name('smstemplate.deletedata');

Route::get('tag', 'TagController@list')->name('tag');
Route::get('tag/getdata', 'TagController@getdata')->name('tag.getdata');
Route::post('tag/postdata', 'TagController@postdata')->name('tag.postdata');
Route::get('tag/fetchdata/', 'TagController@fetchdata')->name('tag.fetchdata');
Route::get('tag/deletedata/', 'TagController@deletedata')->name('tag.deletedata');

Route::get('customfield', 'CustomfieldController@list')->name('customfield');
Route::get('customfield/getdata', 'CustomfieldController@getdata')->name('customfield.getdata');
Route::post('customfield/postdata', 'CustomfieldController@postdata')->name('customfield.postdata');
Route::get('customfield/fetchdata/', 'CustomfieldController@fetchdata')->name('customfield.fetchdata');
Route::get('customfield/deletedata/', 'CustomfieldController@deletedata')->name('customfield.deletedata');

Route::get('customer', 'FollowupController@list')->name('customer');
Route::get('customer/getcustomer', 'FollowupController@getcustomer')->name('customer.getcustomer');
Route::post('customer/postcustomer', 'FollowupController@postcustomer')->name('customer.postcustomer');
Route::get('customer/fetchcustomer/', 'FollowupController@fetchcustomer')->name('customer.fetchcustomer');
Route::get('customer/deletecustomer/', 'FollowupController@deletecustomer')->name('customer.deletecustomer');

//Route::get('followupitem/getfollowupitem/{cid}', 'FollowupController@getfollowupitem')->name('followupitem.getfollowupitem');
Route::get('followupitem/getfollowupitem', 'FollowupController@getfollowupitem')->name('followupitem.getfollowupitem');
Route::post('followupitem/postfollowupitem', 'FollowupController@postfollowupitem')->name('followupitem.postfollowupitem');
Route::get('followupitem/fetchfollowupitem/', 'FollowupController@fetchfollowupitem')->name('followupitem.fetchfollowupitem');
Route::get('followupitem/deletefollowupitem/', 'FollowupController@deletefollowupitem')->name('followupitem.deletefollowupitem');
