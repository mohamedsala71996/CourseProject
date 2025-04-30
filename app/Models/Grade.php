<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'student_id',
        'lecture_id',
        'total_score',
        'max_score',
        'percentage',
        'status'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }
}