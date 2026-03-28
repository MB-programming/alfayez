<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
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
        $data['users'] = \App\User::orderby('id','DESC')->get();
        return view('admin.users.index')->with($data);
    }

    public function add(Request $request)
    {            
        if (\Request::isMethod('post')) {           

            $messages = [
                'name.required'     =>trans('cp.namerequired'),
                'name.min'          =>trans('cp.namemin'),

                'username.required' =>trans('cp.usernamerequired'),
                'username.min'      =>trans('cp.usernamemin'),
                'username.unique'   =>trans('cp.usernameunique'),

                'email.required'    =>trans('cp.emailrequired'),
                'email.email'       =>trans('cp.emailemail'),
                'email.unique'      =>trans('cp.emailunique'),

                'password.required' =>trans('cp.passwordrequired'),
                'password.min'      =>trans('cp.passwordmin'),
            ];
            $validator = $this->validate($request, [
                'name'     => 'required|min:3',
                'username' => 'required|min:3|unique:users,username',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|min:6',
            ],$messages);

            \App\User::create([
                'name' => \Input::get('name'),        
                'username' => \Input::get('username'),        
                'email' => \Input::get('email'),        
                'password' => bcrypt(\Input::get('password')), 
            ]);
            return \Redirect::to(config('app.prefix','Cpanel').'/users')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            $data['type'] = 'add';
            $data['users'] = \App\User::all();
            return view('admin.users.index')->with($data);
        } 
    }

    public function edit($id,Request $request)
    {               
        if (\Request::isMethod('post')) {
            if (empty(\Input::get('password'))) {
                $messages = [
                    'name.required'     =>trans('cp.namerequired'),
                    'name.min'          =>trans('cp.namemin'),
                ];
                $validator = $this->validate($request, [
                    'name'     => 'required|min:3', 
                ],$messages);         
                $user =  \App\User::find($id);
                $user->update([
                    'name' => \Input::get('name'),       
                ]);
                return \Redirect::to(config('app.prefix','Cpanel').'/users')->with(['success'=>trans('cp.oprationsuccess')]); 
            }

            $messages = [
                'name.required'     =>trans('cp.namerequired'),
                'name.min'          =>trans('cp.namemin'),

                'password.min'      =>trans('cp.passwordmin'),
            ];
            $validator = $this->validate($request, [
                'name'     => 'required|min:3',                
                'password' => 'min:6',
            ],$messages);         
            $user =  \App\User::find($id);
            $user->update([
                'name' => \Input::get('name'),  
                'password' => bcrypt(\Input::get('password')),    
            ]);
            return \Redirect::to(config('app.prefix','Cpanel').'/users')->with(['success'=>trans('cp.oprationsuccess')]);  
        }else{
            $data['type'] = 'edit';
            $data['users'] = \App\User::all();
            $data['user'] = \App\User::find($id);
            return view('admin.users.index')->with($data);      
        }
              
    }

    public function delete($id)
    {
        if (\App\User::find($id)) {
            \App\User::whereId($id)->delete();
            return \Redirect::to(config('app.prefix','Cpanel').'/users')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }       
    }

    /**************************************************************/

    public function followers($id)
    {                            
        $data['followers'] = \App\Userfollower::where('user_id','=',$id)->with('followers')->get();
        $data['user'] = \App\User::find($id);
        return view('admin.users.followers')->with($data);
    }

    public function deletefollowers($user_id,$id)
    {            
        if (\App\Userfollower::find($id)) {
            \App\Userfollower::whereId($id)->delete();
            return \Redirect::to(config('app.prefix','Cpanel').'/users/followers/'.$user_id)->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }    
    }

    public function permissions($id)
    {            
        if (\Request::isMethod('post')) {           

            if(\Input::has('permissions_id')){
                $permissions = implode(',', \Input::get('permissions_id'));
                $user =  \App\User::find($id);
                $user->update([
                    'permissions' => $permissions, 
                ]);
                return \Redirect::to(config('app.prefix','Cpanel').'/users')->with(['success'=>trans('cp.oprationsuccess')]);
            }                       
        }else{
            $data['user'] = \App\User::find($id);
            $data['permissions'] = \App\Permission::get();  
            return view('admin.users.permissions')->with($data);
        } 
    }


}
