<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Milon\Barcode\Facades\DNS2DFacade as DNS2D;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;

class QrController extends Controller
{
    public function index() {
        echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG('4', 'C39+',3,33) . '" alt="barcode"   />';
    }
}
