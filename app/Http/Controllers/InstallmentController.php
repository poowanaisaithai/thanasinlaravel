<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Installment;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;


class InstallmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $installments = Installment::with('user')->get();

        dd($installments);


        return view('installments.create', compact('users'));  // ตรวจสอบว่าใช้ compact('users') เพื่อส่งตัวแปรไปยัง view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('installments.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // กำหนดกฎการตรวจสอบข้อมูล
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'installment_number' => 'required|integer',
            'date' => 'required|date',
            'payment_amount' => 'required|numeric',
            'interest' => 'required|numeric',
            'collection_fee' => 'nullable|numeric',
            'principal_return' => 'required|numeric',
            'remaining_balance' => 'required|numeric',
        ]);

        // สร้างข้อมูล Installment ใหม่
        Installment::create([
            'user_id' => $request->user_id,
            'installment_number' => $request->installment_number,
            'date' => $request->date,
            'payment_amount' => $request->payment_amount,
            'interest' => $request->interest,
            'collection_fee' => $request->collection_fee ?? 0,
            'principal_return' => $request->principal_return,
            'remaining_balance' => $request->remaining_balance,
        ]);

        // Redirect ไปที่หน้าแสดงข้อมูลหลังจากบันทึกเสร็จ
        return redirect()->route('dashboard')->with('success', 'ข้อมูลได้ถูกบันทึกเรียบร้อย');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function printReceipt()
    {
        // Fetch installments for the logged-in user
        $installments = Installment::where('user_id', auth()->id())->get();

        // Generate the PDF and return the download
        $pdf = PDF::loadView('pdf.receipt', compact('installments'));

        // Return the PDF as a download
        return $pdf->download('installment_receipt.pdf');
    }
}
