<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'isbn',
        'description',
        'genre',
        'condition',
        'image_path',
        'rental_price_per_day',
        'security_deposit',
        'rental_duration_max_days',
        'is_available',
        'lender_id',
        'status',
    ];

    protected $casts = [
        'rental_price_per_day' => 'decimal:2',
        'security_deposit' => 'decimal:2',
    ];

    /**
     * Book belongs to a lender (user who owns the book)
     */
    public function lender()
    {
        return $this->belongsTo(User::class, 'lender_id');
    }

    /**
     * Book can have many rentals
     */
    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    /**
     * Search scope for books
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhere('author', 'LIKE', "%{$search}%")
                  ->orWhere('genre', 'LIKE', "%{$search}%")
                  ->orWhere('description', 'LIKE', "%{$search}%");
            });
        }
        return $query;
    }

    /**
     * Category scope for books
     */
    public function scopeByCategory($query, $category)
    {
        if ($category) {
            return $query->where('genre', 'LIKE', "%{$category}%");
        }
        return $query;
    }

    /**
     * Available books scope
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    /**
     * Exclude own books scope
     */
    public function scopeExcludeOwn($query, $userId)
    {
        return $query->where('lender_id', '!=', $userId);
    }

    /**
     * Get current active rental
     */
    public function currentRental()
    {
        return $this->hasOne(Rental::class)->where('status', 'active');
    }

    /**
     * Check if book is currently rented
     */
    public function isRented(): bool
    {
        return $this->currentRental()->exists();
    }
}
