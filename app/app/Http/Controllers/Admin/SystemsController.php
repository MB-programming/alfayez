<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemsController extends Controller
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
        $data['systems'] = \App\Page::where('type','=','SYSTEM')->orderby('id','DESC')->where('lang',\App::getLocale())->get();
        return view('admin.systems.index')->with($data);
    }

    public function add(Request $request)
    {            
        if (\Request::isMethod('post')) {           

            $messages = [
                'title.required'=>trans('cp.titlerequired'),
                'title.min'=>trans('cp.titlemin'), 
                              
                'detail.required'=>trans('cp.detailrequired'),
                'detail.min'=>trans('cp.detailmin'), 

                'image.image'=>trans('cp.imageimage'), 
            ];
            $validator = $this->validate($request, [
                'title'     => 'required|min:3',
                'detail'     => 'required|min:10',
                'image'     => 'image',
            ],$messages);

            if(\Input::hasFile('image')) {
                $filename = \Input::file('image')->getClientOriginalName();
                $extension = \Input::file('image')->getClientOriginalExtension();
                $fid = time();
                \Input::file('image')->move('uploads/systems', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
            }else{
                $imgpath = '';
            }

            \App\Page::create([
                'title' => \Input::get('title'),    
                //'job_title' => \Input::get('jobtitle'),    
                'detail' => \Input::get('detail'),    
                'image' => $imgpath,    
                // 'lang' => \Input::get('lang'),  
                'lang' => \App::getLocale(),      
                'type' => 'SYSTEM',    
            ]);
            return \Redirect::to(config('app.prefix','Cpanel').'/systems')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            $data['type'] = 'add';            
            // $data['systems'] = \App\Page::all();
            return view('admin.systems.form')->with($data);
        } 
    }

    public function edit($id,Request $request)
    {               
        if (\Request::isMethod('post')) {
            $messages = [
                'title.required'=>trans('cp.titlerequired'),
                'title.min'=>trans('cp.titlemin'), 
                              
                'detail.required'=>trans('cp.detailrequired'),
                'detail.min'=>trans('cp.detailmin'), 

                'image.image'=>trans('cp.imageimage'), 
            ];
            $validator = $this->validate($request, [
                'title'     => 'required|min:3',
                'detail'     => 'required|min:10',
                'image'     => 'image',
            ],$messages);

            if(\Input::hasFile('image')) {
                $filename = \Input::file('image')->getClientOriginalName();
                $extension = \Input::file('image')->getClientOriginalExtension();
                $fid = time();
                \Input::file('image')->move('uploads/systems', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
                
                $system =  \App\Page::find($id);

                try{                    
                    @unlink('uploads/systems/'.$system->image);
                }catch (Exception $exp){}

                $system->update([
                    'title' => \Input::get('title'),  
                    //'job_title' => \Input::get('jobtitle'),      
                    'detail' => \Input::get('detail'),    
                    'image' => $imgpath,    
                    // 'lang' => \Input::get('lang'),  
                    'lang' => \App::getLocale(),    
                    'type' => 'SYSTEM',    
                ]);

            }else{
                $system =  \App\Page::find($id);
                $system->update([
                    'title' => \Input::get('title'),    
                    'detail' => \Input::get('detail'),    
                    //'job_title' => \Input::get('jobtitle'),   
                    // 'lang' => \Input::get('lang'), 
                    'lang' => \App::getLocale(),     
                ]);
            }

            
            return \Redirect::to(config('app.prefix','Cpanel').'/systems')->with(['success'=>trans('cp.oprationsuccess')]);  
        }else{
            $data['type'] = 'edit';
            // $data['systems'] = \App\Page::all();
            $data['system'] = \App\Page::find($id);
            return view('admin.systems.form')->with($data);      
        }
              
    }

    public function delete($id)
    {
        if (\App\Page::find($id)) {
            \App\Page::whereId($id)->delete();
            return \Redirect::to(config('app.prefix','Cpanel').'/systems')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }       
    }

}
