<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TrackingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id = Auth::user()->id;
        $user = User::select('role')->where('id',$id)->get()->first();

        if($user->role == 'admin'){
            $data  = DB::table('tb_permohonan')
            ->Join('users','users.id','tb_permohonan.user_id')
            ->select('tb_permohonan.*','users.name','users.last_name','users.nip','users.instansi')
            ->get();
        } else {
            $data  = DB::table('tb_permohonan')
                ->Join('users','users.id','tb_permohonan.user_id')
                ->where('tb_permohonan.user_id',$id)
                ->select('tb_permohonan.*','users.name','users.last_name','users.nip','users.instansi')
                ->get();
        }

        return view('pages.tracking.list',[
                'title'=>'TRACKING',
                'data'=>$data,
            ]);

    }
}
