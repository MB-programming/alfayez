<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MenuController extends Controller
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
        $data['pages'] = \App\Page::all();
        return view('admin.pages.index')->with($data);
    }

    public function add(Request $request)
    {            
        if (\Request::isMethod('post')) {           

            $messages = [
                'name.required'=>trans('cp.namerequired'),
                'name.min'=>trans('cp.namemin'),               
            ];
            $validator = $this->validate($request, [
                'name'     => 'required|min:3',
            ],$messages);

            \App\Page::create([
                'name' => \Input::get('name'),    
            ]);
            return \Redirect::to(config('app.prefix','Cpanel').'/pages')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            $data['type'] = 'add';            
            $data['pages'] = \App\Page::all();
            return view('admin.pages.form')->with($data);
        } 
    }

    public function edit($id,Request $request)
    {               
        if (\Request::isMethod('post')) {
            $messages = [
                'name.required'=>trans('cp.namerequired'),
                'name.min'=>trans('cp.namemin'), 
            ];
            $validator = $this->validate($request, [
                'name'     => 'required|min:3',
            ],$messages);         
            $user =  \App\Page::find($id);
            $user->update([
                'name' => \Input::get('name'),  
            ]);
            return \Redirect::to(config('app.prefix','Cpanel').'/pages')->with(['success'=>trans('cp.oprationsuccess')]);  
        }else{
            $data['type'] = 'edit';
            $data['pages'] = \App\Page::all();
            $data['page'] = \App\Page::find($id);
            return view('admin.pages.form')->with($data);      
        }
              
    }

    public function delete($id)
    {
        if (\App\Page::find($id)) {
            \App\Page::whereId($id)->delete();
            return \Redirect::to(config('app.prefix','Cpanel').'/pages')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }       
    }

}
