@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="panel panel-default">
  <div class="card-header"><h3 class="text-center font-weight-light my-4">Order List</h3></div>
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
            <th>No</th>
            <th>Order code</th>
            <th>Date</th>
            <th>Status</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @php
            $i=0;
        @endphp
        @foreach($order as $key =>$ord )
        @php
            $i++;
        @endphp

        <tr>
            <td><i>{{$i}}</i></label></td>
            <td>{{$ord->order_code}}</td>
            <td>{{$ord->created_at}}</td>
            <td>
                @if($ord->order_status ==1)
                  New order
                @else
                  Finish
                @endif
            </td>
            <td>
              <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class="active" ui-toggle-class="">
                <i class="fa fa-eye text-success text-active"></i></a>
                <a onclick="return confirm('Do you want detelet this order ?')" href="{{URL::to('/delete-order/'.$ord->order_code)}}" class="active" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i></a>
            </td>  
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection