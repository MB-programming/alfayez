<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    protected $table = 'events';
    public $timestamps = true;
    protected $fillable = ['title','detail','image','day','month','status','lang'];
       
}