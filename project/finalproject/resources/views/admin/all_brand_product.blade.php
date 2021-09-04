@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="card shadow-lg border-0 rounded-lg mt-5">
      <div class="card-header"><h3 class="text-center font-weight-light my-4">Brand List</h3></div>
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
            <th>Brand name</th>
            <th>Status</th>
            <th>Desc</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_brand_product as $key =>$brd_pro )
        <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$brd_pro->brand_name}}</td>
            <td><span class="text-ellipsis">
            <?php
            if($brd_pro->brand_status ==1){
            ?>
            <a href="{{URL::to('/unactive-brand-product/'.$brd_pro->brand_id)}}">
              <span class="fa-thumb-styling fa fa-thumbs-up" color="green"></span></a>
            <?php              
            }else{
            ?>
            <a href="{{URL::to('/active-brand-product/'.$brd_pro->brand_id)}}">
            <span class="fa-thumb-styling fa fa-thumbs-down" color="red"></span></a>
            <?php
            }
            ?>
            </span></td>
            </td> <td>{{$brd_pro->brand_desc}}</td>
            <td>
              <a href="{{URL::to('/edit-brand-product/'.$brd_pro->brand_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pen text-success text-active"></i></a>
                <a onclick="return confirm('Do you want detelet this product ?')" href="{{URL::to('/delete-brand-product/'.$brd_pro->brand_id)}}" class="active" ui-toggle-class="">
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