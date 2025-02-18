@extends('layouts.auth')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
          <h3 class="page-title"> ข้อมูลลูกค้า </h3>
      
        </div>
        <div class="row">
          <div class="col-lg-6 grid-margin stretch-card">     
          </div>
       
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">รายชื่อลูกค้า</h4>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('installments.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="user_id">เลือกผู้ใช้</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">-- เลือกผู้ใช้ --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="installment_number">งวดที่</label>
            <select name="installment_number" class="form-control" required>
                <option value="">เลือกงวดที่</option>
                <?php for ($i = 1; $i <= 48; $i++): ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php endfor; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="date">วันที่</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="payment_amount">ยอดชำระเงิน</label>
            <input type="number" name="payment_amount" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="interest">ดอกเบี้ย</label>
            <input type="number" name="interest" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="collection_fee">ค่าทวงถาม</label>
            <input type="number" name="collection_fee" class="form-control">
        </div>

        <div class="form-group">
            <label for="principal_return">ต้นคืน</label>
            <input type="number" name="principal_return" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="remaining_balance">คงเหลือ</label>
            <input type="number" name="remaining_balance" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">บันทึก</button>
    </form>
</div>
@endsection
