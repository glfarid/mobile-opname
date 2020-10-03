<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class data_scan extends Model
{
    protected $table = "data_scan";

    public $timestamps = false;

    protected $guarded=[]; 
}
