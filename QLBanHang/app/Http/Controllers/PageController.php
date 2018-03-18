<?php

namespace App\Http\Controllers;
use App\Slide;
use App\Product;
use App\ProductType;
use App\Cart;
use Session;
use App\User;
use Hash;
use Illuminate\Http\Request;
use App\Customer;
use App\Bill;
use App\BillDetail;

class PageController extends Controller
{
    //Lay trang chu
    public function getIndex(){
        $slide=Slide::all();
        $new_product=Product::where('new',1)->paginate(4);
        $sanpham_khuyenmai=Product::where('promotion_price','<>',0)->paginate(12);
        return view('page.trangchu',compact('slide','new_product','sanpham_khuyenmai'));
        return view('page.trangchu',['slide'=>$slide]);
    }

    public function getLoaiSp($type){
        $sp_theoloai=Product::where('id_type',$type)->get();
        $sp_khac=Product::where('id_type','<>',$type)->paginate(6);
        $loai=ProductType::all();
        $loai_sp=ProductType::where('id',$type)->first();
        return view('page.loai_sanpham',compact('sp_theoloai','sp_khac','loai','loai_sp'));
    }

    public function getChitiet(Request $req){
        $sanpham=Product::where('id',$req->id)->first();
        $sp_tuongtu=Product::where('id_type',$sanpham->id_type)->paginate(6);
        $sp_khuyenmai=Product::where('promotion_price','<>',0)->paginate(4);
        $sp_moi=Product::where('new',1)->paginate(4);
        return view('page.chitiet_sanpham',compact('sanpham','sp_tuongtu','sp_khuyenmai','sp_moi'));
    }

    public function getLienHe(){
        return view('page.lien_he');
    }

    public function getGioiThieu(){
        return view('page.gioi_thieu');
    }

    public function getAddtoCart(Request $req,$id){
        $product = Product::find($id);
        $oldCart = Session('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->add($product,$id);
        $req->session()->put('cart',$cart);
        return redirect()->back();
    }

    public function getDelItemCart($id){
        $oldCart = Session::has('cart')?Session::get('cart'):null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id);
        if(count($cart->items)>0){
            Session::put('cart',$cart);
        }
        else{

            Session::forget('cart');
        }
        
        return redirect()->back();
    }

    public function getSearch(Request $req){
        $product=Product::where('name','like','%'.$req->key.'%')
                        ->orWhere('unit_price',$req->key)
                        ->paginate(8);
        return view('page.search',compact('product'));
    }

     public function getdathang()
    {
        return view('page.dat_hang');
    }

    public function postdathang(Request $req)
    {
        $cart = Session::get('cart');
        $customer = new Customer;
        $customer->name = $req ->name;
        $customer->gender=$req->gender;
        $customer->email = $req->email;
        $customer->address = $req->address;
        $customer->phone_number=$req->phone;
        $customer->note = $req->notes;
        $customer->save();

        $bill = new Bill;
        $bill->id_customer = $customer->id;
        $bill->date_order = date('Y-m-d');
        $bill->total = $cart->totalPrice;
        $bill->payment = $req->payment;
        $bill->note = $req->notes;
        $bill->save();

        foreach($cart->items as $key => $value)
        {
            $bill_detail = new BillDetail;
            $bill_detail->id_bill= $bill->id;
            $bill_detail->id_product = $key;
            $bill_detail->quantity = $value['qty'];
            $bill_detail->unit_price = $value['price'] / $value['qty'];
            $bill_detail->save();
        }
        Session::forget('cart');
        return redirect()->back()->with('thongbao','Đặt Hàng thành công');
        
    }

    
}
