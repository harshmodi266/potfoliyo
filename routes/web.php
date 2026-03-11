<?php

use App\Http\Controllers\contactController;
use Illuminate\Support\Facades\Route;

Route::get('/404', function () {
    return view('404');
});

Route::get('/index',[contactController::class,'index'])->name('index');
Route::post('/contact', [contactController::class, 'send'])->name('contact.send');