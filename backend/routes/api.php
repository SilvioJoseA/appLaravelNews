<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewYorkTimesNewsController;
use App\Http\Controllers\GuardianNewsController;
use App\Http\Controllers\AlphaNewsController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserSettingController;
use App\Http\Controllers\UserController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/news/guardian', [GuardianNewsController::class, 'getNewsApi']);
Route::get('/newsapi/guardian', [GuardianNewsController::class, 'getNews']);

Route::get('/news/nyt', [NewYorkTimesNewsController::class, 'getNewsApi']);

Route::get('/news/news', [NewsController::class , 'getNewsApi']);

Route::get('/news/allnews', [AlphaNewsController::class , 'getNewsDb']);

Route::post('/users/login', [UserController::class, 'findUser']);
Route::get('/users/{id}', [UserController::class, 'show']);
Route::post('/users/register', [UserController::class, 'store']);
Route::put('/users/{userId}/settings', [UserSettingController::class, 'update']);
Route::post('/settings', [UserSettingController::class , 'findSettings']);
Route::post('/settings/store', [UserSettingController::class , 'store']);

Route::get('/news/alpha/{per_page}/{page}', [AlphaNewsController::class, 'getNewsDb']);
Route::post('/news/alpha/{per_page}/{page}', [AlphaNewsController::class, 'getNewsDb']);