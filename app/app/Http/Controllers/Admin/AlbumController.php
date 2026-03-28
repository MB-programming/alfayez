<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlbumController extends Controller
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
        $data['albums'] = \App\Album::orderby('id','DESC')->where('type','IMAGE')->where('lang',\App::getLocale())->get();
        return view('admin.albums.index')->with($data);
    }

    public function add(Request $request)
    {            
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
                \Input::file('image')->move('uploads/albums', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
            }else{
                $imgpath = '';
            }

            $saved = \App\Album::create([
                'title' => \Input::get('title'),    
                'detail' => \Input::get('detail'),    
                'image' => $imgpath,    
                // 'lang' => \Input::get('lang'),      
                'lang' => \App::getLocale(),    
                'status' => \Input::get('status'),    
            ]);


            /***************************************************/
            if(\Input::hasFile('albumsphoto'))
            {
                $albumsphoto = [];
                $images = \Input::file('albumsphoto');
                for ($i=0; $i < count($images) ; $i++) { 
                	if(is_null($images[$i]))
                	{
                		continue;
                	}

            		$filename1 = $images[$i]->getClientOriginalName();
                    $extension1 = $images[$i]->getClientOriginalExtension();
                    $fid2 = time();
                    $images[$i]->move('uploads/albumsi', $fid2.$i.'.'.$extension1);
                    \App\Albummedia::create([
		                'album_id'=> $saved->id,
		                'path' => $fid2.$i.'.'.$extension1,   
		                // 'lang' => \Input::get('lang'),
                        'lang' => \App::getLocale(),         			                
                        'type'=>'IMAGES',  
		            ]);
                }
            }        
            /***************************************************/


            return \Redirect::to(config('app.prefix','Cpanel').'/albums')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            $data['type'] = 'add';
            return view('admin.albums.form')->with($data);
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
                \Input::file('image')->move('uploads/albums', $fid.'.'.$extension);
                $imgpath = $fid.'.'.$extension;
                
                $album =  \App\Album::find($id);

                try{                    
                    @unlink('uploads/albums/'.$album->image);
                }catch (Exception $exp){}

                $album->update([
                    'title' => \Input::get('title'),    
                    'detail' => \Input::get('detail'),    
                    'image' => $imgpath,    
                    // 'lang' => \Input::get('lang'),    
                    'lang' => \App::getLocale(),    
                    'status' => \Input::get('status'), 
                ]);

            }else{
                $album =  \App\Album::find($id);
                $album->update([
                    'title' => \Input::get('title'),    
                    'detail' => \Input::get('detail'),    
                    // 'lang' => \Input::get('lang'),  
                    'lang' => \App::getLocale(),    
                    'status' => \Input::get('status'), 
                ]);
            }

            /***************************************************/
            if(\Input::hasFile('editalbumsphoto'))
            {
                $editalbumsphoto = [];
                $images = \Input::file('editalbumsphoto');
                $editalbumsid = \Input::get('editalbumsid');
                $editalbumsimg = \Input::get('editalbumsimg');
                for ($i=0; $i < count($images) ; $i++) { 
                	if(is_null($images[$i]))
                	{
                		continue;
                	}

            		$filename1 = $images[$i]->getClientOriginalName();
                    $extension1 = $images[$i]->getClientOriginalExtension();
                    $fid3 = time();
                    $images[$i]->move('uploads/albumsi', $fid3.$i.'.'.$extension1);

                    try{
                    	@unlink('uploads/albumsi/'.$editalbumsimg[$i]);
	                }catch (Exception $exp){}

                    $albummedia = \App\Albummedia::find($editalbumsid[$i]);
                    $albummedia->update([
	                    'album_id'=> $id,
		                'path' => $fid3.$i.'.'.$extension1,
	                ]);
                }
            }        
            /***************************************************/

            /***************************************************/
            if(\Input::hasFile('albumsphoto'))
            {
                $albumsphoto = [];
                $images = \Input::file('albumsphoto');
                for ($i=0; $i < count($images) ; $i++) { 
                	if(is_null($images[$i]))
                	{
                		continue;
                	}

            		$filename1 = $images[$i]->getClientOriginalName();
                    $extension1 = $images[$i]->getClientOriginalExtension();
                    $fid2 = time();
                    $images[$i]->move('uploads/albumsi', $fid2.$i.'.'.$extension1);
                    \App\Albummedia::create([
		                'album_id'=> $id,
		                'path' => $fid2.$i.'.'.$extension1,   
		                // 'lang' => \Input::get('lang'),     	
                        'lang' => \App::getLocale(),    		                
                        'type'=>'IMAGES',  
		            ]);
                }
            }        
            /***************************************************/

            
            return \Redirect::to(config('app.prefix','Cpanel').'/albums')->with(['success'=>trans('cp.oprationsuccess')]);  
        }else{
            $data['type'] = 'edit';
            $data['album'] = \App\Album::find($id);
            $data['Albummedia'] = \App\Albummedia::where('album_id',$id)->get();
            return view('admin.albums.form')->with($data);      
        }
              
    }

    public function delete($id)
    {
        if (\App\Album::find($id)) {
            \App\Album::whereId($id)->delete();
            return \Redirect::to(config('app.prefix','Cpanel').'/albums')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }       
    }

}
