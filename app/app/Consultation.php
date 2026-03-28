<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consultation extends Model
{
    use SoftDeletes;
    protected $table = 'consultations';
    public $timestamps = true;
    protected $fillable = ['name','email','mobile'];
    
}