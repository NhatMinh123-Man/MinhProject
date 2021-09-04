@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
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
            <th>Product name</th>
            <th>Quantity</th>
            <th>Product image</th>
            <th>Product price</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Status</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_product as $key =>$pro )
        <tr>
            <td>{{$pro->product_name}}</td>
            <td>{{$pro->product_qty}}</td>
            <td><img src="public/upload/product/{{$pro->product_image}}" height="100" width="100"></td>
            <td>{{$pro->product_price}}</td>
            <td>{{$pro->category_name}}</td>
            <td>{{$pro->brand_name}}</td>
            
            <td><span class="text-ellipsis">
            <?php
            if($pro->product_status ==1){
            ?>
            <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}">
              <span class="fa-thumb-styling fa fa-thumbs-up" color="green"></span></a>
            <?php              
            }else{
            ?>
            <a href="{{URL::to('/active-product/'.$pro->product_id)}}">
            <span class="fa-thumb-styling fa fa-thumbs-down" color="red"></span></a>
            <?php
            }
            ?>
            </span></td>
            <td>
              <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pen text-success text-active"></i></a>
                <a onclick="return confirm('Do you want detelet this product ?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <form action="{{url('import-csv')}}" method="POST" enctype="multipart/form-data">
          @csrf
        <input type="file" name="file" accept=".xlsx"><br>
       <input type="submit" value="Import file Excel" name="import_csv" class="btn btn-warning">
        </form>
       <form action="{{url('export-csv')}}" method="POST">
          @csrf
       <input type="submit" value="Export file Excel" name="export_csv" class="btn btn-success">
      </form>
      </div>
  </div>
</div>
@endsection