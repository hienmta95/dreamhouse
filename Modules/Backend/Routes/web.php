<?php

Route::group(['prefix' => 'admin'], function() {

    config(['session.cookie' => 'dreamhouse_admin_cookie']);

    Route::get('/login', 'BackendLoginController@showLoginForm')->name('backend.login');
    Route::post('/login', 'BackendLoginController@login')->name('backend.login.submit');
    Route::get('/logout', 'BackendLoginController@logout')->name('backend.logout');

    // indexData
    Route::get('/user/indexData', 'UserController@indexData')->name('backend.user.indexData');
    Route::get('/room/indexData', 'RoomController@indexData')->name('backend.room.indexData');
    Route::get('/category/indexData', 'CategoryController@indexData')->name('backend.category.indexData');
    Route::get('/product/indexData', 'ProductController@indexData')->name('backend.product.indexData');
    Route::get('/linhvuc/indexData', 'LinhvucController@indexData')->name('backend.linhvuc.indexData');
    Route::get('/hoatdong/indexData', 'HoatdongController@indexData')->name('backend.hoatdong.indexData');
    Route::get('/page/indexData', 'PageController@indexData')->name('backend.page.indexData');
    Route::get('/lienhe/indexData', 'LienheController@indexData')->name('backend.lienhe.indexData');
    Route::get('/slide/indexData', 'SlideController@indexData')->name('backend.slide.indexData');
    Route::get('/section/{position}/indexData', 'SectionController@indexData')->name('backend.section.indexData');

    Route::post('/room/image/delete/{room_id}', 'RoomController@deleteImage')->name('backend.room.image.delete');
    Route::post('/product/image/delete/{product_id}', 'ProductController@deleteImage')->name('backend.product.image.delete');
    Route::post('/upload', 'ProductController@uploadImage')->name('backend.uploadPhoto');

    Route::group(['middleware' => ['adminLogin']], function() {

        Route::get('/', 'ProductController@index')->name('backend.dashboard');

        // Management
        Route::get('/user', 'UserController@index')->name('backend.user.index');
        Route::get('/user/create', 'UserController@create')->name('backend.user.create');
        Route::post('/user', 'UserController@store')->name('backend.user.store');
        Route::get('/user/view/{id}', 'UserController@show')->name('backend.user.show');
        Route::get('/user/update/{id}', 'UserController@edit')->name('backend.user.edit');
        Route::put('/user/update/{id}', 'UserController@update')->name('backend.user.update');
        Route::delete('/user/delete/{id}', 'UserController@destroy')->name('backend.user.destroy');

        // Management
        Route::get('/room', 'RoomController@index')->name('backend.room.index');
        Route::get('/room/create', 'RoomController@create')->name('backend.room.create');
        Route::post('/room', 'RoomController@store')->name('backend.room.store');
        Route::get('/room/view/{id}', 'RoomController@show')->name('backend.room.show');
        Route::get('/room/update/{id}', 'RoomController@edit')->name('backend.room.edit');
        Route::put('/room/update/{id}', 'RoomController@update')->name('backend.room.update');
        Route::delete('/room/delete/{id}', 'RoomController@destroy')->name('backend.room.destroy');

        // Management
        Route::get('/category', 'CategoryController@index')->name('backend.category.index');
        Route::get('/category/create', 'CategoryController@create')->name('backend.category.create');
        Route::post('/category', 'CategoryController@store')->name('backend.category.store');
        Route::get('/category/view/{id}', 'CategoryController@show')->name('backend.category.show');
        Route::get('/category/update/{id}', 'CategoryController@edit')->name('backend.category.edit');
        Route::put('/category/update/{id}', 'CategoryController@update')->name('backend.category.update');
        Route::delete('/category/delete/{id}', 'CategoryController@destroy')->name('backend.category.destroy');
        Route::get('/category/ajax', 'CategoryController@ajax')->name('backend.category.ajax');

        // Management
        Route::get('/product', 'ProductController@index')->name('backend.product.index');
        Route::get('/product/create', 'ProductController@create')->name('backend.product.create');
        Route::post('/product', 'ProductController@store')->name('backend.product.store');
        Route::get('/product/view/{id}', 'ProductController@show')->name('backend.product.show');
        Route::get('/product/update/{id}', 'ProductController@edit')->name('backend.product.edit');
        Route::put('/product/update/{id}', 'ProductController@update')->name('backend.product.update');
        Route::delete('/product/delete/{id}', 'ProductController@destroy')->name('backend.product.destroy');

        // Management
        Route::get('/linhvuc', 'LinhvucController@index')->name('backend.linhvuc.index');
        Route::get('/linhvuc/create', 'LinhvucController@create')->name('backend.linhvuc.create');
        Route::post('/linhvuc', 'LinhvucController@store')->name('backend.linhvuc.store');
        Route::get('/linhvuc/view/{id}', 'LinhvucController@show')->name('backend.linhvuc.show');
        Route::get('/linhvuc/update/{id}', 'LinhvucController@edit')->name('backend.linhvuc.edit');
        Route::put('/linhvuc/update/{id}', 'LinhvucController@update')->name('backend.linhvuc.update');
        Route::delete('/linhvuc/delete/{id}', 'LinhvucController@destroy')->name('backend.linhvuc.destroy');

        // Management
        Route::get('/hoatdong', 'HoatdongController@index')->name('backend.hoatdong.index');
        Route::get('/hoatdong/create', 'HoatdongController@create')->name('backend.hoatdong.create');
        Route::post('/hoatdong', 'HoatdongController@store')->name('backend.hoatdong.store');
        Route::get('/hoatdong/view/{id}', 'HoatdongController@show')->name('backend.hoatdong.show');
        Route::get('/hoatdong/update/{id}', 'HoatdongController@edit')->name('backend.hoatdong.edit');
        Route::put('/hoatdong/update/{id}', 'HoatdongController@update')->name('backend.hoatdong.update');
        Route::delete('/hoatdong/delete/{id}', 'HoatdongController@destroy')->name('backend.hoatdong.destroy');

        // Management
        Route::get('/page', 'PageController@index')->name('backend.page.index');
        Route::get('/page/create', 'PageController@create')->name('backend.page.create');
        Route::post('/page', 'PageController@store')->name('backend.page.store');
        Route::get('/page/view/{id}', 'PageController@show')->name('backend.page.show');
        Route::get('/page/update/{id}', 'PageController@edit')->name('backend.page.edit');
        Route::put('/page/update/{id}', 'PageController@update')->name('backend.page.update');
        Route::delete('/page/delete/{id}', 'PageController@destroy')->name('backend.page.destroy');

        // Management
        Route::get('/lienhe', 'LienheController@index')->name('backend.lienhe.index');
        Route::get('/lienhe/create', 'LienheController@create')->name('backend.lienhe.create');
        Route::post('/lienhe', 'LienheController@store')->name('backend.lienhe.store');
        Route::get('/lienhe/view/{id}', 'LienheController@show')->name('backend.lienhe.show');
        Route::get('/lienhe/update/{id}', 'LienheController@edit')->name('backend.lienhe.edit');
        Route::put('/lienhe/update/{id}', 'LienheController@update')->name('backend.lienhe.update');
        Route::delete('/lienhe/delete/{id}', 'LienheController@destroy')->name('backend.lienhe.destroy');

        // Management
        Route::get('/slide', 'SlideController@index')->name('backend.slide.index');
        Route::get('/slide/create', 'SlideController@create')->name('backend.slide.create');
        Route::post('/slide', 'SlideController@store')->name('backend.slide.store');
        Route::get('/slide/view/{id}', 'SlideController@show')->name('backend.slide.show');
        Route::get('/slide/update/{id}', 'SlideController@edit')->name('backend.slide.edit');
        Route::put('/slide/update/{id}', 'SlideController@update')->name('backend.slide.update');
        Route::delete('/slide/delete/{id}', 'SlideController@destroy')->name('backend.slide.destroy');

        // Management
        Route::get('/section/{position}', 'SectionController@index')->name('backend.section.index');
        Route::get('/section/create/{position}', 'SectionController@create')->name('backend.section.create');
        Route::post('/section/{position}', 'SectionController@store')->name('backend.section.store');
        Route::get('/section/view/{position}/{id}', 'SectionController@show')->name('backend.section.show');
        Route::get('/section/update/{position}/{id}', 'SectionController@edit')->name('backend.section.edit');
        Route::put('/section/update/{position}/{id}', 'SectionController@update')->name('backend.section.update');
        Route::delete('/section/delete/{id}', 'SectionController@destroy')->name('backend.section.destroy');

    });
});
