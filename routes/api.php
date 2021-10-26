<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Api\ActivitiesController;
use App\Http\Controllers\Api\ClassController;
use App\Http\Controllers\Api\DeliveriesController;
use App\Http\Controllers\Api\EvaluationsController;
use App\Http\Controllers\Api\ForgotPasswordController;
use App\Http\Controllers\Api\HomeworkController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\Api\MessagesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('class' , 'Api\ClassController');
Route::apiResource('users' , 'Api\UsersController');
Route::apiResource('homework' , 'Api\HomeworkController');
Route::apiResource('homework' , 'Api\HomeworkController');
Route::apiResource('activities' , 'Api\ActivitiesController');
Route::apiResource('deliveries' , 'Api\DeliveriesController');
Route::apiResource('evaluations' , 'Api\EvaluationsController');
Route::apiResource('messages' , 'Api\MessagesController');
Route::apiResource('userdevices' , 'Api\UserDevicesController');
Route::get('/student', [ClassController::class,'student']);
Route::get('/{id}/teacher-class', [ClassController::class,'indexx']);
Route::get('/{id}/student', [UsersController::class,'student']);
Route::get('/{id}/teacher', [UsersController::class,'teacher']);
Route::get('/{token}/profile', [UsersController::class,'profile']);
Route::get('/{id}/assignmentsolved/{ids}', [DeliveriesController::class,'indexhomework']);
Route::get('/{id}/activities', [ActivitiesController::class,'activ']);
Route::get('/{id}/activ', [ActivitiesController::class,'activi']);
Route::get('/{id}/homework/{ids}', [DeliveriesController::class,'index']);
Route::get('/{id}/assignmentnotsolved/{ids}', [DeliveriesController::class,'homework']);
Route::get('/{id}/evaluation', [EvaluationsController::class,'indexx']);
Route::get('/{id}/homework', [HomeworkController::class,'homework']);
Route::get('/{id}/messages', [MessagesController::class,'massages']);
//Route::view('forgot_password','auth.rest_password')->name('password_rest');
Route::post('password/email',[ForgotPasswordController::class,'forgot']);
Route::post('password/reset',[ForgotPasswordController::class,'reset']);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');
Route::get('material',[MaterialController::class,'material'])->name('material');
Route::get('/{id}/evaluations-student', [EvaluationsController::class,'evaluationsstudent']);
Route::delete('/{id}/homework-destroy', [HomeworkController::class, 'destroy']);
Route::delete('/{id}/activitie-destroy', [ActivitiesController::class, 'destroy']);