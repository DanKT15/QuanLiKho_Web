<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\TestApiController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\PhieunhapxuatController;

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


Route::get('/test/tonkho', [TestApiController::class, 'tonkho'])->middleware(['Apiuser']);
Route::get('/test/phieukiem', [TestApiController::class, 'phieukiem'])->middleware(['Apiuser']);
Route::get('/test/phieukiemct/{id}', [TestApiController::class, 'phieukiemct'])->middleware(['Apiuser']);
Route::post('/test/testpost', [TestApiController::class, 'testpost']);
Route::get('/getdiachi', [TestApiController::class, 'getdiachi'])->middleware(['Apiuser']);


// phieu nhap
Route::get('/getctphieu/{id}', [PhieunhapxuatController::class, 'show'])->middleware(['Apiuser']);
Route::post('/addphieu', [PhieunhapxuatController::class, 'store'])->middleware(['Apiuser']);
Route::get('/getsp/{id}', [PhieunhapxuatController::class, 'showSP'])->middleware(['Apiuser']);

// login api
Route::post('login', [AuthenticatedSessionController::class, 'storeAPI']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroyAPI'])->middleware(['Apilogout']);
Route::get('info', [AuthenticatedSessionController::class, 'infoAPI']);