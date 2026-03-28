<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contactus extends Model
{
    use SoftDeletes;
    protected $table = 'contact_us';
    public $timestamps = true;
    protected $fillable = ['name','email','subject','message','replay'];
    
}