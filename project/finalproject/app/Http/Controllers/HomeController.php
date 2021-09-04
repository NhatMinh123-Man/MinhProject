<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Http\Requests;
use Session;
use App\Slider;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{

    public function index(Request $request){
        //slider
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(3)->get();
        
        //seo
        $meta_desc="Sale controller service";
        $meta_keywords="controller";
        $meta_title="E-commerce";
        $url_canonical=$request->url();        
        //end seo

        $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brd_product=DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $all_product=DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(4)->get();
        return view('pages.home')->with('category',$cate_product)->with('brand',$brd_product)
        ->with('all_product',$all_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)
        ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical)->with('slider', $slider);
        //return view('pages.home')->with(compact('cate_product','brd_product','all_product'));
    }

    public function search(Request $request){

        $keyword=$request->keyword_submit;
        $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brd_product=DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $all_product=DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->limit(4)->get();

        $search_product=DB::table('tbl_product')->where('product_name','like','%'.$keyword.'%')->get();

        $slider = Slider::orderby('slider_id','DESC')->where('slider_status','1')->take(3)->get();
        //seo
        $meta_desc="Search";
        $meta_keywords="Controller";
        $meta_title="Search Item";
        $url_canonical=$request->url();        
        //end seo


        return view('pages.product.search')->with('category',$cate_product)->with('brand',$brd_product)->with('all_product',$all_product)->with('slider',$slider)
        ->with('search_product',$search_product)->with('meta_desc', $meta_desc)
        ->with('meta_keywords', $meta_keywords)
        ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
    public function send_mail(){
         //send mail
         $to_name = "Minh";
         $to_email = "nhatminhtbt@gmail.com";//send to this email
 
         $data = array("name"=>"Mail from Minh","body"=>"Mail delivery"); //body of mail.blade.php
     
         Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){
             $message->to($to_email)->subject('test mail');//send this mail with subject
             $message->from($to_email,$to_name);//send from this mail
         });
         //--send mail
        
         return Redirect::to('/')->with('message','');
    }
}
