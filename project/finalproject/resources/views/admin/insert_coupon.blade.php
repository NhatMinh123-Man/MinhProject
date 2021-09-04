@extends('admin_layout')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Insert Coupon</h3></div>
                        <div class="card-body">
                                <?php
                                    $message = Session::get('message');
                                    if($message){
                                        echo '<span class="text-alert">',$message,'</span>' ;
                                        Session::put('message',null); 
                                    }
                                    ?>
                            <form role="form" action="{{URL::to('/insert-coupon-code')}}" method="post">
                                {{csrf_field()}}
                                <div class="form-group"> 
                                    <label for="inputEmail">Name Coupon</label>
                                    <input class="form-control" name="coupon_name" id="inputEmail" type="text" placeholder="Name Product" />
                                </div>
                                <div class="form-group">
                                <label for="inputPassword">Coupon code</label>
                                <input type="text" style="resize:none" row="5" class="form-control" name="coupon_code">
                                </div>
                                <div class="form-group">
                                <label for="inputPassword">Quantity</label>
                                <input type="text" style="resize:none" row="5" class="form-control" name="coupon_time" >
                                </div>
                                <div class="form-group">
                                <label for="inputPassword">Function of coupon</label>
                                        <select name="coupon_cond" class="form-control m-bot15">
                                            <option value="0">Choose </option>
                                            <option value="1">Decrease by percent </option>
                                            <option value="2">Decrease by money</option>
                                        </select>
                                </div>
                                <div class="form-group">
                                <label for="inputPassword">Percent or Money Decrease</label>
                                <input type="text" style="resize:none" row="5" class="form-control" name="coupon_num" >
                                </div>
                                </div>
                                <button type="submit" name="add_category_product" class="btn btn-primary btn-block">ADD</button>
                            </form>
                            </div>

                    </div>
            </div>
</div>

@endsection