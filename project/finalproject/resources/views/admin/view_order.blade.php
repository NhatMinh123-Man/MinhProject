@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
  <div class="card-header"><h3 class="text-center font-weight-light my-4">Customer Information</h3></div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <?php
            $message = Session::get('message');
            if($message){
                echo '<span class="text-alert">',$message,'</span>' ;
                Session::put('message',null); 
            }
            ?>
        <thead>
          <tr>
            <th style="width:20px;">
            </th>
            <th>Customer name</th>
            <th>Phone</th>  
            <th>Email</th>
            <th>Note</th>
          </tr>
        </thead>
        <tbody>
        <tr>
            <td><i></i></td>
            <td>{{$customer->customer_name}}</td>
            <td>{{$customer->customer_phone}}</td>
            <td>{{$customer->customer_email}}</td>        
            <th></th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<br><br>

<div class="table-agile-info">
  <div class="panel panel-default">
  <div class="card-header"><h3 class="text-center font-weight-light my-4">Order Information</h3></div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <?php
            $message = Session::get('message');
            if($message){
                echo '<span class="text-alert">',$message,'</span>' ;
                Session::put('message',null); 
            }
            ?>
        <thead>
          <tr>
            <th style="width:20px;">
            </th>
            <th>Customer name</th>
            <th>Addresss</th>
            <th>Phone</th>  
            <th>Email</th>
            <th>Note</th>
            <th>Payment method</th>
          </tr>
        </thead>
        <tbody>
        <tr>
            <td><i></i></td>
            <td>{{$shipping->shipping_name}}</td>
            <td>{{$shipping->shipping_address}}</td>
            <td>{{$shipping->shipping_phone}}</td>
            <td>{{$shipping->shipping_email}}</td>
            <td>{{$shipping->shipping_note}}</td>
            <td>
              @if($shipping->shipping_method ==0) 
              Payment by cart
              @else
              Payment by Cash
              @endif
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>


<br><br>

<div class="table-agile-info">
  <div class="panel panel-default">
  <div class="card-header"><h3 class="text-center font-weight-light my-4">Shipping Information</h3></div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <?php
            $message = Session::get('message');
            if($message){
                echo '<span class="text-alert">',$message,'</span>' ;
                Session::put('message',null); 
            }
            ?>
        <thead>
          <tr>
            <th >No</th>
            <th>Product name</th>
            <th>Product quantity</th>
            <th>Coupon code</th>
            <th>Feeship</th>
            <th>Sale Quantity</th>
            <th>Price</th>  
            <th>Total</th>
       
          </tr>
        </thead>
        <tbody>
        @php
            $i=0;
            $total=0;
        @endphp
          @foreach($order_details as $key => $detail)
          @php
            $i++;
            $subtotal= $detail->product_price * $detail->product_sales_qty;
            $total+=$subtotal;
        @endphp
        <tr class="color_qty_{{$detail->product_id}}">
            <td><i>{{$i}}</i></td>
            <td>{{$detail->product_name}}</td>
            <td>{{$detail->product->product_qty}}</td>
            <td>
            @if($detail->product_coupon!='0')  
            {{$detail->product_coupon}}
            @else
            Don't have coupon
            @endif
            </td>
            <td>{{number_format($detail->product_feeship,0,',','.')}} VNĐ</td>
            <td>
              <input type="number" min="1" {{$order_status==2 ?'disabled' : ''}} class="order_qty_{{$detail->product_id}}" value="{{$detail->product_sales_qty}}" name="product_sales_qty">
              <input type="hidden" name="order_storage" class="order_storage_{{$detail->product_id}}"
               value="{{$detail->product->product_qty}}">
              
              <input type="hidden" name="order_code" class="order_code" value="{{$detail->order_code}}">
              <input type="hidden" name="order_product_id" class="order_product_id" value="{{$detail->product_id}}">
              
              @if($order_status!=2)
              <button class="btn btn-primary update_qty" data-product_id="{{$detail->product_id}}" name="update_qty">Update</button>  
              @endif
          </td>
            <td>{{number_format($detail->product_price,0,',','.')}} VNĐ</td>
            <td>{{number_format($subtotal,0,',','.')}} VNĐ</td>
          </tr>
          @endforeach
         <tr colspan="7">
          <th>
          Total: {{number_format($total,0,',','.')}} VNĐ
          <br></br>
          @php
              $total_coupon=0;
              $total_final=0;
          @endphp
          @if($coupon_cond==1)
            @php
                $total_coupon=($total*$coupon_num)/100;
                echo 'Decrease: ' .$coupon_num.'%'.' '.'('.number_format($total_coupon,0,',','.').' '.'VNĐ'.')';
                $total_final=$total-$total_coupon;
            @endphp
          @else
            @php
                echo 'Decrease: '.number_format($coupon_num,0,',','.').' '.'VNĐ';
                $total_final=$total-$coupon_num;
            @endphp
          @endif
          <br></br>
          Feeship: {{number_format($detail->product_feeship,0,',','.')}} VNĐ
          <br></br>
          Paid: {{number_format($total_final+$detail->product_feeship,0,',','.')}} VNĐ
          </th>
          </tr>
          <tr>
          @foreach($order as $key => $or)
            @if($or->order_status==1)
              <form>
              @csrf
              <td colspan="7">
                  <select class="form-control order_delivery">
                      <option value="">Choose Status</option>
                      <option id="{{$or->order_id}}" selected value="1">New order</option>
                      <option id="{{$or->order_id}}" value="2">Finish</option>
                      <option id="{{$or->order_id}}" value="3">Cancel</option>
                  </select>
              </td>
            </form>
          @elseif($or->order_status==2)
          <form>
            @csrf
              <td colspan="7">
                  <select class="form-control order_delivery">
                      <option value="">Choose Status</option>
                      <option id="{{$or->order_id}}" value="1">New order</option>
                      <option id="{{$or->order_id}}" selected value="2">Finish</option>
                      <option id="{{$or->order_id}}" value="3">Cancel</option>
                  </select>
              </td>
            </form>
          @else
          <form>
            @csrf
              <td colspan="7">
                  <select class="form-control order_delivery">
                      <option value="">Choose Status</option>
                      <option id="{{$or->order_id}}" value="1">New order</option>
                      <option id="{{$or->order_id}}" value="2">Finish</option>
                      <option id="{{$or->order_id}}" selected value="3">Cancel</option>
                  </select>
              </td>
            </form>
          @endif
          @endforeach
          </tr>
        </tbody>
      </table>
      <a target="_blank"href="{{url('/print-order/'.$detail->order_code)}}"><i class="fas fa-file-pdf fa-2x" color="red"></i> Print</a>
    </div>
  </div>
</div>
@endsection