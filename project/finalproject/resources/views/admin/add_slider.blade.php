
@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Slide</h3></div>
                        <div class="card-body">
                                <?php
                                    $message = Session::get('message');
                                    if($message){
                                        echo '<span class="text-alert">',$message,'</span>' ;
                                        Session::put('message',null); 
                                    }
                                    ?>
                            <form role="form" action="{{URL::to('/insert-slider')}}" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                                <div class="form-group"> 
                                    <label for="inputEmail">Slider name</label>
                                    <input class="form-control" name="slider_name" id="inputEmail" type="text"/>
                                </div>
                                <div class="form-group">
                                <label for="inputPassword">Description</label>
                                <textarea style="resize:none" row="5" class="form-control" name="slider_desc" id="ck4"></textarea>
                                </div>
                                <div class="form-group">
                                <label for="inputPassword">Image</label>
                                <input class="form-control" name="slider_image" id="inputEmail" type="file" />
                                </div>
                                <div class="form-group">
                                <label>Status</label>
                                <select name="slider_status" class="form-control m-bot15">
                                <option value="1">Show</option>
                                <option value="0">Hide</option>
                            </select>
                                </div>
                                </div>
                                <button type="submit" name="add_slider" class="btn btn-primary btn-block">ADD</button>
                            </form>
                            </div>

                        </div>
            </div>
        </div>

@endsection