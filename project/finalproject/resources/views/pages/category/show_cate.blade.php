@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->

<div class="fb-share-button" data-href="https://localhost/project/" data-layout="button" data-size="large"><a target="_blank" 
href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" 
class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
<div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" 
data-action="like" data-size="large" data-share="false"></div>
			@foreach($category_name as $key =>$catename)
				<h2 class="title text-center">{{$catename->category_name}}</h2>
            @endforeach
					@foreach($category_by_id as $key=> $product)
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{URL::to('public/upload/product/'.$product->product_image)}}" alt="" />
											<h2>{{number_format($product->product_price).' '.'VND'}}</h2>
											<p>{{$product->product_name}}</p>
											<a href="{{URL::to('/details-product/'.$product->product_id)}}" class= "btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Detail</a>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
										</div>
								</div>
							</div>
						</div>
						@endforeach
					</div>
					<div class="fb-comments" data-href="{{$url_canonical}}"
					 data-width="" data-numposts="20"></div>
@endsection