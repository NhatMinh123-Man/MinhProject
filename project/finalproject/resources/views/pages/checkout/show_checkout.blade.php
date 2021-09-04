@extends('cart')
@section('content')

<section id="cart_items">
		<div class="container">
		<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Home</a></li>
				  <li class="active">Cart payment</li>
				</ol>
			</div>	

			<div class="register-req">
				<p>Please Register or Login before checkout  </p>
			</div><!--/register-req-->
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Bill To</p>
							<div class="form-one">
								<form method="post">
									{{csrf_field()}}
									<input type="text" name="shipping_email" class="shipping_email" placeholder="Email">
									<input type="text" name="shipping_name" class="shipping_name"  placeholder="Name">
									<input type="text" name="shipping_address" class="shipping_address"  placeholder="Address">
									<input type="text" name="shipping_phone" class="shipping_phone"  placeholder="Phone">
									<textarea name="shipping_note" class="shipping_note"  placeholder="Notes about your order" rows="5"></textarea>
									
									@if(Session::get('fee'))
									<input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
									@else
									<input type="hidden" name="order_fee" class="order_fee" value="15000">
									@endif
									

									@if(Session::get('coupon'))
									@foreach(Session::get('coupon') as $key =>$cou)
									<input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
									@endforeach
									@else
									<input type="hidden" name="order_coupon" class="order_coupon" value="0">
									@endif
									
									<input type="hidden" name="order_coupon" class="order_coupon">
									<div class="">
										<div class="form-group">
                          				  <label>Choose Payment option</label>
                            				<select name="payment_select" class="form-control m-bot15 payment_select">
                              			  	<option value="0">Payment by Card</option>
											<option value="1">Payment by Cash</option>
                            				</select>
                        				</div>
									</div>
									<input type="button" value="Payment" name="send_order" class="btn btn-primary btn-sm send_order">
								</form>
						<form>
                        {{csrf_field()}}
                        <div class="form-group">
                            <label>Choose City</label>
                            <select name="city" id="city" class="form-control m-bot15 choose city">
                                <option value="">Choose City</option>
                                @foreach($city as $key => $ci)
                                <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                @endforeach
                            </select>
                        </div>
						
                        <div class="form-group">
                            <label>Choose District</label>
                            <select name="district" id="district" class="form-control m-bot15 district choose">
                            <option value="">Choose District</option>
                            </select>
                        </div>
                    
                        <div class="form-group">
                            <label>Choose Ward</label>
                            <select name="ward" id="ward" class="form-control m-bot15 ward">
                            <option value="">Choose Ward</option>
                            </select>
                        </div>
					<input type="button" value="Fee ship" name="calculate_order" class="btn btn-primary btn-sm calculate_delivery">
                    </form>
							</div>
						</div>
					</div>

					<div class="col-sm-12 clearfix">
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
							<li>Cart Sub Total: <span>{{number_format( $total,0,',','.')}} VNĐ</span></li>
							@if(Session::get('coupon'))
							<li> <span>
								@foreach(Session::get('coupon') as $key =>$cou)
									@if($cou['coupon_cond']==1)
										Coupon: {{$cou['coupon_num']}}%
										<p>
											@php
											$total_coupon=($total*$cou['coupon_num'])/100;
											echo '<li>Decrease: '.number_format( $total_coupon,0,',','.').'VND</li>';	
											@endphp
										</p>
									@elseif($cou['coupon_cond']==2)
											Coupon: {{number_format($cou['coupon_num'],0,',','.')}} VND
										<p>
											@php
											$total_coupon=$cou['coupon_num'];
											echo '<li>Decrease: '.number_format( $total_coupon,0,',','.').'VND</li>';
											@endphp
										</p>
									@endif
								@endforeach
							</span></li>
							@endif

							@if(Session::get('fee'))
							<li>
							<a class="cart_quantity_delete" href="{{url('/delete-fee/')}}"><i class="fa fa-times"></i></a>
							Fee shipping<span> {{number_format( Session::get('fee'),0,',','.')}} VNĐ</span></li>
							<?php $total_after_fee = $total - Session::get('fee'); ?>
							@endif

							<li>Total: 
							@php
							if(Session::get('fee') && !Session::get('coupon')){
								$total_after=$total_after_fee; 
								echo number_format( $total_after,0,',','.').'VNĐ';
							}elseif(!Session::get('fee') && Session::get('coupon')){
								$total_after=$total-$total_coupon; 
								echo number_format( $total_after,0,',','.').'VNĐ';
							}elseif(Session::get('fee') && Session::get('coupon')){
								$total_after=$total-$total_coupon; 
								$total_after=$total_after + Session::get('fee');
								echo number_format( $total_after,0,',','.').'VNĐ'; 
							}elseif(!Session::get('fee') && !Session::get('coupon')){
								$total_after=$total;
								echo number_format( $total_after,0,',','.').'VNĐ';
							}
							@endphp</li>
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
				</div>
			</div>	
	</div>
	</section> <!--/#cart_items-->


@endsection