<?php

use App\Http\Controllers\dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategroiesCntroller;
use App\Http\Controllers\Dashboard\ProductsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[HomeController::class,'index']);

Route::get('/news',[HomeController::class,"news"]);


Route::get('/news/latest',[HomeController::class,"index"]);
Route::get('/news/{id}',[HomeController::class,"news"]);

//CRUD
// create ,read,update,delte
route::group([
    'prefix'=>'dashboard/',
    'as'=>'dashboard.',
],
function (){
    Route::get('products/trash',[ProductsController::class,'trash'])->name('products.trash');
    Route::patch('products/{id}/restore',[ProductsController::class,'restore'])->name('products.restore');
    Route::resource('/products',ProductsController::class);
    route::group([
        'prefix'=>'/categories',
        'as'=>'categories',
    ]
    ,function(){
        Route::get('/',[CategoriesController::class,'index'])->name('.index');
        Route::get('/create',[CategoriesController::class,'create'])->name('.create');
        Route::post('/store',[CategoriesController::class,'store'])->name('.store');
        Route::get('/trash',[CategoriesController::class,'trash'])->name('.trash');
        Route::patch('/{id}/restore',[CategoriesController::class,'restore'])->name('.restore');
        Route::delete('/{id}',[CategoriesController::class,'destroy'])->name('.destroy');
        Route::get('/{id}/edit',[CategoriesController::class,'edit'])->name('.edit');
        Route::put('/{id}',[CategoriesController::class,'update'])->name('.update');
    });
    


});

//dashboard
Route::get('/dashboard',[DashboardController::class,"index"])->name('dashboard');
Route::get('/dashboard/page',[DashboardController::class,"page"])->name('dashboard.page');