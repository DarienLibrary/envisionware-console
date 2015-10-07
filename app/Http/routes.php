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
Route::get('/report/tx/welcomedesk', 'ReportsController@wdMdseTxReport');
Route::get('/report/tx/helpdesk', 'ReportsController@hdMdseTxReport');
Route::get('/report/tx/cafe', 'ReportsController@cafeMdseTxReport');

Route::get('/report/tx/kioskKLS', 'ReportsController@kioskKLSTxReport');
Route::get('/report/tx/kioskBC', 'ReportsController@kioskBCTxReport');
Route::get('/report/tx/kioskPL', 'ReportsController@kioskPLTxReport');
Route::get('/report/tx/kioskWeb', 'ReportsController@kioskWebTxReport');

Route::get('/report/tx/ldsKLS', 'ReportsController@ldsKLSTxReport');
Route::get('/report/tx/ldsBC', 'ReportsController@ldsBCTxReport');

// Form Results
Route::post('/reportdisplay/tx/welcomedesk', 'ReportsController@wdMdseTxReportDisp');
Route::post('/reportdisplay/tx/helpdesk', 'ReportsController@hdMdseTxReportDisp');
Route::post('/reportdisplay/tx/cafe', 'ReportsController@cafeMdseTxReportDisp');

Route::post('/reportdisplay/tx/kioskKLS', 'ReportsController@kioskKLSTxReportDisp');
Route::post('/reportdisplay/tx/kioskBC', 'ReportsController@kioskBCTxReportDisp');
Route::post('/reportdisplay/tx/KioskPL', 'ReportsController@kioskPLTxReportDisp');
Route::post('/reportdisplay/tx/KioskWeb', 'ReportsController@kioskWebTxReportDisp');

Route::post('/reportdisplay/tx/ldsKLS', 'ReportsController@ldsKLSTxReportDisp');
Route::post('/reportdisplay/tx/ldsBC', 'ReportsController@ldsBCTxReportDisp');