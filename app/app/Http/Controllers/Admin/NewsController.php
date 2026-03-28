<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
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
        $data['news'] = \App\News::with('categories')->orderby('id','DESC')->where('lang',\App::getLocale())->get();
        return view('admin.news.index')->with($data);
    }

    public function add(Request $request)
    {            
        if (\Request::isMethod('post')) {           

            $messages = [
                'title.required'=>trans('cp.titlerequired'),
                'title.min'=>trans('cp.titlemin'), 
                              
                'detail.required'=>trans('cp.detailrequired'),
                'detail.min'=>trans('cp.detailmin'), 

                'category_id.required'=>trans('cp.categoryrequired'),

                'image.image'=>trans('cp.imageimage'), 
            ];
            $validator = $this->validate($request, [
                'title'     => 'required|min:3',
                'detail'     => 'required|min:10',
                'category_id'     => 'required',
                'image'     => 'image',
            ],$messages);

            if(\Input::hasFile('image')) {
                $filename = \Input::file('image')->getClientOriginalName();
                $extension = \Input::file('image')->getClientOriginalExtension();
                $fid = time();
                \Input::file('image')->move('uploads/news', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
            }else{
                $imgpath = '';
            }

            \App\News::create([
                'title' => \Input::get('title'),    
                'detail' => \Input::get('detail'),    
                'image' => $imgpath,    
                // 'lang' => \Input::get('lang'),   
                'lang' => \App::getLocale(),   
                'date' => \Input::get('date'),    
                'category_id' => \Input::get('category_id'),    
                'status' => \Input::get('status'),    
            ]);
            return \Redirect::to(config('app.prefix','Cpanel').'/news')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            $data['type'] = 'add';
            $data['categories'] = \App\Category::all();
            return view('admin.news.form')->with($data);
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

                'category_id.required'=>trans('cp.categoryrequired'),

                'image.image'=>trans('cp.imageimage'), 
            ];
            $validator = $this->validate($request, [
                'title'     => 'required|min:3',
                'detail'     => 'required|min:10',
                'category_id'     => 'required',
                'image'     => 'image',
            ],$messages);

            if(\Input::hasFile('image')) {
                $filename = \Input::file('image')->getClientOriginalName();
                $extension = \Input::file('image')->getClientOriginalExtension();
                $fid = time();
                \Input::file('image')->move('uploads/news', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
                
                $news =  \App\News::find($id);

                try{                    
                    @unlink('uploads/news/'.$news->image);
                }catch (Exception $exp){}

                $news->update([
                    'title' => \Input::get('title'),    
                    'detail' => \Input::get('detail'),    
                    'image' => $imgpath,    
                    // 'lang' => \Input::get('lang'),
                    'lang' => \App::getLocale(),        
                    'date' => \Input::get('date'),      
                    'category_id' => \Input::get('category_id'),    
                    'status' => \Input::get('status'), 
                ]);

            }else{
                $news =  \App\News::find($id);
                $news->update([
                    'title' => \Input::get('title'),    
                    'detail' => \Input::get('detail'),    
                    // 'lang' => \Input::get('lang'),  
                    'lang' => \App::getLocale(),  
                    'date' => \Input::get('date'),  
                    'category_id' => \Input::get('category_id'),    
                    'status' => \Input::get('status'), 
                ]);
            }

            
            return \Redirect::to(config('app.prefix','Cpanel').'/news')->with(['success'=>trans('cp.oprationsuccess')]);  
        }else{
            $data['type'] = 'edit';
            $data['news'] = \App\News::find($id);
            $data['categories'] = \App\Category::all();
            return view('admin.news.form')->with($data);      
        }
              
    }

    public function delete($id)
    {
        if (\App\News::find($id)) {
            \App\News::whereId($id)->delete();
            return \Redirect::to(config('app.prefix','Cpanel').'/news')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }       
    }

}
