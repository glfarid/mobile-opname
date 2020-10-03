<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataFisik extends Model
{
 protected $table = "data_fisik";



 protected $fillable = ['id_buku','jdl_buku','rak_buku','ket','status','jmlh_buku','jmlh_asli','id_barcode','sesi'];

 public function jmlh_data(){ 

    return $this->belongsTo(Pustaka::class,'id_buku','ID');



 }





}



