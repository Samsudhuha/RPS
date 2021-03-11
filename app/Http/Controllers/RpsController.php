<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class RpsController extends Controller
{
    public function getRpsById()
    {
        return view('rps.rps');
    }

    public function cetakPDF()
    {
        $pdf = PDF::loadview('rps.cetakPDF');
        return $pdf->download('RPS.pdf');
    }
}
