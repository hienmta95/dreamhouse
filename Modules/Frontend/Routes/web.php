<?php

Route::group(['middleware' => ['web'], 'prefix' => ''], function()
{

    Route::get('', 'FrontendController@homepage')->name('frontend.homepage');
    Route::get('/phong/{slug_room}', 'FrontendController@getRoom')->name('frontend.get.room');
    Route::get('/loai-san-pham/{slug}', 'FrontendController@getCategory')->name('frontend.get.category');
    Route::get('/san-pham/{slug}', 'FrontendController@getProduct')->name('frontend.get.product');
    Route::get('/lien-he-thanh-cong', 'FrontendController@getLienhethanhcong')->name('frontend.get.thanhcong');
    Route::get('/lien-he', 'FrontendController@getLienhe')->name('frontend.get.lienhe');
    Route::post('/lien-he', 'FrontendController@postLienhe')->name('frontend.post.lienhe');
    Route::get('/linh-vuc/{slug}', 'FrontendController@getPageLinhvuc')->name('frontend.get.linhvuc');
    Route::get('/hoat-dong/{slug}', 'FrontendController@getPageHoatdong')->name('frontend.get.hoatdong');
    Route::get('/search', 'FrontendController@getSearch')->name('frontend.search');
    Route::get('/page/{slug}', 'FrontendController@getPage')->name('frontend.get.page');

});
