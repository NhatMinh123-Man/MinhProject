<!-- Cart ajax	 -->

@extends('cart')
@section('content')

<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			@if(session()->has('message'))
                <div class="alert alert-success">
                    {{session()->get('message')}}
                </div>
            @elseif(session()->has('error'))
                <div class="alert alert-danger">
                    {{session()->get('error')}}
                </div>
            @endif

			<div class="table-responsive cart_info">
			<form action="{{url('/update-cart-ajax')}}" method="post">
			{{csrf_field()}}
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="description">Description</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					@if(Session::get('cart')==true)
					@php
					$total=0;
					@endphp
                    
					@foreach(Session::get('cart') as $key => $cart)
                        @php
                                $subtotal = $cart['product_price']*$cart['product_qty'];
                                $total+=$subtotal;
                    	@endphp

					
					<tr>
							<td class="cart_product">
							<img src="{{asset('public/upload/product/'.$cart['product_image'])}}"
                                width="90" alt="{{$cart['product_name']}}" />

							</td>
							<td class="cart_description">
								<p>{{$cart['product_name']}}</p>
							</td>
							<td class="cart_price">
							<p>{{number_format($cart['product_price'],0,',','.')}} VNĐ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<input class="cart_quantity" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" 
									value="{{$cart['product_qty']}}">
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{number_format( $subtotal,0,',','.')}} VNĐ
								</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{url('/delete-cart-ajax/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						
						@endforeach
						<tr>
							<td><input type="submit" value="Update" name="update_qty" class="check_out btn btn-default btn-sm"></td>
							<td><a class="btn btn-default check_out" href="{{url('/del-all-product')}}">Delete all</a></td>
							<td>
							<?php
								$customer_id=Session::get('customer_id');
								if($customer_id!=NULL){
							?>
							<a class="btn btn-default check_out"  href="{{url('/checkout')}}">Order</a>
							<?php
							}else{
							?>
							<a class="btn btn-default check_out"  href="{{url('/login-checkout')}}">Order</a>
							<?php	
							}
							?>
						</td>

						<td>
							<li>Cart Sub Total: <span>{{number_format( $total,0,',','.')}} VNĐ</span></li>
							@if(Session::get('coupon'))
							<li> <span>
								@foreach(Session::get('coupon') as $key =>$cou)
									@if($cou['coupon_cond']==1)
										Coupon: {{$cou['coupon_num']}}%
										<p>
											@php
											$total_coupon=($total*$cou['coupon_num'])/100;
											echo '<li>Decrease:'.number_format( $total_coupon,0,',','.').'VND</li>';	
											@endphp

										</p>
										<li>Total: {{number_format( $total-$total_coupon,0,',','.')}} VNĐ</li>
										@elseif($cou['coupon_cond']==2)
											Coupon: {{number_format($cou['coupon_num'],0,',','.')}} VND
										<p>
											@php
											$total_coupon=$cou['coupon_num'];
											echo '<li>Decrease:'.number_format( $total_coupon,0,',','.').'VND</li>';
											@endphp

										</p>
										<li>Total: {{number_format( $total-$total_coupon,0,',','.')}} VNĐ</li>
									@endif
								@endforeach
							</span></li>
							@endif
						</td>
						</tr>
						@else
						<tr>
							<td colspan="5"><center><h1>Please add product in your cart</h1>
							<a class="btn btn-default check_out" href="{{url('/')}}"><h4>Go to Shop</h4></a>
							</center>
							</td>
						</tr>
						@endif
					</tbody>
				</table>
				</form>
				<tr>
					@if(Session::get('cart'))
					<td colspan="5">
						<form action="{{url('/check-coupon')}}" method="post">
						{{csrf_field()}}
						<input type="text" class="form-control" name="coupon" placeholder="Coupon"><br>
						<input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Coupon">
						@if(Session::get('coupon'))
						<a class="btn btn-default check_coupon"href="{{url('/del-coupon')}}">Delete Coupon</a>
						@endif
						</form>
					</td>
					@endif

				</tr>
			</div>
		</div>
	</section>
@endsection