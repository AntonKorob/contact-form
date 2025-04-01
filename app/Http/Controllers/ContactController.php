<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
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

    protected function saveEmailToFile(Contact $contact)
    {
        $emailContent = view('emails.contact-form', compact('contact'))->render();
        $filename = 'emails/contact_'.now()->format('Y-m-d_H-i-s').'.html';
        
        Storage::disk('local')->put($filename, $emailContent);
    }
}