@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="card shadow-lg border-0 rounded-lg mt-5">
      <div class="card-header"><h3 class="text-center font-weight-light my-4">List Coupon</h3></div>
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
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Coupon name</th>
            <th>Coupon code</th>
            <th>Coupon qty</th>
            <th>Coupon function</th>
            <th>Coupon Descrease</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
        @foreach($coupon as $key =>$cou )
        <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$cou->coupon_name}}</td>
            <td>{{$cou->coupon_code}}</td>
            <td>{{$cou->coupon_time}}</td>
            <td><span class="text-ellipsis">
            <?php
            if($cou->coupon_cond ==1){
            ?>
           Decrease by percent
            <?php              
            }else{
            ?>
            Decrease by money
            <?php
            }
            ?>
            </span></td>
            
            <td><span class="text-ellipsis">
            <?php
            if($cou->coupon_cond ==1){
            ?>
           Decrease {{$cou->coupon_num}} %
            <?php              
            }else{
            ?>
            Decrease {{$cou->coupon_num}} VND
            <?php
            }
            ?>
            </span></td>
          
            <td>
                <a onclick="return confirm('Do you want detelet this coupon ?')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
    </div>
</div>
@endsection