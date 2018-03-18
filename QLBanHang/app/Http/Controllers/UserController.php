<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
class usercontroller extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    public function getdanhsach(){
        $nguoidung=User::all();
        return view('admin.user.danhsach',['nguoidung'=>$nguoidung]);
    }
    public function getthem(){
        $nguoidung = User::all();
        return view('admin.user.them',['nguoidung'=> $nguoidung]);
    }

    public function postthem(Request $req){
        $check = [
            
            'email'=>'required|max:50|email',
            'name'=>'required|max:50',
            'password'=>'required|min:6|max:20',
            'confirm_password'=>'required|same:password',
           
            
        ];

        $mess = [
            'email.required'=>'Vui lòng nhập email',
            'email.max'=>'Email không quá :max kí tự',
            'email.email'=>'Vui lòng nhập đúng email',
            'name.required'=>'Vui lòng nhập họ tên',
            'name.max'=>'Họ tên không quá :max kí tự',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu phải có ít nhất .min kí tự',
            'password.max'=>'Mật khẩu không quá .max kí tự',
            'confirm_password.same'=>'Mật khẩu không trùng nhau',
            'confirm_password.required'=>'Vui lòng nhập lại mật khẩu'

        ];
        $validator = $req->validate($check,$mess);
        $user = new User();
        $user->full_name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();
        return redirect('admin/user/danhsach')->with('thongbao','Thêm người dùng thành công');

    }
    public function getsua($id){
            $nguoidung =  User::find($id);
            return view('admin/user/sua',['nguoidung'=>$nguoidung]);
    }
    public function postsua(Request $request,$id)
    {
       
        $user = User::find($id);
        $this->validate($request,[
            'email'=>'required|max:50|email',
            'name'=>'required|max:50',
            'address'=>'required|max:50',
            'phone'=>'required|numeric',
            'password'=>'required|min:6|max:20',
            'confirm_password'=>'required|same:password',
        ],[
            'email.required'=>'Vui lòng nhập email',
            'email.max'=>'Email không quá :max kí tự',
            'email.email'=>'Vui lòng nhập đúng email',
            'name.required'=>'Vui lòng nhập họ tên',
            'name.max'=>'Họ tên không quá :max kí tự',
            'password.required'=>'Vui lòng nhập mật khẩu',
            'password.min'=>'Mật khẩu phải có ít nhất .min kí tự',
            'password.max'=>'Mật khẩu không quá .max kí tự',
            'confirm_password.same'=>'Mật khẩu không trùng nhau',
            'confirm_password.required'=>'Vui lòng nhập lại mật khẩu'

        ]);
     
        $user->full_name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('admin/user/sua/' .$id)->with('thongbao','sửa thành công');
    }
}
