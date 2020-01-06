<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'lastName',
        'firstName',
        'middleName',
        'dateOfBirth',
        'gender',
        'religion',
        'cityAddress',
        'provincialAddress',
        'course_id',
        'placeOfBirth',
        'civilStatus',
        'languages',
        'tellCellNo',
        'ethnicity',
        'infoVerification',
    ];

    protected $appends = [
        'college'
    ];

    public function getFullNameAttribute()
    {
        return "{$this->attributes['lastName']}, {$this->attributes['firstName']} {$this->attributes['middleName']}";
    }

    public function course()
    {
        return $this->belongsTo('App\Course');
    }

    public function getCollegeAttribute()
    {
        return $this->course->college_id;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
