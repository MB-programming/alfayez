<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MaillistController extends Controller
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
        $data['maillist'] = \App\Maillist::orderby('id','DESC')->get();
        return view('admin.maillist.index')->with($data);
    }

    public function delete($id)
    {
        if (\App\Maillist::find($id)) {
            \App\Maillist::whereId($id)->delete();
            return \Redirect::to(config('app.prefix','Cpanel').'/maillist')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }       
    }

}
