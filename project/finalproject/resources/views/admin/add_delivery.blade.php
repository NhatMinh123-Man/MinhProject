
@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Delivery</h3></div>
                        <div class="card-body">
                                <?php
                                    $message = Session::get('message');
                                    if($message){
                                        echo '<span class="text-alert">',$message,'</span>' ;
                                        Session::put('message',null); 
                                    }
                                    ?>
                        <form >
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
                            <select name="district" id="district" class="form-control input-sm m-bot15 district choose">
                            <option value="">Choose District</option>
                            </select>
                        </div>
                    
                        <div class="form-group">
                            <label>Choose Ward</label>
                            <select name="ward" id="ward" class="form-control input-sm m-bot15 ward">
                            <option value="">Choose Ward</option>
                            </select>
                        </div>

                        <div class="form-group"> 
                        <label>Fee</label>
                        <input class="form-control feeship"name="feeship" type="text">
                    </div>
                    </div>
                    <button type="button" name="add_delivery" class="btn btn-info add_delivery">Add Delivery</button>
                    </form>
                 </div>
                    <div id="load_delivery">
                    </div>
        </div>
    </div>
</div>

@endsection