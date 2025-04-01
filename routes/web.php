<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {return view('contact-form');});

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/emails', function() {
    $files = Storage::files('emails');
    $emails = [];
    
    foreach ($files as $file) {
        $emails[] = [
            'file' => $file,
            'content' => Storage::get($file)
        ];
    }
    
    return view('emails.index', compact('emails'));
});