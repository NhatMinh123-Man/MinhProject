<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ExcelImport;
use App\Exports\ExcelExport;
use Excel;
use Product;
use App\Slider;
use DB;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
    //Backend
    public function AuthLogin(){
        $admin_id=Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function add_product(){
        $this->AuthLogin();
        $cate_product=DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brd_product=DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();
        return view('admin.add_product')->with('cate_product',$cate_product)->with('brd_product',$brd_product);
    }
    public function all_product(){
        $this->AuthLogin();
        $all_product =  DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();
        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manager_product);
    } 
    public function save_product(Request $request){
        $this->AuthLogin();
        $data=array();
        $data['product_name']=$request->product_name;
        $data['product_qty']=$request->product_qty;
        $data['product_price']=$request->product_price;
        $data['product_desc']=$request->product_desc;
        $data['product_content']=$request->product_content;
        $data['category_id']=$request->product_cate;
        $data['brand_id']=$request->product_brand;
        $data['product_status']=$request->product_status;
        $data['meta_keywords']=$request->product_keywords;
        $get_image = $request->file ('product_image');
        if($get_image){
            $get_name_image=$get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image']=$new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Add product successful');
            return Redirect::to('add-product');

        }
        $data['product_image']='';
       DB::table('tbl_product')->insert($data);
       Session::put('message','Add product successful');
       return Redirect::to('all-product');
    }
    
    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Hide product');
        return Redirect::to('all-product');
    }
    
    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Show product');
        return Redirect::to('all-product');
    }
    
    public function edit_product ($product_id){
        $this->AuthLogin();
        $cate_product=DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brd_product=DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();

        $edit_product =  DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)
        ->with('brd_product',$brd_product);
        return view('admin_layout')->with('admin.edit_product',$manager_product);
    
    }
    
    public function update_product (Request $request,$product_id){
        $this->AuthLogin();
        $data=array();
        $data['product_name']=$request->product_name;
        $data['product_qty']=$request->product_qty;
        $data['product_price']=$request->product_price;
        $data['product_desc']=$request->product_desc;
        $data['product_content']=$request->product_content;
        $data['category_id']=$request->product_cate;
        $data['brand_id']=$request->product_brand;
        $data['product_status']=$request->product_status;
        $data['meta_keywords']=$request->product_keywords;
        $get_image=$request->file('product_image');
        if($get_image){
            $get_name_image=$get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['product_image']=$new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Update product successful');
            return Redirect::to('add-product');

        }
        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Update product successful');
        return Redirect::to('all-product'); 
    }
    
    public function delete_product ($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Delete product successful');
        return Redirect::to('all-product'); 
    }
    //end Backend

   public function details_product(Request $request,$product_id){
        $cate_product=DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brd_product=DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $details_product=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();
        $slider = Slider::orderBy('slider_id','DESC')->where('slider_status','1')->take(3)->get();
        foreach ($details_product as $key => $value){
            $category_id = $value->category_id;
            //seo
            $meta_desc=$value->product_desc;
            $meta_keywords=$value->meta_keywords;
            $meta_title=$value->product_name;
            $url_canonical=$request->url();        
            //end seo
        }
        $related_product=DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)
        ->whereNotIn('tbl_product.product_id',[$product_id])->get();

    
        return view('pages.product.show_detail')->with('category',$cate_product)->with('brand',$brd_product)->with('slider',$slider)
       ->with('product_details',$details_product)->with('related',$related_product)
       ->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)
       ->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }

    public function export_csv(){
        return Excel::download(new ExcelExport , 'product.xlsx');
    }

    public function import_csv(Request $request){
        $path = $request->file('file')->getRealPath();
        Excel::import(new ExcelImport, $path);
        return back();
    }

}


