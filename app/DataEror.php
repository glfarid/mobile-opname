<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataEror extends Model
{
    protected $table = 'data_eror';

    protected $fillable = ['id','id_buku','jdl_buku','rak_buku','data_sistem','id_barcode'];

    // protected $guarded = ['data_sistem','id_barcode'];
}

