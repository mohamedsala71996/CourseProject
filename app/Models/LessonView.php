<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LessonView extends Model
{
    protected $fillable = ['student_id', 'lecture_id', 'watched_percent', 'viewed_at'];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }
}
