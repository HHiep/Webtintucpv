<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


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



Route::get('/home',[HomeController::class,'index'])->name('home');
Route::get('/create',[HomeController::class,'create'])->name('home.create');
Route::post('/store',[HomeController::class,'store'])->name('home.store');
Route::get('/edit/{id}', [HomeController::class, 'edit'])->name('home.edit');
Route::put('/update/{id}', [HomeController::class, 'update'])->name('home.update');
Route::delete('/destroy/{id}', [HomeController::class, 'destroy'])->name('home.destroy');
Route::get('/logout', [HomeController::class, 'logout'])->name('home.logout');

Route::get('/profile',[ProfileController::class,'index'])->name('profile');
Route::get('/profile/create',[ProfileController::class,'create'])->name('profile.create');
Route::post('/profile/store',[ProfileController::class,'store'])->name('profile.store');
Route::get('/profile/edit/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile/destroy/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/sendNotifications',[ProfileController::class,'sendNotifications'])->name('sendNotifications');
Route::get('/confirmAdmin',[ProfileController::class,'confirmAdmin'])->name('confirmAdmin');
Route::get('/listNotification',[ProfileController::class,'listNotification'])->name('listNotification');

Auth::routes();



