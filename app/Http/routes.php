<?php

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

Route::group(['prefix' => 'dashboard', 'middleware' => 'admin'], function () {
    Route::auth();


// Dashboard
    Route::get('/home', 'AdminController@index')->name('dashboard.home');


//// USERS ////
// User Information
    Route::get('/newUser', 'UserController@newUser')->name('dashboard.new.user');
    Route::get('/userList', 'UserController@userList')->name('dashboard.user.list');
    Route::get('/editUser/{user}', 'UserController@edit')->name('dashboard.edit.user');
    Route::post('/saveNewUser', 'UserController@saveUser')->name('dashboard.save.new.user');
    Route::get('/userDelete/{user}', 'UserController@destroy')->name('dashboard.user.delete');
    Route::post('/saveUpdateUser', 'UserController@saveUpdateUser')->name('dashboard.save.update.user');
    Route::get('/roleUser/{id}', 'UserController@roleUser')->name('dashboard.role.user');
    Route::get('/attachRole/{id}', 'UserController@attachRole')->name('dashboard.attach.role');
    Route::get('/detachRole/{id}', 'UserController@detachRole')->name('dashboard.detach.role');
// Roles
    Route::get('/roles', 'SecurityController@roleList')->name('dashboard.roles');
    Route::get('/addRole', 'SecurityController@addRole')->name('dashboard.add.role');
    Route::post('/saveRole', 'SecurityController@saveRole')->name('dashboard.save.role');
    Route::get('/assignRole', 'SecurityController@assignRole')->name('dashboard.assign.role');
    Route::get('/editRole/{id}', 'SecurityController@editRole')->name('dashboard.edit.role');
    Route::post('/saveEditRole', 'SecurityController@saveEditRole')->name('dashboard.save.edit.role');
    Route::get('/deleteRole/{id}', 'SecurityController@deleteRole')->name('dashboard.delete.role');
// Permissions
    Route::get('/permissions', 'SecurityController@permissionList')->name('dashboard.permissions');
    Route::get('/addPermission', 'SecurityController@addPermission')->name('dashboard.add.permission');
    Route::post('/savePermission', 'SecurityController@savePermission')->name('dashboard.save.permission');
    Route::get('/assignPermission', 'SecurityController@assignPermission')->name('dashboard.assign.permission');
    Route::get('/editPermission/{id}', 'SecurityController@editPermission')->name('dashboard.edit.permission');
    Route::post('/saveEditPermission', 'SecurityController@saveEditPermission')->name('dashboard.save.edit.permission');
    Route::get('/deletePermission/{id}', 'SecurityController@deletePermission')->name('dashboard.delete.permission');
    Route::get('/permissionRole/{id}', 'SecurityController@permissionRole')->name('dashboard.permission.role');
    Route::get('/attachPermission/{permissionId}/{roleId}', 'SecurityController@attachPermission')->name('dashboard.attach.permission');
    Route::get('/detachPermission/{permissionId}/{roleId}', 'SecurityController@detachPermission')->name('dashboard.detach.permission');


//// Pages ////
    // List all pages
    Route::get('/listPages', 'PageController@index')->name('dashboard.list.pages');

    // Edit the page
    Route::get('/editPage/{id}', 'PageController@edit')->name('dashboard.edit.page');
    Route::post('/saveUpdatePage', 'PageController@update')->name('dashboard.save.update.page');

    // remove the page
    Route::get('/deletePage/{id}', 'PageController@destroy')->name('dashboard.delete.page');
    Route::get('/undeletePage/{id}', 'PageController@undestroy')->name('dashboard.undelete.page');

    // Add Page
    Route::get('/newPage', 'PageController@create')->name('dashboard.new.page');
    Route::post('/savePage', 'PageController@store')->name('dashboard.save.page');

    // Page Images
    Route::get('/imagesPage/{id}', 'PageController@imagesPage')->name('dashboard.images.page');
    Route::get('/attachImagePage/{pageId}/{imageId}', 'PageController@attachImagePage')->name('dashboard.attach.image.page');
    Route::get('/detachImagePage/{pageId}/{imageId}', 'PageController@detachImagePage')->name('dashboard.detach.image.page');



//// Images ////
    // create images
    Route::get('/newImage', 'ImageController@create')->name('dashboard.new.image');
    Route::post('/saveImage', 'ImageController@store')->name('dashboard.save.image');

    // List Images
    Route::get('/listImages', 'ImageController@index')->name('dashboard.list.images');

    // Delete Images
    Route::get('/deleteImage/{id}', 'ImageController@destroy')->name('dashboard.delete.image');
    Route::get('/reanimateImage/{id}', 'ImageController@reanimate')->name('dashboard.reanimate.image');

//// Analytics
    // pageAnalytics
    Route::get('/pageAnalytics', 'TrackingController@pageAnalytics')->name('dashboard.page.analytics');
    // pageUsers
    Route::get('/pageUsers/{id}', 'TrackingController@pageUsers')->name('dashboard.page.users');
    // trackedUser
    Route::get('/trackedUser/{id}', 'TrackingController@trackedUser')->name('dashboard.tracked.user');


//// Forwards
    // add
    Route::get('/addForward', 'ForwardController@create')->name('dashboard.add.forward');
    Route::post('/saveForward', 'ForwardController@store')->name('dashboard.save.forward');

    // list
    Route::get('/listForwards', 'ForwardController@index')->name('dashboard.list.forwards');

    // remove
    Route::get('/deleteForward/{id}', 'ForwardController@destroy')->name('dashboard.delete.forward');


//// Products
    // List
    Route::get('/listProducts', 'ProductController@index')->name('dashboard.list.products');
    // Add
    Route::get('/addProduct', 'ProductController@create')->name('dashboard.add.product');
    Route::post('/addProduct', 'ProductController@store')->name('dashboard.save.product');
    // Edit
    Route::get('/editProducts/{id}', 'ProductController@edit')->name('dashboard.edit.product');
    Route::post('/saveEditProduct', 'ProductController@update')->name('dashboard.save.update.product');

    // Remove
    Route::get('/removeProduct/{id}', 'ProductController@delete')->name('dashboard.remove.product');
    // Restore
    Route::get('/restoreProduct/{id}', 'ProductController@restore')->name('dashboard.restore.product');
    // Destory
    Route::get('/destoryProduct/{id}', 'ProductController@destory')->name('dashboard.destroy.product');
    // Product Images
    Route::get('/productImages', 'ProductController@index')->name('dashboard.product.images');


//// Categories
    // List
    Route::get('/listCategory', 'CategoryController@index')->name('dashboard.list.categories');
    // Add
    Route::get('/addCategory', 'CategoryController@create')->name('dashboard.add.category');
    Route::post('/addCategory', 'CategoryController@store')->name('dashboard.save.category');
    // Edit
    Route::get('/editCategory/{id}', 'CategoryController@edit')->name('dashboard.edit.category');
    Route::post('/saveEditCategory', 'CategoryController@update')->name('dashboard.save.update.category');
    // Remove
    Route::get('/deleteCategory/{id}', 'CategoryController@delete')->name('dashboard.remove.category');
    // Destory
    Route::get('/destoryCategory/{id}', 'CategoryController@destroy')->name('dashboard.destroy.category');
    // Restore
    Route::get('/restoreCategory/{id}', 'CategoryController@restore')->name('dashboard.restore.category');
});


Route::get('/dashboard/', function(){
    return redirect('/dashboard/home');
});


Route::group(['middleware' => ['web', 'tracking']], function () {

    Route::get('/', function(){
        return redirect('/home.html');
    });

    // contact forms
    Route::post('/contactForms/1', 'ContactFormController@formOne');

    // site
    Route::get('/{url}.html', 'SiteController@index');

    // tracking
    Route::get('/forward/', 'ForwardController@forward');

    // Postcode
    Route::post('/postPostcode', 'PostcodeController@postPostcode');

});


Route::group(['middleware' => ['api']], function () {
    // TrackingClick
    Route::post('/trackingClick', 'TrackingController@trackingClick');
});
