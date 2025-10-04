<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        try {
            // Save to database
            ContactMessage::create($validated);
        } catch (\Exception $e) {
            \Log::error('Failed to save contact message: ' . $e->getMessage());
            return redirect()->route('contact.show')->withErrors('Failed to save your message. Please try again later.');
        }

        try {
            // Send email
            Mail::raw($validated['message'], function ($mail) use ($validated) {
                $mail->to('your-email@example.com') // Replace with your email
                     ->subject($validated['subject'])
                     ->from($validated['email'], $validated['name']);
            });
        } catch (\Exception $e) {
            \Log::error('Failed to send contact email: ' . $e->getMessage());
            return redirect()->route('contact.show')->withErrors('Failed to send your message email. Please try again later.');
        }

        return redirect()->route('contact.show')->with('success', 'Message sent successfully!');
    }
}
