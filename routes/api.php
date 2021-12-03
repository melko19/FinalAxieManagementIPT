<?php

use App\Http\Controllers\ScholarController;
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
Route::apiResource('scholar', ScholarController::class)->only('index', 'store', 'destroy');
Route::post('scholar/{scholar}', [ScholarController::class, 'update'])->name('scholar.update');
Route::get('search/scholar/{field}/{query}', [ScholarController::class, 'search']);