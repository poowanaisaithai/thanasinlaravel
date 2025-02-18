<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function create()
    {
        $users = User::all();
        return view('loans.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:0',
            'term_months' => 'required|integer|min:1',
            'interest_rate' => 'required|numeric|min:0',
        ]);

        Loan::create($validated);

        return redirect()->route('loans.create')
            ->with('success', 'Loan application submitted successfully.');
    }
}