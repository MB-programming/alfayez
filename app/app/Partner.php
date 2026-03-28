<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use SoftDeletes;
    protected $table = 'partners';
    public $timestamps = true;
    protected $fillable = ['title','detail','image','bg_image','link','lang'];
    
}