@extends('layouts.admin.app')

@section('content')

<div class="card">
    <div class="card-header">
        <h4>Edit User</h4>
    </div>

    <div class="card-body">
        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                {{-- Avatar & Info --}}
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="text-center mb-3">
                        @if ($user->avatar)
                            <img src="{{ asset('storage/avatars/' . $user->avatar) }}"
                                class="rounded-circle mb-2"
                                style="width: 80px; height: 80px;"
                                alt="Avatar">
                        @else
                            <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center mb-2"
                                style="width: 80px; height: 80px; font-size: 24px;">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                        @endif
                    </div>

                    {{-- Input file utk avatar --}}
                    <input type="file" name="avatar" class="form-control form-control-sm">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti foto</small>
                </div>

                {{-- Nama Lengkap --}}
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name', $user->name) }}" required>
                </div>

                {{-- Email --}}
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ old('email', $user->email) }}" required>
                </div>

                {{-- Password --}}
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru (Opsional)</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    </div>
                </div>

            </div>

            <button class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

@endsection
