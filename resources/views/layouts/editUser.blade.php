@extends('layouts.auth')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> แก้ไขข้อมูลผู้ใช้ </h3>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h4 class="card-title text-center">แก้ไขข้อมูลลูกค้า</h4>
                    <hr>

                    <form method="POST" action="{{ route('users.update', $user->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">ชื่อผู้ใช้</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">อีเมล</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">บทบาท</label>
                            <select id="role" name="role" class="form-select">
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                <option value="supervisor" {{ $user->role == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                            </select>
                            @error('role') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">บันทึกการเปลี่ยนแปลง</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
