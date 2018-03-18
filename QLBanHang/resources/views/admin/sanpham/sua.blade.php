@extends('admin.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">{{$sanpham->name}}
                            <small>Sửa</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                         @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors ->all() as $err)
                                    {{$err}}<br>
                                @endforeach
                            </div>
                        @endif

                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <form action="admin/sanpham/sua/{{$sanpham->id}}" method="POST" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

                            <div class="form-group">
                                <label>Tên Sản Phẩm</label>
                                <input class="form-control" name="name" value="{{$sanpham->name}}" placeholder="Nhập tên sản phẩm" />
                            </div>

                            <div class="form-group">
                                <label>Loại Sản Phẩm</label>
                                <select class="form-control" name="loaisanpham" id="loaisanpham" >
                                @foreach($loaisp as $lsp)
                                     <option value="{{$sp->id}}">{{$lsp->name}}</option>
                                 @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Miêu tả</label>
                                <textarea id="demo" name="description"  class="form-control " rows="5">{{$sanpham->description}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Gía gốc</label>
                                <input class="form-control" name="unit_price" value="{{$sanpham->unit_price}}" placeholder="Nhập giá gốc sản phẩm" />
                            </div>
                            <div class="form-group">
                                <label>Gía khuyến mãi</label>
                                <input class="form-control" name="promotion_price" value="{{$sanpham->unit_price}}" placeholder="Nhập giá khuyến mãi san phẩm " />
                            </div>
                           
                            <div class="form-group"> 
                                <label>Hình ảnh</label>
                                <input type="file" name="image" class="form-group"/>
                            </div>

                            <div class="form-group">
                                <label>Sản Phẩm Mới</label>
                                <label class="radio-inline">
                                    <input name="new" value="0" checked="" type="radio">Không
                                </label>
                                <label class="radio-inline">
                                    <input name="new" value="1" type="radio">Có
                                </label>
                            </div>

                        
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm Mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
</div>
@endsection