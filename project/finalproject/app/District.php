<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public $timestamps = false; // set time
    protected $fillable=[
        'name_district','type','matp'
    ];
    protected $primaryKey ='maqh';
    protected $table='tbl_quanhuyen';
}
