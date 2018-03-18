@extends('admin.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Người Dùng
                            <small>Thêm</small>
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

                     
                        <form action="admin/user/sua/{{$nguoidung->id}}" method="POST" enctype="multipart/form-data">
                        <input name="_token" type="hidden" value="{{ csrf_token() }}"/>

                            <div class="form-group">
                                <label>Tên Người Dùng</label>
                                <input class="form-control" type="text" name="name" value="{{$nguoidung->full_name}}"/>
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input class="form-control" type="email" name="email" value="{{$nguoidung->email}}"  />
                            </div>
                            
                            <div class="form-group">
                                <label>Mật Khẩu</label>
                                <input class="form-control" type="password" name="password"   />
                            </div>

                             <div class="form-group">
                                <label>Mật Khẩu Nhập Lại</label>
                                <input class="form-control" type="password" name="confirm_password"   />
                            </div>
                           
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm Mới</button>
                        <form>
                    </div>
                </div>
              
            </div>
          
</div>
@endsection