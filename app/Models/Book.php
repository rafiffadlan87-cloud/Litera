<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'title', 'author', 'year', 'cover',
        'isbn', 'publisher', 'stock', 'rack',
        'rating', 'rating_count', 'description',
    ];

    protected $casts = [
        'rating' => 'float',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }

    public function queues()
    {
        return $this->hasMany(BookQueue::class);
    }

    public function isAvailable()
    {
        return $this->stock > 0;
    }

    public function isBorrowedBy($userId)
    {
        return $this->borrowings()
            ->where('borrower_id', $userId)
            ->whereNull('returned_at')
            ->exists();
    }
    public function getTotalCopiesAttribute()
{
    $borrowed = $this->borrowings()->whereNull('returned_at')->count();
    return $this->stock + $borrowed;
}

public function getCoverUrlAttribute()
{
    if (!$this->cover) return 'https://via.placeholder.com/200x280?text=No+Cover';
    if (str_starts_with($this->cover, 'http')) return $this->cover;
    return asset('storage/' . $this->cover);
}
}