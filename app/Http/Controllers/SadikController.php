<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SadikController extends Controller
{
    public function showSadik(){
        return(view('sadik'));
    }
}
