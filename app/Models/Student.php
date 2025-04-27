<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'id_number',
        'email',
        'phone',
        'password',
        'sub_stage_id',
        'is_blocked',
        'image',
        'gender',
        'date_of_birth',
    ];

    protected $hidden = ['password'];

    public function subStage()
    {
        return $this->belongsTo(SubStage::class);
    }

    public function getGenderLabelAttribute()
    {
        return $this->gender === 'male' ? 'ذكر' : ($this->gender === 'female' ? 'أنثى' : 'غير محدد');
    }

    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('default-avatar.png');
    }

    public function viewedLectures()
    {
        return $this->belongsToMany(Lecture::class, 'lesson_views', 'student_id', 'lecture_id')
            ->withPivot('watched_percent', 'viewed_at')
            ->withTimestamps();
    }

    public function studentAnswers()
    {
        return $this->hasMany(\App\Models\StudentAnswer::class);
    }

    public function fines()
    {
        return $this->hasMany(\App\Models\Fine::class);
    }
}
