
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>User Details - BookStore Admin</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Custom Admin Navbar -->
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
<div class="container-fluid" style="padding-bottom: 50px;">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 fw-bold text-primary">
                    <i class="fas fa-user me-2"></i>User Details: {{ $user->name }}
                </h1>
                <div>
                    <a href="{{ route('admin.users') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to Users
                    </a>
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-tachometer-alt me-1"></i> Dashboard
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

            <div class="row">
                <!-- User Information Card -->
                <div class="col-lg-6 mx-auto">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-id-card me-2"></i>User Information
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <div class="rounded-circle bg-primary bg-opacity-15 p-4 d-inline-flex">
                                    <i class="fas fa-user fa-3x text-primary"></i>
                                </div>
                                <h4 class="mt-3 mb-1">{{ $user->name }}</h4>
                                <p class="text-muted mb-2">User ID: {{ $user->id }}</p>
                                @if($user->role === 'user')
                                    <span class="badge bg-success fs-6">User</span>
                                @else
                                    <span class="badge bg-secondary fs-6">{{ ucfirst($user->role) }}</span>
                                @endif
                            </div>

                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h6 class="text-muted mb-1">Email Address</h6>
                                        <p class="mb-0">{{ $user->email }}</p>
                                    </div>
                                </div>
                                
                                @if($user->phone)
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h6 class="text-muted mb-1">Phone Number</h6>
                                        <p class="mb-0">{{ $user->phone }}</p>
                                    </div>
                                </div>
                                @endif

                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h6 class="text-muted mb-1">Account Status</h6>
                                        @if($user->is_verified)
                                            <span class="badge bg-success">Verified</span>
                                        @else
                                            <span class="badge bg-warning">Unverified</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h6 class="text-muted mb-1">Wallet Balance</h6>
                                        <p class="mb-0">${{ number_format($user->wallet_balance, 2) }}</p>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h6 class="text-muted mb-1">Joined Date</h6>
                                        <p class="mb-0">{{ $user->created_at->format('M d, Y') }} ({{ $user->created_at->diffForHumans() }})</p>
                                    </div>
                                </div>
                                
                                @if($user->address)
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h6 class="text-muted mb-1">Address</h6>
                                        <p class="mb-0">{{ $user->address }}</p>
                                    </div>
                                </div>
                                @endif
                                
                                @if($user->bio)
                                <div class="col-12">
                                    <div class="border rounded p-3">
                                        <h6 class="text-muted mb-1">Bio</h6>
                                        <p class="mb-0">{{ $user->bio }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<style>
body {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Admin Navbar Styling */
.admin-navbar {
    background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 0;
}

.admin-navbar .navbar-brand {
    font-weight: bold;
    font-size: 1.5rem;
    color: #fff !important;
    padding: 15px 20px;
}

.admin-navbar .nav-link {
    color: rgba(255,255,255,0.8) !important;
    padding: 15px 20px !important;
    transition: all 0.3s ease;
    border-right: 1px solid rgba(255,255,255,0.1);
}

.admin-navbar .nav-link:hover {
    background: rgba(255,255,255,0.1);
    color: #fff !important;
}

.admin-navbar .nav-link.active {
    background: rgba(255,255,255,0.2);
    color: #fff !important;
}

.admin-navbar .logout-btn {
    background: #e74c3c !important;
    color: white !important;
    border: none;
    margin: 10px;
    padding: 8px 20px;
    border-radius: 25px;
    transition: all 0.3s ease;
}

.admin-navbar .logout-btn:hover {
    background: #c0392b !important;
    transform: translateY(-1px);
}

.admin-content {
    margin-top: 0;
    padding-top: 20px;
}

/* Card Styling */
.card {
    border-radius: 15px;
    border: none;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.badge {
    padding: 6px 12px;
    font-size: 0.75rem;
    font-weight: 500;
    border-radius: 20px;
}

.border {
    border-color: #e9ecef !important;
}

.border:hover {
    border-color: #007bff !important;
    background-color: #f8f9fa;
}
</style>

<script>
// Include the same JavaScript functionality as in users.blade.php for the action buttons
// This would typically be extracted to a common JS file
</script>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
