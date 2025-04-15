<?php

use App\Http\Controllers\Admin\Page\TemplatesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TranslationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminPanelMiddleware;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


 
    


 
    Route::group([  'middleware' => 'api','prefix' => 'auth' ], function ($router) {
        Route::post('login', [AuthController::class,'login'])->name('login.api');
        Route::post('logout', [AuthController::class,'logout'])->name('logout.api');
        Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh.api');
        Route::post('me', [AuthController::class,'me']);
        
        Route::group(['middleware' => 'jwt.auth'], function(){
            Route::namespace('App\Http\Controllers\Admin\Page')->group(function () {
                Route::post('/admin/page', StoreController::class);
                Route::get('/admin/page', IndexController::class);
                Route::patch('/admin/page/{page}', UpdateController::class);
                
            });

            Route::group(['namespace'=>'App\Http\Controllers\Admin\MainContent'],function () {
                Route::post('/admin/main-content', MainStoreController::class);
            });

            Route::group(['namespace'=>'App\Http\Controllers\Admin\MainOption'],function () {
                Route::post('/admin/main-option', MainOptionStoreController::class);
            });
        });

        
    });
 
    Route::post('/translate', [TranslationController::class, 'translate']);

     