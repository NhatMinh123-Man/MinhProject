<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $timestamps = false; // set time
    protected $fillable=[
        'coupon_name','coupon_code','coupon_time','coupon_num','coupon_cond'
    ];
    protected $primaryKey ='coupon_id';
    protected $table='tbl_coupon';

}
