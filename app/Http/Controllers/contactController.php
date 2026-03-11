<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Models\Contact;
use App\Mail\UserThankYouMail;

class contactController extends Controller
{
    public function index(){
        return view('index');
    }

 public function send(Request $request)
{
    $validated = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phone' => 'nullable',
        'message' => 'required'
    ]);

    // Store in database
    Contact::create($validated);

    //  Send to ME
    Mail::to('harshmodi084@gmail.com')
        ->send(new ContactMail($validated));

    //  Send Thank You Mail to USER
    Mail::to($validated['email'])
        ->send(new UserThankYouMail($validated));

    return back()->with('success', 'Message sent successfully!');
}
}