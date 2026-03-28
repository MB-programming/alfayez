<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;
    protected $table = 'news';
    public $timestamps = true;
    protected $fillable = ['title','detail','image','category_id','date','status','lang'];
    
    public function categories()
    {
        return $this->belongsTo('\App\Category','category_id','id');
    }

}