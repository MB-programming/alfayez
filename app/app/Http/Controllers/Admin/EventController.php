<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventController extends Controller
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
        $data['events'] = \App\Event::orderby('id','DESC')->where('lang',\App::getLocale())->get();
        return view('admin.events.index')->with($data);
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
                \Input::file('image')->move('uploads/events', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
            }else{
                $imgpath = '';
            }

            \App\Event::create([
                'title' => \Input::get('title'),    
                'detail' => \Input::get('detail'),    
                'image' => $imgpath,    
                // 'lang' => \Input::get('lang'), 
                'lang' => \App::getLocale(),     
                'day' => \Input::get('day'),    
                'month' => \Input::get('month'),    
                'status' => \Input::get('status'),    
            ]);
            return \Redirect::to(config('app.prefix','Cpanel').'/events')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            $data['type'] = 'add';
            return view('admin.events.form')->with($data);
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
                \Input::file('image')->move('uploads/events', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
                
                $event =  \App\Event::find($id);

                try{                    
                    @unlink('uploads/events/'.$event->image);
                }catch (Exception $exp){}

                $event->update([
                    'title' => \Input::get('title'),    
                    'detail' => \Input::get('detail'),    
                    'image' => $imgpath,    
                    // 'lang' => \Input::get('lang'),  
                    'lang' => \App::getLocale(),      
                    'day' => \Input::get('day'),    
                    'month' => \Input::get('month'), 
                    'status' => \Input::get('status'), 
                ]);

            }else{
                $event =  \App\Event::find($id);
                $event->update([
                    'title' => \Input::get('title'),    
                    'detail' => \Input::get('detail'),    
                    // 'lang' => \Input::get('lang'),  
                    'lang' => \App::getLocale(),  
                    'day' => \Input::get('day'),    
                    'month' => \Input::get('month'), 
                    'status' => \Input::get('status'), 
                ]);
            }

            
            return \Redirect::to(config('app.prefix','Cpanel').'/events')->with(['success'=>trans('cp.oprationsuccess')]);  
        }else{
            $data['type'] = 'edit';
            $data['event'] = \App\Event::find($id);
            return view('admin.events.form')->with($data);      
        }
              
    }

    public function delete($id)
    {
        if (\App\Event::find($id)) {
            \App\Event::whereId($id)->delete();
            return \Redirect::to(config('app.prefix','Cpanel').'/events')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }       
    }

}
