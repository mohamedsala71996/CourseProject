<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['name', 'desc', 'sub_stage_id'];

    public function subStage()
    {
        return $this->belongsTo(SubStage::class);
    }
    
    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }
}
