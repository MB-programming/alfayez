<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['middleware' => 'web'], function () {

    // Route::get('lang/{lang}',['as'=>'lang', function($lang)
    // {
    //     \Session::put('bintwar.language_locale', $lang);
    //     // dd($lang);
    //     return Redirect::back();
    // }]);

    Route::get('/', 'Site\HomeController@index');
    Route::get('/about', 'Site\HomeController@about');
    Route::get('/page/{id}', 'Site\HomeController@page');
    Route::get('/contactus', 'Site\HomeController@contactus');
    Route::post('/contactus/save', 'Site\HomeController@postcontactus');
    
    Route::get('/consultation', 'Site\HomeController@consultation');
    Route::post('/consultation/save', 'Site\HomeController@postconsultation');

    Route::get('apply_services/', 'Site\HomeController@apply_services');
    Route::post('/apply_services/save', 'Site\HomeController@postapply_services');

    Route::get('/faqs', 'Site\HomeController@faqs');
    Route::get('/office', 'Site\HomeController@office');
    Route::get('/news', 'Site\HomeController@news');
    Route::get('/news/{id}', 'Site\HomeController@news');
    Route::get('/skills/{id}', 'Site\HomeController@skills');
    Route::get('/skills/', 'Site\HomeController@skills');
    Route::get('/systems/{id}', 'Site\HomeController@systems');
    Route::get('/systems/', 'Site\HomeController@systems');
    Route::get('/events', 'Site\HomeController@events');
    Route::get('/events/{id}', 'Site\HomeController@events');
    Route::get('/products', 'Site\HomeController@products');
    Route::get('/products/{id}', 'Site\HomeController@products');
    Route::get('/partners', 'Site\HomeController@partners');
    Route::get('/partners/{id}', 'Site\HomeController@partners');
    Route::post('/maillist/save', 'Site\HomeController@postmaillist');
    Route::get('/board_of_directors', 'Site\HomeController@directors');
    Route::get('/jobs', 'Site\HomeController@jobs');
    // Route::get('/albums/{id}', 'Site\HomeController@albums');

    Route::get('/albums', 'Site\HomeController@albums');
    Route::get('/albums/{id}', 'Site\HomeController@albums');
    
    Route::post('/search', 'Site\HomeController@search');


    Route::get('/library', 'Site\HomeController@library');
    Route::get('/library/{type}', 'Site\HomeController@library');

    Route::get('/post', 'Site\HomeController@posts');
    Route::get('/book', 'Site\HomeController@book');
    Route::get('/searches', 'Site\HomeController@searches');
    Route::get('/shadrat', 'Site\HomeController@shadrat');

    Route::get('/videos', 'Site\HomeController@videos');
    Route::get('/videos/{id}', 'Site\HomeController@videos');

    Route::get('/sounds', 'Site\HomeController@sounds');
    Route::get('/sounds/{id}', 'Site\HomeController@sounds');

    // Route::post('/maillist/save', 'Site\HomeController@postmaillist');
    
});


