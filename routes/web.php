<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\paymentController;
use App\Http\Controllers\checkoutController;
use App\Http\Controllers\ProductPageController;
use App\Http\Controllers\Dashboard\RolesController;
use App\Http\Controllers\Dashboard\UsersController;
use App\Http\Controllers\Auth\UserProfileController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\CategroiesCntroller;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Auth\ChangeUserPasswordController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
})->middleware(['auth:web,admin'])->name('dashboard.breeze');
Route::get('/products/{category:slug?}',[ProductPageController::class,"index"])->name('products');
Route::get('/products/{category:slug}/{product:slug}',[ProductPageController::class,"show"])->name('product.show');
Route::post('/products/review/{product:slug}',[ProductPageController::class,"review"])->name('product.review.store');

Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/profile',[UserProfileController::class,"index"])->name('profile')->middleware(['auth:web,admin']);
Route::patch('/profile/{id}',[UserProfileController::class,"update"])->name('profile.update')->middleware(['auth:web,admin',"password.confirm"]);

Route::get('/change_password',[ChangeUserPasswordController::class,"index"])->name('change_passwrod')->middleware(['auth:web,admin']);
Route::put('/change_password/update',[ChangeUserPasswordController::class,"update"])->name('change_passwrod.update')->middleware(['auth:web,admin']);

Route::get('/news',[HomeController::class,"news"]);

Route::get('/cart',[CartController::class,'index'])->name('cart');
Route::post('/cart',[CartController::class,'store'])->name('cart.store');
Route::delete('/cart/{id}',[CartController::class,'destroy'])->name('cart.destroy');

Route::get('/checkout',[checkoutController::class,'index'])->name('checkout');
Route::post('/checkout',[checkoutController::class,'store'])->name('checkout.store');

Route::get("orders/{order}/payments/create",[paymentController::class,"create"])->name("payment.create");
Route::get("orders/{order}/payments/refund",[paymentController::class,"refund"])->name("payment.refund");
Route::get("orders/{order}/payments/return",[paymentController::class,"callback"])->name("payments.callback");
Route::get("orders/{order}/payments/cancel",[paymentController::class,"cancel"])->name("payments.cancel");

Route::get('/news/latest',[HomeController::class,"index"]);
Route::get('/news/{id}',[HomeController::class,"news"]);

//CRUD
// create ,read,update,delte
route::group([
    'prefix'=>LaravelLocalization::setlocale().'/dashboard/',
    'as'=>'dashboard.',
    'middleware'=>['auth:web,admin',"locale"]
],
function (){
    
    Route::get('notification',[NotificationController::class,"index"])->name('notification');
    Route::get('notification/{notification}',[NotificationController::class,"read"])->name('notification.read');
    Route::get('/',[DashboardController::class,"index"])->name('dashboard');
    Route::get('/page',[DashboardController::class,"page"])->name('dashboard.page');
    Route::get('products/trash',[ProductsController::class,'trash'])->name('products.trash');
    Route::patch('products/{id}/restore',[ProductsController::class,'restore'])->name('products.restore');
    Route::resource('/products',ProductsController::class);
    Route::resource(
        "/roles",RolesController::class,
    );
    Route::resource(
        "/users",UsersController::class,
    );
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


// require __DIR__.'/auth.php';