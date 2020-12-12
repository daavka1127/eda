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

// Route::get('/', function () {
//     return view('layouts.layout_main');
// });
Route::get('/android/test', 'HomeController@test123');

// Route::get('/android/test', function(){
//   return "AA";
// });


Route::get('/testing/dadaa', 'employeeController@getEmptyRD');
Route::get('/testing/dadaa1', 'testingController@test1');
Route::get('/testing1/sda', 'testingController@testing1Sda');
Route::get('/sda/getSspClass', 'testingController@sdaSSP');
Route::get('/sda/showSspClass', 'testingController@showingSDA_ssp_CLASS');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('/changePassword','HomeController@changePassword')->name('changePassword');
Route::get('/admins', 'HomeController@showAdmins');
Route::post('/check/admin/password', 'HomeController@checkPassword');
Route::post('/get/checkPassword', 'HomeController@getCheckPasswordview');
Route::post('/update/admin', 'HomeController@updateAdmin');
Route::post('/show/password/reset', 'HomeController@showPasswordReset');
Route::post('/reset/password/admin', 'HomeController@resetPassword');

Route::get('/', 'HomeController@index');

Route::get('/ajillagaa', 'countryController@index');


Route::post('/get/ranks', 'rankController@getRank');


Route::post('/new/country/', 'countryController@store');
Route::post('/update/country/', 'countryController@update');
Route::post('/delete/country/', 'countryController@delete');
Route::get('/show/country/', 'countryController@show');
Route::get('/get/country', 'countryController@getCountries');
Route::post('/get/country/datatable', 'countryController@getCountriesDatatable');
Route::get('/ajillagaa/eelj', 'countryController@showEelj');
Route::post('/get/eelj/datatable', 'countryController@getEeljDatatable');


Route::post('/new/operation/', 'operationController@store');
Route::post('/update/operation/', 'operationController@update');
Route::post('/delete/operation/', 'operationController@delete');
Route::get('/show/operation/', 'operationController@show');
Route::post('/check/operation/', 'operationController@checkOperationNew');
Route::post('/check/operation/edit/', 'operationController@checkOperationEdit');
Route::get('/get/eelj', 'operationController@getEelj');


Route::get('units/', 'unitController@show');
Route::post('units/ajax', 'unitController@show1');
Route::post('/new/unit', 'unitController@store');
Route::post('/update/unit', 'unitController@update');
Route::post('/delete/unit', 'unitController@delete');
Route::post('/check/units', 'unitController@checkUnitID');


Route::get('/sectors', 'sectorController@show');
Route::post('/get/sectors/by/country', 'sectorController@getSector');
Route::post('/new/sector', 'sectorController@store');
Route::post('/update/sector', 'sectorController@update');
Route::post('/delete/sector', 'sectorController@delete');
Route::post('/get/sectors/combobox', 'sectorController@getSectorCombo');


Route::post('new/employee', 'employeeController@store');
Route::post('update/employee', 'employeeController@update');
Route::post('delete/employee', 'employeeController@delete');
Route::post('get/emp/byRD', 'employeeController@getEmpByRD');
Route::post('get/emp/nameRd', 'employeeController@getNameRd');


Route::get('/missions', 'missionController@show');
Route::post('new/mission', 'missionController@store');
Route::post('update/mission', 'missionController@update');
Route::post('delete/mission', 'missionController@delete');
Route::post('/get/mission', 'missionController@getEmpMission');
Route::post('/check/mission', 'missionController@checkMissionEmp');
Route::post('/get/mission/rd', 'missionController@getMissionByRD');
Route::post('/delete/all/emp/eelj', 'missionController@deleteEmpByEelj');


Route::get('/awards', 'awardsController@show');
Route::post('/get/awards/by/eelj', 'awardsController@getAwards');
Route::post('/new/awards', 'awardsController@store');
Route::post('/update/awards', 'awardsController@update');
Route::post('/delete/awards', 'awardsController@delete');
Route::post('/readmore/awards/rd', 'awardsController@readmoreAwads');


Route::get('/punishments', 'punishmentController@show');
Route::post('/get/punishments/by/eelj', 'punishmentController@getPunishmentsByEelj');
Route::post('/new/punishment', 'punishmentController@store');
Route::post('/update/punishment', 'punishmentController@update');
Route::post('/delete/punishment', 'punishmentController@delete');
Route::post('/readmore/punishments/rd', 'punishmentController@readmorePunishments');


Route::get('/mission/search', 'missionSearchController@showMissionSearch');
Route::post('/mission/search1', 'missionSearchController@searchMissionFast');
Route::get('/mission/sear', 'missionSearchController@showMissionSearchTest');


Route::get('/report/employee/details/{rd}', 'missionByemployeeController@showEmpReport');


Route::get('/upload/pdf', 'pdfUploadController@showPdfUpload');
Route::post('/upload/pdf', 'pdfUploadController@savePdf');


Route::get('/import/excel', 'excelController@showExcel');
Route::post('/import/excel', 'excelController@importExcel');
Route::get('/download/excel', 'excelController@downloadExcel');


Route::get('/trainings', 'trainingController@index');
Route::post('/get/trainings', 'trainingController@getTraining');
Route::post('/training/new', 'trainingController@store');
Route::post('/training/update', 'trainingController@update');
Route::post('/training/delete', 'trainingController@delete');
Route::post('/readmore/training/rd', 'trainingController@readmoreTrainings');
