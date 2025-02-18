@extends('layouts.auth')

@section('content')

<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> ข้อมูลลูกค้า </h3>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8 grid-margin stretch-card">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h4 class="card-title text-center">ลงทะเบียนลูกค้าใหม่</h4>
                    <hr>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('registeradmin.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">ชื่อผู้ใช้</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
                            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">อีเมล</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <x-input-label for="role" :value="__('Role')" />
                            <select id="role" name="role" class="form-select border-gray-300 dark:border-gray-700 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:focus:ring-indigo-600">
                                <option value="user">User</option>
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">รหัสผ่าน</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                            @error('password') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">ยืนยันรหัสผ่าน</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                            @error('password_confirmation') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>



                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">ลงทะเบียน</button>
                        </div>
                    </form>

                 
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
