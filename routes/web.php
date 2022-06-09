<?php

use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ConfigController;


/*
|--------------------------------------------------------------------------
| Special Routes
|--------------------------------------------------------------------------
*/
Route::get('/maintenance', function (){
    return view('maintenance');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::prefix('adm')->name('admin.')->group(function () {

    Route::middleware('is_logged')->group(function () {
        Route::get('/login', [AuthController::class, 'index'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    });

    Route::middleware('is_admin')->group(function () {
        Route::get('/dashboard', [Dashboard::class, 'index'])->name('dashboard');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::prefix('articles')->name('article.')->group(function () {
            Route::get('/{id}/delete', [ArticleController::class, 'delete'])->name('delete');
            Route::get('/{id}/delete-permanently', [ArticleController::class, 'deletePermanently'])->name('deletePermanently');
            Route::get('/{id}/recover', [ArticleController::class, 'recover'])->name('recover');
            Route::get('/trash', [ArticleController::class, 'trash'])->name('trash');
            Route::get('/switch', [ArticleController::class, 'activation'])->name('switch');
        });
        Route::resource('articles', ArticleController::class);

        Route::prefix('categories')->name('category.')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::post('/create', [CategoryController::class, 'store'])->name('create');
            Route::get('/get-data', [CategoryController::class, 'getData'])->name('getData');
            Route::post('/update', [CategoryController::class, 'update'])->name('update');
            Route::post('/delete', [CategoryController::class, 'delete'])->name('delete');
            Route::get('/switch', [CategoryController::class, 'activation'])->name('switch');
        });

        Route::prefix('pages')->name('page.')->group(function () {
            Route::get('/', [PageController::class, 'index'])->name('index');
            Route::get('/create', [PageController::class, 'create'])->name('create');
            Route::post('/store', [PageController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [PageController::class, 'edit'])->name('edit');
            Route::post('/{id}/update', [PageController::class, 'update'])->name('update');
            Route::get('/{id}/delete', [PageController::class, 'delete'])->name('delete');
            Route::get('/switch', [PageController::class, 'activation'])->name('switch');
            Route::get('/orders', [PageController::class, 'sort'])->name('orders');
        });

        Route::prefix('configs')->name('config.')->group(function () {
            Route::get('/', [ConfigController::class, 'index'])->name('index');
            Route::post('/update', [ConfigController::class, 'update'])->name('update');
        });

    });
});

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index']);
Route::get('/category/{slug}', [HomeController::class, 'category'])->name('category');
Route::get('/iletisim', [HomeController::class, 'contact'])->name('contact');
Route::post('/iletisim', [HomeController::class, 'contactPost'])->name('contact.post');

Route::get('/{category}/{slug}', [HomeController::class, 'single'])->name('single');
Route::get('/{page}', [HomeController::class, 'page'])->name('page');
