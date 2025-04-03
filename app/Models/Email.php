<?php
namespace App\Email;

use App\Models\Email;
use Illuminate\Support\Facades\Log;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

function sendToAdmin($subject, $body) {
    Email::create([
        'to' => 'admin@example.com',
        'subject' => $subject,
        'body' => $body
    ]);
}

function logEmail($subject, $body) {
    Log::channel('emails')->info("Email to admin:\nSubject: $subject\n\n$body");
}


function saveAsPdf($subject, $body) {
    $pdf = PDF::loadView('emails.pdf', compact('subject', 'body'));
    $filename = 'emails/'.now()->format('Y-m-d_His').'.pdf';
    Storage::put($filename, $pdf->output());
}



