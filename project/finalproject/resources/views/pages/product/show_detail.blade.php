@extends('welcome')
@section('content')

@foreach($product_details as $key => $value)
<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{URL::to('/public/upload/product/'.$value->product_image)}}" alt="" />
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
										  <a href=""><img src="{{URL::to('/public/frontend/images/similar1.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('/public/frontend/images/similar2.jpg')}}" alt=""></a>
										  <a href=""><img src="{{URL::to('/public/frontend/images/similar3.jpg')}}" alt=""></a>
										</div>
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>
						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{$value->product_name}}</h2>
								<p>Product ID:{{$value->product_id}}</p>
								<img src="images/product-details/rating.png" alt="" />

								<form action="{{URL::to('/save-cart')}}" method="post">
								{{csrf_field() }}
								<span>
									<span>{{number_format($value->product_price).' '.'VND'}}</span>
									<label>Quantity:</label>
									<input name="qty" type="number" min="1" value="1" />
									<input name="productid_hide" type="hidden" value="{{$value->product_id}}" />
								</span>
								<button type="button" class= "btn btn-default add-to-cart" data-id="{{$value->product_id}}" 
											name="add-to-cart" ><i class="fas fa-shopping-cart"> Add to cart</i>
										</button>
								</form>
								<p><b>Availability:</b> In Stock</p>
								<p><b>Condition:</b> New</p>
								<p><b>Brand:</b> {{$value->brand_name}}</p>
								<p><b>Category:</b> {{$value->category_name}}</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
								<div class="fb-share-button" data-href="https://localhost/project/" data-layout="button" data-size="large"><a target="_blank" 
								href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse" 
								class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
								<div class="fb-like" data-href="{{$url_canonical}}" data-width="" data-layout="button_count" 
								data-action="like" data-size="large" data-share="false"></div>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
                    
                    
                    <div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Descreption</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Content</a></li>
								<li class="active"><a href="#reviews" data-toggle="tab">Reviews</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
								<p>{!!$value->product_desc!!}</p>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
							<p>{!!$value->product_content!!}</p>
							</div>
						
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
								<div class="fb-comments" data-href="{{$url_canonical}}"
					 			data-width="" data-numposts="20"></div>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
@endforeach
                    <div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
							@foreach($related as $key =>$recommend)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="{{URL::to('public/upload/product/'.$recommend->product_image)}}" alt="" />
													<h2>{{number_format($recommend->product_price).' '.'VND'}}</h2>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							@endforeach
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->

@endsection