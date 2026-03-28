<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
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
        $data['sliders'] = \App\Slider::orderby('id','DESC')->where('lang',\App::getLocale())->get();
        // 'lang' => \App::getLocale(),    
        return view('admin.sliders.index')->with($data);
    }

    public function add(Request $request)
    {            
        if (\Request::isMethod('post')) {           

            $messages = [
                'title.required'=>trans('cp.titlerequired'),
                'title.min'=>trans('cp.titlemin'), 

                'image.image'=>trans('cp.imageimage'), 
            ];
            $validator = $this->validate($request, [
                'title'     => 'required|min:3',
                'image'     => 'image',
            ],$messages);

            if(\Input::hasFile('image')) {
                $filename = \Input::file('image')->getClientOriginalName();
                $extension = \Input::file('image')->getClientOriginalExtension();
                $fid = time();
                \Input::file('image')->move('uploads/sliders', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
            }else{
                $imgpath = '';
            }

            \App\Slider::create([
                'title' => \Input::get('title'),    
                'detail' => \Input::get('detail'),    
                'image' => $imgpath, 
                'link' => \Input::get('link'),    
                // 'lang' => \Input::get('lang'),    
                // 'lang' => \App::getLocale(),    
                'lang' => \App::getLocale(),    
                'status' => \Input::get('status'),    
            ]);
            return \Redirect::to(config('app.prefix','Cpanel').'/sliders')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            $data['type'] = 'add';            
            // $data['sliders'] = \App\Slider::all();
            return view('admin.sliders.form')->with($data);
        } 
    }

    public function edit($id,Request $request)
    {               
        if (\Request::isMethod('post')) {
            $messages = [
                'title.required'=>trans('cp.titlerequired'),
                'title.min'=>trans('cp.titlemin'), 

                'image.image'=>trans('cp.imageimage'), 
            ];
            $validator = $this->validate($request, [
                'title'     => 'required|min:3',
                'image'     => 'image',
            ],$messages);

            if(\Input::hasFile('image')) {
                $filename = \Input::file('image')->getClientOriginalName();
                $extension = \Input::file('image')->getClientOriginalExtension();
                $fid = time();
                \Input::file('image')->move('uploads/sliders', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
                
                $slider =  \App\Slider::find($id);

                try{                    
                    @unlink('uploads/sliders/'.$slider->image);
                }catch (Exception $exp){}

                $slider->update([
                    'title' => \Input::get('title'),    
                    'detail' => \Input::get('detail'),    
                    'image' => $imgpath,    
                    'link' => \Input::get('link'),  
                    // 'lang' => \Input::get('lang'),  
                    // 'lang' => \App::getLocale(),    
                    'lang' => \App::getLocale(),    
                    'status' => \Input::get('status'),  
                ]);

            }else{
                $slider =  \App\Slider::find($id);
                $slider->update([
                    'title' => \Input::get('title'),    
                    'detail' => \Input::get('detail'),    
                    // 'lang' => \Input::get('lang'), 
                    // 'lang' => \App::getLocale(), 
                    'lang' => \App::getLocale(),        
                    'link' => \Input::get('link'), 
                    'status' => \Input::get('status'), 
                ]);
            }

            
            return \Redirect::to(config('app.prefix','Cpanel').'/sliders')->with(['success'=>trans('cp.oprationsuccess')]);  
        }else{
            $data['type'] = 'edit';
            // $data['sliders'] = \App\Slider::all();
            $data['slider'] = \App\Slider::find($id);
            return view('admin.sliders.form')->with($data);      
        }
              
    }

    public function delete($id)
    {
        if (\App\Slider::find($id)) {
            \App\Slider::whereId($id)->delete();
            return \Redirect::to(config('app.prefix','Cpanel').'/sliders')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }       
    }

}
