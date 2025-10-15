<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserContronller;
use Illuminate\Support\Facades\Route;


Route::resource('products', ProductController::class);

Route::get('/products', [ProductController::class,'index'])->name('products.index');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/students', [StudentController::class, 'index']);

Route::get('/students/{id}', [StudentController::class, 'index']);

Route::get('/user_profiles',[UserContronller::class,'index'])->name('user_profiles.index');

?>
