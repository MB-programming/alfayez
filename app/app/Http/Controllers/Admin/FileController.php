<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FileController extends Controller
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
        $data['files'] = \App\File::orderby('id','DESC')->get();
        return view('admin.files.index')->with($data);
    }

    public function add(Request $request)
    {            
        if (\Request::isMethod('post')) {           

            $validator = $this->validate($request, [
                'image'     => 'mimes:jpeg,bmp,png,svg,gif,wmv,asf,video/x-ms-wmv,audio/x-ms-wmv,video/mp4, mp4,wav,doc,docx,xls,xlsx,zip,rar' ,
            ]);

            if(\Input::hasFile('image')) {
                $filename = \Input::file('image')->getClientOriginalName();
                $extension = \Input::file('image')->getClientOriginalExtension();
                $fid = time();
                \Input::file('image')->move('uploads/files', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
            }else{
                $imgpath = '';
            }

            \App\File::create([ 
                'path' => $imgpath,   
            ]);
            return \Redirect::to(config('app.prefix','Cpanel').'/files')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            $data['type'] = 'add';
            return view('admin.files.form')->with($data);
        } 
    }

    public function edit($id,Request $request)
    {               
        if (\Request::isMethod('post')) {
            $validator = $this->validate($request, [
                // 'image'     => 'image',
                'image'     => 'mimes:jpeg,bmp,png,svg,gif,wmv,asf,video/x-ms-wmv,audio/x-ms-wmv,video/mp4, mp4,wav,doc,docx,xls,xlsx,zip,rar' ,
            ]);

            if(\Input::hasFile('image')) {
                $filename = \Input::file('image')->getClientOriginalName();
                $extension = \Input::file('image')->getClientOriginalExtension();
                $fid = time();
                \Input::file('image')->move('uploads/files', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
                
                $file =  \App\File::find($id);

                try{                    
                    @unlink('uploads/files/'.$file->image);
                }catch (Exception $exp){}

                $file->update([
                    'path' => $imgpath,   
                ]);

            }

            
            return \Redirect::to(config('app.prefix','Cpanel').'/files')->with(['success'=>trans('cp.oprationsuccess')]);  
        }else{
            $data['type'] = 'edit';
            $data['file'] = \App\File::find($id);
            return view('admin.files.form')->with($data);      
        }
              
    }

    public function delete($id)
    {
        if (\App\File::find($id)) {
            \App\File::whereId($id)->delete();
            return \Redirect::to(config('app.prefix','Cpanel').'/files')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }       
    }

}
