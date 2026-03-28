<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlbummediamediaController extends Controller
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
    public function index($category_id)
    {        
        $data['albummedias'] = \App\Albummedia::where('lang',\App::getLocale())->where('type','VIDEO')->where('category_id',$category_id)->orderby('id','DESC')->get();
        $data['category_id'] = $category_id;
        return view('admin.albummedias.index')->with($data);
    }

    public function add($category_id,Request $request)
    {            
        $data['category_id'] = $category_id;

        if (\Request::isMethod('post')) {           

            $messages = [
                'title.required'=>trans('cp.titlerequired'),
                'title.min'=>trans('cp.titlemin'), 
                              
                'path.required'=>trans('cp.linkrequired'),

                // 'detail.required'=>trans('cp.detailrequired'),
                // 'detail.min'=>trans('cp.detailmin'), 

                // 'image.image'=>trans('cp.imageimage'), 
            ];
            $validator = $this->validate($request, [
                'title'     => 'required|min:3',
                'path'     => 'required',
                // 'detail'     => 'required|min:10',
                // 'image'     => 'image',
            ],$messages);

            // if(\Input::hasFile('image')) {
            //     $filename = \Input::file('image')->getClientOriginalName();
            //     $extension = \Input::file('image')->getClientOriginalExtension();
            //     $fid = time();
            //     \Input::file('image')->move('uploads/albummedias', $fid.'.'.$extension);
            //     $imgpath = $fid.'.'.$extension;
            // }else{
            //     $imgpath = '';
            // }

            \App\Albummedia::create([
                'title' => \Input::get('title'),    
                'path' => \Input::get('path'),    
                // 'detail' => \Input::get('detail'),    
                // 'image' => $imgpath,    
                // 'lang' => \Input::get('lang'),      
                'lang' => \App::getLocale(),    
                'type' => 'VIDEO',      
                'category_id' => $category_id,     
                // 'status' => \Input::get('status'),    
            ]);
            return \Redirect::to(config('app.prefix','Cpanel').'/albummedias/'.$category_id)->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            
            $data['type'] = 'add';
            return view('admin.albummedias.form')->with($data);
        } 
    }

    public function edit($category_id,$id,Request $request)
    {               
        $data['category_id'] = $category_id;
        if (\Request::isMethod('post')) {
            $messages = [
                'title.required'=>trans('cp.titlerequired'),
                'title.min'=>trans('cp.titlemin'), 

                'path.required'=>trans('cp.linkrequired'),
                              
                // 'detail.required'=>trans('cp.detailrequired'),
                // 'detail.min'=>trans('cp.detailmin'), 

                // 'image.image'=>trans('cp.imageimage'), 
            ];
            $validator = $this->validate($request, [
                'title'     => 'required|min:3',
                'path'     => 'required',
                // 'detail'     => 'required|min:10',
                // 'image'     => 'image',
            ],$messages);

            // if(\Input::hasFile('image')) {
            //     $filename = \Input::file('image')->getClientOriginalName();
            //     $extension = \Input::file('image')->getClientOriginalExtension();
            //     $fid = time();
            //     \Input::file('image')->move('uploads/albummedias', $fid.'.'.$extension);
            //     $imgpath = $fid.'.'.$extension;
                
            //     $albummedia =  \App\Albummedia::find($id);

            //     try{                    
            //         @unlink('uploads/albummedias/'.$albummedia->image);
            //     }catch (Exception $exp){}

            //     $albummedia->update([
            //         'title' => \Input::get('title'),    
            //         'detail' => \Input::get('detail'),    
            //         'image' => $imgpath,    
            //         'lang' => \Input::get('lang'),    
            //         'status' => \Input::get('status'), 
            //     ]);

            // }else{
                $albummedia =  \App\Albummedia::find($id);
                $albummedia->update([
                    'title' => \Input::get('title'),    
                    // 'detail' => \Input::get('detail'),    
                    'path' => \Input::get('path'),    
                    // 'lang' => \Input::get('lang'), 
                    'lang' => \App::getLocale(),     
                    // 'status' => \Input::get('status'), 
                ]);
            // }

            
            return \Redirect::to(config('app.prefix','Cpanel').'/albummedias/'.$category_id)->with(['success'=>trans('cp.oprationsuccess')]);  
        }else{
            $data['type'] = 'edit';
            $data['albummedia'] = \App\Albummedia::find($id);
            return view('admin.albummedias.form')->with($data);      
        }
              
    }

    public function delete($category_id,$id)
    {
        if (\App\Albummedia::find($id)) {
            \App\Albummedia::whereId($id)->delete();
            return \Redirect::to(config('app.prefix','Cpanel').'/albummedias/'.$category_id)->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }       
    }

}
