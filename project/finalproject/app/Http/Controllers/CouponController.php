<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Coupon;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CouponController extends Controller
{
    public function check_coupon(Request $request){
        $data=$request->all();
        $coupon=Coupon::where('coupon_code',$data['coupon'])->first();
        if ($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                $coupon_session = Session::get('coupon');
                if ($coupon_session==true){
                    $is_avaible=0;
                    if($is_avaible==0){
                        $cou[]=array(
                            'coupon_code'=>$coupon->coupon_code,
                            'coupon_cond'=>$coupon->coupon_cond,
                            'coupon_num'=>$coupon->coupon_num,
                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[]=array(
                        'coupon_code'=>$coupon->coupon_code,
                        'coupon_cond'=>$coupon->coupon_cond,
                        'coupon_num'=>$coupon->coupon_num,
                    );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Use coupon code success');
            }
        }else{
                return redirect()->back()->with('message','Coupon code not exist');
            }
}
    public function insert_coupon(){
        return view('admin.insert_coupon');
    }

    public function insert_coupon_code(Request $request){
        $data=$request->all();

        $coupon=new Coupon;

        $coupon->coupon_name=$data['coupon_name'];
        $coupon->coupon_code=$data['coupon_code'];
        $coupon->coupon_time=$data['coupon_time'];
        $coupon->coupon_cond=$data['coupon_cond'];
        $coupon->coupon_num=$data['coupon_num'];
        $coupon->save();
        
        Session::put('message','Insert coupon code success');
        return Redirect::to('insert-coupon');
    }

    public function list_coupon(){
        $coupon= Coupon::orderby('coupon_id','desc')->get();
        return view('admin.list_coupon')->with(compact('coupon'));
    }

    public function delete_coupon($coupon_id){
        $coupon=Coupon::find($coupon_id);
        $coupon->delete();
        
        Session::put('message','Delete coupon code success');
        return Redirect::to('list-coupon');
    }

    public function del_coupon(){
        $coupon=Session::get('coupon');
        if($coupon==true){
            // Session::destroy();
            Session::forget('coupon');
            return redirect()->back()->with('message','Delete coupon complete');
        }

    }
}
