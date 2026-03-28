<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LangController extends Controller
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
        $array = \Lang::get('site');
        foreach ($array as $key => $value) {            
            $object = \App\Lang::where('key',$key)->where('lang',\App::getLocale())->first();
            if (isset($object->id) && intval($object->id)>0) {
               $object->value = $value;
               $object->save();
            }else{
                \App\Lang::create([
                    'key'=>$key,
                    'value'=>$value,
                    'lang'=>strtoupper(\App::getLocale()),
                ]);
            }
        }
        $data['langs'] = \App\Lang::where('lang',\App::getLocale())->get();
        return view('admin.langs.index')->with($data);
    }

    public function postUpdate()
    {
        /*
        $inputs = \Input::except('top_main_image','middle_main_image','bottom_main_image');
        foreach($inputs as $key=>$input)
        {
            \Cache::forever('langs.'.$key,$input);
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
                    unlink('uploads/'.\Cache::get('langs.'.$adv));
                }catch (Exception $exp){}
                \Input::file($adv)->move('uploads/', $fid.'_'.$filename);
                \Cache::forever('langs.'.$adv,$fid.'_'.$filename);
            }
        }

        \Session::flash('success','تمت العملية بنجاح');
        return \Redirect::back();
        */
        $array = \Input::all();
        foreach ($array as $key => $value) {
            if ($key == '_token') {
                continue;
            }
            $object = \App\Lang::where('key',$key)->where('lang',\App::getLocale())->first();
            if (isset($object->id) && intval($object->id)>0) {
               \App\Libraries\LangFile::updateFile(\App::getLocale().'/site.php',$key,$object->value,$value);
               $object->value = $value;
               $object->save();
               // \Lang::set('site.'.$key, $value);
               // trans('site.'.$key,$value);
            }            
        }        

        \Session::flash('success','تمت العملية بنجاح');
        return \Redirect::back();
    }

}
