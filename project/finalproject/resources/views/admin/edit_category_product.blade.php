@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Update Product</h3></div>
                        <div class="card-body">
                                <?php
                                    $message = Session::get('message');
                                    if($message){
                                        echo '<span class="text-alert">',$message,'</span>' ;
                                        Session::put('message',null); 
                                    }
                                    ?>
                            @foreach($edit_category_product as $key =>$edit_value)
                            <form role="form" action="{{URL::to('/update-category-product/'.$edit_value->category_id)}}" method="post">
                            {{csrf_field()}}
                            
                                <div class="form-group"> 
                                    <label for="inputEmail">Name Product</label>
                                    <input class="form-control" value="{{$edit_value->category_name}}" 
                                    name="category_product_name" id="inputEmail" type="text" placeholder="Name Product" />
                                </div>
                                <div class="form-group">
                                <label for="inputPassword">Product Description</label>
                                <textarea style="resize:none" row="5" class="form-control" 
                                name="category_product_desc" id="ck6" >{{$edit_value->category_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                <label for="inputPassword">Category Keyword</label>
                                <textarea style="resize:none" row="5" class="form-control" name="category_product_keywords" id="ck3"
                                placeholder="Description">{{$edit_value->meta_keywords}}</textarea>
                                </div>
                                </div>
                                <button type="submit" name="update_category_product" class="btn btn-primary btn-block">UPDATE</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
            </div>
        </div>

@endsection