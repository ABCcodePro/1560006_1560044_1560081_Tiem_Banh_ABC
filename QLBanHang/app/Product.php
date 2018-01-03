<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table ="products";
    // Khoa ngoai
    public function product_type()
    {
    	// 1 san pham thuoc ve 1 loai sp
    	return $this-> belongsTo('App\ProductType','id_type','id');
    }
    public function bill_detail(){
    	return $this->hasMany('App\BillDetail','id_product','id');
    }
}
