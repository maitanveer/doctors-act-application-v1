@extends('layouts.admin')
@section('title', 'User Management')
@section('content')

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>User Management <span class="badge badge-primary">{{ $users->total() }}</span></h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
        <i class="fa fa-user-plus"></i> Create New User
    </a>
</div>

<div class="stat-card">
    <table class="table table-hover">
        <thead>
            <tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Status</th><th>Registered</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if(auth()->user()->isSuperAdmin() || $user->role !== 'superadmin')
                        <form action="{{ route('admin.users.update-role', $user->id) }}" method="POST">
                            @csrf
                            <select name="role" class="form-control form-control-sm" onchange="this.form.submit()" {{ $user->id === auth()->id() ? 'disabled' : '' }}>
                                <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                @if(auth()->user()->isSuperAdmin())
                                <option value="superadmin" {{ $user->role === 'superadmin' ? 'selected' : '' }}>SuperAdmin</option>
                                @endif
                            </select>
                        </form>
                    @else
                        <span class="badge badge-danger">SuperAdmin</span>
                    @endif
                </td>
                <td>
                    @if($user->id !== auth()->id())
                        <form action="{{ route('admin.users.toggle-status', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-{{ $user->is_active ? 'success' : 'secondary' }}">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </form>
                    @else
                        <span class="badge badge-success">You</span>
                    @endif
                </td>
                <td>{{ $user->created_at->format('M d, Y') }}</td>
                <td>
                    @if($user->id !== auth()->id() && ($user->role !== 'superadmin' || auth()->user()->isSuperAdmin()))
                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" onsubmit="return confirm('Delete user?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $users->links() }}
</div>
@endsection
