<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataLogin extends Model
{
      protected $table = "login";

      protected $fillable = ['nama','password'];
}
