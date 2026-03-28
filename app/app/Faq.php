<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use SoftDeletes;
    protected $table = 'faqs';
    public $timestamps = true;
    protected $fillable = ['question','answer','lang'];
}