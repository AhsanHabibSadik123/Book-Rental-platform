@extends('layouts.app')

@section('title', $book->title . ' - BookStore')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Back Button -->
        <div class="mb-6">
            <a href="{{ url()->previous() }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Back
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Book Image -->
            <div class="space-y-4">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    @if($book->image_path)
                        <img src="{{ asset('storage/' . $book->image_path) }}" alt="{{ $book->title }}" class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                            <svg class="h-24 w-24 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Book Details -->
            <div class="space-y-6">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <!-- Title and Author -->
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $book->title }}</h1>
                    <p class="text-xl text-gray-600 mb-4">by {{ $book->author }}</p>
                    
                    <!-- Status and Condition Badges -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        <span class="px-3 py-1 text-sm font-medium bg-gray-100 text-gray-800 rounded-full">{{ $book->genre }}</span>
                        <span class="px-3 py-1 text-sm font-medium rounded-full
                            @if($book->condition === 'excellent') bg-green-100 text-green-800
                            @elseif($book->condition === 'good') bg-blue-100 text-blue-800
                            @elseif($book->condition === 'fair') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($book->condition) }} Condition
                        </span>
                        <span class="px-3 py-1 text-sm font-medium rounded-full
                            @if($book->status === 'available') bg-green-100 text-green-800
                            @elseif($book->status === 'rented') bg-red-100 text-red-800
                            @elseif($book->status === 'maintenance') bg-yellow-100 text-yellow-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst($book->status) }}
                        </span>
                    </div>

                    <!-- Description -->
                    @if($book->description)
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Description</h3>
                            <p class="text-gray-600 leading-relaxed">{{ $book->description }}</p>
                        </div>
                    @endif

                    <!-- Book Details -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        @if($book->isbn)
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">ISBN</h4>
                                <p class="text-lg text-gray-900">{{ $book->isbn }}</p>
                            </div>
                        @endif
                        <div>
                            <h4 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Added</h4>
                            <p class="text-lg text-gray-900">{{ $book->created_at->format('M j, Y') }}</p>
                        </div>
                    </div>

                    <!-- Lender Information -->
                    <div class="bg-gray-50 rounded-lg p-4 mb-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">
                            <svg class="inline h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Lender Information
                        </h3>
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                                <span class="text-sm font-medium text-gray-600">{{ substr($book->lender->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <p class="font-medium text-gray-900">{{ $book->lender->name }}</p>
                                <p class="text-sm text-gray-500">Member since {{ $book->lender->created_at->format('M Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                        <div class="grid grid-cols-2 gap-4 text-center">
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-2">Rental Price</h4>
                                <p class="text-3xl font-bold text-green-600">
                                    ₹{{ number_format($book->rental_price_per_day, 2) }}
                                    <span class="text-sm text-gray-500 font-normal">/day</span>
                                </p>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-gray-500 mb-2">Security Deposit</h4>
                                <p class="text-3xl font-bold text-yellow-600">₹{{ number_format($book->security_deposit, 2) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    @if($book->status === 'available')
                        @if(Auth::user()->role === 'borrower' || Auth::user()->role === 'user')
                            <div class="space-y-3">
                                <button onclick="openRentModal()" class="w-full bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition-colors duration-200 font-medium">
                                    <svg class="inline h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m-2.4 8H7m6 0a2 2 0 100 4 2 2 0 000-4zm6 0a2 2 0 100 4 2 2 0 000-4z"></path>
                                    </svg>
                                    Request This Book
                                </button>
                                <button class="w-full border border-gray-300 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                                    <svg class="inline h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                    Add to Wishlist
                                </button>
                            </div>
                        @else
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <div class="flex">
                                    <svg class="h-5 w-5 text-yellow-400 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    <div>
                                        <p class="text-sm text-yellow-800">
                                            @if(Auth::user()->role === 'lender')
                                                You are a lender. Switch to borrower mode to rent books.
                                            @elseif(Auth::user()->role === 'admin')
                                                Admins cannot rent books. This feature is for borrowers only.
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex">
                                <svg class="h-5 w-5 text-red-400 mr-3 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-sm text-red-800">This book is currently not available for rent.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if((Auth::user()->role === 'borrower' || Auth::user()->role === 'user') && $book->status === 'available')
<!-- Rent Request Modal -->
<div id="rentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">Request Book Rental</h3>
                    <button onclick="closeRentModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <div class="mb-4">
                    <h4 class="font-medium text-gray-900 mb-2">{{ $book->title }}</h4>
                    <p class="text-sm text-gray-600 mb-4">Are you sure you want to request this book for rental? The lender will be notified of your request.</p>
                    
                    <div class="bg-gray-50 rounded-lg p-3 mb-4">
                        <div class="flex justify-between text-sm">
                            <span>Daily Rate:</span>
                            <span class="font-medium">₹{{ number_format($book->rental_price_per_day, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>Security Deposit:</span>
                            <span class="font-medium">₹{{ number_format($book->security_deposit, 2) }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="flex space-x-3">
                    <button onclick="closeRentModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        Cancel
                    </button>
                    <button onclick="submitRentalRequest()" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                        Send Request
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function openRentModal() {
    document.getElementById('rentModal').classList.remove('hidden');
}

function closeRentModal() {
    document.getElementById('rentModal').classList.add('hidden');
}

function submitRentalRequest() {
    // Rental functionality has been disabled
    alert('Rental functionality is currently unavailable.');
}
</script>
@endif
@endsection
                    </div>

                    <!-- Book Details -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h6 class="fw-bold">ISBN</h6>
                            <p class="text-muted">{{ $book->isbn ?? 'Not specified' }}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold">Publication Year</h6>
                            <p class="text-muted">{{ $book->publication_year ?? 'Not specified' }}</p>
                        </div>
                    </div>

                    <!-- Lender Information -->
                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body">
                            <h6 class="fw-bold mb-2">
                                <i class="fas fa-user me-2"></i>Lender Information
                            </h6>
                            <p class="mb-1"><strong>Name:</strong> {{ $book->lender->name }}</p>
                            <p class="mb-0"><strong>Member since:</strong> {{ $book->lender->created_at->format('M Y') }}</p>
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div class="card border-primary mb-4">
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6">
                                    <h6 class="text-muted mb-1">Rental Price</h6>
                                    <h3 class="text-success fw-bold mb-0">
                                        ${{ number_format($book->rental_price_per_day, 2) }}
                                        <small class="text-muted fs-6">/day</small>
                                    </h3>
                                </div>
                                <div class="col-6">
                                    <h6 class="text-muted mb-1">Security Deposit</h6>
                                    <h3 class="text-warning fw-bold mb-0">
                                        ${{ number_format($book->security_deposit, 2) }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    @if($book->status === 'available')
                        @if(Auth::user()->role === 'borrower')
                            <div class="d-grid gap-2 d-md-flex">
                                <button class="btn btn-success btn-lg flex-fill" data-bs-toggle="modal" data-bs-target="#rentModal">
                                    <i class="fas fa-shopping-cart me-2"></i>Rent This Book
                                </button>
                                <button class="btn btn-outline-primary btn-lg">
                                    <i class="fas fa-heart me-2"></i>Add to Wishlist
                                </button>
                            </div>
                        @else
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Only borrowers can rent books. 
                                @if(Auth::user()->role === 'lender')
                                    You are a lender.
                                @elseif(Auth::user()->role === 'admin')
                                    You are an admin.
                                @endif
                            </div>
                        @endif
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            This book is currently not available for rent.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Rent Modal -->
@if(Auth::user()->role === 'borrower' && $book->status === 'available')
<div class="modal fade" id="rentModal" tabindex="-1" aria-labelledby="rentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="rentModalLabel">Rent "{{ $book->title }}"</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="rental_days" class="form-label">Number of Days</label>
                        <input type="number" 
                               class="form-control" 
                               id="rental_days" 
                               name="rental_days" 
                               data-daily-rate="{{ $book->rental_price_per_day }}"
                               data-security-deposit="{{ $book->security_deposit }}"
                               min="1" 
                               max="30" 
                               value="7" 
                               required>
                        <div class="form-text">Minimum 1 day, maximum 30 days</div>
                    </div>
                    
                    <div class="card bg-light">
                        <div class="card-body">
                            <h6 class="card-title">Rental Summary</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Daily Rate:</span>
                                <span>${{ number_format($book->rental_price_per_day, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Days:</span>
                                <span id="days-display">7</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal:</span>
                                <span id="subtotal">${{ number_format($book->rental_price_per_day * 7, 2) }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Security Deposit:</span>
                                <span>${{ number_format($book->security_deposit, 2) }}</span>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-between fw-bold">
                                <span>Total:</span>
                                <span id="total">${{ number_format(($book->rental_price_per_day * 7) + $book->security_deposit, 2) }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            The security deposit will be refunded when you return the book in good condition.
                        </small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check me-1"></i>Confirm Rental
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const rentalDaysInput = document.getElementById('rental_days');
    const daysDisplay = document.getElementById('days-display');
    const subtotalElement = document.getElementById('subtotal');
    const totalElement = document.getElementById('total');
    
    // Get values from data attributes to avoid Blade syntax in JS
    const dailyRate = parseFloat(rentalDaysInput?.dataset.dailyRate || '0');
    const securityDeposit = parseFloat(rentalDaysInput?.dataset.securityDeposit || '0');
    
    if (rentalDaysInput) {
        rentalDaysInput.addEventListener('input', function() {
            const days = parseInt(this.value) || 1;
            const subtotal = days * dailyRate;
            const total = subtotal + securityDeposit;
            
            daysDisplay.textContent = days;
            subtotalElement.textContent = '$' + subtotal.toFixed(2);
            totalElement.textContent = '$' + total.toFixed(2);
        });
    }
});
</script>
@endsection
@endsection
