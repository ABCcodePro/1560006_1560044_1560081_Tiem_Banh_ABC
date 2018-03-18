<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[
	'as'=>'trang-chu',
	'uses'=>'PageController@getIndex' 
]);

Route::get('index',[
	'as'=>'trang-chu',
	'uses'=>'PageController@getIndex'
]);

Route::get('loai-san-pham/{type}',[
	'as'=>'loaisanpham',
	'uses'=>'PageController@getLoaiSp'
]);

Route::get('chi-tiet-san-pham/{id}',[
	'as'=>'chitietsanpham',
	'uses'=>'PageController@getChitiet'
]);

Route::get('lien-he',[
	'as'=>'lienhe',
	'uses'=>'PageController@getLienHe'
]);

Route::get('gioi-thieu',[
	'as'=>'gioithieu',
	'uses'=>'PageController@getGioiThieu'
]);

Route::get('add-to-cart/{id}',[
	'as'=>'themgiohang',
	'uses'=>'PageController@getAddtoCart'
]);

Route::get('del-cart/{id}',[
	'as'=>'xoagiohang',
	'uses'=>'PageController@getDelItemCart'
]);

Route::get('search',[
	'as'=>'search',
	'uses'=>'PageController@getSearch'
]);

Auth::routes();

Route::get('dat_hang',[
    'as'=>'dat-hang',
    'uses'=>'PageController@getdathang'
]);

Route::post('dat_hang',[
    'as'=>'dat-hang',
    'uses'=>'PageController@postdathang'
]);

Route::group(['prefix'=>'admin'],function(){
    Route::group(['prefix'=>'loaisanpham'],function(){
        Route::get('danhsach','loaisanphamcontroller@getdanhsach');
        Route::get('sua/{id}','loaisanphamcontroller@getsua');
        Route::post('sua/{id}','loaisanphamcontroller@postsua');
        Route::get('them','loaisanphamcontroller@getthem');
        Route::post('them','loaisanphamcontroller@postthem');

        Route::get('xoa/{id}','loaisanphamcontroller@getxoa');
	});
	
	Route::group(['prefix'=>'sanpham'],function(){
        Route::get('danhsach','sanphamcontroller@getdanhsach');
        Route::get('sua/{id}','sanphamcontroller@getsua');
        Route::post('sua/{id}','sanphamcontroller@postsua');
        Route::get('xoa/{id}','sanphamcontroller@getxoa');
        Route::get('them','sanphamcontroller@getthem');
        Route::post('them','sanphamcontroller@postthem');
    });

    Route::group(['prefix'=>'slide'],function(){
        Route::get('danhsach','slidecontroller@getdanhsach');
        Route::get('sua/{id}','slidecontroller@getsua');
        Route::post('sua/{id}','slidecontroller@postsua');
        Route::get('xoa/{id}','slidecontroller@getxoa');
        Route::get('them','slidecontroller@getthem');
        Route::post('them','slidecontroller@postthem');
    });

    Route::group(['prefix'=>'user'],function(){
        Route::get('danhsach','usercontroller@getdanhsach');
        Route::get('sua/{id}','usercontroller@getsua');
        Route::post('sua/{id}','usercontroller@postsua');
        Route::get('xoa/{id}','usercontroller@getxoa');
        Route::get('them','usercontroller@getthem');
        Route::post('them','usercontroller@postthem');
    });

});
