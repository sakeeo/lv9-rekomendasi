<?php

namespace App\Http\Controllers;

use App\Permohonan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DasboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        

        $id = Auth::user()->id;
        $user = User::select('role')->where('id',$id)->get()->first();

        // dd($user->role);
        if( $user->role ==='admin'){
            $users = User::count();
            $widget = [
                'users'         => $users,
                'rekomendasi'   => Permohonan::count(),
                'hosting'       => 'Belum ada'
            ];
            return view('pages.dasboard.index', compact('widget'));
        }  else {
            $permohonan = Permohonan::count();
            $widget = [
            'permohonan' => $permohonan,
            ];
            return view('pages.dasboard.client', compact('widget'));
        }
  
       
            
    }


}
