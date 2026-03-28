<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManagerController extends Controller
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
        $data['managers'] = \App\Page::where('type','=','PEOPLE')->orderby('id','DESC')->where('lang',\App::getLocale())->get();
        return view('admin.managers.index')->with($data);
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
                \Input::file('image')->move('uploads/managers', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
            }else{
                $imgpath = '';
            }

            \App\Page::create([
                'title' => \Input::get('title'),    
                'job_title' => \Input::get('jobtitle'),    
                'detail' => \Input::get('detail'),    
                'image' => $imgpath,    
                // 'lang' => \Input::get('lang'),  
                'lang' => \App::getLocale(),      
                'type' => 'PEOPLE',    
            ]);
            return \Redirect::to(config('app.prefix','Cpanel').'/managers')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            $data['type'] = 'add';            
            // $data['managers'] = \App\Page::all();
            return view('admin.managers.form')->with($data);
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
                \Input::file('image')->move('uploads/managers', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
                
                $manager =  \App\Page::find($id);

                try{                    
                    @unlink('uploads/managers/'.$manager->image);
                }catch (Exception $exp){}

                $manager->update([
                    'title' => \Input::get('title'),  
                    'job_title' => \Input::get('jobtitle'),      
                    'detail' => \Input::get('detail'),    
                    'image' => $imgpath,    
                    // 'lang' => \Input::get('lang'),  
                    'lang' => \App::getLocale(),    
                    'type' => 'PEOPLE',    
                ]);

            }else{
                $manager =  \App\Page::find($id);
                $manager->update([
                    'title' => \Input::get('title'),    
                    'detail' => \Input::get('detail'),    
                    'job_title' => \Input::get('jobtitle'),   
                    // 'lang' => \Input::get('lang'), 
                    'lang' => \App::getLocale(),     
                ]);
            }

            
            return \Redirect::to(config('app.prefix','Cpanel').'/managers')->with(['success'=>trans('cp.oprationsuccess')]);  
        }else{
            $data['type'] = 'edit';
            // $data['managers'] = \App\Page::all();
            $data['manager'] = \App\Page::find($id);
            return view('admin.managers.form')->with($data);      
        }
              
    }

    public function delete($id)
    {
        if (\App\Page::find($id)) {
            \App\Page::whereId($id)->delete();
            return \Redirect::to(config('app.prefix','Cpanel').'/managers')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }       
    }

}
