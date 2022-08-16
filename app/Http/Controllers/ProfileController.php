<?php

namespace App\Http\Controllers;

use App\Instansi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit($id)
    {
        return view('pages.profile.edit', [
            'title' => 'Edit Profile',
            'user' => User::find($id),
            'instansis'=>Instansi::all(),
        ]);
    }

    public function update(Request $request){
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
        return redirect()->route('dasboard');
    }
}
