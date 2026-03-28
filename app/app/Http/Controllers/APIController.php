<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class APIController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function all()
    {
        $data['categories'] = \App\Category::all();
        $data['feeling'] = \App\Feeling::all();
        $data['motivation'] = \App\Motivation::all();
        $data['memos'] = \App\Memo::all();
        $data['Usermemo'] = \App\Usermemo::all();
        // $data['user'] = \App\User::all();
        // $data['Userfollower'] = \App\Userfollower::all();
        return  json_encode($data);
    }

    public function categories()
    {
        $data['categories'] = \App\Category::all();
        return  json_encode($data);
    }


    public function feeling()
    {
        $data['feeling'] = \App\Feeling::all();
        return  json_encode($data);
    }


    public function motivation()
    {
        $data['motivation'] = \App\Motivation::all();
        return  json_encode($data);
    }

    public function memos()
    {
        $data['memos'] = \App\Memo::all();
        return  json_encode($data);
    }


}
