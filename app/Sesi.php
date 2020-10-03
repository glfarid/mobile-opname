<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sesi extends Model
{
    protected $table = "sesi";

    protected $fillable = ['nama_sesi','nama_audit'];
}
