<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
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
        $data['jobs'] = \App\Job::orderby('id','DESC')->where('lang',\App::getLocale())->get();
        return view('admin.jobs.index')->with($data);
    }

    public function add(Request $request)
    {            
        if (\Request::isMethod('post')) {           

            $messages = [
                'title.required'=>trans('cp.titlerequired'),
                'title.min'=>trans('cp.titlemin'), 
                              
                'detail.required'=>trans('cp.detailrequired'),
                'detail.min'=>trans('cp.detailmin'), 
            ];
            $validator = $this->validate($request, [
                'title'     => 'required|min:3',
                'detail'     => 'required|min:10',
            ],$messages);

            \App\Job::create([
                'title' => \Input::get('title'),    
                'detail' => \Input::get('detail'),     
                // 'lang' => \Input::get('lang'),     
                'lang' => \App::getLocale(),    
                'status' => \Input::get('status'),    
            ]);
            return \Redirect::to(config('app.prefix','Cpanel').'/jobs')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            $data['type'] = 'add';
            return view('admin.jobs.form')->with($data);
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
            ];
            $validator = $this->validate($request, [
                'title'     => 'required|min:3',
                'detail'     => 'required|min:10',
            ],$messages);

            $job =  \App\Job::find($id);
            $job->update([
                'title' => \Input::get('title'),    
                'detail' => \Input::get('detail'),    
                // 'lang' => \Input::get('lang'),  
                'lang' => \App::getLocale(),    
                'status' => \Input::get('status'), 
            ]);
            
            return \Redirect::to(config('app.prefix','Cpanel').'/jobs')->with(['success'=>trans('cp.oprationsuccess')]);  
        }else{
            $data['type'] = 'edit';
            $data['job'] = \App\Job::find($id);
            return view('admin.jobs.form')->with($data);      
        }     
    }

    public function delete($id)
    {
        if (\App\Job::find($id)) {
            \App\Job::whereId($id)->delete();
            return \Redirect::to(config('app.prefix','Cpanel').'/jobs')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }       
    }

}
