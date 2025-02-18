@php
    $layout = match(auth()->user()->role) {
        'admin' => 'admin.dashboard',
        'supervisor' => 'supervisor.dashboard',
        'user' => 'users.dashboard',
        default => 'dashboard'
    };
@endphp

@extends($layout)

