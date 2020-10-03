<?php

namespace App\Http\Controllers;

use App\DataLogin;
use Illuminate\Http\Request;

class ApiLogin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $login = DataLogin::all();
        return $login;
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
     
        $login = DataLogin::where(["nama" => $request->nama, "password" => $request->password])->get();

        // dd(sizeof($login) > 0);

        if(sizeof($login) > 0){

            return response()->json(["Success"],202);
        }else{
            return response()->json(["Gagal"],404);
            
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $login = DataLogin::wherenama($id)->first();
        if ($login) {
            return response()->json($login);
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


    public function tambah(Request $request)
    {
     
        DataLogin::create([

            'nama' => $request->nama,
            'password' => $request->password,



        ]);

        return response()->json(["success" => "Berhasil Disimpan"]);
        
    }


   
}
