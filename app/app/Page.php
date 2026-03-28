<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;
    protected $table = 'pages';
    public $timestamps = true;
    protected $fillable = ['title','detail','image','job_title','type','auther','order','lang','vision','value','message'];   
}