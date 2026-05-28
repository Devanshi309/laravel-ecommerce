<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([

            'name'=>'required|max:255',

            'email'=>'required|email',

            'message'=>'required|min:5',

            'g-recaptcha-response'=>'required'

        ]);

        Feedback::create([

            'name'=>$request->name,

            'email'=>$request->email,

            'message'=>$request->message

        ]);

      return redirect()->route('product.index')
                         ->with('success','Feedback Submitted Successfully!');
    }
}