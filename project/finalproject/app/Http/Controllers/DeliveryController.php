<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\District;
use App\Ward;
use App\Feeship;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class DeliveryController extends Controller
{
    public function delivery(Request $request){
        $city= City::orderby('matp','ASC')->get();
        return view('admin.add_delivery')->with(compact('city'));
    }

    public function select_delivery(Request $request){
        $data = $request->all();
        if($data['action']){
            $output ='';
            if($data['action']=="city"){
                $select_district = District::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
                $output.='<option>Choose District</option>';
                foreach($select_district as $key => $district){ 
                    $output.='<option value="'.$district->maqh.'">'.$district->name_district.'</option>';
                } 
            }else{
                $select_ward = Ward::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
                $output.='<option>Choose Ward</option>';
                foreach($select_ward as $key => $ward){ 
                    $output.='<option value="'.$ward->xaid.'">'.$ward->name_ward.'</option>';
                } 
            }
        }
        echo $output;
    }


    public function insert_delivery(Request $request){
        $data=$request->all();
        $fee=new Feeship();
        $fee->fee_city= $data['city'];
        $fee->fee_distr= $data['district'];
        $fee->fee_ward= $data['ward']; 
        $fee->fee_feeship= $data['feeship'];
        $fee->save();
    }


    public function select_feeship(){
        $feeship = Feeship::orderby('fee_id','DESC')->get();
        $output = '';
        $output .= '<div class="table-responsive">  
            <table class="table table-bordered">
                <thread> 
                    <tr>
                        <th>City Name</th>
                        <th>District</th> 
                        <th>Ward</th>
                        <th>Fee ship</th>
                    </tr>  
                </thread>
                <tbody>
                ';
    
                foreach($feeship as $key => $fee){

                $output.='
                    <tr>
                        <td>'.$fee->city->name_city.'</td>
                        <td>'.$fee->district->name_district.'</td>
                        <td>'.$fee->ward->name_ward.'</td>
                        <td contenteditable data-feeship_id="'.$fee->fee_id.'" class="fee_feeship_edit">'.number_format($fee->fee_feeship,0,',','.').'</td>
                    </tr>
                    ';
                }

                $output.='      
                </tbody>
                </table></div>
                ';

                echo $output;
    }

    public function update_delivery(Request $request){
        $data = $request->all();
        $fee_ship =  Feeship::find($data['feeship_id']);
        $fee_value = rtrim($data['fee_value'],'.'); 
        $fee_ship->fee_feeship = $fee_value;
        $fee_ship->save();
    }
}
