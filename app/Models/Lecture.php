<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'desc', 'sub_stage_id', 'subject_id'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function subStage()
    {
        return $this->belongsTo(SubStage::class);
    }
}