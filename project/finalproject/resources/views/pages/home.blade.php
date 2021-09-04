@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						@foreach($all_product as $key=>$product)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
										<form>
											{{csrf_field()}}
											<input type="hidden" class="cart_product_id_{{$product->product_id}}" 
											value="{{$product->product_id}}">
											<input type="hidden" class="cart_product_name_{{$product->product_id}}" 
											value="{{$product->product_name}}">
											<input type="hidden" class="cart_product_image_{{$product->product_id}}" 
											value="{{$product->product_image}}">
											<input type="hidden" class="cart_product_price_{{$product->product_id}}" 
											value="{{$product->product_price}}">
											<input type="hidden" class="cart_product_qty_{{$product->product_id}}" 
											value="1">
											
											<a href="{{URL::to('/details-product/'.$product->product_id)}}">
											<img src="{{URL::to('public/upload/product/'.$product->product_image)}}" alt="" />
											<h2>{{number_format($product->product_price).' '.'VND'}}</h2>
											<p>{{$product->product_name}}</p>
											<!-- <a href="{{URL::to('/details-product/'.$product->product_id)}}" class= "btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Detail</a> -->
											</a>
											<button type="button" class= "btn btn-default add-to-cart" data-id="{{$product->product_id}}" 
											name="add-to-cart" ><i class="fas fa-shopping-cart"> Add to cart</i></button>
										</form>
										</div>
								</div>
							</div>
						</div>
						@endforeach
					</div><!--features_items-->
					
@endsection