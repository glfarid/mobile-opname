<?php

use App\Pustaka;
use Barryvdh\DomPDF\PDF;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CetakController extends Controller
{
    public function cetakpdf($id)
    {
        $data = Pustaka::find($id);
 
        $pdf = PDF::loadview('data_pdf',compact('data'));
        return $pdf->stream();
    }
}
