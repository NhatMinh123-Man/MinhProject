<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Socialite;
use App\Login;
use App\Social;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
{   
    public function AuthLogin(){
        $admin_id=Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('admin')->send();
        }
    }
    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $login = Login::where('admin_email',$admin_email)
        ->where('admin_password',$admin_password)->first();
        
        if($login){
            $login_count=$login->count();
            if ($login_count){
            Session::put    ('admin_name',$login->admin_name);
            Session::put('admin_id',$login->admin_id);
            return Redirect::to('/dashboard');
            }
    }else{
            Session::put('message','Wrong email or password. Please input again');
            return Redirect::to('/admin');
        }
}
    public function logout(){ 
        $this->AuthLogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null); 
        return Redirect::to('/admin');
    }


}

