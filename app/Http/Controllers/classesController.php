<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class classesController extends Controller
{
    //
    public function showClasses(){
        return view('classes.index');
    }
}
