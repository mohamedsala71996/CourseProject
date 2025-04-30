<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'subject_id',
        'lecture_id',
        'question_text',
        'read_text',
        'video',
        'record',
    ];

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function options()
    {
        return $this->hasMany(Option::class);
    }

    public function studentAnswers()
    {
        return $this->hasMany(StudentAnswer::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_answers')
            ->using(StudentAnswer::class)
            ->withPivot(['option_id', 'is_correct']);
    }
}
