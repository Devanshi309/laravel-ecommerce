<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' =>'required|email',
            'message' =>'required',
             'g-recaptcha-response' => 'required'
        ]);
        // Verify CAPTCHA
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $request->get('g-recaptcha-response'),
        ]);
        // dd($response);
           $result = $response->json();

        if (!$result['success']) {
            return back()->with('error', 'CAPTCHA verification failed.');
        }

        // Save or send email here

        return back()->with('success', 'Message sent successfully!');
    }
}
