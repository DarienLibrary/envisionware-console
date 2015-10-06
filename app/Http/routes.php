<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Front Page
Route::get('/', 'WelcomeController@index');

// Report Forms
Route::get('/report/tx/welcomedesk', 'ReportsController@wdTxReport');
Route::get('/report/tx/helpdesk', 'ReportsController@hdTxReport');
Route::get('/report/tx/cafe', 'ReportsController@cafeTxReport');

// Form Results
Route::post('/reportdisplay/tx/welcomedesk', 'ReportsController@wdTxReportDisp');
Route::post('/reportdisplay/tx/helpdesk', 'ReportsController@hdTxReportDisp');
Route::post('/reportdisplay/tx/cafe', 'ReportsController@cafeTxReportDisp');
