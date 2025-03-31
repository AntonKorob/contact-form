<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validate = $request->validate([
                "name"=> "required|string|max:255",
                "phone"=> "required|string|max:20",
                "email"=> "required|email|max:255",
        ]);

        $contact = Contact::create($validate);

        Mail::to('admin@example.com')->send(new ContactFormMail($contact));

        return response()->json([
            'success' => true,
            'message' => 'Form successfully submitted!'
        ]);
    }
}
