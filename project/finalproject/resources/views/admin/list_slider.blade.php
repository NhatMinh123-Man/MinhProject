@extends('admin_layout')
@section('admin_content')

<div class="table-agile-info">
  <div class="card shadow-lg border-0 rounded-lg mt-5">
      <div class="card-header"><h3 class="text-center font-weight-light my-4">List Slider</h3></div>
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
            <th>Slide name</th>
            <th>Image</th>
            <th>Status</th>
            <th>Desc</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
        @foreach($all_slide as $key => $slide )
        <tr>
            <td>{{$slide->slider_name}}</td>
            <td><img src="public/upload/slider/{{$slide->slider_image}}" height="100" width="100"></td>
            <td><span class="text-ellipsis">
            <?php
            if($slide->slider_status ==1){
            ?>
            <a href="{{URL::to('/unactive-slide/'.$slide->slider_id)}}">
              <span class="fa-thumb-styling fa fa-thumbs-up" color="green"></span></a>
            <?php              
            }else{
            ?>
            <a href="{{URL::to('/active-slide/'.$slide->slider_id)}}">
            <span class="fa-thumb-styling fa fa-thumbs-down" color="red"></span></a>
            <?php
            }
            ?>
            </span></td>
            </td> 
            <td>{{$slide->slider_desc}}</td>
            <td>
                <a onclick="return confirm('Do you want detelet this slide ?')" href="{{URL::to('/delete-slider/'.$slide->slider_id)}}" class="active" ui-toggle-class="">
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