<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookController extends Controller
{
    /**
     * Display a listing of the user's books.
     */
    public function index()
    {
        $user = Auth::user();
        $search = request('search');
        $category = request('category');

        $query = Book::query();
        if ($user && $user->role === 'admin') {
            // Admin sees all books
        } else {
            $query->where('lender_id', Auth::id());
        }

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('author', 'LIKE', "%{$search}%")
                  ->orWhere('genre', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }
        if ($category) {
            $query->where('genre', $category);
        }

        $books = $query->latest()->paginate(12)->appends(['search' => $search, 'category' => $category]);

        return view('user.myBooks', compact('books', 'search', 'category'));
    }

    /**
     * Show the form for creating a new book.
     */
    public function create()
    {
        // Only admin can add books (on behalf of a user/lender)
        if (!Auth::user() || Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Only admin can add books.');
        }

        // Admin selects the book owner (lender)
        $users = User::orderBy('name')->get(['id', 'name']);
        return view('books.create', compact('users'));
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request)
    {
        // Only admin can add books
        if (!Auth::user() || Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'Only admin can add books.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:20|unique:books,isbn',
            'genre' => 'required|string|max:100',
            'description' => 'nullable|string',
            'condition' => 'required|in:new,good,fair,poor',
            'rental_price_per_day' => 'required|numeric|min:0.01|max:999.99',
            'security_deposit' => 'required|numeric|min:0|max:9999.99',
            'lender_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('books', 'public');
            $validated['image_path'] = $imagePath;
        }

        // Set default status
        $validated['status'] = 'available';

        $book = Book::create($validated);

        return redirect()->route('books.index')->with('success', 'Book added successfully!');
    }

    /**
     * Display the specified book.
     */
    public function show(Book $book)
    {
        return view('user.show', compact('book'));
    }

    /**
     * Show the form for editing the specified book.
     */
    public function edit(Book $book)
    {
        // Only admin can edit books
        if (!Auth::user() || Auth::user()->role !== 'admin') {
            return redirect()->route('books.index')->with('error', 'Only admin can edit books.');
        }

        $users = User::orderBy('name')->get(['id', 'name']);
        return view('books.edit', compact('book', 'users'));
    }

    /**
     * Update the specified book in storage.
     */
    public function update(Request $request, Book $book)
    {
        // Only admin can update books
        if (!Auth::user() || Auth::user()->role !== 'admin') {
            return redirect()->route('books.index')->with('error', 'Only admin can update books.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'nullable|string|max:20|unique:books,isbn,' . $book->id,
            'genre' => 'required|string|max:100',
            'description' => 'nullable|string',
            'condition' => 'required|in:new,good,fair,poor',
            'rental_price_per_day' => 'required|numeric|min:0.01|max:999.99',
            'security_deposit' => 'required|numeric|min:0|max:9999.99',
            'status' => 'required|in:available,rented,maintenance,unavailable',
            'lender_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($book->image_path) {
                Storage::disk('public')->delete($book->image_path);
            }
            $imagePath = $request->file('image')->store('books', 'public');
            $validated['image_path'] = $imagePath;
        }

        $book->update($validated);

        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy(Book $book)
    {
        // Only admin can delete books
        if (!Auth::user() || Auth::user()->role !== 'admin') {
            return redirect()->route('books.index')->with('error', 'Only admin can delete books.');
        }

        // Check if book is currently rented
        if ($book->status === 'rented') {
            return redirect()->route('books.index')->with('error', 'Cannot delete a book that is currently rented.');
        }

        // Delete image if exists
        if ($book->image_path) {
            Storage::disk('public')->delete($book->image_path);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }

    /**
     * Display available books for browsing (for borrowers)
     */
    public function browse(Request $request)
    {
        $search = $request->get('search');
        $category = $request->get('category');

        // Validate inputs
        $request->validate([
            'search' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:100'
        ]);

        $query = Book::where('status', 'available')->with('lender');

        // Add search functionality
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('author', 'LIKE', "%{$search}%")
                    ->orWhere('genre', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        // Add category filter
        if ($category) {
            $query->where('genre', $category);
        }

        $books = $query->latest()->paginate(12)->appends(['search' => $search, 'category' => $category]);

        return view('user.browseBooks', compact('books', 'search', 'category'));
    }

    /**
     * Borrower home page - same as browse but for home route
     */
    public function home(Request $request)
    {
        // Show available books to any authenticated user
        $search = $request->get('search');

        $query = Book::where('status', 'available')
            ->with('lender');

        // Add search functionality
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('author', 'LIKE', "%{$search}%")
                    ->orWhere('genre', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }

        $books = $query->latest()->paginate(12);
        $totalBooks = Book::where('status', 'available')->count();

        return view('user.home', compact('books', 'search', 'totalBooks'));
    }
    /**
     * Show the rent form for a book (user action)
     */
    public function showRentForm(Book $book)
    {
        if ($book->status !== 'available') {
            return redirect()->route('books.browse')->with('error', 'Book is not available for rent.');
        }
        return view('books.rent', compact('book'));
    }

    /**
     * Process the rent request (wallet check, confirmation, rental creation)
     */
    public function processRent(Request $request, Book $book)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        // Fetch as Eloquent model to avoid type issues with Authenticatable interface
        $user = User::findOrFail(Auth::id());
        if ($user->role !== 'user') {
            return redirect()->route('books.browse')->with('error', 'Only users can rent books.');
        }
        if ($book->status !== 'available') {
            return redirect()->route('books.browse')->with('error', 'Book is not available for rent.');
        }

        $validated = $request->validate([
            'days' => 'required|integer|min:1|max:30',
        ]);
    $days = (int) $validated['days'];
    $dailyRate = (float) $book->rental_price_per_day;
    $deposit = (float) $book->security_deposit;
    $totalCost = ($dailyRate * $days) + $deposit;

        // Check wallet balance
        if ($user->wallet < $totalCost) {
            return redirect()->route('books.rent', $book->id)
                ->with('error', 'Insufficient wallet balance. Please add funds to your wallet.');
        }

        // Show confirmation view before finalizing rental
        if (!$request->has('confirm')) {
            return view('books.rent_confirm', compact('book', 'days', 'totalCost'));
        }

        // Prevent renting own book
        if ($book->lender_id === $user->id) {
            return redirect()->route('books.browse')->with('error', 'You cannot rent your own book.');
        }

        // Deduct from wallet and create rental atomically
    DB::transaction(function () use ($user, $book, $days, $dailyRate, $deposit, $totalCost) {
            $user->wallet = (float)$user->wallet - (float)$totalCost;
            $user->save();

            $book->status = 'rented';
            $book->save();

            \App\Models\Rental::create([
                'book_id' => $book->id,
                'borrower_id' => $user->id,
                'lender_id' => $book->lender_id,
                'rental_start_date' => Carbon::today(),
                'rental_end_date' => Carbon::today()->addDays((int) $days),
                'daily_rate' => $dailyRate,
                'total_amount' => $dailyRate * $days + $deposit,
                'security_deposit' => $deposit,
                'status' => 'active',
            ]);
        });

        return redirect()->route('books.browse')->with('success', 'Book rented successfully!');
    }
}
