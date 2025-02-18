<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('layouts.registeradmin');  // สร้างหน้าฟอร์มสำหรับการลงทะเบียน
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            // 'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // 'role' => ['required', 'string', 'in:user,supervisor']


            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Password::defaults()],  // FIXED
            'role' => ['required', 'string', 'in:user,supervisor']
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role  // Add this
        ]);

        event(new Registered($user));


        return redirect()->route('dashboard')->with('success', 'ข้อมูลได้ถูกบันทึกเรียบร้อย');
    }

    public function edit(User $user)
{
    return view('layouts.editUser', compact('user')); // Pass the user to the edit form
}

public function destroy(User $user)
{
    $user->delete(); // Delete the user

    return redirect()->route('users.list')->with('success', 'ผู้ใช้ถูกลบออกแล้ว');
}

public function showUsers()
{
    // Fetch all users from the database
    $users = User::all();

    // Return the view and pass the users
    return view('dashboard', compact('users')); // Make sure the view name matches your blade file
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id); // Find the user by ID

    // Validate the incoming data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'role' => 'required|in:user,supervisor', // Add your validation rules
    ]);

    // Update the user's data
    $user->update($validatedData);

    return response()->json(['success' => true, 'user' => $user]);
}

}
