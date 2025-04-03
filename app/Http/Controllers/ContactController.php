<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Services\EmailStorageService;

class ContactController extends Controller
{
    public function __construct(
        protected EmailStorageService $emailStorage
    ) {}
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
        ]);

        $contact = Contact::create($validated);

        $this->saveEmailToFile($contact);

        return response()->json([
            'success' => true,
            'message' => 'Форма успешно отправлена!'
        ]);
    }

    protected function saveEmailToFile(Contact $contact): void
{
    $emailContent = view('emails.contact', compact('contact'))->render();
    $this->emailStorage->saveEmail($emailContent);
}
}