<?php

namespace App\Http\Controllers;

use App\DataEror;
use App\DataFisik;
use App\Peminjaman;
use App\Pustaka;
use Illuminate\Http\Request;
use Symfony\Component\VarDumper\Cloner\Data;

class ApiDataFisikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opname = DataFisik::all();
        return $opname;
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


        $error = Peminjaman::where('ID_PUSTAKA','LIKE','%'.$request->id_buku.'%')->get();
     


        DataFisik::Create([

            'id_buku' => $request->id_buku,
            'jdl_buku' => $request->jdl_buku,
            'rak_buku' => $request->rak_buku,
            'ket' => $request->ket,
            'status' => $request->status,
            'jmlh_buku' => $request->jmlh_buku,
            'jmlh_asli' => $request->jmlh_asli,
            'id_barcode' => $request->id_barcode,
            'sesi' => $request->sesi,
            
        ]);


       
        DataEror::create([


            'id_buku' => $request->id_buku,
            'jdl_buku' => $request->jdl_buku,
            'rak_buku' => $request->rak_buku,
            'data_sistem' => $request->data_sistem,
            'id_barcode' =>implode(',',array_column($error->toArray(),'ID_PUSTAKA')),


        ]);

         $datafisik = DataFisik::where('id_buku', $request->id_buku)->get();

        $jumlah = 0;

        foreach ($datafisik as $df) {
            $buku[] = $df->id_barcode;
            $peminjaman = Peminjaman::where('ID_PUSTAKA', 'LIKE', '%' . $df->id_buku . '%')->get();
            $jumlah = $df->jmlh_data->JUMLAH;

            foreach ($peminjaman as $p) {
                array_push($buku, $p->ID_PUSTAKA);
            }

            
        }

     
        $bukuasli = array_unique($buku);


        sort($bukuasli);

        function caridata($list, $max)
        {

            $DADA = [];
            $nampung_data = '';
            foreach ($list as $a) {

                $nampung_data =  explode('.', $a)[0];

                array_push($DADA, explode('.', $a)[1]);
            }


            $new_array = range(min($DADA), $max);

            return array_diff($new_array, $DADA);
        }

        //   dd(caridata($bukuasli, $jumlah));

        DataEror::where('id_buku',$request->id_buku)->create([

            'id_buku' => $request->id_buku,
            'jdl_buku' => $request->jdl_buku,
            'rak_buku' => $request->rak_buku,
            'data_sistem' => $request->data_sistem,
            'id_barcode' => json_encode(caridata($bukuasli,$jumlah)),
        ]);



        return response()->json(["success" => "Berhasil Disimpan"]);
    }


    

    public function joinTable(Request $request)
    {
    //     $datafisik = DataFisik::where('id_buku', $request->id_buku)->get();

    //     $jumlah = 0;

    //     foreach ($datafisik as $df) {
    //         $buku[] = $df->id_barcode;
    //         $peminjaman = Peminjaman::where('ID_PUSTAKA', 'LIKE', '%' . $df->id_buku . '%')->get();
    //         $jumlah = $df->jmlh_data->JUMLAH;

    //         foreach ($peminjaman as $p) {
    //             array_push($buku, $p->ID_PUSTAKA);
    //         }
    //     }

     
    //     $bukuasli = array_unique($buku);


    //     sort($bukuasli);

    //     function caridata($list, $max)
    //     {

    //         $DADA = [];
    //         $nampung_data = '';
    //         foreach ($list as $a) {

    //             $nampung_data =  explode('.', $a)[0];

    //             array_push($DADA, explode('.', $a)[1]);
    //         }


    //         $new_array = range(min($DADA), $max);

    //         return array_diff($new_array, $DADA);
    //     }

    //       dd(caridata($bukuasli, $jumlah));

    //     DataEror::where('id_buku',$request->id_buku)->Insert([

    //         'id_buku' => $request->id_buku,
    //         'jdl_buku' => $request->jdl_buku,
    //         'rak_buku' => $request->rak_buku,
    //         'data_sistem' => $request->data_sistem,
    //         'id_barcode' => json_encode(caridata($bukuasli,$jumlah)),
    //     ]);

    // //  json_encode(caridata($bukuasli,$jumlah));

    }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $opname = DataFisik::whereid_buku($id)->first();
        if ($opname) {
            return response()->json($opname);
        } else {
            return response()->json(["status" => "ID tidak ada"]);
        }
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
