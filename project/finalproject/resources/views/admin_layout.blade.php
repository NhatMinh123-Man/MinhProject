<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Manage</title>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link href="{{asset('public/backend/css/styles.css')}}" rel="stylesheet" />
        <link href="{{asset('public/backend/css/formValidation.min.css')}}" rel="stylesheet" />
        <link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
        <link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
        <link href="{{asset('public/backend/fontawesome/css/all.css')}}" rel="stylesheet"/>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Admin</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i>
                        <span class="username">
                            <?php
                                $name = Session::get('admin_name');
                                if($name){
                                    echo $name ;
                                }
                                ?>
                        </span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="{{URL::to('/logout')}}">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{URL::to('/dashboard')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Slider banner</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#SliLayout" aria-expanded="false" aria-controls="SliLayout">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Slider banner
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="SliLayout" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{URL::to('/add-slider')}}">Add Slider</a>
                                    <a class="nav-link" href="{{URL::to('/manage-slider')}}">List Slider</a>
                                </nav>
                            </div> 

                            <div class="sb-sidenav-menu-heading">Manage Product</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#CateLayout" aria-expanded="false" aria-controls="CateLayout">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Category  
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="CateLayout" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{URL::to('/add-category-product')}}">Add Category Products</a>
                                    <a class="nav-link" href="{{URL::to('/all-category-product')}}">Category Products List </a>
                                </nav>
                            </div> 
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#BrandLayout" aria-expanded="false" aria-controls="BrandLayout">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Brands
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="BrandLayout" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{URL::to('/add-brand-product')}}">Add Brands</a>
                                    <a class="nav-link" href="{{URL::to('/all-brand-product')}}">Brands List</a>
                                </nav>
                            </div> 
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#ProductLayout" aria-expanded="false" aria-controls="ProductLayout">
                                <div class="sb-nav-link-icon"><i class="fab fa-product-hunt"></i></div>
                                Product
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="ProductLayout" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{URL::to('/add-product')}}">Add Product</a>
                                    <a class="nav-link" href="{{URL::to('/all-product')}}">Product List</a>
                                </nav>
                            </div> 

                            <div class="sb-sidenav-menu-heading">Manage Order</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#OrderLayout" aria-expanded="false" aria-controls="OrderLayout">
                                <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                                Order
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="OrderLayout" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{URL::to('/manage-order')}}">Order History</a>
                                </nav>
                            </div> 

                            <div class="sb-sidenav-menu-heading">Manage Coupon</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#CouponLayout" aria-expanded="false" aria-controls="CouponLayout">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Coupon
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="CouponLayout" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{URL::to('/insert-coupon')}}">Add Coupon</a>
                                </nav>
                            </div> 
                            <div class="collapse" id="CouponLayout" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{URL::to('/list-coupon')}}">List Coupon</a>
                                </nav>
                            </div> 


                            <div class="sb-sidenav-menu-heading">Manage Delivery</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#ShippingLayout" aria-expanded="false" aria-controls="ShippingLayout">
                                <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                                Delivery
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="ShippingLayout" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="{{URL::to('/delivery')}}">Delivery</a>
                                </nav>
                            </div> 
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                           <?php
                            $name = Session::get('admin_name');
                                if($name){
                                    echo $name ;
                                }
                            ?>
                    </div>
                </nav>
            </div>


           <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                     @yield('admin_content')
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2021</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="{{asset('public/backend/js/scripts.js')}}"></script>
        <script src="{{asset('public/backend/js/chart-area-demo.js')}}"></script>
        <script src="{{asset('public/backend/js/chart-bar-demo.js')}}"></script>
        <script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
        <script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
        <script src="{{asset('public/backend/js/scripts.js')}}"></script>
        <script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
        <script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
        <script src="{{asset('public/backend/ckeditor/ckeditor.js')}}"></script>
        <script src="{{asset('public/backend/fontawesome/all.js')}}"></script>
        <script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
        <script>
            CKEDITOR.replace('ck1');
            CKEDITOR.replace('ck2'); 
            CKEDITOR.replace('ck3');
            CKEDITOR.replace('ck4');
            CKEDITOR.replace('ck5');
            CKEDITOR.replace('ck6');
            CKEDITOR.replace('ck7');
            CKEDITOR.replace('ck8');
        </script>

 <script type="text/javascript">
    $(document).ready(function(){  
        fetch_delivery();

        function fetch_delivery(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
     url : '{{url('/select-feeship')}}',
     method: 'POST',
     data:{_token:_token},
     success:function(data){
        $('#load_delivery').html(data);
     }
    });
        }
       
       
     $(document).on('blur','.fee_feeship_edit',function(){
         var feeship_id = $(this).data('feeship_id');
         var fee_value = $(this).text();
         var _token = $('input[name="_token"]').val();

         $.ajax({
                url : '{{url('/update-delivery')}}',
                method: 'POST',
                data:{feeship_id:feeship_id, fee_value:fee_value, _token:_token},
                success:function(data){
                   fetch_delivery();
                }
            });

        });

