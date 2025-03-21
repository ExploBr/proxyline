<?php
 
use Illuminate\Support\Facades\Route;
use App\Helpers\Langs;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
 
use App\Http\Controllers\LangsController;
use App\Http\Controllers\Post\IndexPostController;
use App\Http\Middleware\AdminPanelMiddleware;
 

 
 
Route::prefix('admin')->middleware(AdminPanelMiddleware::class)->namespace('App\Http\Controllers\Admin')->group(function () {
    Route::get('', IndexAdminController::class)->name('admin.index');
     Route::group(['namespace'=>'Page'],function () {
        Route::get('/page', IndexController::class)->name('admin.page.index');
        Route::get('/page/create', CreateController::class)->name('admin.page.create');
        Route::post('/page', StoreController::class)->name('admin.page.store');

        //Route::get('/page/{page}', ShowController::class)->name('admin.page.show');

         Route::get('/page/{page}/edit', EditController::class)->name('admin.page.edit');
         Route::patch('/page/{page}', UpdateController::class)->name('admin.page.update');

       // Route::delete('/page/{page}', DestroyController::class)->name('admin.page.delete');
    });  
});

Route::get('/admin/login', [HomeController::class,'index'])->name('login');
Route::get('/logout', [LoginController::class,'logout']);

Auth::routes();
 






Route::get('/lang/{lang}', LangsController::class)->name('setlang');

 
Route::prefix(Langs::getLocales())->middleware('langs')->group( function () {

    Route::get('/', App\Http\Controllers\IndexController::class )->name('index');

    

    Route::group(['namespace'=>'App\Http\Controllers\Post'],function () {
        Route::get('/blog', IndexPostController::class )->name('post.index');
    });

    Route::group(['namespace'=>'App\Http\Controllers\Page'],function () {
        Route::get('/{page}', ShowPageController::class)->name('page.show');
    });
    
    

});
 
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

  