<?php

    use App\Http\Controllers\site\v1\LinkController;
    use Illuminate\Support\Facades\Route;

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

Route::get('/link/private/{hash}/{protect?}', [LinkController::class, 'private'])->middleware(['protect']);
Route::get('/link/public/{hash}', [LinkController::class, 'public']);
