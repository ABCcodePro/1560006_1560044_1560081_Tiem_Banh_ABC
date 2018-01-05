<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //Lay trang chu
    public function getIndex(){
    	return view('page.trangchu');
    }

    public function getLoaiSp(){
    	return view('page.loai_sanpham');
    }
    public function getChitiet(){
    	return view('page.chitiet_sanpham');
    }
    public function getLienHe(){
    	return view('page.lienhe');
    }
    public function getGioiThieu(){
    	return view('page.gioi_thieu');
    }

}
