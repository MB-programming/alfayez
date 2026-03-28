<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConsultationController extends Controller
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
        $data['consultation'] = \App\Consultation::orderby('id','DESC')->get();
        return view('admin.consultation.index')->with($data);
    }


    public function edit($id,Request $request)
    {               
        if (\Request::isMethod('post')) {     
            $user =  \App\Consultation::find($id);
            $user->update([
                'replay' => \Input::get('replay'),  
            ]);
            /****************************************************************************/              
            \Mail::send('emails.test',['name'=>\Input::get('name') , 'subject'=>\Input::get('subject') , 'email'=>\Input::get('email') , 'replay'=>\Input::get('replay') ], function ($m) {
                $m->from('test@watnie.com', 'Alsharq Website');
                // $m->to(Cache::get('settings.contact_us_email') ,\Input::get('name') )->subject('اتصل بنا جديد!');
                $m->to(\Input::get('email') ,\Input::get('name') )->subject('الرد على اتصل بنا ');
                // $m->to(array_filter(explode( ',', Cache::get('settings.contact_us_email'))) ,\Input::get('name') )->subject('اتصل بنا ');
            });
            /***************************************************************************/

            return \Redirect::to(config('app.prefix','Cpanel').'/contactus')->with(['success'=>trans('cp.oprationsuccess')]);  
        }else{
            $data['type'] = 'edit';
            $data['consultation'] = \App\Consultation::all();
            $data['contact'] = \App\Consultation::find($id);
            return view('admin.consultation.form')->with($data);      
        }
              
    }

    public function delete($id)
    {
        if (\App\Consultation::find($id)) {
            \App\Consultation::whereId($id)->delete();
            return \Redirect::to(config('app.prefix','Cpanel').'/contactus')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }       
    }

}
