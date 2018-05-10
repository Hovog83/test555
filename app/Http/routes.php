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

    Route::group(array('middleware'  => ['web','admin']), function ()
    {
        
        Route::get('/laravel-filemanager', '\Unisharp\Laravelfilemanager\controllers\LfmController@show');
        Route::post('/laravel-filemanager/upload', '\Unisharp\Laravelfilemanager\controllers\LfmController@upload');
       
        // Show integration error messages
        Route::get('/laravel-filemanager/errors', [
            'uses' => '\Unisharp\Laravelfilemanager\controllers\LfmController@getErrors',
            'as' => 'getErrors',
        ]);
        // upload
        Route::any('/laravel-filemanager/upload', [
            'uses' => 'UploadController@upload',
            'as' => 'upload',
        ]);
        // list images & files
        Route::get('/laravel-filemanager/jsonitems', [
            'uses' => 'ItemsController@getItems',
            'as' => 'getItems',
        ]);
        // folders
        Route::get('/laravel-filemanager/newfolder', [
            'uses' => 'FolderController@getAddfolder',
            'as' => 'getAddfolder',
        ]);
        Route::get('/laravel-filemanager/deletefolder', [
            'uses' => 'FolderController@getDeletefolder',
            'as' => 'getDeletefolder',
        ]);
        Route::get('/laravel-filemanager/folders', [
            'uses' => 'FolderController@getFolders',
            'as' => 'getFolders',
        ]);
        // crop
        Route::get('/laravel-filemanager/crop', [
            'uses' => 'CropController@getCrop',
            'as' => 'getCrop',
        ]);
        Route::get('/laravel-filemanager/cropimage', [
            'uses' => 'CropController@getCropimage',
            'as' => 'getCropimage',
        ]);
        Route::get('/laravel-filemanager/cropnewimage', [
            'uses' => 'CropController@getNewCropimage',
            'as' => 'getCropimage',
        ]);
        // rename
        Route::get('/laravel-filemanager/rename', [
            'uses' => 'RenameController@getRename',
            'as' => 'getRename',
        ]);
        // scale/resize
        Route::get('/laravel-filemanager/resize', [
            'uses' => 'ResizeController@getResize',
            'as' => 'getResize',
        ]);
        Route::get('/laravel-filemanager/doresize', [
            'uses' => 'ResizeController@performResize',
            'as' => 'performResize',
        ]);
        // download
        Route::get('/laravel-filemanager/download', [
            'uses' => 'DownloadController@getDownload',
            'as' => 'getDownload',
        ]);
        // delete
        Route::get('/laravel-filemanager/delete', [
            'uses' => 'DeleteController@getDelete',
            'as' => 'getDelete',
        ]);
    });

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
       
    // TaskController 
    /*TaskController*/
        Route::get('/task', [
            'uses' => "TaskController@index",
            'as'   => 'admin.task.index'
        ]);
        /*TaskController  Edit*/
        Route::any('task/edit/{id}', [
            'uses' => "TaskController@addEdit",
            'as'   => 'admin.task.edit'
        ]);       
        /*TaskController create */
        Route::any('task/create', [
            'uses' => "TaskController@addEdit",
            'as'   => 'admin.task.create'
        ]);   
        Route::any('task/anyData', [
            'uses' => "TaskController@anyData",
            'as'   => 'admin.task.create'
        ]);   
        Route::get('task/delete/{id}', ['uses' => "TaskController@delete"]);
        Route::any('task/sortTable', ['uses' => "TaskController@sortTable"]);
    /* end TaskController*/


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

    });
});
Route::group([
    'namespace' => 'front',
    'middleware' => [
        'web',
        'login'
    ],
], function(){
    Route::any('/auth', ['uses' => 'UserController@auth']);
    Route::any('/login', ['uses' => 'UserController@login']);
    Route::any('/logout', ['uses' => 'UserController@logout']);
    Route::get('/', [
            'uses' => 'UserController@login',
            'as'   => 'front.index'
        ]);
});
Route::group([
    'namespace' => 'user',
    'prefix'    => 'user',
    'middleware' => [
        'web',
        'users'
    ],
], function(){
    Route::get('/', [
            'uses' => 'IndexController@index',
            'as'   => 'front.index'
        ]);
    Route::any('/logout', ['uses' => 'UserController@logout']);
});
