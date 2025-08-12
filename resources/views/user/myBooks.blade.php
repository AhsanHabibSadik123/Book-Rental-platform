<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Books - {{ config('app.name', 'BookStore') }}</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .stats-row {
            padding-top: 20px;
            padding-bottom: 20px;
        }
        .stats-card {
            min-width: 120px;
            max-width: 160px;
            margin: 0 auto 10px auto;
            padding: 10px 8px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(44,62,80,0.10);
        }
        body {
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
        .navbar-nav .nav-link, .navbar-nav .dropdown-item {
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
        .book-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 15px;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            background: #fff;
        }
        .book-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(44,62,80,0.12);
        }
        .book-image {
            height: 200px;
            object-fit: cover;
            border-radius: 15px 15px 0 0;
            background-color: #f8f9fa;
        }
        .status-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 0.85rem;
            padding: 0.3rem 0.7rem;
            border-radius: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #fff;
            font-weight: 500;
        }
        .empty-state {
            text-align: center;
            padding: 3rem 1rem;
            color: #6c757d;
        }
        .price-tag {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        .card-title {
            font-size: 1.1rem;
            font-weight: 600;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 8px;
            font-weight: 500;
        }
        .btn-primary:hover {
            background: #495057;
        }
    </style>
</head>
<body class="bg-light">
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
    </nav>

    <div class="container py-4">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="fw-bold text-white mb-1"><i class="fas fa-book me-2"></i>My Books</h1>
                <p class="lead text-light">All books you are lending</p>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

            <div class="row mb-4 stats-row justify-content-center">
                <div class="col-auto">
                    <div class="stats-card bg-primary text-white text-center">
                        <i class="fas fa-book fa-lg mb-1"></i>
                        <div class="fw-bold" style="font-size:1.2rem;">{{ $books->total() }}</div>
                        <div class="small">Total Books</div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="stats-card bg-success text-white text-center">
                        <i class="fas fa-check-circle fa-lg mb-1"></i>
                        <div class="fw-bold" style="font-size:1.2rem;">{{ $books->where('status', 'available')->count() }}</div>
                        <div class="small">Available</div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="stats-card bg-warning text-white text-center">
                        <i class="fas fa-handshake fa-lg mb-1"></i>
                        <div class="fw-bold" style="font-size:1.2rem;">{{ $books->where('status', 'rented')->count() }}</div>
                        <div class="small">Rented Out</div>
                    </div>
                </div>
            </div>

        @if($books->count() > 0)
            <div class="row g-4">
                @foreach($books as $book)
                    @if($book->lender_id === Auth::id())
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card book-card h-100">
                                <div class="position-relative">
                                    @if($book->image_path)
                                        <img src="{{ asset('storage/' . $book->image_path) }}" class="card-img-top book-image" alt="{{ $book->title }}">
                                    @else
                                        <div class="card-img-top book-image d-flex align-items-center justify-content-center bg-light">
                                            <i class="fas fa-book fa-3x text-muted"></i>
                                        </div>
                                    @endif
                                    <span class="badge status-badge">
                                        {{ ucfirst($book->status) }}
                                    </span>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h6 class="card-title fw-bold mb-2">{{ $book->title }}</h6>
                                    <p class="text-muted small mb-2"><i class="fas fa-user me-1"></i>{{ $book->author }}</p>
                                    <p class="text-muted small mb-2"><i class="fas fa-tags me-1"></i>{{ $book->genre }}</p>
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="price-tag">${{ number_format($book->rental_price_per_day, 2) }}/day</span>
                                        <small class="text-muted"><i class="fas fa-star me-1"></i>{{ ucfirst($book->condition) }}</small>
                                    </div>
                                    <p class="card-text small text-muted flex-grow-1">{{ Str::limit($book->description, 80) }}</p>
                                    <div class="mt-auto">
                                        <a href="{{ route('books.show', $book) }}" class="btn btn-outline-primary btn-sm w-100">See Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $books->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-book-open fa-5x mb-4 text-muted"></i>
                <h4>No Books Yet</h4>
                <p class="mb-4">Start building your book collection and earn money by renting them out!</p>
                <a href="{{ route('books.create') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus me-2"></i>Add Your First Book
                </a>
            </div>
        @endif
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>