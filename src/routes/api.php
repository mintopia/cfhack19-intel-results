<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\Api\Version1\PingResource;

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

Route::prefix('v1')->name('api.v1.')->namespace('Api\Version1')->group(function() {
    Route::get('ping', function() {
        return PingResource::make(null)->response();
    })->name('ping');

    Route::middleware(['auth.apitoken'])->group(function() {
        Route::apiResource('results', 'ResultController')->only([
            'index', 'store', 'show'
        ]);
    });
});
