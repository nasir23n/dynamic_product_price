<?php

use App\Http\Controllers\QrController;
use App\Models\Product;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [\App\Http\Controllers\ProductController::class, 'index']);
Route::post('/varient_price', [\App\Http\Controllers\ProductController::class, 'varient_price'])->name('varient_price');




Route::get('/qr', [QrController::class, 'index']);

Auth::routes();

Route::get('/email/verify', function(Request $request) {
    // dd($request->user());
    $request->user()->sendEmailVerificationNotification();
    return view('auth.verify');
})->name('verification.notice');

Route::get('/email/resend', function() {
    return view('auth.verify');
})->name('verification.resend');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
