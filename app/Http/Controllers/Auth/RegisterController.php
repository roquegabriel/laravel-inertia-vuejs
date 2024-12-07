<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RegisterController extends Controller
{
    // show create form
    public function create()
    {
        return inertia('Auth/Register');
    }

    //register
    public function store(Request $request)
    {
        sleep(2);
        //validate
        $credentials = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|lowercase|email|max:255',
            'password' => 'required|confirmed|min:3',
        ]);

        $user = User::create($credentials);

        // send verification email
        event(new Registered($user));
        
        Auth::login($user);

        return redirect()->route('home');
    }

}
