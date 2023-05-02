<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth_api')->get('/courses', [CourseController::class, 'getCourses']);
Route::middleware('auth_api')->get('/course/{send_currency}/{recive_currency}', [CourseController::class, 'getCourse']);
