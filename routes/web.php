<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\lkController;
use App\Http\Controllers\cartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, "getData"])->name('home');

Route::post('/addIngridient', [HomeController::class, "addIngridient"]);
Route::post('/addNewIngridient', [HomeController::class, "addIngridientNewFood"]);
Route::post('/deleteIngridient', [HomeController::class, "deleteIngridient"]);
Route::post('/deleteNewIngridient', [HomeController::class, "deleteIngridientNewFood"]);
Route::post('/addNewFood', [HomeController::class, "AddNewFood"]);

Route::post('/NewFood', [HomeController::class, "getModalForAddNewFood"]);

Route::get('/orders', [StatusController::class, "getOdersData"]);
Route::post('/orders/change', [StatusController::class, "changeStatus"])->name('orders.change');
Route::post('orders/next', [StatusController::class, "setNextStatus"])->name('orders.next');


Route::get('welcome', function() {
return view('welcome');
});

Route::get('login', function() {
    return view('login');
})->name('login')->middleware('login');

Route::post('login', [LoginController::class, "login"]);

Route::get('register', function() {
    return view('register');
})->middleware('login');

Route::post('register', [RegisterController::class, "register"]);

Route::get('me', [LoginController::class, 'me']);

Route::post('/cart/add', [cartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/addInto', [cartController::class, 'addIntoCart'])->name('cart.addInto');
Route::get('/cart', [cartController::class, 'showCart'])->name('cart.show')->middleware('jwt');
Route::post('/cart/clear', [cartController::class, 'clearCart'])->name('cart.clear');
Route::post('/cart/remove', [cartController::class, 'removeFromCart'])->name('cart.remove');

Route::get('/lk',[lkController::class, 'getInfo'])->name('lk')->middleware('jwt');

Route::get('logout', [LoginController::class, "logout"]);

Route::post('/cart/addorder', [cartController::class, 'addOrder']);

// Route::get('')
