<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\FieldStudyController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\RulerController;

Route::get('/', function () {
    return view('welcome');
});

// university

Route::get('/university/create',[UniversityController::class , "create"]);
Route::post('/university/store',[UniversityController::class , "store"]);
Route::get('/university/index',[UniversityController::class , "index"]);
Route::get('/university/show/{id}',[UniversityController::class , "show"]);
Route::get('/university/delete/{id}',[UniversityController::class , "delete"]);
Route::get('/university/edite/{id}',[UniversityController::class , "edite"]);
Route::post('/university/update',[UniversityController::class , "update"]);
Route::get('/university/show_colleges/{id}',[UniversityController::class , "universitys_colleges"]);


// college

Route::get('/college/create',[CollegeController::class , "create"]);
Route::post('/college/store',[CollegeController::class , "store"]);
Route::get('/college/index',[CollegeController::class , "index"]);
Route::get('/college/show/{id}',[CollegeController::class , "show"]);
Route::get('/college/delete/{id}',[CollegeController::class , "delete"]);
Route::get('/college/edite/{id}',[CollegeController::class , "edite"]);
Route::get('/college/show_fields/{id}',[CollegeController::class , "collegesFields"]);
Route::post('/college/update',[CollegeController::class , "update"]);




// field_study

Route::get('/fieldStudy/create',[FieldStudyController::class , "create"]);
Route::post('/fieldStudy/store',[FieldStudyController::class , "store"]);
Route::get('/fieldStudy/index',[FieldStudyController::class , "index"]);
Route::get('/fieldStudy/show/{id}',[FieldStudyController::class , "show"]);
Route::get('/fieldStudy/edite/{id}',[FieldStudyController::class , "edite"]);
Route::get('/fieldStudy/delete/{id}',[FieldStudyController::class , "delete"]);
Route::get('/fieldStudy/fieldLessons/{id}',[FieldStudyController::class , "fieldLessons"]);
Route::post('/fieldStudy/update',[FieldStudyController::class , "update"]);
Route::get('/fieldStudy/masters/{id}',[FieldStudyController::class , "mastersList"]);


// lesson
Route::get('/lesson/create',[LessonController::class , "create"]);
Route::post('/lesson/store',[LessonController::class , "store"]);
Route::get('/lesson/index',[LessonController::class , "index"]);
Route::get('/lesson/show/{id}',[LessonController::class , "show"]);
Route::get('/lesson/edite/{id}',[LessonController::class , "edite"]);
Route::get('/lesson/delete/{id}',[LessonController::class , "delete"]);
Route::post('/lesson/update',[LessonController::class , "update"]);


// master
Route::get('/master/create',[MasterController::class , "create"]);



Route::post('/master/store',[MasterController::class , "store"]);

Route::get('/master/index',[MasterController::class , "index"]);
Route::get('/master/show/{id}',[MasterController::class , "show"]);
Route::get('/master/delete/{id}',[MasterController::class , "delete"]);
Route::get('/master/edite/{id}',[MasterController::class , "edite"]);
Route::post('/master/updata',[MasterController::class , "update"]);


// student

Route::get('/student/create',[StudentController::class , "create"]);
Route::get('/student/create2',[StudentController::class , "subCreate"]);
Route::post('/student/store',[StudentController::class , "store"]);
Route::get('/student/show/{id}',[StudentController::class , "show"]);
Route::get('/student/index',[StudentController::class , "index"]);
Route::get('/student/edite/{id}',[StudentController::class , "edit"]);
Route::get('/student/subEdit',[StudentController::class , "subEdit"]);
Route::get('/student/delete/{id}',[StudentController::class , "delete"]);
Route::get('/student/profile',[StudentController::class , "profile"]);
Route::post('/student/log',[StudentController::class , "log"]);
Route::post('/student/update',[StudentController::class , "update"]);

Route::get('/student/indexTerm/{id}',[StudentController::class , "indexTerm"]);
Route::get('/student/showLessons/{id}',[StudentController::class , "showLessons"]);

Route::get('/student/selectUnit/{id}',[StudentController::class , "selectUnit"]);

Route::post('/student/storeUnits',[StudentController::class , "storeUnits"]);

Route::get('/student/studentUnits/{id}',[StudentController::class , "studentUnits"]);

Route::get('/student/editeUnit/{id}/number_term/{number_term}',[StudentController::class , "editeUnit"]);

Route::post('/student/updateUnite',[StudentController::class , "updateUnite"]);



Route::get('/student/requests/{id}',[StudentController::class , "requests"]);

Route::get('/student/result_requests/{id}',[StudentController::class , "result_requests"]);
Route::get('/student/leave/{id}',[StudentController::class , "leave"]);


Route::get('/student/transfer/{id}',[StudentController::class , "transfer"]);

Route::post('/student/transfer2',[StudentController::class , "transfer2"]);
Route::post('/student/storeTransfer',[StudentController::class , "storeTransfer"]);


Route::get('/student/logEnteringGrades',[StudentController::class , "logEnteringGrades"]);

Route::post('/student/enteringGrades',[StudentController::class , "enteringGrades"]);
Route::post('/student/enteringGradesStore',[StudentController::class , "enteringGradesStore"]);
Route::post('/student/updateScore',[StudentController::class , "updateScore"]);

// ruler

Route::get('/ruler/create',[RulerController::class , "create"]);
Route::post('/ruler/store',[RulerController::class , "store"]); 
Route::get('/ruler/index',[RulerController::class , "index"]);
Route::get('/ruler/edite/{id}',[RulerController::class , "edite"]);
Route::get('/ruler/delete/{id}',[RulerController::class , "delete"]);

Route::post('/ruler/update',[RulerController::class , "update"]); 

Route::get('/ruler/show/{id}',[RulerController::class , "show"]);


Route::get('/ruler/transfers/{id}',[RulerController::class , "transfers"]);

Route::post('/ruler/transferStudent',[RulerController::class , "transferStudent"]); 


















