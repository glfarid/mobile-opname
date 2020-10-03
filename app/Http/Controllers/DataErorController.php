<?php

namespace App\Http\Controllers;

use App\DataEror;
use App\Peminjaman;
use Illuminate\Http\Request;

class DataErorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eror = DataEror::all();

        // $error = Peminjaman::where('ID_PUSTAKA','LIKE','%'.'00071'.'%')->get();
        
        dd($eror);
        

        return view('data_eror',compact('eror'));
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
        DataEror::create([

            'id_buku' =>$request->id_buku,
            'jdl_buku' =>$request->jdl_buku,
            'rak_buku' =>$request->rak_buku,
            'data_sistem' =>$request->data_sistem,
            'id_barcode' =>$request->id_barcode

        ]);


        return redirect()->route('data_eror.index');
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
