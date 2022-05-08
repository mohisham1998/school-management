<?php

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function () {

    //==============================dashboard============================
    Route::get('/teacher/dashboard', function () {



       $sections_ids = Teacher::findorfail(auth() -> user() -> id)->Sections()-> pluck('section_id');
       $data['sections_count'] = $sections_ids -> count();
       $data['students_count'] = Student::whereIn('section_id',$sections_ids) -> get() -> count();




        return view('pages.Teachers.dashboard',$data);
    });

});
