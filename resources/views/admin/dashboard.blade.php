@php
    $users = \App\Models\User::all();
@endphp
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
                    <h4 class="card-title text-center">รายชื่อลูกค้า</h4>
                    <hr>
                    @if ($message = session('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ชื่อ</th>
                                    <th>อีเมล</th>
                                    <th>บทบาท</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr id="user-{{ $user->id }}">
                                        <td class="name">{{ $user->name }}</td>
                                        <td class="email">{{ $user->email }}</td>
                                        <td class="role">{{ ucfirst($user->role) }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <button class="btn btn-primary edit-btn" data-id="{{ $user->id }}">
                                                Edit
                                            </button>
                                            <!-- Delete Button -->
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    <!-- Hidden Edit Form Row -->
                                    <tr id="edit-row-{{ $user->id }}" class="d-none">
                                        <td>
                                            <input type="text" class="form-control" name="edit_name" id="edit_name_{{ $user->id }}" value="{{ $user->name }}">
                                        </td>
                                        <td>
                                            <input type="email" class="form-control" name="edit_email" id="edit_email_{{ $user->id }}" value="{{ $user->email }}">
                                        </td>
                                        <td>
                                            <select class="form-select" name="edit_role" id="edit_role_{{ $user->id }}">
                                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                                <option value="supervisor" {{ $user->role == 'supervisor' ? 'selected' : '' }}>Supervisor</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button class="btn btn-success save-btn" data-id="{{ $user->id }}">
                                                Save
                                            </button>
                                            <button class="btn btn-secondary cancel-btn" data-id="{{ $user->id }}">
                                                Cancel
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-btn');
        const cancelButtons = document.querySelectorAll('.cancel-btn');
        const saveButtons = document.querySelectorAll('.save-btn');

        // Show the editable row when Edit button is clicked
        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-id');

                // Hide the current user data row
                document.getElementById('user-' + userId).classList.add('d-none');

                // Show the edit row
                document.getElementById('edit-row-' + userId).classList.remove('d-none');
            });
        });

        // Cancel editing
        cancelButtons.forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-id');

                // Hide the edit row
                document.getElementById('edit-row-' + userId).classList.add('d-none');

                // Show the user data row again
                document.getElementById('user-' + userId).classList.remove('d-none');
            });
        });

        // Save the edited user data
        saveButtons.forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-id');

                const name = document.getElementById('edit_name_' + userId).value;
                const email = document.getElementById('edit_email_' + userId).value;
                const role = document.getElementById('edit_role_' + userId).value;

                // Perform the update using AJAX (using Fetch API for simplicity)
                fetch(`/users/${userId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        name: name,
                        email: email,
                        role: role
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the table with new values
                        document.querySelector('#user-' + userId + ' .name').textContent = name;
                        document.querySelector('#user-' + userId + ' .email').textContent = email;
                        document.querySelector('#user-' + userId + ' .role').textContent = role;

                        // Hide the edit row and show the normal row
                        document.getElementById('edit-row-' + userId).classList.add('d-none');
                        document.getElementById('user-' + userId).classList.remove('d-none');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            });
        });
    });
</script>
@endpush
