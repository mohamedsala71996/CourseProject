<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAnswer extends Model
{
    protected $fillable = [
        'student_id',
        'lecture_id',
        'question_id',
        'option_id',
        'is_correct',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}
