<!-- this page is ok -->
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Book Management - BookStore</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <style>
        /* Global Styles */
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #212529;
        }
        
        .container-fluid {
            background-color: transparent;
        }
        
        /* Admin Navbar */
        .admin-navbar {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
            padding: 0;
            border: none;
        }
        
        .admin-navbar .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: #fff !important;
            padding: 15px 20px;
            text-decoration: none;
        }
        
        .admin-navbar .navbar-brand:hover {
            color: #f8f9fa !important;
        }
        
        .admin-navbar .nav-link {
            color: rgba(255,255,255,0.8) !important;
            padding: 15px 20px !important;
            transition: all 0.3s ease;
            border-right: 1px solid rgba(255,255,255,0.1);
            text-decoration: none;
        }
        
        .admin-navbar .nav-link:hover {
            background: rgba(255,255,255,0.1);
            color: #fff !important;
        }
        
        .admin-navbar .nav-link.active {
            background: rgba(255,255,255,0.2);
            color: #fff !important;
        }
        
        .admin-navbar .navbar-toggler {
            border: 1px solid rgba(255,255,255,0.3);
            padding: 4px 8px;
        }
        
        .admin-navbar .navbar-toggler:focus {
            box-shadow: 0 0 0 0.2rem rgba(255,255,255,0.25);
        }
        
        .admin-navbar .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.75%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        
        .admin-navbar .dropdown-menu {
            background: #fff;
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            margin-top: 5px;
        }
        
        .admin-navbar .dropdown-item {
            color: #333 !important;
            padding: 10px 20px;
            text-decoration: none;
        }
        
        .admin-navbar .dropdown-item:hover {
            background: #f8f9fa;
            color: #333 !important;
        }
        
        .admin-navbar .dropdown-item.text-danger {
            color: #dc3545 !important;
        }
        
        .admin-navbar .dropdown-item.text-danger:hover {
            background: #dc3545;
            color: #fff !important;
        }
        
        /* Main Content */
        .admin-content {
            margin-top: 0;
            padding-top: 20px;
        }
        
        /* Cards */
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            background: #fff;
            margin-bottom: 20px;
        }
        
        .card-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-bottom: 1px solid #dee2e6;
            border-radius: 15px 15px 0 0 !important;
            padding: 15px 20px;
        }
        
        .card-body {
            background: #fff;
            color: #212529;
            padding: 20px;
        }
        
        /* Navigation Tabs */
        .nav-tabs {
            border-bottom: none;
        }
        
        .nav-tabs .nav-link {
            border: none;
            border-radius: 10px 10px 0 0;
            color: #6c757d !important;
            font-weight: 500;
            padding: 12px 20px;
            margin-right: 5px;
            background: transparent;
            text-decoration: none;
        }
        
        .nav-tabs .nav-link:hover {
            border-color: transparent;
            background: #e9ecef;
            color: #495057 !important;
        }
        
        .nav-tabs .nav-link.active {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%) !important;
            color: #ffffff !important;
            border: none;
        }
        
        /* Table Styles */
        .table {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            background: #fff;
            margin-bottom: 0;
        }
        
        .table thead th {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            color: #ffffff !important;
            font-weight: 600;
            border: none;
            padding: 15px 12px;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        
        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #e9ecef;
            background: #fff;
        }
        
        .table tbody tr:hover {
            background: #f8f9fa !important;
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .table tbody td {
            padding: 15px 12px;
            vertical-align: middle;
            border: none;
            color: #212529;
            background: inherit;
        }
        
        .table tbody td strong {
            color: #212529 !important;
            font-weight: 600;
        }
        
        .table tbody td .text-muted {
            color: #6c757d !important;
        }
        
        /* Buttons */
        .btn {
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .btn-sm {
            padding: 8px 12px;
            font-size: 0.8rem;
            border-radius: 6px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border: none;
            color: #fff !important;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3 0%, #004494 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
            color: #fff !important;
        }
        
        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            border: none;
            color: #fff !important;
        }
        
        .btn-success:hover {
            background: linear-gradient(135deg, #20c997 0%, #17a2b8 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
            color: #fff !important;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            border: none;
            color: #fff !important;
        }
        
        .btn-danger:hover {
            background: linear-gradient(135deg, #c82333 0%, #a71e2a 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.3);
            color: #fff !important;
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
            border: none;
            color: #212529 !important;
        }
        
        .btn-warning:hover {
            background: linear-gradient(135deg, #e0a800 0%, #d39e00 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(255, 193, 7, 0.3);
            color: #212529 !important;
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%);
            border: none;
            color: #fff !important;
        }
        
        .btn-secondary:hover {
            background: linear-gradient(135deg, #5a6268 0%, #4e555b 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
            color: #fff !important;
        }
        
        .btn-outline-primary {
            color: #007bff !important;
            border: 2px solid #007bff;
            background: transparent;
        }
        
        .btn-outline-primary:hover {
            background: #007bff;
            border-color: #007bff;
            color: #fff !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }
        
        /* Badges */
        .badge {
            padding: 6px 12px;
            font-size: 0.75rem;
            font-weight: 500;
            border-radius: 20px;
        }
        
        .badge.bg-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
            color: #fff !important;
        }
        
        .badge.bg-info {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%) !important;
            color: #fff !important;
        }
        
        .badge.bg-warning {
            background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%) !important;
            color: #212529 !important;
        }
        
        .badge.bg-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
            color: #fff !important;
        }
        
        .badge.bg-secondary {
            background: linear-gradient(135deg, #6c757d 0%, #5a6268 100%) !important;
            color: #fff !important;
        }
        
        /* Images */
        .img-thumbnail {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }
        
        .img-thumbnail:hover {
            transform: scale(1.1);
            border-color: #007bff;
        }
        
        /* Alerts */
        .alert {
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724 !important;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24 !important;
        }
        
        .alert-warning {
            background: linear-gradient(135deg, #fff3cd 0%, #fdeaa7 100%);
            color: #856404 !important;
        }
        
        .alert i {
            color: inherit !important;
        }
        
        /* Modal */
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }
        
        .modal-header {
            border-bottom: 1px solid #dee2e6;
            padding: 20px 24px;
        }
        
        .modal-header.bg-danger {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%) !important;
            color: #fff !important;
        }
        
        .modal-body {
            padding: 24px;
            background: #fff;
            color: #212529;
        }
        
        .modal-footer {
            border-top: 1px solid #dee2e6;
            padding: 20px 24px;
            background: #f8f9fa;
        }
        
        .modal-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: inherit !important;
        }
        
        /* Text Colors */
        .text-primary {
            color: #007bff !important;
        }
        
        .text-success {
            color: #28a745 !important;
        }
        
        .text-danger {
            color: #dc3545 !important;
        }
        
        .text-warning {
            color: #ffc107 !important;
        }
        
        .text-muted {
            color: #6c757d !important;
        }
        
        .fw-bold {
            font-weight: 600 !important;
        }
        
        .h3 {
            color: #212529 !important;
            font-weight: 600;
        }
        
        /* Empty State */
        .text-center.py-5 {
            padding: 3rem 1rem !important;
            background: #fff;
            border-radius: 10px;
        }
        
        .text-center.py-5 i {
            opacity: 0.5;
            color: #6c757d !important;
        }
        
        .text-center.py-5 h5 {
            color: #6c757d !important;
        }
        
        .text-center.py-5 p {
            color: #6c757d !important;
        }
        
        /* Pagination */
        .pagination .page-link {
            color: #007bff;
            background: #fff;
            border: 1px solid #dee2e6;
            padding: 8px 12px;
            margin: 0 2px;
            border-radius: 6px;
            text-decoration: none;
        }
        
        .pagination .page-link:hover {
            color: #0056b3;
            background: #e9ecef;
            border-color: #dee2e6;
            transform: translateY(-1px);
        }
        
        .pagination .page-item.active .page-link {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border-color: #007bff;
            color: #fff;
        }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .admin-navbar .navbar-brand {
                font-size: 1.2rem;
                padding: 12px 15px;
            }
            
            .admin-navbar .nav-link {
                padding: 12px 15px !important;
            }
            
            .card-body {
                padding: 15px;
            }
            
            .table-responsive {
                border-radius: 10px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            }
            
            .btn-sm {
                font-size: 0.7rem;
                padding: 6px 10px;
            }
            
            .d-flex.flex-column.gap-1 {
                gap: 0.25rem !important;
            }
        }
        
        /* Utility Classes */
        .gap-1 {
            gap: 0.25rem !important;
        }
        
        .gap-2 {
            gap: 0.5rem !important;
        }
        
        /* Link Styles */
        a {
            text-decoration: none;
        }
        
        a:hover {
            text-decoration: none;
        }
        
        /* Form Controls */
        .form-control {
            border-radius: 8px;
            border: 2px solid #e9ecef;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #0056b3 0%, #004494 100%);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg admin-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
                <i class="fas fa-shield-alt me-2"></i>Admin Panel
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
    <div class="admin-content">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 fw-bold text-primary">
                    <i class="fas fa-book-medical me-2"></i>Book Management
                </h1>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.books.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-1"></i> Add New Book
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
                    </a>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Filter Tabs -->
            <div class="card mb-4">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link {{ $status === 'all' ? 'active' : '' }}" 
                               href="{{ route('admin.books', ['status' => 'all']) }}">
                                All Books
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status === 'available' ? 'active' : '' }}" 
                               href="{{ route('admin.books', ['status' => 'available']) }}">
                                Available
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $status === 'rented' ? 'active' : '' }}" 
                               href="{{ route('admin.books', ['status' => 'rented']) }}">
                                Rented
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

            <!-- Books Table -->
            <div class="card">
                <div class="card-body">
                    @if($books->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Book Details</th>
                                        <th>Owner Info</th>
                                        <th>Pricing</th>
                                        <th>Status</th>
                                        <th>Added Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($books as $book)
                                        <tr>
                                            <td>
                                                @if($book->image_path)
                                                    <img src="{{ asset('storage/' . $book->image_path) }}" 
                                                         alt="{{ $book->title }}" 
                                                         class="img-thumbnail" 
                                                         style="width: 50px; height: 50px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light d-flex align-items-center justify-content-center" 
                                                         style="width: 50px; height: 50px;">
                                                        <i class="fas fa-book text-muted"></i>
                                                    </div>
                                                @endif
                                            </td>
                                            <td>
                                                <div>
                                                    <strong>{{ $book->title }}</strong><br>
                                                    <small class="text-muted">by {{ $book->author }}</small><br>
                                                    <small class="text-muted">Genre: {{ $book->genre }}</small><br>
                                                    <small class="text-muted">Condition: {{ ucfirst(str_replace('_', ' ', $book->condition)) }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    @if($book->lender_id)
                                                        <strong>{{ $book->lender->name }}</strong><br>
                                                        <small class="text-muted">{{ $book->lender->email }}</small><br>
                                                        <small class="text-muted">{{ $book->lender->phone }}</small>
                                                    @else
                                                        <small class="text-muted">Admin Added</small>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <strong>${{ number_format($book->rental_price_per_day, 2) }}/day</strong><br>
                                                    <small class="text-muted">Deposit: ${{ number_format($book->security_deposit, 2) }}</small>
                                                </div>
                                            </td>
                                            <td>
                                                @if($book->status === 'available')
                                                    <span class="badge bg-success">Available</span>
                                                @elseif($book->status === 'rented')
                                                    <span class="badge bg-info">Rented</span>
                                                @else
                                                    <span class="badge bg-secondary">{{ ucfirst($book->status) }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                {{ $book->created_at->format('M d, Y') }}<br>
                                                <small class="text-muted">{{ $book->created_at->format('h:i A') }}</small>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column gap-1">
                                                    <a href="{{ route('admin.books.show', $book) }}" 
                                                       class="btn btn-sm btn-outline-primary w-100">
                                                        <i class="fas fa-eye me-1"></i> View
                                                    </a>
                                                    
                                                    <a href="{{ route('admin.books.edit', $book) }}" 
                                                       class="btn btn-sm btn-warning w-100">
                                                        <i class="fas fa-edit me-1"></i> Edit
                                                    </a>
                                                    
                                                    <button type="button" 
                                                            class="btn btn-sm btn-danger w-100 delete-btn" 
                                                            data-book-id="{{ $book->id }}"
                                                            data-book-title="{{ $book->title }}">
                                                        <i class="fas fa-trash me-1"></i> Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $books->appends(['status' => $status])->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No books found</h5>
                            <p class="text-muted">
                                @if($status === 'available')
                                    No books are currently available for rent.
                                @elseif($status === 'rented')
                                    No books are currently rented out.
                                @else
                                    No books have been added to the system yet.
                                @endif
                            </p>
                            <a href="{{ route('admin.books.create') }}" class="btn btn-success">
                                <i class="fas fa-plus me-2"></i>Add First Book
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Book Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title fw-bold" id="deleteModalLabel">
                    <i class="fas fa-trash me-2"></i>Delete Book
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4">
                    <div class="mb-3">
                        <i class="fas fa-exclamation-triangle fa-4x text-danger"></i>
                    </div>
                    <h4 class="text-danger fw-bold" id="deleteBookTitle">Book Title</h4>
                    <p class="text-muted mb-0">Are you sure you want to delete this book?</p>
                </div>
                
                <div class="alert alert-warning">
                    <h6 class="fw-bold">⚠️ Warning:</h6>
                    <ul class="mb-0">
                        <li>This action <strong>CANNOT</strong> be undone</li>
                        <li>The book will be permanently removed</li>
                        <li>Any rental history will be preserved</li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Cancel
                </button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">
                    <i class="fas fa-trash me-1"></i>Delete Book
                </button>
            </div>
        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Book Management page loaded, setting up event listeners...');
    
    let currentBookId = null;
    let currentBookTitle = null;
    let currentButton = null;
    
    // Get modal elements
    const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
    
    // Event delegation for delete buttons
    document.addEventListener('click', function(e) {
        if (e.target.closest('.delete-btn')) {
            const button = e.target.closest('.delete-btn');
            currentBookId = button.getAttribute('data-book-id');
            currentBookTitle = button.getAttribute('data-book-title');
            currentButton = button;
            
            console.log('Delete button clicked:', currentBookId, currentBookTitle);
            
            // Update modal content
            document.getElementById('deleteBookTitle').textContent = currentBookTitle;
            
            // Show modal
            deleteModal.show();
        }
    });
    
    // Handle delete confirmation
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (!currentBookId || !currentButton) return;
        
        console.log('User confirmed deletion, processing...');
        
        // Store original button state
        const originalHTML = currentButton.innerHTML;
        
        // Add loading state to button
        currentButton.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Deleting...';
        currentButton.disabled = true;
        currentButton.classList.add('btn-secondary');
        currentButton.classList.remove('btn-danger');
        
        // Hide modal
        deleteModal.hide();
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        if (!csrfToken) {
            alert('Error: CSRF token not found. Please refresh the page and try again.');
            // Reset button on error
            currentButton.innerHTML = originalHTML;
            currentButton.disabled = false;
            currentButton.classList.remove('btn-secondary');
            currentButton.classList.add('btn-danger');
            return;
        }
        
        // Make AJAX request
        fetch(`/admin/books/${currentBookId}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Show success message
                showSuccessAlert(data.message);
                
                // Remove the table row with animation
                const tableRow = currentButton.closest('tr');
                if (tableRow) {
                    tableRow.style.transition = 'all 0.5s ease';
                    tableRow.style.backgroundColor = '#f8d7da';
                    tableRow.style.transform = 'scale(0.95)';
                    tableRow.style.opacity = '0.7';
                    
                    setTimeout(() => {
                        tableRow.style.height = '0px';
                        tableRow.style.padding = '0px';
                        tableRow.style.margin = '0px';
                        tableRow.style.overflow = 'hidden';
                        
                        setTimeout(() => {
                            tableRow.remove();
                            
                            // Check if table is empty and show empty state
                            const tbody = document.querySelector('.table tbody');
                            if (tbody && tbody.children.length === 0) {
                                location.reload(); // Reload to show empty state
                            }
                        }, 500);
                    }, 1000);
                }
                
                console.log('Book deleted successfully');
            } else {
                // Show error message
                showErrorAlert(data.message || 'Failed to delete book.');
                
                // Reset button on error
                currentButton.innerHTML = originalHTML;
                currentButton.disabled = false;
                currentButton.classList.remove('btn-secondary');
                currentButton.classList.add('btn-danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showErrorAlert('An error occurred while deleting the book.');
            
            // Reset button on error
            currentButton.innerHTML = originalHTML;
            currentButton.disabled = false;
            currentButton.classList.remove('btn-secondary');
            currentButton.classList.add('btn-danger');
        });
    });
    
    // Helper function to show success alerts
    function showSuccessAlert(message) {
        // Remove existing alerts
        const existingAlerts = document.querySelectorAll('.alert-success');
        existingAlerts.forEach(alert => alert.remove());
        
        // Create new alert
        const alertHtml = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        
        // Insert at top of container
        const container = document.querySelector('.container-fluid .row .col-md-12');
        if (container) {
            const firstCard = container.querySelector('.card');
            if (firstCard) {
                firstCard.insertAdjacentHTML('beforebegin', alertHtml);
            }
        }
        
        // Auto-dismiss after 5 seconds
        setTimeout(() => {
            const newAlert = document.querySelector('.alert-success');
            if (newAlert) {
                newAlert.remove();
            }
        }, 5000);
    }
    
    // Helper function to show error alerts
    function showErrorAlert(message) {
        // Remove existing alerts
        const existingAlerts = document.querySelectorAll('.alert-danger');
        existingAlerts.forEach(alert => alert.remove());
        
        // Create new alert
        const alertHtml = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        
        // Insert at top of container
        const container = document.querySelector('.container-fluid .row .col-md-12');
        if (container) {
            const firstCard = container.querySelector('.card');
            if (firstCard) {
                firstCard.insertAdjacentHTML('beforebegin', alertHtml);
            }
        }
        
        // Auto-dismiss after 5 seconds
        setTimeout(() => {
            const newAlert = document.querySelector('.alert-danger');
            if (newAlert) {
                newAlert.remove();
            }
        }, 5000);
    }
    
    console.log('Book Management event listeners set up successfully');
});
</script>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Initialize Bootstrap components
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips and dropdowns
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
</body>
</html>
