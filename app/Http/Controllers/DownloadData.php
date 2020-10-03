<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DownloadData extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // INI UNTUK TERSEDIA(sebelum diolah)

        $datasesi =  DB::select(DB::raw("
          SELECT GROUP_CONCAT(id_barcode) as data_fisik, GROUP_CONCAT(peminjaman.ID_PUSTAKA) as peminjaman
          FROM data_fisik 
          LEFT JOIN peminjaman on peminjaman.ID_PUSTAKA LIKE concat('%',id_buku,'%') AND peminjaman.STATUS = 'pinjam'
          WHERE id_barcode LIKE concat('%',id_buku,'%')  AND sesi LIKE concat ('%', sesi,'%') GROUP BY sesi  
          "));

        //SAMA INI
        $datapustaka =  DB::select(DB::raw("SELECT ID, JUMLAH FROM pustaka GROUP BY ID
          "));




        $datalengkap = collect($datapustaka)->map(function ($value) {
            $newarray = range(1, $value->JUMLAH);



            $databaru = collect($newarray)->map(function ($val) use ($value) {
                return $value->ID . '.' . $val;
            });




            return $databaru->implode(',');
        });






        $explode = collect(explode(',', $datalengkap->implode(',')));



        $arr2 = collect($datasesi)->map(function ($val, $i) use ($explode) {
            return [
                'Sesi' => $i + 1,
                'Tersedia' => Helper::dataada($val->peminjaman, $val->data_fisik),
                'Tidak Tersedia' => $explode->diff(Helper::dataada($val->peminjaman, $val->data_fisik))->all()
            ];
        });



        $print = [];
        foreach ($arr2 as $mp) {
            if (count($mp['Tidak Tersedia']) > count($mp['Tersedia'])) {

                foreach ($mp['Tidak Tersedia'] as $key => $ttsd) {

                    array_push($print, [
                        'Sesi' => $mp['Sesi'],
                        'Tersedia' => (array_key_exists($key, $mp['Tersedia'])) ? $mp['Tersedia'][$key] : '',
                        'Tidak Tersedia' => $ttsd

                    ]);
                }
            } else {

                foreach ($mp['Tidak Tersedia'] as $key => $ttsd) {

                    array_push($print, [
                        'Sesi' => $mp['Sesi'],
                        'Tersedia' => $ttsd,
                        'Tidak Tersedia' => (array_key_exists($key, $mp['Tidak Tersedia'])) ? $mp['Tidak Tersedia'][$key] : ''

                    ]);
                }
            }
        }



        return response()->json($print);
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
