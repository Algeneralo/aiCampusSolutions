<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questions extends Model
{
    protected $table = "questions";
    protected $fillable = ['parent_id', 'subject', 'info', 'link1', 'link2', 'link3'];
}
