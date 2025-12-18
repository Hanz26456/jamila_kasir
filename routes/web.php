<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('pages.home');    
})->name('home');

Route::get('/about', function () {
    return view('pages.about');    
})->name('about');

Route::get('/product', function () {
    return view('pages.product');    
})->name('product');

Route::get('/contact', function () {
    return view('pages.contact');    
})->name('contact');

Route::get('/service', function () {
    return view('pages.services');    
})->name('service');

Route::get('/team', function () {
    return view('pages.team');    
})->name('team');

Route::get('/testimonial', function () {
    return view('pages.testimonial');    
})->name('testimonial');

// Auth routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


