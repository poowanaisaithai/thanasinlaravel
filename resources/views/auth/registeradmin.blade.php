<form action="{{ url('registeradmin') }}" method="POST">
    @csrf
    <div>
        <label for="name">ชื่อผู้ใช้</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        @error('name') <div>{{ $message }}</div> @enderror
    </div>

    <div>
        <label for="email">อีเมล</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email') <div>{{ $message }}</div> @enderror
    </div>

    <div>
        <label for="password">รหัสผ่าน</label>
        <input type="password" id="password" name="password" required>
        @error('password') <div>{{ $message }}</div> @enderror
    </div>

    <div>
        <label for="password_confirmation">ยืนยันรหัสผ่าน</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>
        @error('password_confirmation') <div>{{ $message }}</div> @enderror
    </div>

    <button type="submit">ลงทะเบียน</button>
</form>
