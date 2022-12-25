<?php

use App\Http\Controllers\api\v1\AuthController;
use App\Http\Controllers\api\v1\FileController;
use App\Http\Controllers\api\v1\FolderController;
use App\Http\Controllers\api\v1\LinkHashController;
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

Route::middleware('guest')->prefix('v1')->group(function () {
    Route::post('/auth/create', [AuthController::class, 'create']);
    Route::post('/auth/login', [AuthController::class, 'login']);
    Route::post('/auth/forgot', [AuthController::class, 'forgot']);
    Route::post('/auth/password', [AuthController::class, 'password']);
    Route::post('/files/public-file', [FileController::class, 'getPublicFile']);
});

Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::get('/auth/user', [AuthController::class, 'auth_user']);

    Route::apiResource('/folders', FolderController::class);
    Route::apiResource('/files', FileController::class);
    Route::post('/files/generate-public-link', [FileController::class, 'generatePublicLink']);
    Route::post('/files/delete-public-link', [FileController::class, 'deletePublicLink']);

    Route::apiResource('/hash/generate', LinkHashController::class);
});
