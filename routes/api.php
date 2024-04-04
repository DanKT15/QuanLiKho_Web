<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\TestApiController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

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


Route::get('/trangthai/index', [TestApiController::class, 'index'])->middleware(['Apiuser']);
Route::post('/trangthai/testpost', [TestApiController::class, 'testpost'])->middleware(['Apiuser']);

// test login api
Route::post('login', [AuthenticatedSessionController::class, 'storeAPI'])->middleware(['guest']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroyAPI'])->middleware(['Apilogout']);