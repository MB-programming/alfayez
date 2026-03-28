<?php

namespace App\Http\Controllers\Site;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Alaouy\Youtube\Facades\Youtube;
use Thujohn\Twitter\Facades\Twitter;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {       
        // phpinfo();die();
      //   $this->data['products'] = \App\Product::limit(9)->get(); 
        // $this->data['partners'] = \App\Partner::where('lang','=',\App::getLocale())->orderby('order','ASC')->get();

        // $this->data['services'] = \App\Page::where('id','>',1)->where('id','<',6)->get();
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     * **/
     
    public function index()
    {
        

//       try {
            
//          $parm = array(
//             'client_id' => '609409482552036',
//             'client_secret' => '41b72545e48ad273ea38432d3e3bf032',
//             'grant_type' => 'client_credentials',
//             );
//         $resp = $this->httpGetRequest('https://graph.facebook.com/oauth/access_token',$parm);
        
//   //  return substr($resp, 17 , 43);
        

        
      
        
//         $parm2 = array(
//             'fields' => 'message,source,picture,link,story,id',
//           'access_token' => substr($resp, 13),
//             'access_token' => substr($resp, 17 , 43),
//             );
            
//           // return $parm2['access_token'];
//         $facebook_page_res = $this->httpGetRequest('https://graph.facebook.com/379793945496313/posts',$parm2);
        
//          $facebook_page_res;
//         $facebook_data = (array) json_decode($facebook_page_res);
        
//                 // dd($facebook_data['data']);
       
//         $this->data['facebook_page_res'] = $facebook_data['data'];
//           $facebook_data['data'];
//              $facebook_data['data'];



        
//          } catch (Exception $e) {
//             $this->data['facebook_page_res'] = null;
//         }
        

        

       
    //   try {
            
                               

    //         $parm3 = array(
    //             'key' => 'AIzaSyCD0_WSExapMyfqDu9u7ZWPXieicgHHN3A',
    //             'forUsername' => 'MZiD3',
    //             'part' => 'id',
    //         'part' => 'UC-8K5FUOcohr1CmnkZCsu2w'
    //             );
    //       $resp3 = $this->httpGetRequest('https://www.googleapis.com/youtube/v3/channels',$parm3);
            

    //         $manage = (array)json_decode(str_replace("\n","",$resp3));
    //         // dd($manage);

            
    //         if (count($manage['items']) > 0) {
    //             $youtube_playlist_res = Youtube::getPlaylistsByChannelId($manage['items'][0]->id,array('maxResults'=>20));
                
    //             $this->data['youtube_playlist_res'] = $youtube_playlist_res;                            
    //         }else{
    //             $this->data['youtube_playlist_res'] = null;                
    //         }                

    //         // return $manage['items'][0]->id;
    //         // dd($youtube_playlist_res);
    //     } catch (Exception $e) {
    //         $this->data['youtube_playlist_res'] = null;
    //     }
        
        // 
        

       
       
        $data = [];


        $data['home'] = 151515;
        



        $data['sliders'] = \App\Slider::limit(5)->where('status','=','ACTIVE')->where('lang','=',\App::getLocale())->get();
        $data['news'] = \App\News::limit(8)->where('status','=','ACTIVE')->where('category_id','=',2)->where('lang','=',\App::getLocale())->orderby('id','DESC')->get();

        
        $data['skills'] = \App\Page::where('type','SKILL')->orderby('id','ASC')->get();

        $data['managers'] = \App\Page::where('type','PEOPLE')->orderby('id','ASC')->get();
        $data['systems'] = \App\Page::where('type','SYSTEM')->limit(6)->orderby('id','ASC')->get();
        $data['about'] = \App\Page::whereId(1)->first();

           


        // $data['partners'] = \App\Partner::orderby('id','DESC')->get();

        
        // $data['categories'] = \App\Category::all();
        // $data['albums'] = \App\Album::limit(6)->where('status','=','ACTIVE')->where('lang','=',\App::getLocale())->get();

        $data['waseet'] = \App\Page::whereId(5)->first();
        
      
   
        return view('home')->with($data);
                 

        
    }
    
   

    public function about()
    {
        $this->data['partners'] = \App\Partner::all();
        if (\App::getLocale() == 'ar') {            
            $this->data['about'] = \App\Page::whereId(4)->first();
        }else{
            $this->data['about'] = \App\Page::whereId(15)->first();
        }
        return view('about')->with($this->data);
    }

    public function page($id)
    {
        $this->data['page'] = \App\Page::whereId($id)->first();
        return view('page')->with($this->data);
    }

    public function contactus()
    {        
        return view('contact')->with($this->data);
    }

    public function postcontactus(Request $request)
    {
        if (\Request::isMethod('post')) {    
            $messages = [
                'name.required'     =>trans('cp.namerequired'),
                'name.min'          =>trans('cp.namemin'),

                'email.required'    =>trans('cp.emailrequired'),
                'email.email'       =>trans('cp.emailemail'),

                'subject.required' =>trans('cp.subjectrequired'),
                'message.required' =>trans('cp.messagerequired'),
                'message.min'      =>trans('cp.messagemin'),
            ];
            $validator = $this->validate($request, [
                'name'     => 'required|min:3',
                'email'    => 'required|email',
                'message' => 'required|min:10',
            ],$messages);

            \App\Contactus::create([
                'name' => \Input::get('name'),        
                'email' => \Input::get('email'),    
                'message' => \Input::get('message'),  
            ]);

            /*******************************************************************************
            \Mail::send('emails.contactus',[ 'name'=>\Input::get('name') , 'email'=>\Input::get('email')  , 'subject'=>\Input::get('subject')  , 'message2'=>\Input::get('message')  ], function ($m) {                
                $m->from('test@watnie.com', 'Alsharq Website');          
                $m->to(\Cache::get('settings.email') ,\Input::get('name') )->subject('اتصل بنا من - '.\Input::get('subject') );
            });
            /*******************************************************************************/

            return \Redirect::to('/contactus')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }

    }

    public function apply_services()
    {        
        return view('applyservice')->with($this->data);
    }

    public function postapply_services(Request $request)
    {
        if (\Request::isMethod('post')) {    
            $messages = [
                'name.required'     =>trans('cp.namerequired'),
                'name.min'          =>trans('cp.namemin'),

                'email.required'    =>trans('cp.emailrequired'),
                'email.email'       =>trans('cp.emailemail'),

                'subject.required' =>trans('cp.subjectrequired'),
                'message.required' =>trans('cp.messagerequired'),
                'message.min'      =>trans('cp.messagemin'),
            ];
            $validator = $this->validate($request, [
                'name'     => 'required|min:3',
                'email'    => 'required|email',
                'subject'    => 'required',
                'message' => 'required|min:10',
            ],$messages);

            \App\Contactus::create([
                'name' => \Input::get('name'),        
                'email' => \Input::get('email'),        
                'subject' => \Input::get('subject'),  
                'message' => \Input::get('message'),  
            ]);

            /*******************************************************************************/
            // \Mail::send('emails.contactus',[ 'name'=>\Input::get('name') , 'email'=>\Input::get('email')  , 'subject'=>\Input::get('subject')  , 'message2'=>\Input::get('message')  ], function ($m) {                
            //     $m->from('test@watnie.com', 'Alsharq Website');            
            //     // $m->to('mohf_1992@hotmail.com' ,\Input::get('name') )->subject('اتصل بنا من - '.\Input::get('subject') );
            //     $m->to(\Cache::get('settings.email') ,\Input::get('name') )->subject('اتصل بنا من - '.\Input::get('subject') );
            // });
            /*******************************************************************************/

            return \Redirect::to('/applyservice')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }

    }

    public function faqs()
    {        
        $this->data['faqs'] = \App\Faq::all();
        return view('faqs')->with($this->data);
    }

    public function directors()
    {        
        $this->data['people'] = \App\Page::where('type','=','PEOPLE')->get();
        $this->data['board_of_directors'] = \App\Page::whereId(5)->first();
        return view('board_of_directors')->with($this->data);
    }

    public function news($id = 0)
    {        
        if (intval($id) > 0) {
            $this->data['news'] = \App\News::whereId($id)->first();
            return view('onenews')->with($this->data);
        }else{            
            $this->data['albums'] = \App\Album::limit(6)->where('status','=','ACTIVE')->where('lang','=',\App::getLocale())->get();
            $this->data['albummedia'] = \App\Albummedia::limit(6)->where('lang','=',\App::getLocale())->where('type','=','VIDEO')->orderby('id','DESC')->get();
            $this->data['events'] = \App\Event::where('status','=','ACTIVE')->where('lang','=',\App::getLocale())->limit(3)->orderby('id','DESC')->get();
            // $this->data['news'] = \App\News::where('status','=','ACTIVE')->where('lang','=',\App::getLocale())->orderby('date','DESC')->get();
            $this->data['news'] = \App\News::where('status','=','ACTIVE')->where('category_id',2)->where('lang','=',\App::getLocale())->orderby('date','DESC')->paginate(20);
            $this->data['title'] = 'أخبار العدل والمحاماة';
            return view('news')->with($this->data);
        }        
    }

    public function office($id = 0)
    {        
                 
            $this->data['news'] = \App\News::where('status','=','ACTIVE')->where('category_id',1)->where('lang','=',\App::getLocale())->orderby('date','DESC')->paginate(20);
            $this->data['title'] = 'أخبار المكتب';
            return view('news')->with($this->data);
            
    }

    
    public function skills($id = 0)
    {        
        if (intval($id) > 0) {
            $this->data['skills'] = \App\Page::whereId($id)->first();
            return view('oneskills')->with($this->data);
        }else{            
            $this->data['skills'] = \App\Page::where('type','SKILL')->orderby('id','ASC')->get();
            return view('skills')->with($this->data);
        }        
    }

    public function systems($id = 0)
    {        
        if (intval($id) > 0) {
            $this->data['systems'] = \App\Page::whereId($id)->first();
            return view('onesystem')->with($this->data);
        }else{            
            $this->data['systems'] = \App\Page::where('type','SYSTEM')->orderby('id','ASC')->paginate(20);
            return view('systems')->with($this->data);
        }        
    }

    public function events($id = 0)
    {        
        if (intval($id) > 0) {
            $this->data['event'] = \App\Event::whereId($id)->first();
            return view('oneevent')->with($this->data);
        }else{            
            $this->data['events'] = \App\Event::where('status','=','ACTIVE')->limit(3)->get();
            return view('events')->with($this->data);
        }        
    }
    
    public function jobs()
    {        
        $this->data['job'] = \App\Page::whereId(6)->first();         
        $this->data['jobs'] = \App\Job::where('status','=','ACTIVE')->limit(6)->get();
        return view('jobs')->with($this->data);
    }

    // public function albums($id)
    // {        
    //     $this->data['albums'] = \App\Album::whereId($id)->first();         
    //     $this->data['albumsmedia'] = \App\Albummedia::where('album_id','=',$id)->get();
    //     return view('albums')->with($this->data);
    // }


    // public function jobs()
    // {        
    //     $this->data['job'] = \App\Page::whereId(6)->first();         
    //     $this->data['jobs'] = \App\Job::where('status','=','ACTIVE')->where('lang','=',\App::getLocale())->limit(6)->get();
    //     return view('jobs')->with($this->data);
    // }

    public function albums($id=0)
    {        
        if (intval($id) > 0) {
            $this->data['albums'] = \App\Album::whereId($id)->first();         
            $this->data['albumsmedia'] = \App\Albummedia::where('album_id','=',$id)->get();
            return view('onealbum')->with($this->data);
        }else{
            $this->data['albums'] = \App\Album::where('status','=','ACTIVE')->where('type','IMAGE')->where('lang','=',\App::getLocale())->limit(12)->get();
            return view('albums')->with($this->data);
        }     
    }
    
    public function videos($id = 0)
    {        
        if (!empty($id)) {
            $this->data['videos'] = \App\Albummedia::limit(9)->where('lang','=',\App::getLocale())->where('category_id',$id)->where('type','=','VIDEO')->orderby('id','DESC')->get();  
            $cat = \App\Album::whereId($id)->first();
            $this->data['category'] =  $cat->title;     
            if ($cat->type != 'VIDEO') {
                return \Redirect::to('/');
            }
            
            return view('videos')->with($this->data); 
        }else{
            // $this->data['videos'] = \App\Albummedia::limit(4)->where('lang','=',\App::getLocale())->whereNotIn('id', [2, 4])->where('type','=','VIDEO')->orderby('id','DESC')->get();       
            $this->data['videos'] = \App\Albummedia::limit(4)->where('lang','=',\App::getLocale())->where('type','=','VIDEO')->orderby('id','DESC')->get();       
            $cats = \App\Album::where('type','VIDEO')->get();
            $this->data['cats'] = $cats;
            $this->data['title'] =  'تصنيفات الفيديوهات';

            return view('videos2')->with($this->data); 
        }
        
 
    }

    public function sounds($id = 0)
    {        
        if (!empty($id)) {
            $this->data['videos'] = \App\Albummedia::limit(9)->where('lang','=',\App::getLocale())->where('category_id',$id)->where('type','=','SOUND')->orderby('id','DESC')->get();  
            $cat = \App\Album::whereId($id)->first();
            $this->data['category'] =  $cat->title;      
            if ($cat->type != 'SOUND') {
                 return \Redirect::to('/');
            }
            return view('sounds')->with($this->data);
        }else{
            $this->data['sounds'] = \App\Albummedia::limit(4)->where('lang','=',\App::getLocale())->where('type','=','SOUND')->orderby('id','DESC')->get();       
            $cats = \App\Album::where('type','SOUND')->get();
            $this->data['cats'] = $cats;
            $this->data['title'] =  'تصنيفات الصوتيات';

            return view('sounds2')->with($this->data); 
        }
        
 
    }
    

    public function products($id = 0)
    {   
        if (intval($id) > 0) {
            $this->data['product'] = \App\Product::whereId($id)->first();
            $this->data['products'] = \App\Product::all();
            return view('oneproduct')->with($this->data);
        }else{            
            $this->data['products'] = \App\Product::all();
            return view('products')->with($this->data);
        }
    }

    public function partners($id = 0)
    {               
        if (intval($id) > 0) {
            $this->data['partner'] = \App\Partner::whereId($id)->first();
            $this->data['partners'] = \App\Partner::all();
            return view('onepartner')->with($this->data);
        }else{            
            $this->data['partners'] = \App\Partner::orderby('order','ASC')->get();
            return view('partners')->with($this->data);
        }        
    }


    public function postmaillist(Request $request)
    {
        if (\Request::isMethod('post')) {    
            $messages = [
                'email.required'    =>trans('cp.emailrequired'),
                'email.email'       =>trans('cp.emailemail'),
                'email.unique'       =>trans('cp.emailunique'),
            ];
            $validator = $this->validate($request, [
                'email'    => 'required|email|unique:maillist,email'
            ],$messages);

            \App\Maillist::create([
                'email' => \Input::get('email')
            ]);
            return \Redirect::back()->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }

    }








    protected function httpGetRequest($url, $parameters)
    {
        try {

            if(!empty($parameters)){
                $fields_string = '?';
                foreach ($parameters as $key => $value) {
                    $fields_string .= $key . '=' . $value . '&';
                }
                rtrim($fields_string, '&');
            } else {
                $fields_string = '';
            }
            // dd(substr($url.$fields_string,0, -1));
            $ch = curl_init();

            if (substr($url.$fields_string, -1) == '&') {
                $requrl = substr($url.$fields_string,0, -1);
            }else{
                $requrl = $url.$fields_string;
            }

            curl_setopt($ch, CURLOPT_URL, $requrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);

            $response = curl_exec($ch);

            // echo curl_errno($ch);
            // echo curl_error($ch);


            if ($response === false) {
                dd(curl_error($ch), curl_errno($ch));
                throw new \Exception(curl_error($ch), curl_errno($ch));
            }

            curl_close($ch);

            return $response;
        } catch (\Exception $ex) {
            throw new \Exception($ex->getMessage());
        }
    }

    public function recipesrate(){
        // dd(\Input::all());
        \App\Rating::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'value' => \Input::get('value'),
            'type' => \Input::get('type'),
            'type_id' => \Input::get('id'),
        ]);

        if (\Input::get('type') == 'RECIPE') {
            $product =  \App\Recipes::find(intval(\Input::get('id')));
            $newtotal = $product->rate_count;  
            // echo $product->rate.'----'.$product->rate_count;
            $product->update([
                'rate' => ((($product->rate*$newtotal)+\Input::get('value'))/($newtotal+1)),    
                'rate_count' => ($newtotal+1),
            ]);
            return ((($product->rate*$newtotal)+\Input::get('value'))/($newtotal+1));exit();
        }elseif (\Input::get('type') == 'PRODUCT') {
            $product =  \App\Product::find(intval(\Input::get('id')));
            $newtotal = $product->rate_count;
            $product->update([
                'rate' => ((($product->rate*$newtotal)+\Input::get('value'))/($newtotal+1)),    
                'rate_count' => ($newtotal+1),
            ]);
            return ((($product->rate*$newtotal)+\Input::get('value'))/($newtotal+1));exit();
        }

    }

    public function pollrate(){

        \App\Rating::create([
            'ip' => $_SERVER['REMOTE_ADDR'],
            'value' => \Input::get('value'),
            'type' => \Input::get('type'),
            'type_id' => \Input::get('id'),
        ]);

        $poll = \App\Polls::whereId(intval(\Input::get('id')))->with('answer_1')->with('answer_2')->with('answer_3')->with('answer_4')->first();
         try{
            $total = count($poll->answer_1)+count($poll->answer_2)+count($poll->answer_3)+count($poll->answer_4);
            $an1 = count($poll->answer_1)/$total*100;
            $an2 = count($poll->answer_2)/$total*100;
            $an3 = count($poll->answer_3)/$total*100;
            $an4 = count($poll->answer_4)/$total*100;         
        }catch(\Exception $e){
            $an1 = 0;
            $an2 = 0;
            $an3 = 0;
            $an4 = 0;   
        }
        

        return json_encode(array($an1,$an2,$an3,$an4));exit();
    }


    public function search(Request $request)
    {
        // dd(\Input::get('s'));
        $s = \Input::get('s');     

        $this->data['news'] = \App\News::where('status','=','ACTIVE')->where('category_id',2)->where('lang','=',\App::getLocale())->where(function($query) use ($s) {
                $query->where('title', 'LIKE', '%'.$s.'%');
                $query->orWhere('detail', 'LIKE', '%'.$s.'%');
            })->orderby('date','DESC')->paginate(20);

        $this->data['office'] = \App\News::where('status','=','ACTIVE')->where('category_id',1)->where('lang','=',\App::getLocale())->where(function($query) use ($s) {
                $query->where('title', 'LIKE', '%'.$s.'%');
                $query->orWhere('detail', 'LIKE', '%'.$s.'%');
            })->orderby('date','DESC')->paginate(20);
       
        $this->data['s'] = $s;

        return view('search')->with($this->data);

    }


    /***********************************************************/

    public function library($type = null)
    {
        if (!empty($type)) {
            $this->data['albumsmedia'] = \App\Albummedia::where('type','=','LIBRARY')->where('category_id',$type)->paginate(20);
            // $this->data['title'] = 'كتب عامة';

            $cat = \App\Album::whereId($type)->first();
            $this->data['title'] =  $cat->title;

            return view('book')->with($this->data);
        }else{        
            $cats = \App\Album::where('type','LIBRARY')->whereNotIn('id', [3, 6])->get();
            $this->data['cats'] = $cats;
            $this->data['title'] = 'مختارات قانونية';
         
            return view('library')->with($this->data);
        }


    }

    public function posts($id = 0)
    {        
                 
            $this->data['news'] = \App\News::where('status','=','ACTIVE')->where('category_id',3)->where('lang','=',\App::getLocale())->orderby('date','DESC')->paginate(20);
            $this->data['title'] = 'مقالات';
            return view('news')->with($this->data);
            
    }

    public function book()
    {        
        $this->data['albumsmedia'] = \App\Albummedia::where('type','=','LIBRARY')->where('category_id',3)->paginate(20);
        $this->data['title'] = 'كتب عامة';
        
        return view('book')->with($this->data);
            
    }

    public function searches()
    {        
        $this->data['albumsmedia'] = \App\Albummedia::where('type','=','LIBRARY')->where('category_id',6)->paginate(20);
        $this->data['title'] = 'بحوث ودراسات';
        
        return view('book')->with($this->data);
            
    }
    
     public function shadrat()
    {        
          $this->data['news'] = \App\News::where('status','=','ACTIVE')->where('category_id',10)->where('lang','=',\App::getLocale())->orderby('date','DESC')->paginate(20);
        
       //  return $this->data;
        $this->data['title'] = 'شذرات قانونية';
      
        
        return view('shadrat')->with($this->data);
            
    }
    
    
    
    
    public function consultation()
    {        
        return view('consultation')->with($this->data);
    }

    public function postconsultation(Request $request)
    {
        if (\Request::isMethod('post')) {    
            $messages = [
                'name.required'     =>trans('cp.namerequired'),
                'name.min'          =>trans('cp.namemin'),

                'email.required'    =>trans('cp.emailrequired'),
                'email.email'       =>trans('cp.emailemail'),

                'mobile.required' =>trans('cp.messagerequired'),
                'mobile.min'      =>trans('cp.messagemin'),
            ];
            $validator = $this->validate($request, [
                'name'     => 'required|min:3',
                'email'    => 'required|email',
                'mobile' => 'required|min:7',
            ],$messages);

            \App\Consultation::create([
                'name' => \Input::get('name'),        
                'email' => \Input::get('email'),       
                'mobile' => \Input::get('mobile'),  
            ]);

            /*******************************************************************************
            \Mail::send('emails.contactus',[ 'name'=>\Input::get('name') , 'email'=>\Input::get('email')  , 'subject'=>\Input::get('subject')  , 'message2'=>\Input::get('message')  ], function ($m) {                
                $m->from('test@watnie.com', 'Alsharq Website');            
                // $m->to('mohf_1992@hotmail.com' ,\Input::get('name') )->subject('اتصل بنا من - '.\Input::get('subject') );
                $m->to(\Cache::get('settings.email') ,\Input::get('name') )->subject('اتصل بنا من - '.\Input::get('subject') );
            });
            /*******************************************************************************/
            
            $this->sendSMS('AhmedNAbil','CC123123@',\Cache::get('settings.consultation_text_sms'),\Input::get('mobile'),'alfayez');
            
            /*******************************************************************************/

            return \Redirect::to('/consultation')->with(['success'=>trans('cp.oprationsuccess')]);
        }else{
            return \Redirect::back()->withErrors(['error'=>trans('cp.rownotfound')]);
        }

    }
    
    
    
    
    
    function sendSMS($oursmsusername,$oursmspassword,$messageContent,$mobileNumber,$senderName){
        
        $user = $oursmsusername;
        $password = $oursmspassword;
        $sendername = $senderName;
        $text = urlencode( $messageContent);
        $to = $mobileNumber;
        // auth call
         
        $url = "http://www.4jawaly.net/api/sendsms.php?username=$user&password=$password&numbers=$to&message=$text&sender=$sendername&unicode=E&return=full";

          $curl_handle=curl_init();
          curl_setopt($curl_handle,CURLOPT_URL,$url);
          curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
          curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
          $buffer = curl_exec($curl_handle);
          curl_close($curl_handle);
          if (empty($buffer)){
              print "Nothing returned from url.<p>";
          }
          else{
              print $buffer;
          }
      
    }
    
    

    
    
    

}