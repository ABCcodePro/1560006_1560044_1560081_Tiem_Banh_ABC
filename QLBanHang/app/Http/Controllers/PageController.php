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
        return view('page.lienhe');
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

    public function getLogin(){
        return view('page.dangnhap');
    }

    public function getDangKi(){
        return view ('page.dangki');
    }

    public function postDangKi(Request $req){
        $this-> validate($req,
        [
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:6|max:20',
            'fullname'=>'required',
            're_password'=>'required|same:password'
        ],
        [
            'email.required'=>'Vui lòng nhập Email',
            'email.email'=>'Không đúng định dạng Email',
            'email.unique'=>'Email đã có người sử dụng',
            'password.required'=>'Vui lòng nhập password',
            're_password.same'=>'Mật khẩu không giống nhau',
            'password.min'=>'Mật khẩu phải có ít nhất 6 kí tự?'
        ]);
        $user= new User();
        $user->full_name=$req->fullname;
        $user->email=$req->email;
        $user->password=Hash::make($req->password);
        $user->phone=$req->phone;
        $user->address=$req->address;
        $user->save();
        return redirect()->back()->with('thanhcong','Đã tạo tài khoản thành công');
    }
}
