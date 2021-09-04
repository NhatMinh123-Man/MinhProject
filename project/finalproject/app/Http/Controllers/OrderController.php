<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Feeship;
use App\Order;
use App\Shipping;
use App\OrderDetails;
use App\Customer; 
use App\Coupon;
use App\Product;
use PDF;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
class OrderController extends Controller
{
    public function manage_order(){
        $order=Order::orderby('created_at','DESC')->get();
        return view('admin.manage_order')->with(compact('order'));
    }

    public function view_order($order_code){
        $order_details= OrderDetails::with('product')->where('order_code',$order_code)->get();
        $order=Order::where('order_code',$order_code)->get();
        foreach($order as $key => $ord){
            $customer_id=$ord->customer_id;
            $shipping_id=$ord->shipping_id;
            $order_status=$ord->order_status;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();
        $order_details_pro= OrderDetails::with('product')->where('order_code',$order_code)->get();

        foreach($order_details_pro as $key =>$order_d){
            $product_coupon=$order_d->product_coupon;
        }
        if($product_coupon !='0'){
            $coupon = Coupon::where('coupon_code',$product_coupon)->first();
            $coupon_cond=$coupon->coupon_cond;
            $coupon_num=$coupon->coupon_num;
        }else{
            $coupon_cond=1;
            $coupon_num=0;
        }
        
        return view('admin.view_order')->with(compact('order_details','customer','shipping', 'order_details_pro',
        'coupon_cond','coupon_num','order','order_status'));
    }

    public function print_order($checkout_code){
        $pdf= \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }

    public function print_order_convert($checkout_code){
        $order_details= OrderDetails::where('order_code',$checkout_code)->get();
        $order=Order::where('order_code',$checkout_code)->get();
        foreach($order as $key => $ord){
            $customer_id=$ord->customer_id;
            $shipping_id=$ord->shipping_id;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();
        $order_details_pro= OrderDetails::with('product')->where('order_code',$checkout_code)->get();

        foreach($order_details_pro as $key =>$order_d){
            $product_coupon=$order_d->product_coupon;
        }
        if($product_coupon !='0'){
            $coupon = Coupon::where('coupon_code',$product_coupon)->first();
            $coupon_cond=$coupon->coupon_cond;
            $coupon_num=$coupon->coupon_num;
            if($coupon_cond==1){
                $coupon_echo = $coupon_num.'%';
            }else{
                $coupon_echo = number_format($coupon_num,0,',','.').'VNĐ';
            }
        }else{
            $coupon_cond=1;
            $coupon_num=0;
        }


        $output=' ';
        $output.='<style>body{
            font-family: DejaVu Sans;
        }
        .table-styling{
            border:1px solid #000;
        }
        .table-styling tbody tr td{
            border:1px solid #000;
        }
        .table-styling thead tr th{
            border:1px solid #000;
        }
        </style>
    
        <h1><center>BILL</center></h1>
        <table class="table-styling">
            <thead>
                <tr>
                    <th>Customer name</th>
                    <th>Phone</th>
                    <th>Email</th>
                </tr>
            </thead>      
            <tbody>';
      
            $output.='
                <tr>
                    <td>'.$customer->customer_name.'</td>
                    <td>'.$customer->customer_phone.'</td>
                    <td>'.$customer->customer_email.'</td>        
                </tr>';
         
            $output.='
            </tbody>  
        </table>
        <p><h4>Order Information</h4></p>
		<table class="table-styling">
		<thead>
		<tr>
		<th>Customer name</th>
		<th>Address</th>
		<th>Phone</th>
		<th>Email</th>
		<th>Note</th>
		</tr>
		</thead>
		<tbody>';

		$output.='		
		<tr>
		<td>'.$shipping->shipping_name.'</td>
		<td>'.$shipping->shipping_address.'</td>
		<td>'.$shipping->shipping_phone.'</td>
		<td>'.$shipping->shipping_email.'</td>
		<td>'.$shipping->shipping_note.'</td>

		</tr>';
        $output.='				
		</tbody>

		</table>

		<p><h4>The Order</h4></p>
		<table class="table-styling">
		<thead>
		<tr>
		<th>Product name</th>
		<th>Coupon code</th>
		<th>Feeship</th>
		<th>Quantity</th>
		<th>Price</th>
		<th>Total</th>
		</tr>
		</thead>
		<tbody>';

		$total = 0;

		foreach($order_details_pro as $key => $product){

			$subtotal = $product->product_price*$product->product_sales_qty;
			$total+=$subtotal;

			if($product->product_coupon!='0'){
				$product_coupon = $product->product_coupon;
			}else{
				$product_coupon = 'Do not have coupon';
			}		

			$output.='		
			<tr>
			<td>'.$product->product_name.'</td>
			<td>'.$product_coupon.'</td>
			<td>'.number_format($product->product_feeship,0,',','.').'VNĐ'.'</td>
			<td>'.$product->product_sales_qty.'</td>
			<td>'.number_format($product->product_price,0,',','.').'VNĐ'.'</td>
			<td>'.number_format($subtotal,0,',','.').'VNĐ'.'</td>

			</tr>';
		}

		if($coupon_cond==1){
			$total_coupon = ($total* $coupon_num)/100;
			$total_final = $total - $total_coupon;
		}else{
			$total_final = $total - $coupon_num;
		}

		$output.= '<tr>
		<td colspan="2">
        <p>Total Final: '.number_format($total,0,',','.').'VNĐ'.'</p>
		<p>Decrease: '.$coupon_echo.' '.'('.number_format($total_coupon,0,',','.').'VNĐ'.')'.'</p>
		<p>Feeship: '.number_format($product->product_feeship,0,',','.').'VNĐ'.'</p>
		<p>Paid : '.number_format($total_final + $product->product_feeship,0,',','.').'VNĐ'.'</p>
		</td>
		</tr>';
		$output.='				
		</tbody>

		</table>

		<p><h3>Sign</h3></p>
		<table>
		<thead>
		<tr>
		<th width="200px">Cashier</th>
		<th width="800px">Receiver</th>
		</tr>
		</thead>
		<tbody>';
		$output.='				
		</tbody>
		</table>
		';
        return $output;
    }

    public function update_order_qty(Request $request){
        $data= $request->all();

        $order =Order::find($data['order_id']);
        $order->order_status= $data['order_status'];
        $order->save();

        if($order->order_status ==2){
            foreach($data['order_product_id'] as $key => $product_id ){
                $product = Product::find($product_id );
                $product_qty= $product->product_qty;
                $product_sold = $product->product_sold;
                foreach($data['quantity'] as $key2 => $qty){
                    if($key==$key2){
                        $product_remain=$product_qty - $qty;
                        $product->product_qty=$product_remain;
                        $product->product_sold=$product_sold+$qty;
                        $product->save();
                    }
                }
            }
        }elseif($order->order_status !=2 && $order->order_status !=3 ){
            foreach($data['order_product_id'] as $key => $product_id ){
                $product = Product::find($product_id );
                $product_qty= $product->product_qty;
                $product_sold = $product->product_sold;
                foreach($data['quantity'] as $key2 => $qty){
                    if($key==$key2){
                        $product_remain=$product_qty + $qty;
                        $product->product_qty=$product_remain;
                        $product->product_sold=$product_sold - $qty;
                        $product->save();
                    }
                }
            }
        }
    }

    public function update_quantity(Request $request){
        $data = $request->all();
        $order_details= OrderDetails::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
        $order_details->product_sales_qty = $data['order_qty'];
        $order_details->save();
    }
}
