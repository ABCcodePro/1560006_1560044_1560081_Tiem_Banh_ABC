@extends('master')
@section('content')
	<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="beta-products-list">
							<b><h4>TÌM KIẾM</h4><b>
							<div class="beta-products-details">
								<p class="pull-left">Đã tìm thấy {{count($product)}} sản phẩm.</p>
								<div class="clearfix"></div>
							</div>

							<div class="row">
								@foreach($product as $p)
								<div class="col-sm-3">
									<div class="single-item">
										@if($p->promotion_price!=0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
										@endif
										<div class="single-item-header">
											<a href="{{route('chitietsanpham',$p->id)}}"><img src="source/image/product/{{$p->image}}" alt=""height="270px"></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$p->name}} </p>
											<p class="single-item-price" style="font-size: 16px">
												@if($p->promotion_price==0)
												<span class="flash-sale">{{number_format($p->unit_price)}} đồng</span>
												@else
												<span class="flash-del">{{number_format($p->unit_price)}} đồng</span>
												<span class="flash-sale">{{number_format($p->promotion_price)}} đồng</span>
												@endif
											</p>
										</div>
										<div class="single-item-caption">
											<a class="add-to-cart pull-left" href=" {{route('themgiohang',$p->id)}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('chitietsanpham',$p->id)}}">Chi tiết <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
								@endforeach
							<div class="row">{{$product->links()}}</div>
						</div> <!-- .beta-products-list -->

					</div>
				</div> <!-- end section with sidebar and main content -->
			</div> <!-- .main-content -->
		</div> <!-- #content -->
@endsection