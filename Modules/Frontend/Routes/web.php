<?php

Route::group(['middleware' => ['web'], 'prefix' => ''], function()
{

    Route::get('', 'FrontendController@homepage')->name('frontend.homepage');
    Route::get('/phong/{id}/{slug?}', 'FrontendController@getRoom')->name('frontend.get.room');
    Route::get('/loai-san-pham/{id}/{slug?}', 'FrontendController@getCategory')->name('frontend.get.category');
    Route::get('/san-pham/{id}/{slug?}', 'FrontendController@getProduct')->name('frontend.get.product');
    Route::get('/linh-vuc/{id}/{slug?}', 'FrontendController@getPageLinhvuc')->name('frontend.get.linhvuc');
    Route::get('/hoat-dong/{id}/{slug?}', 'FrontendController@getPageHoatdong')->name('frontend.get.hoatdong');
    Route::get('/page/{id}/{slug?}', 'FrontendController@getPage')->name('frontend.get.page');
    Route::get('/search', 'FrontendController@getSearch')->name('frontend.search');

    Route::get('/lien-he', 'FrontendController@getLienhe')->name('frontend.get.lienhe');
    Route::post('/lien-he', 'FrontendController@postLienhe')->name('frontend.post.lienhe');
    Route::get('/lien-he-thanh-cong', 'FrontendController@getLienhethanhcong')->name('frontend.get.thanhcong');

});
