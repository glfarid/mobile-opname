<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
    //     $report =  DB::table('pustaka')->select("pustaka.ID","pustaka.JUMLAH"
    //     ,DB::raw("(GROUP_CONCAT(peminjaman.ID_PUSTAKA)) as `peminjaman`"))
    // ->leftjoin("peminjaman","peminjaman.ID_PUSTAKA","=","pustaka.ID")
    // ->selectRaw()
    // ->groupBy('pustaka.ID')
    // ->get();

    $data = DB::select(DB::raw("SELECT pustaka.ID ,pustaka.JUMLAH as jumlah, pustaka.JUDUL as judul, GROUP_CONCAT(peminjaman.ID_PUSTAKA) as peminjaman, GROUP_CONCAT(data_fisik.id_barcode) as data_fisik FROM pustaka LEFT JOIN data_fisik ON data_fisik.id_buku = pustaka.ID LEFT JOIN peminjaman ON peminjaman.ID_PUSTAKA LIKe concat('%',pustaka.ID, '%') AND peminjaman.STATUS = 'pinjam'     GROUP BY pustaka.ID 
    "));

        // dd($data);




    
        return view('data_scan',compact('data'));
    }
}
