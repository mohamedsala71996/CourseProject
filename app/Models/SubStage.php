<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubStage extends Model
{
    protected $fillable = ['name', 'desc', 'stage_id'];

    public function stage()
    {
        return $this->belongsTo(Stage::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
