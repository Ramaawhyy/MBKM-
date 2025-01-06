<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\user;


class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'nim' => 'required|unique:users',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'nim' => $request->nim,
            'role' => 'user', // Automatically assign 'user' role
        ]);

        // Log the user in or redirect as needed
        Auth::login($user);

        return redirect()->route('login');
    }
    public function showRegistrationForm()
    {
        return view('register'); // Ensure this matches the path to your register view
    }
}
