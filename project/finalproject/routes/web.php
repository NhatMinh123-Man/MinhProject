<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Frontend
Route::get('/', 'HomeController@index');
Route::get('/homepage','HomeController@index');
Route::post('/search','HomeController@search');

//Homepage
Route::get('/product-category/{category_id}','CategoryProduct@show_cate_home');
Route::get('/product-brand/{brand_id}','BrandProduct@show_brand_home');
Route::get('/details-product/{product_id}','ProductController@details_product');

//Backend
Route::get('/admin','AdminController@index');
Route::get('/dashboard','AdminController@show_dashboard');
Route::get('/logout','AdminController@logout');

Route::post('/admin-dashboard','AdminController@dashboard');


//Category Product
Route::get('/edit-category-product/{category_product_id}','CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}','CategoryProduct@delete_category_product');
Route::get('/add-category-product','CategoryProduct@add_category_product');
Route::get('/all-category-product','CategoryProduct@all_category_product');

Route::get('/unactive-category-product/{category_product_id}','CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}','CategoryProduct@active_category_product');

Route::post('/save-category-product','CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}','CategoryProduct@update_category_product');

//Brand Product 
Route::get('/edit-brand-product/{brand_product_id}','BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}','BrandProduct@delete_brand_product');
Route::get('/add-brand-product','BrandProduct@add_brand_product');
Route::get('/all-brand-product','BrandProduct@all_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}','BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}','BrandProduct@active_brand_product');

Route::post('/save-brand-product','BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}','BrandProduct@update_brand_product');

//Product
Route::get('/edit-product/{product_id}','ProductController@edit_product');
Route::get('/delete-product/{product_id}','ProductController@delete_product');
Route::get('/add-product','ProductController@add_product');
Route::get('/all-product','ProductController@all_product');

Route::get('/unactive-product/{product_id}','ProductController@unactive_product');
Route::get('/active-product/{product_id}','ProductController@active_product');

Route::post('/save-product','ProductController@save_product');
Route::post('/update-product/{product_id}','ProductController@update_product');

//Cart
Route::post('/save-cart','CartController@save_cart');
Route::post('/update-cart-quantity','CartController@update_cart_quantity');
Route::post('/add-cart-ajax','CartController@add_cart_ajax');
Route::post('/update-cart-ajax','CartController@update_cart_ajax');

Route::get('/show-cart','CartController@show_cart');
Route::get('/delete-cart/{rowId}','CartController@delete_cart');
Route::get('/cart-ajax','CartController@cart_ajax');
Route::get('/delete-cart-ajax/{session_id}','CartController@delete_cart_ajax');
Route::get('/del-all-product','CartController@delete_all_ajax');

//Coupon
Route::post('/check-coupon','CouponController@check_coupon');
Route::post('/insert-coupon-code','CouponController@insert_coupon_code'); 


Route::get('/insert-coupon','CouponController@insert_coupon');
Route::get('/list-coupon','CouponController@list_coupon');
Route::get('/delete-coupon/{coupon_id}','CouponController@delete_coupon');
Route::get('/del-coupon','CouponController@del_coupon');

//Checkout
Route::get('/login-checkout','CheckoutController@login_checkout');
Route::get('/logout-checkout','CheckoutController@logout_checkout');
Route::get('/checkout','CheckoutController@checkout');
Route::get('/payment','CheckoutController@payment');
Route::get('/delete-fee','CheckoutController@delete_fee');

Route::post('/add-customer','CheckoutController@add_customer');
Route::post('/save-checkout-customer','CheckoutController@save_checkout_customer');
Route::post('/login-customer','CheckoutController@login_customer');
Route::post('/order','CheckoutController@order');
Route::post('/select-delivery-home','CheckoutController@select_delivery_home');
Route::post('/calculate-fee','CheckoutController@calculate_fee');




//Order
Route::get('/manage-order','OrderController@manage_order');
Route::get('/view-order/{order_code}','OrderController@view_order');
Route::get('/print-order/{checkout_code}','OrderController@print_order');

Route::post('/confirm-order','CheckoutController@confirm_order');
Route::post('/update-order-qty','OrderController@update_order_qty');
Route::post('/update-quantity','OrderController@update_quantity');
//Delivery
Route::get('/delivery','DeliveryController@delivery');

Route::post('/select-delivery','DeliveryController@select_delivery');
Route::post('/insert-delivery','DeliveryController@insert_delivery');
Route::post('/select-feeship','DeliveryController@select_feeship');
Route::post('/update-delivery','DeliveryController@update_delivery');

//send mail
Route::get('/send-mail','HomeController@send_mail');

//Login Facebook and Google
Route::get('/login-facebook','LoginController@login_fb');
Route::get('/login-google','LoginController@login_gg');
Route::get('/admin/callback','LoginController@callback_fb');
Route::get('/google/callback','LoginController@callback_gg');


//Slide
Route::get('/manage-slider','BannerController@manage_slider');
Route::get('/add-slider','BannerController@add_slider');
Route::get('/unactive-slide/{slider_id}','BannerController@unactive_slide');
Route::get('/active-slide/{slider_id}','BannerController@active_slide');
Route::get('/delete-slider/{slider_id}','BannerController@delete_slider');

Route::post('/insert-slider','BannerController@insert_slider');

//Export and Import
Route::post('/export-csv','ProductController@export_csv');
Route::post('/import-csv','ProductController@import_csv');
