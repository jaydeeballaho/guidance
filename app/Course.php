<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    public $timestamps = false;

    protected $fillable = ['name', 'college_id'];

    public function college()
    {
        return $this->belongsTo('App\College');
    }

    public function students()
    {
        return $this->hasMany('App\Student');
    }
}