Route::group(['middleware' => 'web','prefix' => config('app.prefix','Cpanel')], function () {
    
    Route::auth();
    Route::get('/', 'Admin\HomeController@index');
    Route::get('/home', 'Admin\HomeController@index');

    Route::get('/login', 'Auth\AuthController@authenticate');
    Route::post('/login', 'Auth\AuthController@authenticate');

    Route::get('/users', 'Admin\UsersController@index');    
    Route::get('/users/add', 'Admin\UsersController@add');    
    Route::post('/users/add', 'Admin\UsersController@add');    
    Route::get('/users/edit/{id}', 'Admin\UsersController@edit');    
    Route::post('/users/edit/{id}', 'Admin\UsersController@edit');    
    Route::get('/users/delete/{id}', 'Admin\UsersController@delete');

    Route::get('/users/permissions/{id}', 'Admin\UsersController@permissions');
    Route::post('/users/permissions/{id}', 'Admin\UsersController@permissions');

    Route::get('/categories', 'Admin\CategoriesController@index');    
    Route::get('/categories/add', 'Admin\CategoriesController@add');    
    Route::post('/categories/add', 'Admin\CategoriesController@add');    
    Route::get('/categories/edit/{id}', 'Admin\CategoriesController@edit');    
    Route::post('/categories/edit/{id}', 'Admin\CategoriesController@edit');    
    Route::get('/categories/delete/{id}', 'Admin\CategoriesController@delete');

    Route::get('/pages', 'Admin\PageController@index');    
    Route::get('/pages/add', 'Admin\PageController@add');    
    Route::post('/pages/add', 'Admin\PageController@add');    
    Route::get('/pages/edit/{id}', 'Admin\PageController@edit');    
    Route::post('/pages/edit/{id}', 'Admin\PageController@edit');    
    Route::get('/pages/delete/{id}', 'Admin\PageController@delete');

    Route::get('/managers', 'Admin\ManagerController@index');    
    Route::get('/managers/add', 'Admin\ManagerController@add');    
    Route::post('/managers/add', 'Admin\ManagerController@add');    
    Route::get('/managers/edit/{id}', 'Admin\ManagerController@edit');    
    Route::post('/managers/edit/{id}', 'Admin\ManagerController@edit');    
    Route::get('/managers/delete/{id}', 'Admin\ManagerController@delete');

    Route::get('/skills', 'Admin\SkillsController@index');    
    Route::get('/skills/add', 'Admin\SkillsController@add');    
    Route::post('/skills/add', 'Admin\SkillsController@add');    
    Route::get('/skills/edit/{id}', 'Admin\SkillsController@edit');    
    Route::post('/skills/edit/{id}', 'Admin\SkillsController@edit');    
    Route::get('/skills/delete/{id}', 'Admin\SkillsController@delete');

    Route::get('/systems', 'Admin\SystemsController@index');    
    Route::get('/systems/add', 'Admin\SystemsController@add');    
    Route::post('/systems/add', 'Admin\SystemsController@add');    
    Route::get('/systems/edit/{id}', 'Admin\SystemsController@edit');    
    Route::post('/systems/edit/{id}', 'Admin\SystemsController@edit');    
    Route::get('/systems/delete/{id}', 'Admin\SystemsController@delete');

    Route::get('/news', 'Admin\NewsController@index');    
    Route::get('/news/add', 'Admin\NewsController@add');    
    Route::post('/news/add', 'Admin\NewsController@add');    
    Route::get('/news/edit/{id}', 'Admin\NewsController@edit');    
    Route::post('/news/edit/{id}', 'Admin\NewsController@edit');    
    Route::get('/news/delete/{id}', 'Admin\NewsController@delete');

    Route::get('/partners', 'Admin\PartnerController@index');    
    Route::get('/partners/add', 'Admin\PartnerController@add');    
    Route::post('/partners/add', 'Admin\PartnerController@add');    
    Route::get('/partners/edit/{id}', 'Admin\PartnerController@edit');    
    Route::post('/partners/edit/{id}', 'Admin\PartnerController@edit');    
    Route::get('/partners/delete/{id}', 'Admin\PartnerController@delete');

    // Route::get('/partners/order', 'Admin\PartnerController@saveorder');
    Route::post('/partners/order', array( 'as' => 'partners/order' , 'uses' => function() 
    {
        //dd(Input::all());
        if (count(Input::get('ides')) > 0 ) {
            foreach (Input::get('ides') as $key => $value) {
                $partner = \App\Partner::find(intval($value));
                $partner->order = (intval($key)+1);
                $partner->save();
            }
        }
        return \Redirect::back()->with(['success'=>trans('cp.oprationsuccess')]);
    }));

    Route::get('/products', 'Admin\ProductController@index');    
    Route::get('/products/add', 'Admin\ProductController@add');    
    Route::post('/products/add', 'Admin\ProductController@add');    
    Route::get('/products/edit/{id}', 'Admin\ProductController@edit');    
    Route::post('/products/edit/{id}', 'Admin\ProductController@edit');    
    Route::get('/products/delete/{id}', 'Admin\ProductController@delete');

    Route::get('/sliders', 'Admin\SliderController@index');    
    Route::get('/sliders/add', 'Admin\SliderController@add');    
    Route::post('/sliders/add', 'Admin\SliderController@add');    
    Route::get('/sliders/edit/{id}', 'Admin\SliderController@edit');    
    Route::post('/sliders/edit/{id}', 'Admin\SliderController@edit');    
    Route::get('/sliders/delete/{id}', 'Admin\SliderController@delete');

    Route::get('/faqs', 'Admin\FaqController@index');    
    Route::get('/faqs/add', 'Admin\FaqController@add');    
    Route::post('/faqs/add', 'Admin\FaqController@add');    
    Route::get('/faqs/edit/{id}', 'Admin\FaqController@edit');    
    Route::post('/faqs/edit/{id}', 'Admin\FaqController@edit');    
    Route::get('/faqs/delete/{id}', 'Admin\FaqController@delete');

    Route::get('/settings/', 'Admin\SettingsController@index');
    Route::post('/settings/save', 'Admin\SettingsController@postUpdate');


     Route::get('/langs/', 'Admin\LangController@index');
    Route::post('/langs/save', 'Admin\LangController@postUpdate');

    Route::get('/contactus', 'Admin\ContactController@index');  
    Route::get('/contactus/edit/{id}', 'Admin\ContactController@edit');    
    Route::post('/contactus/edit/{id}', 'Admin\ContactController@edit');    
    Route::get('/contactus/delete/{id}', 'Admin\ContactController@delete');
    
    
    
    Route::get('/consultation', 'Admin\ConsultationController@index');  
    Route::get('/consultation/edit/{id}', 'Admin\ConsultationController@edit');    
    Route::post('/consultation/edit/{id}', 'Admin\ConsultationController@edit');    
    Route::get('/consultation/delete/{id}', 'Admin\ConsultationController@delete');
    

    Route::get('/maillist', 'Admin\MaillistController@index');  
    Route::get('/maillist/delete/{id}', 'Admin\MaillistController@delete');

    Route::get('/events', 'Admin\EventController@index');    
    Route::get('/events/add', 'Admin\EventController@add');    
    Route::post('/events/add', 'Admin\EventController@add');    
    Route::get('/events/edit/{id}', 'Admin\EventController@edit');    
    Route::post('/events/edit/{id}', 'Admin\EventController@edit');    
    Route::get('/events/delete/{id}', 'Admin\EventController@delete');

    Route::get('/jobs', 'Admin\JobController@index');    
    Route::get('/jobs/add', 'Admin\JobController@add');    
    Route::post('/jobs/add', 'Admin\JobController@add');    
    Route::get('/jobs/edit/{id}', 'Admin\JobController@edit');    
    Route::post('/jobs/edit/{id}', 'Admin\JobController@edit');    
    Route::get('/jobs/delete/{id}', 'Admin\JobController@delete');

    Route::get('/albums', 'Admin\AlbumController@index');    
    Route::get('/albums/add', 'Admin\AlbumController@add');    
    Route::post('/albums/add', 'Admin\AlbumController@add');    
    Route::get('/albums/edit/{id}', 'Admin\AlbumController@edit');    
    Route::post('/albums/edit/{id}', 'Admin\AlbumController@edit');    
    Route::get('/albums/delete/{id}', 'Admin\AlbumController@delete');

    Route::get('/category/{type}', 'Admin\MediacategoryController@index');  
    Route::get('/category/{type}/add', 'Admin\MediacategoryController@add');    
    Route::post('/category/{type}/add', 'Admin\MediacategoryController@add');    
    Route::get('/category/{type}/edit/{id}', 'Admin\MediacategoryController@edit');    
    Route::post('/category/{type}/edit/{id}', 'Admin\MediacategoryController@edit');    
    Route::get('/category/delete/{type}/{id}', 'Admin\MediacategoryController@delete');


    Route::get('/albummedias/{category_id}', 'Admin\AlbummediamediaController@index');    
    Route::get('/albummedias/{category_id}/add', 'Admin\AlbummediamediaController@add');    
    Route::post('/albummedias/{category_id}/add', 'Admin\AlbummediamediaController@add');    
    Route::get('/albummedias/{category_id}/edit/{id}', 'Admin\AlbummediamediaController@edit');    
    Route::post('/albummedias/{category_id}/edit/{id}', 'Admin\AlbummediamediaController@edit');    
    Route::get('/albummedias/{category_id}/delete/{id}', 'Admin\AlbummediamediaController@delete');

    Route::get('/sounds/{category_id}', 'Admin\SoundController@index');    
    Route::get('/sounds/{category_id}/add', 'Admin\SoundController@add');    
    Route::post('/sounds/{category_id}/add', 'Admin\SoundController@add');    
    Route::get('/sounds/{category_id}/edit/{id}', 'Admin\SoundController@edit');    
    Route::post('/sounds/{category_id}/edit/{id}', 'Admin\SoundController@edit');    
    Route::get('/sounds/{category_id}/delete/{id}', 'Admin\SoundController@delete');

    Route::get('/librarys/{category_id}', 'Admin\LibrarysController@index');    
    Route::get('/librarys/{category_id}/add', 'Admin\LibrarysController@add');    
    Route::post('/librarys/{category_id}/add', 'Admin\LibrarysController@add');    
    Route::get('/librarys/{category_id}/edit/{id}', 'Admin\LibrarysController@edit');    
    Route::post('/librarys/{category_id}/edit/{id}', 'Admin\LibrarysController@edit');    
    Route::get('/librarys/{category_id}/delete/{id}', 'Admin\LibrarysController@delete');

    Route::get('/files', 'Admin\FileController@index');    
    Route::get('/files/add', 'Admin\FileController@add');    
    Route::post('/files/add', 'Admin\FileController@add');    
    Route::get('/files/edit/{id}', 'Admin\FileController@edit');    
    Route::post('/files/edit/{id}', 'Admin\FileController@edit');    
    Route::get('/files/delete/{id}', 'Admin\FileController@delete');


});
