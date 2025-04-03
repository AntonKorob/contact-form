<?php

namespace App\Http\Controllers;

use App\Services\EmailStorageService;
use Illuminate\View\View;
// use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class EmailController extends Controller
{
    public function __construct(
        protected EmailStorageService $emailStorage
    ) {}

    /**
     * Показать список всех писем
     */
    public function index(): View
    {
        return view('emails.index', [
            'emails' => $this->emailStorage->getAllEmails()
        ]);
    }
 
    /**
     * Показать конкретное письмо
     */
    public function show(string $filename): View
    {
        return view('emails.show', [
            'email' => $this->emailStorage->getEmailData('emails/'.$filename)
        ]);
    }
}