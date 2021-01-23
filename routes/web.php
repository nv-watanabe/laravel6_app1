<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FullCalenderController;


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

Route::get('/', function () {
    return view('welcome');
});

// ajax-user(success)
Route::resource('ajax-crud', 'AjaxUserController');

// ajax-contacts(failure)
Route::get('contacts','ContactController@getIndex');
Route::post('contacts','ContactController@postStore');
Route::get('contacts/data','ContactController@getData');
Route::post('contact/update','ContactController@postUpdate');
Route::post('contact/delete','ContactController@postDelete');

// ajax-contact_form
Route::get('contact-form', 'ContactFormController@create');
Route::post('contact-form', 'ContactFormController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Ajax Multiple Image Upload with Preview
Route::get('image-view','AjaxImageController@ajaxImageUpload');
Route::post('image-view','AjaxImageController@ajaxImageUploadPost')->name('ajax.image.upload');


Route::get('/setEvents', 'EventController@setEvents');

Route::post('/ajax/addEvent', 'EventController@addEvent');
Route::post('/ajax/editEventDate', 'EventController@editEventDate');

// fullcalendar1
Route::get('fullcalender', [FullCalenderController::class, 'index']);
Route::post('fullcalenderAjax', [FullCalenderController::class, 'ajax']);


// fullcalendar2
Route::get('/fullcalendareventmaster','FullCalendarEventMasterController@index');
Route::get('/reservation','FullCalendarEventMasterController@reservation');
Route::post('/fullcalendareventmaster/create','FullCalendarEventMasterController@create');
Route::post('/fullcalendareventmaster/update','FullCalendarEventMasterController@update');
Route::post('/fullcalendareventmaster/delete','FullCalendarEventMasterController@destroy');
