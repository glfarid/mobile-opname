<?php

namespace App\Http\Controllers;

use App\DataEror;
use App\DataFisik;
use App\Peminjaman;
use App\Pustaka;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataFisikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //tipe data collection
        $opname = DataFisik::all();
        return view('opname', compact('opname'));
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

        DataFisik::create([

            'id_buku' => $request->id_buku,
            'jdl_buku' => $request->jdl_buku,
            'rak_buku' => $request->rak_buku,
            'ket' => $request->ket,
            'sesi' => $request->sesi,
            'status' => $request->status,
            'jmlh_buku' => $request->jmlh_buku,
            'jmlh_asli' => $request->jmlh_asli,
            'id_barcode' => $request->id_barcode,
        ]);


        return redirect()->route('opname.index');
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
        DataFisik::where('id', $id)->update([
            'id_buku' => $request->id_buku,
            'jdl_buku' => $request->jdl_buku,
            'rak_buku' => $request->rak_buku,
            'ket' => $request->ket,
            'sesi' => $request->sesi,
            'jmlh_asli' => $request->jmlh_asli,
            'id_barcode' => $request->id_barcode,
        ]);

        return redirect()->back()->with('alert-success', 'Edit Data Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // DB::table('DataFisik')->where('id_barcode',$id)->delete();
        // return redirect('/opname');

        DataFisik::where('id', $id)->delete();
        return redirect()->back()->with('alert-success', 'Hapus Data Berhasil!!');
    }
}
