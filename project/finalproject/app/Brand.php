<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public $timestamps = false; // set time
    protected $fillable=[
        'brand_name','brand_desc','brand_status'
    ];
    protected $primaryKey ='brand_id';
    protected $table='tbl_brand_product';
}
