<?php

namespace App\Http\Controllers;

use App\Peminjaman;
use Illuminate\Http\Request;

class ApiPeminjaman extends Controller
{
    public function index(){

        $peminjaman = Peminjaman::all();
        return $peminjaman;
    }

    public function show($id)
    {
        $peminjaman = Peminjaman::where("ID_PUSTAKA",$id)->first();
        if($peminjaman){
        return response()->json($peminjaman);
        }else{
            return response()->json(["status"=>"ID tidak ada"]);
        }
    }
}
