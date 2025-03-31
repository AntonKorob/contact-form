<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('contact-form');
});

Rout::post('/contact'. [ContactController::class,'store'])->name('contact.store');
