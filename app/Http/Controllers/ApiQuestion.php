<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class ApiQuestion extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $question = Question::all();
        return $question;
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
    
        Question::create([
            'nama' => $request->nama,
            'nim' =>$request->nim,
            'username' =>$request->username,
            'password' =>$request->password
        ]);

        return response()->json(["Message" => "Berhasil Disimpan"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Question::where('id',$id)->get();
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
        Question::where('id',$id)->update([
            'nama' => $request->nama,
            'nim' => $request->nim,
            'username' => $request->username,
            'password' => $request->password
          
        ]);

        return response()->json(["message" => "Berhasil"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $question = Question::where('nama',$id)->delete();

        // return response()->json(["success" => "Berhasil Di hapus"]);


        $tes = Question::where('id',$id)->delete();

        return response()->json(["Message" => "Berhasil Di Hapus Tolol"]);
    }
}
