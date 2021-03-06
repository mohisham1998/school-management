<?php

use App\Http\Livewire\Calendar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;

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


Route::get('/', 'HomeController@index')->name('selection');

Route::group(['namespace' => 'Auth'], function () {
    Route::get('/login/{type}', 'LoginController@loginForm')->middleware('guest')->name('login.show');
    Route::post('/login', 'LoginController@login')->name('login');
    Route::get('/logout/{type}', 'LoginController@logout')->name('logout');
});


//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function () {

    //==============================dashboard============================
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

    //==============================dashboard============================


    //==============================Grades============================
    Route::group(['namespace' => 'Grades'], function () {
        Route::resource('Grades', 'GradeController');
    });
    //==============================Grades============================

    //==============================Classes============================
    Route::group(['namespace' => 'Classrooms'], function () {
        Route::resource('Classrooms', 'ClassroomController');
        Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');
        Route::get('Filter_Classes/{id}', 'ClassroomController@Filter_Classes')->name('Filter_Classes');
    });
    //==============================Classes============================

    //==============================Sections============================
    Route::group(['namespace' => 'Sections'], function () {
        Route::resource('Sections', 'SectionController');
        Route::get('/classes/{id}', 'SectionController@getclasses');
    });
    //==============================Sections============================


    //==============================Parents============================
    Route::view('add_parent', 'livewire.show_Form')->name('add_parent');
    //==============================Parents============================


    //==============================Teachers============================
    Route::group(['namespace' => 'Teachers'], function () {
        Route::resource('Teachers', 'TeacherController');
    });

    //==============================Students============================
    Route::group(['namespace' => 'Students'], function () {
        Route::resource('Students', 'StudentController');
        Route::resource('Promotion', 'PromotionController');
        Route::resource('Graduated', 'GraduatedController');
        Route::resource('Fees', 'FeesController');
        Route::resource('Fees_Invoices', 'FeeInvoicesController');
        Route::resource('receipt_students', 'ReceiptStudentsController');
        Route::resource('ProcessingFee', 'ProcessingFeeController');
        Route::resource('Payment_students', 'StudentPaymentController');
        Route::resource('Attendance', 'AttendanceController');
        Route::resource('online_classes', 'OnlineClassController');
        Route::resource('library', 'LibraryController');
        Route::get('download_file/{filename}', 'LibraryController@downloadAttachment')->name('downloadAttachment');
        Route::get('/Get_classrooms/{id}', 'StudentController@Get_classrooms');
        Route::get('/Get_Sections/{id}', 'StudentController@Get_Sections');
        Route::post('Upload_attachment', 'StudentController@Upload_attachment')->name('Upload_attachment');
        Route::get('Download_attachment/{studentsname}/{filename}', 'StudentController@Download_attachment')->name('Download_attachment');
        Route::post('Delete_attachment', 'StudentController@Delete_attachment')->name('Delete_attachment');

    });


    //==============================Subjects============================
    Route::group(['namespace' => 'Subjects'], function () {
        Route::resource('subjects', 'SubjectController');
    });


    //==============================Settings============================
    Route::group(['namespace' => 'Settings'], function () {
        Route::resource('settings', 'SettingController');
    });

    Livewire::component('calendar', Calendar::class);


});


