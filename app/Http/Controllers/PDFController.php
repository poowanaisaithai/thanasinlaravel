<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Installment;

class PDFController extends Controller
{
    public function generatePDF($id)
    {
        $installment = Installment::findOrFail($id);

        $pdf = Pdf::loadView('pdf.installment', compact('installment'));

        return $pdf->stream('installment-'.$id.'.pdf');
    }
}
