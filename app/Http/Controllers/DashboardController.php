<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Installment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
    public function index()
    {
        // Get the currently authenticated user
        $user = Auth::user();

        // Fetch the user's installments
        $installments = Installment::where('user_id', $user->id)->get();

        // Pass data to the view
        return view('dashboard', compact('user', 'installments'));
    }

    public function printReceipt(Request $request)
    {
        // Get the data (you may want to adjust this to fetch the correct user's data)
        $installments = Installment::where('user_id', auth()->id())->get();

        // Generate the PDF
        $pdf = PDF::loadView('pdf.receipt', compact('installments'));

        // Return the PDF as a download
        return $pdf->download('installment_receipt.pdf');
    }
}

