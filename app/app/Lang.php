<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lang extends Model
{
    use SoftDeletes;
    protected $table = 'lang';
    public $timestamps = true;
    protected $fillable = ['key','value','lang'];
    
}