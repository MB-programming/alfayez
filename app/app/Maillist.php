<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maillist extends Model
{
    use SoftDeletes;
    protected $table = 'maillist';
    public $timestamps = true;
    protected $fillable = ['name','email'];
}