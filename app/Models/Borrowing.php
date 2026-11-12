<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrower_id', 'book_id', 'borrow_date', 'due_date',
        'returned_at', 'status', 'fine',
    ];

    protected $casts = [
        'borrow_date' => 'date',
        'due_date'    => 'date',
        'returned_at' => 'date',
        'fine'        => 'decimal:2',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function borrower()
    {
        return $this->belongsTo(Borrower::class);
    }

    public function extensions()
    {
        return $this->hasMany(Extension::class);
    }
}
