<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jobapp extends Model
{
    use SoftDeletes;
    protected $table = 'jobs_app';
    public $timestamps = true;
    protected $fillable = ['job_id','name','email','mobile','cv_path'];
    
}