@extends('layouts.app')

@section('title', 'Browse Books')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Browse Available Books</h1>
            <p class="text-gray-600">Discover and rent books from our community</p>
        </div>

        <!-- Search and Filters -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
            <form action="{{ route('books.browse') }}" method="GET" class="space-y-4">
                <div class="flex flex-col md:flex-row gap-4">
                    <!-- Search Input -->
                    <div class="flex-1">
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search Books</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input 
                                type="text" 
                                name="search" 
                                id="search"
                                value="{{ $search }}"
                                placeholder="Search by title, author, genre..." 
                                class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                        </div>
                    </div>

                    <!-- Category Filter -->
                    <div class="md:w-64">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                        <select 
                            name="category" 
                            id="category"
                            class="block w-full py-2 px-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
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

                    <!-- Search Button -->
                    <div class="flex items-end">
                        <button 
                            type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors duration-200 flex items-center gap-2"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search
                        </button>
                    </div>
                </div>

                @if($search || request('category'))
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="text-sm text-gray-600">Filters: </span>
                        @if($search)
                            <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">Search: "{{ $search }}"</span>
                        @endif
                        @if(request('category'))
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">Category: {{ ucfirst(str_replace('-', ' ', request('category'))) }}</span>
                        @endif
                        <a href="{{ route('books.browse') }}" class="text-sm text-gray-500 hover:text-gray-700 underline">Clear all filters</a>
                    </div>
                @endif
            </form>
        </div>

        <!-- Results Summary -->
        <div class="mb-6">
            <p class="text-gray-600">
                @if($books->total() > 0)
                    Showing {{ $books->firstItem() }} to {{ $books->lastItem() }} of {{ $books->total() }} books
                    @if($search || request('category'))
                        @if($search && request('category'))
                            matching "{{ $search }}" in {{ ucfirst(str_replace('-', ' ', request('category'))) }} category
                        @elseif($search)
                            matching "{{ $search }}"
                        @elseif(request('category'))
                            in {{ ucfirst(str_replace('-', ' ', request('category'))) }} category
                        @endif
                    @endif
                @else
                    @if($search || request('category'))
                        @if($search && request('category'))
                            No books found matching "{{ $search }}" in {{ ucfirst(str_replace('-', ' ', request('category'))) }} category
                        @elseif($search)
                            No books found matching "{{ $search }}"
                        @elseif(request('category'))
                            No books found in {{ ucfirst(str_replace('-', ' ', request('category'))) }} category
                        @endif
                    @else
                        No books available for rental at the moment
                    @endif
                @endif
            </p>
        </div>

        @if($books->count() > 0)
            <!-- Books Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                @foreach($books as $book)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-200">
                        <!-- Book Image -->
                        <div class="aspect-w-3 aspect-h-4 bg-gray-100">
                            @if($book->image_path)
                                <img src="{{ asset('storage/' . $book->image_path) }}" alt="{{ $book->title }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                    <svg class="h-16 w-16 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <!-- Book Details -->
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">{{ $book->title }}</h3>
                            <p class="text-sm text-gray-600 mb-2">by {{ $book->author }}</p>
                            
                            <!-- Genre Badge -->
                            <span class="inline-block px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full mb-3">
                                {{ $book->genre }}
                            </span>

                            <!-- Condition -->
                            <div class="flex items-center mb-2">
                                <span class="text-sm text-gray-500">Condition: </span>
                                <span class="text-sm font-medium ml-1 
                                    @if($book->condition === 'excellent') text-green-600
                                    @elseif($book->condition === 'good') text-blue-600
                                    @elseif($book->condition === 'fair') text-yellow-600
                                    @else text-red-600
                                    @endif">
                                    {{ ucfirst($book->condition) }}
                                </span>
                            </div>

                            <!-- Pricing -->
                            <div class="mb-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-bold text-green-600">₹{{ number_format($book->rental_price_per_day, 2) }}/day</span>
                                </div>
                                <p class="text-xs text-gray-500">Security deposit: ₹{{ number_format($book->security_deposit, 2) }}</p>
                            </div>

                            <!-- Lender Info -->
                            <div class="flex items-center mb-4">
                                <div class="w-6 h-6 bg-gray-300 rounded-full flex items-center justify-center mr-2">
                                    <span class="text-xs font-medium text-gray-600">{{ substr($book->lender->name, 0, 1) }}</span>
                                </div>
                                <span class="text-sm text-gray-600">{{ $book->lender->name }}</span>
                            </div>

                            <!-- Action Buttons -->
                            <div class="space-y-2">
                                <a href="{{ route('books.show', $book) }}" 
                                   class="block w-full text-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                                    View Details
                                </a>
                                
                                @if(Auth::user()->role === 'user')
                                    <button data-book-id="{{ $book->id }}" 
                                            class="rent-book-btn block w-full text-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                                        Request Rental
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $books->appends(['search' => $search])->links() }}
            </div>
        @else
            <!-- No Books Found -->
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                
                @if($search)
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No books found</h3>
                    <p class="text-gray-500 mb-4">Try adjusting your search terms or browse all available books.</p>
                    <a href="{{ route('books.browse') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        View All Books
                    </a>
                @else
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No books available</h3>
                    <p class="text-gray-500 mb-4">Check back later for new books or contact lenders directly.</p>
                @endif
            </div>
        @endif
    </div>
</div>

@if(Auth::user()->role === 'user')
<!-- Rent Book Modal -->
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
                
                <p class="text-gray-600 mb-6">Are you sure you want to request this book for rental? The lender will be notified of your request.</p>
                
                <div class="flex space-x-3">
                    <button onclick="closeRentModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200">
                        Cancel
                    </button>
                    <button onclick="confirmRental()" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-200">
                        Send Request
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let selectedBookId = null;

// Use event delegation for better performance and cleaner code
document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('rent-book-btn')) {
            e.preventDefault();
            const bookId = e.target.getAttribute('data-book-id');
            rentBook(bookId);
        }
    });
});

function rentBook(bookId) {
    selectedBookId = bookId;
    document.getElementById('rentModal').classList.remove('hidden');
}

function closeRentModal() {
    document.getElementById('rentModal').classList.add('hidden');
    selectedBookId = null;
}

function confirmRental() {
    // Rental functionality has been disabled
    alert('Rental functionality is currently unavailable.');
    closeRentModal();
}
</script>
@endif
@endsection
