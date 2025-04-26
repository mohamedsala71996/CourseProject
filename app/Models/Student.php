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

    public function subStage()
    {
        return $this->belongsTo(SubStage::class)->with('stage');
    }

    public function answers()
    {
        return $this->hasMany(StudentAnswer::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function lectures()
    {
        return $this->belongsToMany(Lecture::class, 'grades')
            ->using(Grade::class)
            ->withPivot(['total_score', 'max_score', 'percentage', 'status']);
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
}
