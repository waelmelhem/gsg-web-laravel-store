<?php

use App\Http\Controllers\Auth\ChangeUserPasswordController;
use App\Http\Controllers\Auth\UserProfileController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategroiesCntroller;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductPageController;

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



Route::get('/dashboard/breeze', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard.breeze');
Route::get('/products/{category:slug?}',[ProductPageController::class,"index"])->name('products');
Route::get('/products/{category:slug}/{product:slug}',[ProductPageController::class,"show"])->name('product.show');

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/profile',[UserProfileController::class,"index"])->name('profile')->middleware(['auth:web,admin']);
Route::patch('/profile/{id}',[UserProfileController::class,"update"])->name('profile.update')->middleware(['auth:web,admin',"password.confirm"]);

Route::get('/change_password',[ChangeUserPasswordController::class,"index"])->name('change_passwrod')->middleware(['auth:web,admin']);
Route::put('/change_password/update',[ChangeUserPasswordController::class,"update"])->name('change_passwrod.update')->middleware(['auth:web,admin']);

Route::get('/news',[HomeController::class,"news"]);

Route::get('/cart',[CartController::class,'index'])->name('cart');
Route::post('/cart',[CartController::class,'store'])->name('cart.store');
Route::get('/news/latest',[HomeController::class,"index"]);
Route::get('/news/{id}',[HomeController::class,"news"]);

//CRUD
// create ,read,update,delte
route::group([
    'prefix'=>'dashboard/',
    'as'=>'dashboard.',
    'middleware'=>'auth'
],
function (){
    Route::get('/',[DashboardController::class,"index"])->name('dashboard');
    Route::get('/page',[DashboardController::class,"page"])->name('dashboard.page');
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
// Route::get('/dashboard',[DashboardController::class,"index"])->name('dashboard');
// Route::get('/dashboard/page',[DashboardController::class,"page"])->name('dashboard.page');


require __DIR__.'/auth.php';