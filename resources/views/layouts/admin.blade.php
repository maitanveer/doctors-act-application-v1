<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel - Ibn Sina Foundation')</title>
    
    <link rel="stylesheet" href="/css/bootstrap4.6.2.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/style.min.css">
    
    <style>
        .admin-sidebar {
            min-height: 100vh;
            background: #2c3e50;
            color: white;
        }
        .admin-sidebar .nav-link {
            color: #ecf0f1;
            padding: 15px 20px;
            border-radius: 5px;
            margin: 5px 10px;
        }
        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            background: #34495e;
            color: white;
        }
        .admin-content {
            padding: 30px;
            background: #f8f9fa;
            min-height: 100vh;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .stat-card h3 {
            font-size: 2rem;
            margin: 10px 0;
            color: #2c3e50;
        }
        .badge-role {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.85rem;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 admin-sidebar">
                <div class="p-3">
                    <h4 class="text-white">{{ auth()->user()->role === 'user' ? 'User Portal' : 'Admin Panel' }}</h4>
                    <hr class="bg-light">
                    <p class="mb-1"><strong>{{ auth()->user()->name }}</strong></p>
                    <p class="small">
                        <span class="badge badge-{{ auth()->user()->role === 'superadmin' ? 'danger' : (auth()->user()->role === 'admin' ? 'warning' : 'info') }}">
                            {{ ucfirst(auth()->user()->role) }}
                        </span>
                    </p>
                </div>
                
                <ul class="nav flex-column">
                    @if(auth()->user()->role === 'user')
                        <!-- User Navigation -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
                                <i class="fa fa-dashboard"></i> My Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('application') }}">
                                <i class="fa fa-plus-circle"></i> New Application
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}" target="_blank">
                                <i class="fa fa-external-link"></i> View Website
                            </a>
                        </li>
                    @else
                        <!-- Admin Navigation -->
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                <i class="fa fa-dashboard"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.applications.*') ? 'active' : '' }}" href="{{ route('admin.applications.index') }}">
                                <i class="fa fa-file-text"></i> Applications
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                <i class="fa fa-users"></i> Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}" target="_blank">
                                <i class="fa fa-external-link"></i> View Website
                            </a>
                        </li>
                    @endif
                    
                    <!-- Change Password (All Users) -->
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('password.change') ? 'active' : '' }}" href="{{ route('password.change') }}">
                            <i class="fa fa-lock"></i> Change Password
                        </a>
                    </li>
                    
                    <li class="nav-item mt-4">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link text-left w-100">
                                <i class="fa fa-sign-out"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 admin-content">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif

                @if(session('warning'))
                    <div class="alert alert-warning alert-dismissible fade show">
                        {{ session('warning') }}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="/js/jquery.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
