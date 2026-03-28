<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use SoftDeletes;
    protected $table = 'menus';
    public $timestamps = true;
    protected $fillable = ['title','link','parent_id','place','order','lang'];
    
}