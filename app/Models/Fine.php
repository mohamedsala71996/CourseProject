<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'amount',
        'reason',
        'status',
        'paid_at',
    ];

    // Relationship with Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}