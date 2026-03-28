<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use SoftDeletes;
    protected $table = 'albums';
    public $timestamps = true;
    protected $fillable = ['title','detail','image','type','lang'];
    
}