<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Albummedia extends Model
{
    use SoftDeletes;
    protected $table = 'album_media';
    public $timestamps = true;
    protected $fillable = ['title','detail','path','type','album_id','category_id','infile'];
    
}