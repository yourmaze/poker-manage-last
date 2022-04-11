<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PDFController extends Controller
{
    public function generatePDF()
    {
        //dd($data['qrcode']);
        //return view('tournament.myPDF', $data);
        $pdf = PDF::loadView('resumeEn');
        $pdf->setOptions(['dpi' => 203]);
        return $pdf->download('itsolutionstuff.pdf');
    }
}
