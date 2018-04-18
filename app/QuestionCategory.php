<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionCategory extends Model
{
    protected $table = "question_category";
    protected $fillable = ['question', 'college_id'];

    public function college()
    {
        return $this->belongsTo('\App\Colleges');
    }
}
