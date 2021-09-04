@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Add Category Product</h3></div>
                        <div class="card-body">
                                <?php
                                    $message = Session::get('message');
                                    if($message){
                                        echo '<span class="text-alert">',$message,'</span>' ;
                                        Session::put('message',null); 
                                    }
                                    ?>
                            <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                            {{csrf_field()}}
                                <div class="form-group"> 
                                    <label for="inputEmail">Name Product</label>
                                    <input class="form-control" name="category_product_name" id="inputEmail" type="text" placeholder="Name Product" />
                                </div>
                                <div class="form-group">
                                <label for="inputPassword">Product Description</label>
                                <textarea style="resize:none" row="5" class="form-control" name="category_product_desc" id="ck3"
                                placeholder="Description"></textarea>
                                </div>
                                <div class="form-group">
                                <label for="inputPassword">Category Keyword</label>
                                <textarea style="resize:none" row="5" class="form-control" name="category_product_keywords" id="ck3"
                                placeholder="Description"></textarea>
                                </div>
                                <div class="form-group">
                                <label>Type</label>
                                <select name="category_product_status" class="form-control m-bot15">
                                <option value="1">Show</option>
                                <option value="0">Hide</option>
                            </select>
                                </div>
                                </div>
                                <button type="submit" name="add_category_product" class="btn btn-primary btn-block">ADD</button>
                            </form>
                            </div>

                    </div>
            </div>
</div>

@endsection