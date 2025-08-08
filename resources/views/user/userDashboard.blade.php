<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard - BookStore</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar Styling */
        .admin-navbar {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }

        .navbar-brand {
            font-weight: bold;
            color: white !important;
            font-size: 1.25rem;
        }

        .navbar-nav .nav-link {
            color: white !important;
            font-weight: 500;
        }

        .navbar-nav .nav-link:hover {
            color: #f8f9fa !important;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            border-radius: 8px;
        }

        .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
            font-weight: 600;
            color: #495057;
        }

        /* Stats Cards */
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .stats-card h3 {
            font-size: 2.5rem;
            font-weight: bold;
            margin: 0;
        }

        .stats-card h5 {
            opacity: 0.9;
            font-weight: 500;
        }

        /* Button Styling */
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-info {
            background: linear-gradient(135deg, #17a2b8, #138496);
            border: none;
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            border: none;
            border-radius: 8px;
            font-weight: 500;
        }

        /* Book Cards */
        .book-card {
            height: 100%;
            transition: transform 0.2s;
        }

        .book-card:hover {
            transform: translateY(-3px);
        }

        .book-card h6 {
            color: #495057;
            font-weight: 600;
        }

        .book-card .text-muted {
            font-size: 0.875rem;
        }

        .book-card strong {
            color: #28a745;
            font-size: 1.1rem;
        }

        /* Welcome Section */
        .welcome-card {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .welcome-card h1 {
            color: #495057;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        /* Quick Actions */
        .quick-actions .card-body {
            padding: 1.5rem;
        }

        .quick-actions h5 {
            color: #495057;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        /* Search Form */
        .search-form {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 12px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .search-form .form-control,
        .search-form .form-select {
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .search-form .form-control:focus,
        .search-form .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            transform: translateY(-1px);
        }

        .search-form .form-select {
            background-color: white;
            cursor: pointer;
        }

        .search-form .btn-primary {
            padding: 12px 24px;
            font-weight: 600;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stats-card h3 {
                font-size: 2rem;
            }
            
            .card-body {
                padding: 1rem;
            }
            
            .search-form .form-control {
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg admin-navbar">
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
                            <li><hr class="dropdown-divider"></li>
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
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        <div class="container">
            <!-- Welcome Message -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card welcome-card">
                        <div class="card-body text-center">
                            <h1>Welcome, {{ Auth::user()->name }}!</h1>
                            <p class="lead text-muted">Discover and rent amazing books from our collection</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Books -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card search-form">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                <i class="fas fa-search me-2"></i>Search Books
                            </h5>
                            <form action="{{ route('books.browse') }}" method="GET" class="row g-3">
                                <div class="col-md-5">
                                    <input type="text" 
                                           class="form-control" 
                                           name="search" 
                                           placeholder="Search by book title, author..."
                                           value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3">
                                    <select class="form-select" name="category">
                                        <option value="">All Categories</option>
                                        <option value="fiction" {{ request('category') == 'fiction' ? 'selected' : '' }}>Fiction</option>
                                        <option value="non-fiction" {{ request('category') == 'non-fiction' ? 'selected' : '' }}>Non-Fiction</option>
                                        <option value="mystery" {{ request('category') == 'mystery' ? 'selected' : '' }}>Mystery</option>
                                        <option value="romance" {{ request('category') == 'romance' ? 'selected' : '' }}>Romance</option>
                                        <option value="science-fiction" {{ request('category') == 'science-fiction' ? 'selected' : '' }}>Science Fiction</option>
                                        <option value="fantasy" {{ request('category') == 'fantasy' ? 'selected' : '' }}>Fantasy</option>
                                        <option value="biography" {{ request('category') == 'biography' ? 'selected' : '' }}>Biography</option>
                                        <option value="history" {{ request('category') == 'history' ? 'selected' : '' }}>History</option>
                                        <option value="self-help" {{ request('category') == 'self-help' ? 'selected' : '' }}>Self Help</option>
                                        <option value="business" {{ request('category') == 'business' ? 'selected' : '' }}>Business</option>
                                        <option value="technology" {{ request('category') == 'technology' ? 'selected' : '' }}>Technology</option>
                                        <option value="educational" {{ request('category') == 'educational' ? 'selected' : '' }}>Educational</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-search me-2"></i>Search Books
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Available Books for Rental -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-book-open me-2"></i>All Available Books for Rental</h4>
                        </div>
                        <div class="card-body">
                            @if($recentBooks->count() > 0)
                                <div class="row">
                                    @foreach($recentBooks as $book)
                                        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                            <div class="card book-card h-100">
                                                <div class="card-body">
                                                    <h6 class="card-title">{{ Str::limit($book->title, 25) }}</h6>
                                                    <p class="text-muted small mb-1">by {{ $book->author }}</p>
                                                    <p class="text-muted small mb-2">Lender: {{ $book->lender->name }}</p>
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <strong class="text-success">₹{{ $book->rental_price_per_day }}/day</strong>
                                                        <span class="badge bg-success">Available</span>
                                                    </div>
                                                    <div class="mt-3">
                                                        <a href="{{ route('books.show', $book) }}" class="btn btn-primary btn-sm w-100">
                                                            <i class="fas fa-eye me-1"></i>View & Rent
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <div class="text-center mt-4">
                                    <a href="{{ route('books.browse') }}" class="btn btn-outline-primary">
                                        <i class="fas fa-search me-2"></i>Browse More Books
                                    </a>
                                </div>
                            @else
                                <div class="text-center py-5">
                                    <i class="fas fa-book fa-4x text-muted mb-3"></i>
                                    <h5>No Books Available</h5>
                                    <p class="text-muted">There are currently no books available for rental. Check back later!</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
