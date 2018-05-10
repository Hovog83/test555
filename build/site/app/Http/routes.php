<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group([
    'namespace' => 'back',
    'prefix'    => 'admin'
], function () {
    Route::group(['middleware' => ['web','admin']], function () {
        /*IndexController*/
        Route::get('/', [
            'uses' => "IndexController@index",
            'as'   => 'admin.index.index'
        ]);        
        /*CategorieController*/
        Route::get('/categorie', [
            'uses' => "CategorieController@index",
            'as'   => 'admin.categorie.index'
        ]);
        /*CategorieController  Edit*/
        Route::any('categorie/edit/{id}', [
            'uses' => "CategorieController@addEdit",
            'as'   => 'admin.categorie.edit'
        ]);       
        /*CategorieController create */
        Route::any('categorie/create', [
            'uses' => "CategorieController@addEdit",
            'as'   => 'admin.categorie.create'
        ]);   
        Route::any('categorie/anyData', [
            'uses' => "CategorieController@anyData",
            'as'   => 'admin.categorie.create'
        ]);   
        Route::any('categorie/sortTable', ['uses' => "CategorieController@sortTable"]);
        Route::get('categorie/delete/{id}', ['uses' => "CategorieController@delete"]);
         // sub cat
        /*SubcategoryController*/
            Route::get('/subcategory', [
                'uses' => "SubcategoryController@index",
                'as'   => 'admin.subcategory.index'
            ]);
            /*SubcategoryController  Edit*/
            Route::any('subcategory/edit/{id}', [
                'uses' => "SubcategoryController@addEdit",
                'as'   => 'admin.subcategory.edit'
            ]);       
            /*SubcategoryController create */
            Route::any('subcategory/create', [
                'uses' => "SubcategoryController@addEdit",
                'as'   => 'admin.subcategory.create'
            ]);   
            Route::any('subcategory/anyData', [
                'uses' => "SubcategoryController@anyData",
                'as'   => 'admin.subcategory.create'
            ]);   
            Route::get('subcategory/delete/{id}', ['uses' => "SubcategoryController@delete"]);
            Route::any('subcategory/sortTable', ['uses' => "SubcategoryController@sortTable"]);
        // sub catEnD
             // ServiceController 
            /*ServiceController*/
                Route::get('/service', [
                    'uses' => "ServiceController@index",
                    'as'   => 'admin.service.index'
                ]);
                /*ServiceController  Edit*/
                Route::any('service/edit/{id}', [
                    'uses' => "ServiceController@addEdit",
                    'as'   => 'admin.service.edit'
                ]);       
                /*ServiceController create */
                Route::any('service/create', [
                    'uses' => "ServiceController@addEdit",
                    'as'   => 'admin.service.create'
                ]);   
                Route::any('service/anyData/{type?}', [
                    'uses' => "ServiceController@anyData",
                    'as'   => 'admin.service.create'
                ]);   
                Route::get('service/delete/{id}', ['uses' => "ServiceController@delete"]);
                Route::any('service/sortImages', ['uses' => "ServiceController@sortImages"]);
                Route::any('service/deleteImages/{id}', ['uses' => "ServiceController@deleteImages"]);
                Route::any('service/setMainImages/{id}/{services}', ['uses' => "ServiceController@setMainImages"]);
                Route::any('service/getSubCat/{id?}', ['uses' => "ServiceController@getSubCat"]);
            // ServiceController catEnD

                    Route::any('service/type/{approved}', [
                        'uses' => "ServiceController@type",
                        'as'   => 'admin.service.type.typeApproved'
                    ]);   
                    Route::any('service/type/{new}', [
                        'uses' => "ServiceController@type",
                        'as'   => 'admin.service.type.typeNew'
                    ]);               
                    Route::any('service/type/{blocked}', [
                        'uses' => "ServiceController@type",
                        'as'   => 'admin.service.type.typeBlocked'
                    ]);          
                      
                    Route::any('service/type/{delete}', [
                        'uses' => "ServiceController@type",
                        'as'   => 'admin.service.type.typeDelete'
                    ]);          

        // user 
            /*UserController*/
            Route::get('/user', [
                'uses' => "UserController@index",
                'as'   => 'admin.user.index'
            ]);
            /*UserController  Edit*/
            Route::any('user/edit/{id}', [
                'uses' => "UserController@addEdit",
                'as'   => 'admin.user.edit'
            ]);       
            /*UserController create */
            Route::any('user/create', [
                'uses' => "UserController@addEdit",
                'as'   => 'admin.user.create'
            ]);   
            Route::any('user/anyData', [
                'uses' => "UserController@anyData",
                'as'   => 'admin.user.create'
            ]);   
           Route::get('user/delete/{id}', ['uses' => "UserController@delete"]);
        // end user

        // menu 
            /*menuController*/
            Route::get('/menu', [
            'uses' => "menuController@index",
            'as'   => 'admin.menu.index'
            ]);
            /*menuController  Edit*/
            Route::any('menu/edit/{id}', [
            'uses' => "menuController@addEdit",
            'as'   => 'admin.menu.edit'
            ]);       
            /*menuController create */
            Route::any('menu/create', [
            'uses' => "menuController@addEdit",
            'as'   => 'admin.menu.create'
            ]);   
            Route::any('menu/anyData', [
            'uses' => "menuController@anyData",
            'as'   => 'admin.menu.create'
            ]);              

            Route::get('menu/delete/{id}', ['uses' => "menuController@delete"]);

            Route::get('menu/view/{id}', [
                'uses' => "MenuPagesController@view",
                'as'   => 'admin.menu.view'
            ]);         
            Route::get('MenuPages/isPageCheckedSave', [
                'uses' => "MenuPagesController@isPageCheckedSave",
                'as'   => 'admin.menu.isPageCheckedSave'
            ]);         
            Route::get('MenuPages/sortTable', [
                'uses' => "MenuPagesController@sortTable",
                'as'   => 'admin.menu.sortTable'
            ]);
        // menu EnD
            // pages 
            /*PagesController*/
            Route::get('/pages', [
            'uses' => "PagesController@index",
            'as'   => 'admin.pages.index'
            ]);
            /*PagesController  Edit*/
            Route::any('pages/edit/{id}', [
            'uses' => "PagesController@addEdit",
            'as'   => 'admin.pages.edit'
            ]);       
            /*PagesController create */
            Route::any('pages/create', [
            'uses' => "PagesController@addEdit",
            'as'   => 'admin.pages.create'
            ]);   
            Route::any('pages/anyData', [
            'uses' => "PagesController@anyData",
            'as'   => 'admin.pages.create'
            ]);   
            Route::get('pages/delete/{id}', ['uses' => "PagesController@delete"]);
            Route::any('pages/sortTable', ['uses' => "PagesController@sortTable"]);
        // pages EnD

          // images
             Route::any('/images', [
            'uses' => "ImagesController@add",
            'as'   => 'admin.images.add'
            ]);   
             Route::any('/images/deleteImages/{id}', [
            'uses' => "ImagesController@deleteImages",
            'as'   => 'admin.images.deleteImages'
            ]);   
        // images EnD


             /*LangController*/
             Route::get('language', [
                 'uses' => "LanguageController@index",
                 'as'   => 'admin.lang.list'
             ]);
             Route::any('language/edit/{id?}', [
                 'uses' => "LanguageController@edit",
                 'as'   => 'admin.lang.edit'
             ]);
             Route::get('language/delete/{id}', ['uses' => "LanguageController@delete"]);
    });
});
Route::group([
    'namespace' => 'front',
    'middleware' => [
        'language',
        'web'
    ],
    'prefix' => '{lang?}'
], function(){
Route::get('check', function () {
    // Retrieve a piece of data from the session...
    $value = session('key');

    // Store a piece of data in the session...
    session(['key' => 'value']);
});
    Route::any('/auth', ['uses' => 'UserController@auth']);
    Route::any('/login/active/{token}', ['uses' => 'UserController@active']);
    Route::any('/user', ['uses' => 'UserController@userAccount']);
    Route::any('/reset', ['uses' => 'UserController@reset']);
    Route::any('/logout', ['uses' => 'UserController@logout']);
    Route::any('/user/reset', ['uses' => 'UserController@logout']);
    Route::any('/password/reset/{token}', ['uses' => 'UserController@changePassword']);
    Route::any('/pages/{slug}', [
            'uses' => 'PagesController@index',
            'as'   => 'front.page.index'
        ]);    
    Route::any('/menu/{cat?}/{subCat?}', [
            'uses' => 'ServicesController@index',
            'as'   => 'front.page.index'
        ]);    
    Route::any('/service/{id?}', [
            'uses' => 'ServiceController@index',
            'as'   => 'front.page.index'
        ]);   
 Route::any('/check/{id}', [
            'uses' => 'ServiceController@check',
            'as'   => 'front.page.check'
        ]);




    /*AccountController*/
        Route::get('classifieds', [
            'uses' => "AccountController@index",
            'as'   => 'front.service.index'
        ]);
        /*AccountController  Edit*/
        Route::any('classifieds/edit/{id}', [
            'uses' => "AccountController@addEdit",
            'as'   => 'front.service.edit'
        ]);       
        /*AccountController create */
        Route::any('classifieds/create', [
            'uses' => "AccountController@addEdit",
            'as'   => 'front.service.create'
        ]);   
        Route::any('classifieds/anyData/{type?}', [
            'uses' => "AccountController@anyData",
            'as'   => 'front.service.create'
        ]);   
        Route::get('classifieds/delete/{id}', ['uses' => "AccountController@delete"]);
        Route::any('classifieds/sortImages', ['uses' => "AccountController@sortImages"]);
        Route::any('classifieds/deleteImages/{id}', ['uses' => "AccountController@deleteImages"]);
        Route::any('classifieds/setMainImages/{id}/{services}', ['uses' => "AccountController@setMainImages"]);
        Route::any('classifieds/getSubCat/{id?}', ['uses' => "AccountController@getSubCat"]);
    // AccountController catEnD







    Route::get('{action}/{a?}',  function($lang){
        return redirect($lang . '/');
    });
    Route::get('/', [
            'uses' => 'IndexController@index',
            'as'   => 'front.index'
        ]);
    Route::any('/admin', ['uses' => 'IndexController@index']);






});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
