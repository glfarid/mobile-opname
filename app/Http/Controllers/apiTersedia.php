<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;

use Illuminate\Http\Request;


class apiTersedia extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::select(DB::raw("SELECT pustaka.ID ,pustaka.JUMLAH as jumlah, pustaka.JUDUL as judul, GROUP_CONCAT(peminjaman.ID_PUSTAKA) as peminjaman, GROUP_CONCAT(data_fisik.id_barcode) as data_fisik FROM pustaka LEFT JOIN data_fisik ON data_fisik.id_buku = pustaka.ID LEFT JOIN peminjaman ON peminjaman.ID_PUSTAKA LIKe concat('%',pustaka.ID, '%') AND peminjaman.STATUS = 'pinjam'     GROUP BY pustaka.ID 
        "));
    
      
        $arr = [];
        foreach($data as $d)
        {
        $testing = HelperHelp::dataada($d->peminjaman, $d->data_fisik);
        
        array_push($arr,[
            'ID' => $d->ID,
            'Tersedia' => $testing,
            'Tidak Tersedia' => HelperHelp::caridata($testing,$d->jumlah)
    
            
    
        ]);
            
        }
    
    
        $tersedia = [
            count(array_merge(...array_column($arr,'Tersedia'))),
            count(array_merge(...array_column($arr,'Tidak Tersedia')))
    
        ];
    
    
        return $tersedia;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
