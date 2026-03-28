<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use SoftDeletes;
    protected $table = 'sliders';
    public $timestamps = true;
    protected $fillable = ['title','detail','image','link','link_title','lang','status'];
    
}