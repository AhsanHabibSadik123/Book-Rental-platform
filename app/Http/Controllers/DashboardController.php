<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show the dashboard - redirect to role-specific dashboard
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'user':
                return $this->userDashboard($request);
            default:
                return redirect()->route('login');
        }
    }

    /**
     * User Dashboard - Show unified dashboard for lending and borrowing
     */
    public function userDashboard(Request $request)
    {
        $user = Auth::user();
        
        // Get user statistics from database
        $stats = $this->getUserStats($user);
        
        // Get recent books for browsing (more books for main display)
        $recentBooks = Book::where('status', 'available')
                          ->where('lender_id', '!=', $user->id)
                          ->with('lender')
                          ->latest()
                          ->take(12)
                          ->get();
                          
        // Get user's books (for lenders)
        $myBooks = Book::where('lender_id', $user->id)
                      ->with('lender')
                      ->latest()
                      ->take(5)
                      ->get();
                      
        // Get user's rentals (as borrower)
        $myRentals = Rental::where('borrower_id', $user->id)
                          ->with(['book', 'book.lender'])
                          ->latest()
                          ->take(5)
                          ->get();
        
        return view('user.userDashboard', compact('stats', 'recentBooks', 'myBooks', 'myRentals'));
    }
    
    /**
     * Get comprehensive user statistics from database
     */
    private function getUserStats($user)
    {
        // Books statistics (as lender)
        $myBooksCount = Book::where('lender_id', $user->id)->count();
        $myAvailableBooks = Book::where('lender_id', $user->id)->where('status', 'available')->count();
        $myRentedBooks = Book::where('lender_id', $user->id)->where('status', 'rented')->count();
        
        // Rental statistics (as borrower)
        $myRentals = Rental::where('borrower_id', $user->id)->count();
        $activeRentals = Rental::where('borrower_id', $user->id)
                              ->where('status', 'active')
                              ->count();
        
        // Due soon rentals (due within next 7 days)
        $dueSoon = Rental::where('borrower_id', $user->id)
                        ->where('status', 'active')
                        ->where('rental_end_date', '<=', Carbon::now()->addDays(7))
                        ->where('rental_end_date', '>=', Carbon::now())
                        ->count();
        
        // Total spent on rentals
        $totalSpent = Rental::where('borrower_id', $user->id)
                           ->where('status', 'completed')
                           ->sum('total_amount');
        
        // Overdue rentals
        $overdueRentals = Rental::where('borrower_id', $user->id)
                               ->where('status', 'active')
                               ->where('rental_end_date', '<', Carbon::now())
                               ->count();
        
        // Total available books in system
        $totalAvailableBooks = Book::where('status', 'available')->count();
        
        // Earnings from lending (as lender)
        $totalEarnings = Rental::whereHas('book', function($query) use ($user) {
                               $query->where('lender_id', $user->id);
                           })
                           ->where('status', 'completed')
                           ->sum('total_amount');
        
        // Books currently rented out by this user
        $booksRentedOut = Rental::whereHas('book', function($query) use ($user) {
                                $query->where('lender_id', $user->id);
                            })
                            ->where('status', 'active')
                            ->count();
        
        return [
            // Borrower stats
            'my_rentals' => $myRentals,
            'active_rentals' => $activeRentals,
            'due_soon' => $dueSoon,
            'total_spent' => $totalSpent,
            'overdue_rentals' => $overdueRentals,
            
            // Lender stats
            'my_books' => $myBooksCount,
            'my_available_books' => $myAvailableBooks,
            'my_rented_books' => $myRentedBooks,
            'total_earnings' => $totalEarnings,
            'books_rented_out' => $booksRentedOut,
            
            // General stats
            'total_available_books' => $totalAvailableBooks,
        ];
    }
}
