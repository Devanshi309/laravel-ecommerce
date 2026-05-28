<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
       $request->validate([

'name'=>'required',

'email'=>'required
          |email
          |unique:users',

'password'=>'required
            |confirmed
            |min:6',

'image'=>'required|image',

'phone'=>'required',

'gender'=>'required',

'dob'=>'required',

'address'=>'required',

'city'=>'required',

'state'=>'required',

'country'=>'required',

'zipcode'=>'required'

]);

       $imageName = time().'.'

.$request->image->extension();

$request->image->storeAs(

'users',

$imageName,

'public'

);

$user = User::create([

'image'=>$imageName,

'name'=>$request->name,

'email'=>$request->email,

'phone'=>$request->phone,

'password'=>Hash::make(
$request->password
),

'gender'=>$request->gender,

'dob'=>$request->dob,

'address'=>$request->address,

'city'=>$request->city,

'state'=>$request->state,

'country'=>$request->country,

'zipcode'=>$request->zipcode

]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
