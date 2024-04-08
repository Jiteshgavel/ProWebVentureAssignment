<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductImportController;


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

    Route::get('/', [AdminAuthController::class, 'getLogin'])->name('adminLogin');
    Route::post('/', [AdminAuthController::class, 'postLogin'])->name('adminLoginPost');


    Route::group(['middleware' => 'adminauth'], function () {
        
        Route::get('/logout', [AdminAuthController::class, 'adminLogout'])->name('adminLogout');
        Route::any('/dashboard', [DashboardController::class,'index'])->name('adminDashboard');
        Route::get('/most-resent-viewed', [DashboardController::class,'mostResentViewed'])->name('mostResentViewed');
        

        
        Route::resource('/category',CategoryController::class);
        Route::resource('/product', ProductController::class);

        Route::get('import-products',[ProductImportController::class,'import'])->name('productImport');
        Route::get('export-products',[ProductController::class,'export'])->name('exportProduct');
        
        Route::post('store-import-products', [ProductImportController::class, 'store'])->name('productImportStore');
        Route::get('export-categories', [CategoryController::class, 'export'])->name('exportCategories');

        Route::get('/post', function () {
            return view('admin.post.post');
            })->name('post');
        });
