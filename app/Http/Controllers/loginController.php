<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class loginController extends Controller
{
    //
        public function checkLogin(Request $request)
        {
            $validated = $request->validate([
                'email' => 'required|email',
                'password' => 'required|min:8',
            ]);

            // Attempt to login
            if (Auth::attempt(['email' => $validated['email'], 'password' => $validated['password']])) {
                // Authentication passed
                return redirect(route('dashboard'));
            } else {
                // Authentication failed
                return redirect()->back()->withErrors(['login_error' => 'Invalid email or password.'])->withInput();
            }
        }
}
