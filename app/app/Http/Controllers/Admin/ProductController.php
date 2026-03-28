<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
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
        $data['products'] = \App\Product::orderby('id','DESC')->get();
        return view('admin.products.index')->with($data);
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

            // if(\Input::hasFile('image')) {
            //     $filename = \Input::file('image')->getClientOriginalName();
            //     $extension = \Input::file('image')->getClientOriginalExtension();
            //     $fid = time();
            //     \Input::file('image')->move('uploads/products', $fid.'.'.$extension);
            //     $imgpath = $fid.'.'.$extension;
            // }else{
            //     $imgpath = '';
            // }

            \App\Product::create([
                'title' => \Input::get('title'),    
                'detail' => \Input::get('detail'),    
                // 'image' => $imgpath,    
                'icon' => \Input::get('icon'),    
                'lang' => \Input::get('lang'),    
            ]);
            return \Redirect::to(config('app.prefix','Cpanel').'/products')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            $data['type'] = 'add';            
            // $data['products'] = \App\Product::all();
            return view('admin.products.form')->with($data);
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

            // if(\Input::hasFile('image')) {
            //     $filename = \Input::file('image')->getClientOriginalName();
            //     $extension = \Input::file('image')->getClientOriginalExtension();
            //     $fid = time();
            //     \Input::file('image')->move('uploads/products', $fid.'.'.$extension);
            //     $imgpath = $fid.'.'.$extension;
                
            //     $product =  \App\Product::find($id);

            //     try{                    
            //         @unlink('uploads/products/'.$product->image);
            //     }catch (Exception $exp){}

            //     $product->update([
            //         'title' => \Input::get('title'),    
            //         'detail' => \Input::get('detail'),    
            //         'image' => $imgpath,    
            //         'lang' => \Input::get('lang'),  
            //     ]);

            // }else{
                $product =  \App\Product::find($id);
                $product->update([
                    'title' => \Input::get('title'),    
                    'detail' => \Input::get('detail'),    
                    'icon' => \Input::get('icon'),  
                    'lang' => \Input::get('lang'),  
                ]);
            // }

            
            return \Redirect::to(config('app.prefix','Cpanel').'/products')->with(['success'=>trans('cp.oprationsuccess')]);  
        }else{
            $data['type'] = 'edit';
            // $data['products'] = \App\Product::all();
            $data['product'] = \App\Product::find($id);
            return view('admin.products.form')->with($data);      
        }
              
    }

    public function delete($id)
    {
        if (\App\Product::find($id)) {
            \App\Product::whereId($id)->delete();
            return \Redirect::to(config('app.prefix','Cpanel').'/products')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }       
    }

}
