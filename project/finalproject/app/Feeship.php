<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    public $timestamps = false; // set time
    protected $fillable=[
        'fee_city','fee_distr','fee_ward','fee_feeship'
    ];
    protected $primaryKey ='fee_id';
    protected $table='tbl_feeship';


    public function city(){
        return $this->belongsTo('App\City','fee_city');
    }

    public function district(){
        return $this->belongsTo('App\District','fee_distr');
    }

    public function ward(){
        return $this->belongsTo('App\Ward','fee_ward');
    }
}

