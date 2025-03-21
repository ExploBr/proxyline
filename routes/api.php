<?php

use App\Http\Controllers\Admin\Page\TemplatesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminPanelMiddleware;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


 
    Route::namespace('App\Http\Controllers\Admin\Page')->group(function () {
        Route::post('/admin/page', StoreController::class);
        Route::get('/admin/page', IndexController::class);
    });
 

     