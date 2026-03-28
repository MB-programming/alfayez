<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['settings'] = \App\Slider::all();
        return view('admin.settings.index')->with($data);
    }

    public function postUpdate()
    {
        $inputs = \Input::except('top_main_image','middle_main_image','bottom_main_image');
        foreach($inputs as $key=>$input)
        {
            \Cache::forever('settings.'.$key,$input);
        }

        $advs = ['top_main_image','middle_main_image','bottom_main_image'];
        foreach($advs as $adv)
        {
            if(\Input::hasFile($adv))
            {
                $filename = \Input::file($adv)->getClientOriginalName();
                $extension = \Input::file($adv)->getClientOriginalExtension();
                $fid = time();
                try{
                    unlink('uploads/'.\Cache::get('settings.'.$adv));
                }catch (Exception $exp){}
                \Input::file($adv)->move('uploads/', $fid.'_'.$filename);
                \Cache::forever('settings.'.$adv,$fid.'_'.$filename);
            }
        }

        \Session::flash('success','تمت العملية بنجاح');
        return \Redirect::back();
    }

}
