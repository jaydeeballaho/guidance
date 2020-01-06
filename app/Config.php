<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    public $timestamps = false;
    protected $primaryKey = 'config_key';
    public $incrementing = false;

    protected $fillable = [
        'value', 'config_key'
    ];
}