$('.add_delivery').click(function(request){
var city = $('.city').val();
var district = $('.district').val();
var ward = $('.ward').val();
var feeship = $('.feeship').val();
var _token = $('input[name="_token"]').val();
 $.ajax({
     url : '{{url('/insert-delivery')}}',
     method: 'POST',
     data:{city:city, district:district, _token:_token, ward:ward, feeship:feeship},
     success:function(data){
        fetch_delivery();
     }
 });
});

$('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';

            if(action=='city'){
                result = 'district';
            }else{
                result = 'ward';
            }
            $.ajax({
            url : '{{url('/select-delivery')}}',
            method: 'POST',
            data:{action:action,ma_id:ma_id,_token:_token},
            success:function(data){
                $('#'+result).html(data);     
            }
        });
        }); 
    })
 </script> 

<script type="text/javascript">
    $('.order_delivery').change(function(){
        var order_status =$(this).val();
        var order_id= $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();
        
        quantity=[];
        $("input[name='product_sales_qty']").each(function(){
            quantity.push($(this).val());
        });

        order_product_id =[];
        $("input[name='order_product_id']").each(function(){
            order_product_id.push($(this).val());
        });
        j=0;
        for(i=0;i<order_product_id.length;i++){
            var order_qty=$('.order_qty_'+order_product_id[i]).val();
            var order_storage=$('.order_storage_'+order_product_id[i]).val();
          if(parseInt(order_qty)>parseInt(order_storage)){
              j=j+1;
            if(j==1){
                alert('Not enough product for sale')
            }
            $('.color_qty_'+order_product_id[i]).css('background','red');
          }
        }
        if(j==0){
            $.ajax({    
            url : '{{url('/update}-order-qty')}}',
            method: 'POST',
            data:{_token:_token, order_status:order_status, order_id:order_id, quantity:quantity, order_product_id:order_product_id},
            success:function(data){
                alert('Update successfully');
                location.reload(); 
            }
        });
    }   
})
</script>

<script type='text/javascript'>
    $('.update_qty').click(function(){
        var order_product_id=$(this).data('product_id');
        var order_qty = $('.order_qty_'+order_product_id).val();
        var order_code = $('.order_code').val();
        var _token = $('input[name="_token"]').val();
    //    alert(order_product_id);
    //    alert(order_qty);
    //    alert(order_code);
       
        $.ajax({
            url : '{{url('/update-quantity')}}',
            method: 'POST',
            data:{_token:_token, order_product_id:order_product_id, order_qty:order_qty, order_code:order_code},
            success:function(data){
                alert('Change quatity of product successfully');
                location.reload(); 
            }
    });
 })

</script>

<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
        <script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
        <script src="{{asset('public/backend/js/datatables-simple-demo.js')}}"></script>
        <script src="{{asset('public/backend/js/formValidation.min.js')}}"></script>
        <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"> </script> 
</body>
</html>
