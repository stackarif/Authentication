<?php

use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [AuthController::class,'dashboard'])->middleware(['auth','verified'])->name('dashboard');
Route::get('/login', [AuthController::class,'login'])->name('login')->middleware(['guest']);
Route::post('/auth', [AuthController::class,'auth'])->name('auth')->middleware(['guest']);
Route::get('/register',[AuthController::class,'register'])->name('register')->middleware(['guest']);
Route::post('/store',[AuthController::class,'store'])->name('store')->middleware(['guest']);
Route::post('/logout', [AuthController::class,'logout'])->name('logout')->middleware(['auth']);

//Email verification
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');



