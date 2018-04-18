<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    protected $table = 'students';
    protected $fillable=['college_id','name','email','department','ext'];
    public $timestamps=false;
}
