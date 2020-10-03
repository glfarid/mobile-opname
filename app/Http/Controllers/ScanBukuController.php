<?php

namespace App\Http\Controllers;

use App\data_scan;
use Illuminate\Http\Request;

class ScanBukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        

        $data = data_scan::all();

        // dd($data);

        return view('data_scan',compact('data'));

        
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


        $request->validate([
            'id' => 'required|unique:data_scan|max:50',
            'judul' => 'required',
            'pengarang' => 'required',
            'volume' => 'required',
            'subjek' => 'required',
            'penerbit' => 'required',
            'pages' => 'required',
        ]);
        
        data_scan::create([
            'id' => $request->id,
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'volume' => $request->volume,
            'subjek' => $request->subjek,
            'penerbit' => $request->penerbit,
            'pages' => $request->pages,
        ]);

        return redirect()->route('data_scan.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = data_scan::find($id);
        return view('lol',compact('data'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
        $data = data_scan::find($id);
        return view('data_scan',compact('data'));

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
        $data_scan = data_scan::find($id);
        $data_scan->update($request->all());
        return redirect()->route('data_scan.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = data_scan::find($id);
        $data->delete();

        return redirect()->route('data_scan.index');
    }


     /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function ajaxRequestPost(Request $request)

    {

        
        $id = $request->id;

        $data_scan = data_scan::find($id);
        // $pustaka = Pustaka::where('id',$id);
        return response()->json($data_scan);

        

    }  
}
