@extends('layouts.adm')

@section('title', 'Edit User')

@section('content')
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <!-- Рөлді таңдау -->
        <div class="input-group mb-3">
            <select name="role" class="form-control">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                <option value="moderator" {{ $user->role == 'moderator' ? 'selected' : '' }}>Moderator</option>
            </select>
        </div>

        <!-- Рөлдің атауы -->
        <div class="input-group mb-3">
            <input type="text" name="role_label" class="form-control" value="{{ ucfirst($user->role) }}" disabled />
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
