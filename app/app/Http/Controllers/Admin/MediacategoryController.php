<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MediacategoryController extends Controller
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
    public function index($type)
    {        
        $data['mediacategorys'] = \App\Album::orderby('id','DESC')->where('type',strtoupper($type))->where('lang',\App::getLocale())->get();
        $data['titletype'] = $type;
        return view('admin.mediacategorys.index')->with($data);
    }

    public function add($type,Request $request)
    {            
        $data['titletype'] = $type;
        if (\Request::isMethod('post')) {           
        	//dd($request->all());
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
                \Input::file('image')->move('uploads/mediacategorys', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
            }else{
                $imgpath = '';
            }

            $saved = \App\Album::create([
                'title' => \Input::get('title'),    
                'detail' => \Input::get('detail'),    
                'image' => $imgpath,         
                'lang' => \App::getLocale(),    
                'type' => strtoupper($type),    
                'status' => \Input::get('status'),    
            ]);


            /***************************************************/
            // if(\Input::hasFile('mediacategorysphoto'))
            // {
            //     $mediacategorysphoto = [];
            //     $images = \Input::file('mediacategorysphoto');
            //     for ($i=0; $i < count($images) ; $i++) { 
            //     	if(is_null($images[$i]))
            //     	{
            //     		continue;
            //     	}

            // 		$filename1 = $images[$i]->getClientOriginalName();
            //         $extension1 = $images[$i]->getClientOriginalExtension();
            //         $fid2 = time();
            //         $images[$i]->move('uploads/mediacategorysi', $fid2.$i.'.'.$extension1);
            //         \App\Albummedia::create([
		          //       'mediacategory_id'=> $saved->id,
		          //       'path' => $fid2.$i.'.'.$extension1,   
		          //       // 'lang' => \Input::get('lang'),
            //             'lang' => \App::getLocale(),         			                
            //             'type'=>'IMAGES',  
		          //   ]);
            //     }
            // }        
            /***************************************************/


            return \Redirect::to(config('app.prefix','Cpanel').'/category/'.$type)->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            $data['type'] = 'add';
            return view('admin.mediacategorys.form')->with($data);
        } 
    }

    public function edit($type,$id,Request $request)
    {               
        $data['titletype'] = $type;
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
                \Input::file('image')->move('uploads/mediacategorys', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
                
                $mediacategory =  \App\Album::find($id);

                try{                    
                    @unlink('uploads/mediacategorys/'.$mediacategory->image);
                }catch (Exception $exp){}

                $mediacategory->update([
                    'title' => \Input::get('title'),    
                    'detail' => \Input::get('detail'),    
                    'image' => $imgpath,    
                    // 'lang' => \Input::get('lang'),    
                    'lang' => \App::getLocale(),    
                    'status' => \Input::get('status'), 
                ]);

            }else{
                $mediacategory =  \App\Album::find($id);
                $mediacategory->update([
                    'title' => \Input::get('title'),    
                    'detail' => \Input::get('detail'),    
                    // 'lang' => \Input::get('lang'),  
                    'lang' => \App::getLocale(),    
                    'status' => \Input::get('status'), 
                ]);
            }

            /***************************************************/
            // if(\Input::hasFile('editmediacategorysphoto'))
            // {
            //     $editmediacategorysphoto = [];
            //     $images = \Input::file('editmediacategorysphoto');
            //     $editmediacategorysid = \Input::get('editmediacategorysid');
            //     $editmediacategorysimg = \Input::get('editmediacategorysimg');
            //     for ($i=0; $i < count($images) ; $i++) { 
            //     	if(is_null($images[$i]))
            //     	{
            //     		continue;
            //     	}

            // 		$filename1 = $images[$i]->getClientOriginalName();
            //         $extension1 = $images[$i]->getClientOriginalExtension();
            //         $fid3 = time();
            //         $images[$i]->move('uploads/mediacategorysi', $fid3.$i.'.'.$extension1);

            //         try{
            //         	@unlink('uploads/mediacategorysi/'.$editmediacategorysimg[$i]);
	           //      }catch (Exception $exp){}

            //         $mediacategorymedia = \App\Albummedia::find($editmediacategorysid[$i]);
            //         $mediacategorymedia->update([
	           //          'mediacategory_id'=> $id,
		          //       'path' => $fid3.$i.'.'.$extension1,
	           //      ]);
            //     }
            // }        
            /***************************************************/

            /***************************************************/
            // if(\Input::hasFile('mediacategorysphoto'))
            // {
            //     $mediacategorysphoto = [];
            //     $images = \Input::file('mediacategorysphoto');
            //     for ($i=0; $i < count($images) ; $i++) { 
            //     	if(is_null($images[$i]))
            //     	{
            //     		continue;
            //     	}

            // 		$filename1 = $images[$i]->getClientOriginalName();
            //         $extension1 = $images[$i]->getClientOriginalExtension();
            //         $fid2 = time();
            //         $images[$i]->move('uploads/mediacategorysi', $fid2.$i.'.'.$extension1);
            //         \App\Albummedia::create([
		          //       'mediacategory_id'=> $id,
		          //       'path' => $fid2.$i.'.'.$extension1,   
		          //       // 'lang' => \Input::get('lang'),     	
            //             'lang' => \App::getLocale(),    		                
            //             'type'=>'IMAGES',  
		          //   ]);
            //     }
            // }        
            /***************************************************/

            
            return \Redirect::to(config('app.prefix','Cpanel').'/category/'.$type)->with(['success'=>trans('cp.oprationsuccess')]);  
        }else{
            $data['type'] = 'edit';
            $data['mediacategory'] = \App\Album::find($id);
            // $data['mediacategorymedia'] = \App\Albummedia::where('mediacategory_id',$id)->get();
            return view('admin.mediacategorys.form')->with($data);      
        }
              
    }

    public function delete($type,$id)
    {
        if (\App\Album::find($id)) {
            \App\Album::whereId($id)->delete();
            return \Redirect::to(config('app.prefix','Cpanel').'/mediacategorys/'.$type)->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }       
    }

}
