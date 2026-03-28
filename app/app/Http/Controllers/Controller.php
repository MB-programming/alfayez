<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
    	if(\Request::segment(2) =='add' || \Request::segment(2) =='edit' || \Request::segment(2) =='delete'|| \Request::segment(2) =='followers'|| \Request::segment(2) =='permissions'){
	    	$aa = \App\Permission::whereIn('id', explode(',', \Auth::user()->permissions) )->get();  
	        $arr = array();
	        foreach ($aa as $row) {
	            array_push($arr, $row->controller.'/'.$row->function);
	        }  
	        $uarr2 = array_unique($arr);
	        $ee= \Request::segment(1).'/'.\Request::segment(2);
	        //echo in_array($ee, $uarr2);die();
	        //var_dump($uarr2,in_array($ee, $uarr2));die();
	        if(in_array($ee, $uarr2)){

	        }else{
	        	// dd('this page not available , to back <a href="'.\URL::previous().'">click here</a>');
	        	dd('this page not available');
	        }
        } 
    }
}