<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
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
        $data['pages'] = \App\Page::where('type','=','PAGE')->orderby('id','DESC')->where('lang',\App::getLocale())->get();
        return view('admin.pages.index')->with($data);
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
                \Input::file('image')->move('uploads/pages', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
            }else{
                $imgpath = '';
            }

            \App\Page::create([
                'title' => \Input::get('title'),    
                'detail' => \Input::get('detail'),    
                'auther' => \Input::get('auther'),    
                'image' => $imgpath,    
                // 'lang' => \Input::get('lang'),    
                'lang' => \App::getLocale(),    
            ]);
            return \Redirect::to(config('app.prefix','Cpanel').'/pages')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            $data['type'] = 'add';            
            // $data['pages'] = \App\Page::all();
            return view('admin.pages.form')->with($data);
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
            // dd(\Input::hasFile('image'));
            if(\Input::hasFile('image')) {
                $filename = \Input::file('image')->getClientOriginalName();
                $extension = \Input::file('image')->getClientOriginalExtension();
                $fid = time();
                \Input::file('image')->move('uploads/pages', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
                
                $page =  \App\Page::find($id);

                try{                    
                    @unlink('uploads/pages/'.$page->image);
                }catch (Exception $exp){}
                // if ($id == 4) {
                //     $page->update([
                //         'title' => \Input::get('title'),    
                //         'detail' => \Input::get('detail'),    
                //         'image' => $imgpath,    
                //         // 'lang' => \Input::get('lang'),  
                //         'lang' => \App::getLocale(),    
                //         'vision' => \Input::get('vision'),  
                //         'value' => \Input::get('value'),  
                //         'message' => \Input::get('message'),  
                //         'auther' => \Input::get('auther'),  
                //     ]);
                // }else{
                    $page->update([
                        'title' => \Input::get('title'),    
                        'detail' => \Input::get('detail'),    
                        'image' => $imgpath,    
                        // 'lang' => \Input::get('lang'),  
                        'lang' => \App::getLocale(),    
                        // 'vision' => \Input::get('vision'),  
                        // 'value' => \Input::get('value'),  
                        // 'message' => \Input::get('message'),  
                        // 'auther' => \Input::get('auther'),  
                    ]);
                // }                

            }else{
                $page =  \App\Page::find($id);
                if ($id == 4) {
                    $page->update([
                        'title' => \Input::get('title'),    
                        'detail' => \Input::get('detail'),   
                        // 'lang' => \Input::get('lang'), 
                        'lang' => \App::getLocale(),     
                        'vision' => \Input::get('vision'),  
                        'value' => \Input::get('value'),  
                        'message' => \Input::get('message'),  
                        'auther' => \Input::get('auther'),  
                    ]);
                }else{
                    $page->update([
                        'title' => \Input::get('title'),    
                        'detail' => \Input::get('detail'),    
                        // 'lang' => \Input::get('lang'),  
                        'lang' => \App::getLocale(),    
                        'vision' => \Input::get('vision'),  
                        'value' => \Input::get('value'),  
                        'message' => \Input::get('message'),  
                        'auther' => \Input::get('auther'),  
                    ]);
                }     
            }

            
            return \Redirect::to(config('app.prefix','Cpanel').'/pages')->with(['success'=>trans('cp.oprationsuccess')]);  
        }else{
            $data['type'] = 'edit';
            // $data['pages'] = \App\Page::all();
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
