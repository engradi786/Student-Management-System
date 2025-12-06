<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClassManageController extends Controller
{
    public function classesmanage()
    {
        return view('classes.classesmanage');
    }
}
