<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\WorkExperienceController;
use App\Http\Controllers\EducationController;
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

/*------ Public routes ------*/

// Auth
Route::post('/login', [AuthController::class, 'login']);

// Projects
Route::get('/projects', [ProjectController::class, 'index']);

// Skills
Route::get('/skills', [SkillController::class, 'index']);

// Work experiences
Route::get('/work-experiences', [WorkExperienceController::class, 'index']);

// Education
Route::get('/education', [EducationController::class, 'index']);

/*------ Protected routes ------*/

Route::group(['middleware' => ['auth:sanctum']], function () {

    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);

    // Projects
    Route::post('/projects', [ProjectController::class, 'store']);
    Route::put('/projects/{id}', [ProjectController::class, 'update']);
    Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);

    // Skills
    Route::post('/skills', [SkillController::class, 'store']);
    Route::put('/skills/{id}', [SkillController::class, 'update']);
    Route::delete('/skills/{id}', [SkillController::class, 'destroy']);

    // Work experiences
    Route::post('/work-experiences', [WorkExperienceController::class, 'store']);
    Route::put('/work-experiences/{id}', [WorkExperienceController::class, 'update']);
    Route::delete('/work-experiences/{id}', [WorkExperienceController::class, 'destroy']);

    // Education
    Route::post('/education', [EducationController::class, 'store']);
    Route::put('/education/{id}', [EducationController::class, 'update']);
    Route::delete('/education/{id}', [EducationController::class, 'destroy']);
});
