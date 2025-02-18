
@php
    $users = \App\Models\User::all();
@endphp
@extends('layouts.auth')

@section('content')
<div class="content-wrapper">
  <div class="page-header">
      <h3 class="page-title text-primary">ข้อมูลลูกค้า</h3>
  </div>
  <div class="container py-4">
    <div class="card shadow-lg border-0">
      <div class="card-body">
        <h2 class="text-center text-white">Welcome, {{ Auth::user()->name }}!</h2>
        <hr>
        <h3 class="text-white">สถานะบัญชีของคุณ</h3>

        @if($installments->isEmpty())
            <div class="alert alert-warning text-center">No installments found.</div>
        @else
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>งวดที่</th>
                            <th>วันที่</th>
                            <th>จำนวนเงินที่ชำระ</th>
                            <th>ชำระดอกเบี้ย</th>
                            <th>ค่าทวงถาม</th>
                            <th>เงินต้นคืน</th>
                            <th>ยอดคงเหลือ</th>
                            <th>จัดการ</th> <!-- Added new column header -->

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($installments as $installment)
                            <tr>
                                <td>{{ $installment->installment_number }}</td>
                                <td>{{ $installment->date }}</td>
                                <td class="text-success">฿{{ number_format($installment->payment_amount, 2) }}</td>
                                <td class="text-danger">฿{{ number_format($installment->interest, 2) }}</td>
                                <td class="text-warning">฿{{ number_format($installment->collection_fee, 2) }}</td>
                                <td class="text-primary">฿{{ number_format($installment->principal_return, 2) }}</td>
                                <td class="fw-bold">฿{{ number_format($installment->remaining_balance, 2) }}</td>
                                <td>
                                    <a href="{{ route('installments.pdf', $installment->id) }}" class="btn btn-sm btn-danger">
                                        ดาวน์โหลด PDF
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const rows = document.querySelectorAll("tbody tr");
    rows.forEach(row => {
      row.addEventListener("mouseover", function() {
        this.classList.add("table-info");
      });
      row.addEventListener("mouseout", function() {
        this.classList.remove("table-info");
      });
    });
  });
</script>
@endsection