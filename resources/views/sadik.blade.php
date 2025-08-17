@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Sadik</h2>
    </div>
@endsection

        <!-- body {
            background: linear-gradient(135deg, #556a7eff 0%, #556a7eff 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar */
        .admin-navbar {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            box-shadow: 0 2px 8px rgba(44, 62, 80, 0.08);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.3rem;
            color: #fff !important;
        }

        .navbar-nav .nav-link,
        .navbar-nav .dropdown-item {
            color: #fff !important;
            font-weight: 500;
        }

        .navbar-nav .dropdown-menu {
            background: #34495e;
        }

        .navbar-nav .dropdown-item:hover {
            background: #667eea;
            color: #fff !important;
        }

        /* End navbar */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .admin-content {
            margin-top: 0;
            padding-top: 20px;
        } -->



<!-- Navigation -->
<!-- <nav class="navbar navbar-expand-lg admin-navbar">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <i class="fas fa-book me-2"></i>BookStore
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav me-auto">
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="{{ route('profile') }}">
                                <i class="fas fa-user-edit me-2"></i>Profile
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('books.index') }}">
                                <i class="fas fa-book me-2"></i>View My Books
                            </a></li>
                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">
                                <i class="fas fa-home me-2"></i>User Dashboard
                            </a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline w-100">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav> -->