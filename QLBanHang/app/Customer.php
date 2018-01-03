<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $table ="customer";
     public function bill()
    {
    	//1 nhieu
    	return $this-> hasMany('App\Bill','id_customer','id');
    }
}
