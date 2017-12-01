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

//Route::get('/', function () {
//    return view('welcome');
//});

//Route::resource('member','MemberController');




//Route::get('/', function () {
//    return view('welcome');
//});


//





Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    Route::get('/', 'homecontroller@index');
    Route::resource('home','homecontroller');
    Route::resource('member','MemberController');
    Route::resource('machine','machinecontroller');
    Route::resource('project','projectcontroller');
    Route::resource('Standard','Standardcontroller');
    Route::resource('cho','chocontroller');
    Route::resource('schedule','schedulecontroller');
    Route::resource('VersionChange','VersionChangeController');
    Route::resource('Group','GroupController');
    Route::resource('Group_personnel','Group_personnelController');
    Route::resource('Parameter','Parametercontroller');
    Route::resource('result','resultcontroller');
    Route::resource('Access','AccessController');
    Route::resource('MachineRepair','MachineRepairController');
    Route::resource('MachineRepair_1','MachineRepairController_1');
    Route::resource('Minor_function_list','Minor_function_listController');
    Route::resource('Main_function_list','Main_function_listController');
    Route::resource('MachineRepair_1','MachineRepairController_1');
    Route::resource('alert','AlertController');
    Route::resource('report','reportController');
    Route::get('mail','MailController@mail');
});
