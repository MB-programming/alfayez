<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoriesController extends Controller
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
        $data['categories'] = \App\Category::orderby('id','DESC')->get();
        return view('admin.categories.index')->with($data);
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

            \App\Category::create([
                'name' => \Input::get('name'),    
            ]);
            return \Redirect::to(config('app.prefix','Cpanel').'/categories')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            $data['type'] = 'add';            
            $data['categories'] = \App\Category::all();
            return view('admin.categories.index')->with($data);
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
            $user =  \App\Category::find($id);
            $user->update([
                'name' => \Input::get('name'),  
            ]);
            return \Redirect::to(config('app.prefix','Cpanel').'/categories')->with(['success'=>trans('cp.oprationsuccess')]);  
        }else{
            $data['type'] = 'edit';
            $data['categories'] = \App\Category::all();
            $data['category'] = \App\Category::find($id);
            return view('admin.categories.index')->with($data);      
        }
              
    }

    public function delete($id)
    {
        if (\App\Category::find($id)) {
            \App\Category::whereId($id)->delete();
            return \Redirect::to(config('app.prefix','Cpanel').'/categories')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }       
    }

}
