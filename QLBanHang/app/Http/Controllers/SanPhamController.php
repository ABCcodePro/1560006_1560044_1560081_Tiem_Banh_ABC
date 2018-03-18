<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductType;
use App\Product;
class sanphamcontroller extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    public function getdanhsach(){
        $sanpham = Product::orderBy('id','DESC')->get();
        return view('admin.sanpham.danhsach',['sanpham'=>$sanpham]);
    }
    public function getthem(){
        $loaisanpham = ProductType::all();
        return view('admin.sanpham.them',['loaisanpham'=>$loaisanpham]);
    }

    public function postthem(Request $request){
        $this->validate($request,[
            'loaisanpham'=>'required',
            'name'=>'required|min:3|unique:products,name',
            'description'=>'required',
            'unit_price'=>'required',
            'promotion_price'=>'required',

        ],[
            'loaisanpham.required'=>'Bạn chưa chọn loại sản phẩm',
            'name.required'=>'Bạn chưa nhập tên sản phẩm',
            'name.min'=>'Sản phẩm phải có ít 3 ký tự ',
            'name.unique'=>'Tiêu đề đã tồn tại',
            'description.required'=>'Bạn chưa nhập miêu tả',
            'unit_price.required'=>'Bạn chưa nhập giá gốc',
            'promotion_price.required'=>'Bạn chưa nhập khuyến mãi'
            

        ]);

        $sanpham = new Product;
        $sanpham->name= $request->name;
        $sanpham->id_type=$request->loaisanpham;
        $sanpham->description = $request->description;
        $sanpham->unit_price= $request->unit_price;
        $sanpham->promotion_price = $request->promotion_price;
        $sanpham->new = $request->new;
        if($request ->hasFile('image'))
        {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $image = str_random(4)."_". $name;
            while(file_exists("Source/image/product" .$image))
            {
                $image = str_random(4)."_". $name;
            }
            $file->move("Source/image/product",$image);
            $sanpham->image = $image;
        }
        else
        {
            $sanpham->image="";
        }
        $sanpham->save();
        return redirect('admin/sanpham/them')->with('thongbao','Thêm sản phẩm thành công');
    }

    public function getsua($id){
        $sanpham = Product::find($id);
        $loaisanpham = ProductType::all();
        return view('admin.sanpham.sua',['sanpham'=>$sanpham,'loaisanpham'=>$loaisanpham]);
    }
    public function postsua(Request $request,$id)
    {
        $sanpham = Product::find($id);
        $this->validate($request,[
            'loaisanpham'=>'required',
            'name'=>'required|min:3|unique:products,name',
            'description'=>'required',
            'unit_price'=>'required',
            'promotion_price'=>'required'
        ],[
            'loaisanpham.required'=>'Bạn chưa chọn loại sản phẩm',
            'name.required'=>'Bạn chưa nhập tên sản phẩm',
            'name.min'=>'Sản phẩm phải có ít 3 ký tự ',
            'name.unique'=>'Tiêu đề đã tồn tại',
            'description.required'=>'Bạn chưa nhập miêu tả',
            'unit_price.required'=>'Bạn chưa nhập giá gốc',
            'promotion_price.required'=>'Bạn chưa nhập khuyến mãi'

        ]);
        $sanpham->name= $request->name;
        $sanpham->id_type=$request->loaisanpham;
        $sanpham->description = $request->description;
        $sanpham->unit_price= $request->unit_price;
        $sanpham->promotion_price = $request->promotion_price;
        $sanpham->new = $request->new;

        if($request ->hasFile('image'))
        {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $image = str_random(4)."_". $name;
            while(file_exists("Source/image/product" .$image))
            {
                $image = str_random(4)."_". $name;
            }
            $file->move("Source/image/product",$image);
            unlink("Source/image/product" .$sanpham->image);
            $sanpham->image = $image;
        }
        $sanpham->save();
        return redirect('admin/sanpham/sua/' .$id)->with('thongbao','sửa thành công');
    }
    public function getxoa($id)
    {
        $sanpham = Product::find($id);
        $sanpham->delete();
        return redirect('admin/sanpham/danhsach')->with('thongbao','xóa thành công');
    }
}
