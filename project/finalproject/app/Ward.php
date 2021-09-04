<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    public $timestamps = false; // set time
    protected $fillable=[
        'name_ward','type','maqh',
    ];
    protected $primaryKey ='xaid';
    protected $table='tbl_xaphuongthitran';
}
