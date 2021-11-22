<?php

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

// For API Health Check
Route::get('/', function () {
    return response()->json();
});

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    Route::post('forget-password', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('reset-password', 'Auth\ResetPasswordController@reset');
});

Route::get('tasks/{taskId}/attachments', 'AttachmentController@index');
Route::post('tasks/{taskId}/attachments', 'AttachmentController@store');
Route::apiResource('tasks', 'TaskController');
