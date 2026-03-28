<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    use SoftDeletes;
    protected $table = 'jobs';
    public $timestamps = true;
    protected $fillable = ['title','detail','status','lang'];
   
}