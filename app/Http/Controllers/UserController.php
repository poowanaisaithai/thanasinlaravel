<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',  // 'confirmed' ensures password confirmation field
            'role' => 'required|in:admin,user',  // Only allow 'admin' or 'user' roles
        ]);

        // Create the new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),  // Hash the password
            'role' => $request->role,  // Assign the selected role
        ]);

        // Redirect to a specific page with a success message
        return redirect()->route('users.create')->with('success', 'User successfully created!');
    }

}
