<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PartnerController extends Controller
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
        // $data['partners'] = \App\Partner::orderby('id','DESC')->get();
        $data['partners'] = \App\Partner::orderby('order','ASC')->where('lang',\App::getLocale())->get();
        return view('admin.partners.index')->with($data);
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
                \Input::file('image')->move('uploads/partners', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
            }else{
                $imgpath = '';
            }

            if(\Input::hasFile('bg_image')) {
                $filename = \Input::file('bg_image')->getClientOriginalName();
                $extension = \Input::file('bg_image')->getClientOriginalExtension();
                $fid = time();
                \Input::file('bg_image')->move('uploads/partners', $fid.'.'.$extension);
                $bgimgpath = $fid.'.'.$extension;
            }else{
                $bgimgpath = '';
            }


            \App\Partner::create([
                'title' => \Input::get('title'),    
                'detail' => \Input::get('detail'),    
                'link' => \Input::get('link'),    
                'image' => $imgpath,    
                'bg_image' => $bgimgpath,    
                'lang' => \App::getLocale(),    
            ]);
            return \Redirect::to(config('app.prefix','Cpanel').'/partners')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            $data['type'] = 'add';            
            // $data['partners'] = \App\Partner::all();
            return view('admin.partners.form')->with($data);
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

            if(\Input::hasFile('image') && \Input::hasFile('bg_image')) {
                $filename = \Input::file('image')->getClientOriginalName();
                $extension = \Input::file('image')->getClientOriginalExtension();
                $fid = time();
                \Input::file('image')->move('uploads/partners', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
                
                $filename = \Input::file('bg_image')->getClientOriginalName();
                $extension = \Input::file('bg_image')->getClientOriginalExtension();
                $fid = time();
                \Input::file('bg_image')->move('uploads/partners', $fid.'.'.$extension);
                $bgimgpath = $fid.'.'.$extension;
                
                $partner =  \App\Partner::find($id);

                try{                    
                    @unlink('uploads/partners/'.$partner->image);
                }catch (Exception $exp){}

                 try{                    
                    @unlink('uploads/partners/'.$partner->bg_image);
                }catch (Exception $exp){}

                $partner->update([
                    'title' => \Input::get('title'),    
                    'detail' => \Input::get('detail'),    
                    'link' => \Input::get('link'),    
                    'image' => $imgpath,    
                    'bg_image' => $bgimgpath,    
                    'lang' => \App::getLocale(),  
                ]);
            }elseif(\Input::hasFile('image')){
                $filename = \Input::file('image')->getClientOriginalName();
                $extension = \Input::file('image')->getClientOriginalExtension();
                $fid = time();
                \Input::file('image')->move('uploads/partners', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
                

                try{                    
                    @unlink('uploads/partners/'.$partner->image);
                }catch (Exception $exp){}

                $partner =  \App\Partner::find($id);

                $partner->update([
                    'title' => \Input::get('title'),    
                    'detail' => \Input::get('detail'),    
                    'link' => \Input::get('link'),    
                    'image' => $imgpath,    
                    'lang' => \App::getLocale(),  
                ]);
            }elseif(\Input::hasFile('bg_image')){
                $filename = \Input::file('bg_image')->getClientOriginalName();
                $extension = \Input::file('bg_image')->getClientOriginalExtension();
                $fid = time();
                \Input::file('bg_image')->move('uploads/partners', $fid.'.'.$extension);
                $bgimgpath = $fid.'.'.$extension;

                try{                    
                    @unlink('uploads/partners/'.$partner->bg_image);
                }catch (Exception $exp){}


                $partner =  \App\Partner::find($id);

                $partner->update([
                    'title' => \Input::get('title'),    
                    'detail' => \Input::get('detail'),    
                    'link' => \Input::get('link'),       
                    'bg_image' => $bgimgpath,    
                    'lang' => \Input::get('lang'),  
                ]);
            }else{
                $partner =  \App\Partner::find($id);
                $partner->update([
                    'title' => \Input::get('title'),    
                    'link' => \Input::get('link'),    
                    'detail' => \Input::get('detail'),    
                    'lang' => \Input::get('lang'),  
                ]);
            }

            
            return \Redirect::to(config('app.prefix','Cpanel').'/partners')->with(['success'=>trans('cp.oprationsuccess')]);  
        }else{
            $data['type'] = 'edit';
            // $data['partners'] = \App\Partner::all();
            $data['partner'] = \App\Partner::find($id);
            return view('admin.partners.form')->with($data);      
        }
              
    }

    public function delete($id)
    {
        if (\App\Partner::find($id)) {
            \App\Partner::whereId($id)->delete();
            return \Redirect::to(config('app.prefix','Cpanel').'/partners')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }       
    }

}
