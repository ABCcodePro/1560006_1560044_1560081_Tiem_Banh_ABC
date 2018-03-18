<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
class slidecontroller extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }
    public function getdanhsach(){
        $slide = Slide::all();
        return view('admin.slide.danhsach',['slide'=>$slide]);
    }
    public function getthem(){
        $slide = Slide::all();
        return view('admin.slide.them',['slide'=>$slide]);
   }

    public function postthem(Request $request){
        $slide = new Slide;
        if($request ->hasFile('image'))
        {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $image = str_random(4)."_". $name;
            while(file_exists("Source/image/slide" .$image))
            {
                $image = str_random(4)."_". $name;
            }
            $file->move("Source/image/slide",$image);
            $slide->image = $image;
        }
        else
        {
            $slide->image="";
        }
        $slide->save();
        return redirect('admin/slide/them')->with('thongbao','Thêm slide thành công');
   }

    public function getsua($id){
         $slide =  Slide::find($id);
         return view('admin/slide/sua',['slide'=>$slide]);
    }
    public function postsua(Request $request,$id)
    {
        $slide =Slide::find($id);
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $duoi =  $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg')
            {
                return redirect('admin/slide/them')->with('loi','bạn chỉ được chọn file có đuôi jpg,png,jpeg');

            }
            $name= $file->getClientOriginalName();
            $image = str_random(4). "_". $name;
            while(file_exists('Source/image/slide'.$image))
            {
                $image = str_random(4) . "_" . $name;

            }
            
            $file->move("Source/image/slide",$image);
            $slide->image = $image;
        }
        else
        {
            $slide->image ="";
        }
        $slide->save();
        return redirect('admin/slide/sua/'.$id)->with('thongbao','sửa sản phẩm thành công');
    }
}
