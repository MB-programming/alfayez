<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Maillistmessage extends Model
{
    use SoftDeletes;
    protected $table = 'maillist_messages';
    public $timestamps = true;
    protected $fillable = ['subject','message','receivers'];
    
}