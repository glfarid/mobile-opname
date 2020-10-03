<?php

namespace App\Http\Controllers;

use App\Pustaka;
use Illuminate\Http\Request;


class ApiDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response 
     */

    

    public function index()
    {
        $data = Pustaka::all();

        return $data;
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
        // dd($request->all()); 

        $request->validate([
            'ID' => 'required|unique:pustaka|max:20',
            'judul' => 'required',
            'pengarang' => 'required',
            'subjek' => 'required',
            'penerbit' => 'required',
        ]);

        Pustaka::create([
            
            'ID' => $request->ID,
            'judul' => $request->judul,
            'pengarang' => $request->pengarang,
            'subjek' => $request->subjek,
            'penerbit' => $request->penerbit,

            
            
            ]);
            
            return response()->json('success');
      

        // return redirect()->route('data.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Pustaka::where("ID",$id)->first();
        if($data){
        return response()->json($data);
        }else{
            return response()->json(["status"=>"ID tidak ada"]);
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
        $data = Pustaka::find($id);
        return view('data', compact('data'));
        
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
        // $pustaka  = Pustaka::where('id',$id);
        
        // //dd($request->all());
        // // $pustaka->JUDUL = $request->judul;
        // // $pustaka->JUDUL = $request->judul;

    
        // $pustaka->update($request->except(['_token','_method']));

        
        $pustaka = Pustaka::find($id);
        
       
        
        $pustaka->update($request->all());
        
        return response()->json('success');




          
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Pustaka::find($id);
        $data->delete();

        return response()->json('success');
    }

   
   

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function ajaxRequestPost(Request $request)

    {

        
        $id = $request->id;

        $pustaka = Pustaka::find($id);
        // $pustaka = Pustaka::where('id',$id);
        return response()->json($pustaka);

        

    }
}
