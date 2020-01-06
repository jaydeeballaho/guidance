<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Counselor extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'college_id',
        'lastName',
        'firstName',
        'middleName',
        'extName',
        'dateWorking'
    ];

    protected $appends = [
        'full_name'
    ];

    public function getFullNameAttribute()
    {
        return "{$this->attributes['lastName']}, {$this->attributes['firstName']} {$this->attributes['extName']} {$this->attributes['middleName']}";
    }
    
    public function college()
    {
        return $this->belongsTo('App\College');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
