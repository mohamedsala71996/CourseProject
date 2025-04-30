<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    protected $fillable = ['name', 'desc'];

    public function subStages()
    {
        return $this->hasMany(SubStage::class);
    }

}
