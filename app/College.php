<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class College extends Model
{
    use SoftDeletes;
    
    public $timestamps = false;

    protected $fillable = ['name'];

    public function courses()
    {
        return $this->hasMany('App\Course');
    }

    public function counselors()
    {
        return $this->hasMany('App\Counselor');
    }
    //
}
