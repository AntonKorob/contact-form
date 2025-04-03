<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {return view('contact-form');});

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/emails', [EmailController::class, 'index']);