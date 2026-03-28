<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqController extends Controller
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
        $data['faqs'] = \App\Faq::all();
        return view('admin.faqs.index')->with($data);
    }

    public function add(Request $request)
    {            
        if (\Request::isMethod('post')) {           

            $messages = [
                'question.required'=>trans('cp.questionrequired'),
                'question.min'=>trans('cp.questionmin'), 
                              
                'answer.required'=>trans('cp.answerrequired'),
                'answer.min'=>trans('cp.answermin'),
            ];
            $validator = $this->validate($request, [
                'question'     => 'required|min:3',
                'answer'     => 'required|min:10',
            ],$messages);

            \App\Faq::create([
                'question' => \Input::get('question'),    
                'answer' => \Input::get('answer'), 
                'lang' => \Input::get('lang'),    
            ]);
            return \Redirect::to(config('app.prefix','Cpanel').'/faqs')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            $data['type'] = 'add';            
            // $data['faqs'] = \App\Faq::all();
            return view('admin.faqs.form')->with($data);
        } 
    }

    public function edit($id,Request $request)
    {               
        if (\Request::isMethod('post')) {
             $messages = [
                'question.required'=>trans('cp.questionrequired'),
                'question.min'=>trans('cp.questionmin'), 
                              
                'answer.required'=>trans('cp.answerrequired'),
                'answer.min'=>trans('cp.answermin'),
            ];
            $validator = $this->validate($request, [
                'question'     => 'required|min:3',
                'answer'     => 'required|min:10',
            ],$messages);

            $faq =  \App\Faq::find($id);
            $faq->update([
                'question' => \Input::get('question'),    
                'answer' => \Input::get('answer'), 
                'lang' => \Input::get('lang'), 
            ]);

            return \Redirect::to(config('app.prefix','Cpanel').'/faqs')->with(['success'=>trans('cp.oprationsuccess')]);  
        }else{
            $data['type'] = 'edit';
            // $data['faqs'] = \App\Faq::all();
            $data['faq'] = \App\Faq::find($id);
            return view('admin.faqs.form')->with($data);      
        }
              
    }

    public function delete($id)
    {
        if (\App\Faq::find($id)) {
            \App\Faq::whereId($id)->delete();
            return \Redirect::to(config('app.prefix','Cpanel').'/faqs')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }       
    }

}
