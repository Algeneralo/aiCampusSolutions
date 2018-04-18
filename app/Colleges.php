<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Colleges extends Model
{
    protected $table = 'colleges';
    protected $fillable = ['name'];
}
