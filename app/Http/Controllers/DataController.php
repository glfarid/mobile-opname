<?php


namespace App\Http\Controllers;

use App\Pustaka;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataController extends Controller 
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pustaka::all();
        return view('data',compact('data'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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

      


        return redirect()->route('data.index')->with('flash_data','Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Pustaka::find($id);
        return view('data', compact('data'));
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
        
        return redirect()->route('data.index');




          
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

        return redirect()->route('data.index')->with('flash_data','Dihapus');
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





    
    public function cetakpdf($id)
    {
        $data['barcode'] = Pustaka::find($id);
        $customPaper = array(0,0,567.00,283.80);
        $pdf = PDF::loadview('data_pdf',$data)->setPaper($customPaper);
        return $pdf->download('barcode.pdf');
    }







}
