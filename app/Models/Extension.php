<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    use HasFactory;

    protected $fillable = [
        'borrowing_id',
        'requested_days',
        'additional_days',
        'status',        // menunggu, disetujui, ditolak
        'approved_by',
    ];

    // 1 perpanjangan milik 1 peminjaman
    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class);
    }

    // Petugas/admin yang menyetujui/menolak
    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
