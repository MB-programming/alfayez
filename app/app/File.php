<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class File extends Model
{
    use SoftDeletes;
    protected $table = 'files';
    public $timestamps = true;
    protected $fillable = ['path'];

    protected $sroteRules = array(
        'image' => 'required|mimes:jpeg,bmp,png,svg,gif,wmv,asf,video/x-ms-wmv,audio/x-ms-wmv,video/mp4, mp4,wav,doc,docx,xls,xlsx,zip,rar',  
    );
    
}