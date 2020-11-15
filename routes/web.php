<?php

use Illuminate\Support\Facades\Route;

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

/*
https://laravel.com/docs/7.x/controllers#introduction
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Route::view('/apis', 'apis')->middleware('auth');
Route::view('/apis', 'apis');
Route::get('/getTargetSolutionsData/employees', 'TargetSolutionsController@getEmployees');
Route::get('/getTargetSolutionsData/positions', 'TargetSolutionsController@getPositions');
Route::get('/getTargetSolutionsData/employees_profile', 'TargetSolutionsController@getEmployeesProfile');
Route::get('/getTargetSolutionsData/credentials', 'TargetSolutionsController@getCredentials');
Route::get('/getTargetSolutionsData/employees_credentials', 'TargetSolutionsController@getEmployeeCredentials');
Route::get('/getTargetSolutionsData/employees_credentials_complete', 'TargetSolutionsController@getEmployeesCredentialsComplete');

Route::resource('requirements','RequirementController');

Route::resource('credential_requirements','CredentialRequirementController');
Route::delete('credential_requirements/delete/{first}/{second}', 'CredentialRequirementController@destroy');
Route::get('credential_requirements/create/{first}', 'CredentialRequirementController@create');

Route::resource('position_requirements','PositionRequirementController');
Route::delete('position_requirements/delete/{first}/{second}', 'PositionRequirementController@destroy');
Route::get('position_requirements/create/{first}', 'PositionRequirementController@create');

Route::resource('employee_requirements_exclusion','EmployeeRequirementExclusionController');
Route::delete('employee_requirements_exclusion/delete/{first}/{second}', 'EmployeeRequirementExclusionController@destroy');
Route::get('employee_requirements_exclusion/create/{first}', 'EmployeeRequirementExclusionController@create');

Route::get('/audit', 'AuditController@createPDF');


Route::resource('gap_report','GapController');
Route::get('/gap_report/organization/{org}', 'GapController@createPDF');
Route::get('/gap_report/shift/{shift}', 'GapController@createPDF');
