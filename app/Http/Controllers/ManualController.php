<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManualController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // return view('pages.manual.index',[
        //     'title'=>'MANUAL',
        //     ]);

        dd(Auth::user()->id);
            
    }
}
