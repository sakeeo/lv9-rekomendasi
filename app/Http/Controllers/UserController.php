<?php

namespace App\Http\Controllers;

use App\Instansi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id = Auth::user()->id;
        $user = User::select('role')->where('id',$id)->get()->first();

        if( $user->role =='client'){
            return redirect()->route('dasboard');
        } 
        return view('pages.user.list',[
            'title'=>'USERS',
            'users'=>User::all(),
            ]);
            
    }

    public function create (){
        return view('pages.user.create',[
            'title'=>'CREATE NEW USER',
            'instansis'=>Instansi::all(),
            ]);
    }

    public function store(Request $request){
            $input = $request->all();
            // dd($input);
            $user = New User;
            $user->name         = $input['name'];
            $user->last_name    = $input['last_name'];
            $user->instansi     = $input['instansi'];
            $user->password     = Hash::make($input['password']);
            $user->role         = $input['role'];
            $user->email        = $input['email'];
            $user->nip          = $input['nip'];
            $user->save();
            return redirect()->route('user')->with('message', 'User added successfully!');
    }

    public function edit($id)
    {
        return view('pages.user.edit', [
            'title' => 'Edit User',
            'user' => User::find($id),
            'instansis'=>Instansi::all(),
        ]);
    }

    public function update(Request $request)
    {
        $input = $request->all();
        $data = [
            'name'      => $input['name'],
            'last_name' => $input['last_name'],
            'instansi'  => $input['instansi'],
            'email'     => $input['email'],
            'password'  => Hash::make($input['password']),
            'role'      => $input['role'],
            'nip'       => $input['nip']
        ];
        User::where('id', $input['id'])
              ->update($data);
              return redirect()->route('user')->with('message', 'User update successfully!');

    }

    public function destroy($id)
    {
        User::where('id',$id)->delete();
        return redirect()->route('user')->with('message', 'User has been deleted!');
    }
  
}
