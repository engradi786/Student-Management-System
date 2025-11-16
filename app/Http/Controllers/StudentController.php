<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function dashboard(){
        return view('dashboard.index');
    }

    public function students(){
        return view('dashboard.index');
    }

}
