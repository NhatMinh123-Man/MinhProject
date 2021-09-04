@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Product</h3></div>
                        <div class="card-body">
                                <?php
                                    $message = Session::get('message');
                                    if($message){
                                        echo '<span class="text-alert">',$message,'</span>' ;
                                        Session::put('message',null); 
                                    }
                                    ?>
                            <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype='multipart/form-data'>
                            {{csrf_field()}}
                                <div class="form-group"> 
                                    <label for="inputEmail">Name Product</label>
                                    <input class="form-control" data-validation="number" data-validation-length="min10"
                                    data-validation-error-msg="Input at least 10 value"
                                    name="product_qty" id="inputEmail" type="text" placeholder="Name Product" />
                                </div>
                                <div class="form-group"> 
                                    <label for="inputEmail">Quantity</label>
                                    <input class="form-control" data-validation="length" data-validation-length="min10"
                                    data-validation-error-msg="Input at least 10 value"
                                    name="product_name" id="inputEmail" type="number"/>
                                </div>
                                <div class="form-group"> 
                                    <label for="inputEmail">Product Image</label>
                                    <input class="form-control" name="product_image" id="inputEmail" type="file" />
                                </div>
                                <div class="form-group"> 
                                    <label for="inputEmail">Product Price</label>
                                    <input class="form-control" name="product_price" id="inputEmail" type="text" placeholder="Price" />
                                </div>
                                <div class="form-group">
                                <label for="inputPassword">Product Description</label>
                                <textarea style="resize:none" row="5" class="form-control" name="product_desc" id="ck1"
                                placeholder="Description"></textarea>
                                </div>
                                <div class="form-group">
                                <label for="inputPassword">Product Content</label>
                                <textarea style="resize:none" row="5" class="form-control" name="product_content" id="ck2"
                                placeholder="Content"></textarea>
                                </div>
                                <div class="form-group">
                                <label for="inputPassword">Product Keyword</label>
                                <textarea style="resize:none" row="5" class="form-control" name="product_keywords" id="ck3"
                                placeholder="Description"></textarea>
                                </div>
                                <div class="form-group">
                                <label>Category</label>
                                <select name="product_cate" class="form-control m-bot15">
                                @foreach ($cate_product as $key =>$cate)
                                <option value="{{($cate->category_id)}}">{{($cate->category_name)}}</option>
                                @endforeach
                            </select>
                                </div><div class="form-group">
                                <label>Brands</label>
                                <select name="product_brand" class="form-control m-bot15">
                                @foreach ($brd_product as $key =>$brd)
                                <option value="{{($brd->brand_id)}}">{{($brd->brand_name)}}</option>
                                @endforeach
                            </select>
                                </div>

                                <div class="form-group">
                                <label>Type</label>
                                <select name="product_status" class="form-control m-bot15">
                                <option value="1">Show</option>
                                <option value="0">Hide</option>
                            </select>
                                </div>
                                </div>
                                <button type="submit" name="add_product" class="btn btn-primary btn-block">ADD</button>
                            </form>
                            </div>

                        </div>
            </div>
        </div>

@endsection