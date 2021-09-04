<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Coupon;
use App\Slider;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
session_start();


class CartController extends Controller
{
    public function save_cart(Request $request){
        
        $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brd_product=DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();

        $productId =$request->productid_hide;
        $quantity=$request->qty;

        $product_info=DB::table('tbl_product')->where('product_id',$productId)->first();
        
        $data['meta_keywords']=$request->cart_keywords;
        $data ['id']=$product_info->product_id;
        $data ['qty']=$quantity;
        $data ['name']=$product_info->product_name;
        $data ['price']=$product_info->product_price;
        $data ['weight']='123';
        $data ['options']['image']=$product_info->product_image;
        Cart::add($data);
        // Cart::destroy();
        return Redirect::to('/cart-ajax');
    }

    public function show_cart(Request $request){
        $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brd_product=DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        
         //seo
         $meta_desc="Cart";
         $meta_keywords="Cart";
         $meta_title="Cart";
         $url_canonical=$request->url();        
         //end seo
        

        return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brd_product)
        ->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)
        ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
}

    public function delete_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/cart-ajax');
    }

    public function update_cart_quantity(Request $request){
        $rowId=$request->rowId_cart;
        $qty=$request->cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/cart-ajax');
    }


    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id =substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if ($cart==true){
            $is_avaiable =0;
            foreach($cart as $key => $val){
                if($val ['product_id']==$data['cart_product_id']){
                    $is_avaiable++;
                }
            }
            if($is_avaiable == 0 ){
                $cart[] = array(
                    'session_id' =>$session_id,
                    'product_name'=> $data['cart_product_name'],
                    'product_id'=> $data['cart_product_id'],
                    'product_image'=> $data['cart_product_image'],
                    'product_qty'=> $data['cart_product_qty'],
                    'product_price'=> $data['cart_product_price'],
                    
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[]= array(
                'session_id' =>$session_id,
                'product_name'=> $data['cart_product_name'],
                'product_id'=> $data['cart_product_id'],
                'product_image'=> $data['cart_product_image'],
                'product_qty'=> $data['cart_product_qty'],
                'product_price'=> $data['cart_product_price'],
                
            );   
            Session::put('cart',$cart);
        }
     
        Session::save();
      
    }


    public function delete_cart_ajax($session_id){
        $cart=Session::get('cart');
        if($cart==true){
            foreach($cart as $key=>$val){
                if($val['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Delete product success');
        }else{
            return redirect()->back()->with('message','Delete product fail');
        }
    }

    public function update_cart_ajax(Request $request){
        $data=$request->all();
        $cart=Session::get('cart');
        if($cart==true){
            foreach($data['cart_qty'] as $key => $qty){
                foreach($cart as $session => $val){
                    if($val['session_id']==$key){
                        $cart[$session]['product_qty']=$qty;
                    }
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Update product successful');
        }else{
        return redirect()->back()->with('message','Update product successful');
        }
    }

    public function delete_all_ajax(){
        $cart=Session::get('cart');
        if($cart==true){
            // Session::destroy();
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back()->with('message','Delete complete');
        }

    }


    public function cart_ajax(Request $request){
        $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brd_product=DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        
        $slider = Slider::orderby('slider_id','DESC')->where('slider_status','1')->take(3)->get();
         //seo
         $meta_desc="Cart";
         $meta_keywords="Cart";
         $meta_title="Cart";
         $url_canonical=$request->url();        
         //end seo
        

        return view('pages.cart.cart_ajax')->with('category',$cate_product)->with('brand',$brd_product)
        ->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)
        ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider',$slider);
    }


  

}
