<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SessionController extends Controller
{
    function index(){
        return view('session.index');
    }
    function login(Request $request){
        Session::flash('email', $request->email);
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'Email wajib diisi.',
            'password.required'=>'Password wajib diisi.'
        ]);

        $infologin =[
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($infologin)) {
            return redirect('/')->with('succes', 'Berhasil Login');
        } else {
            return redirect('login')->with('succes', 'Berhasil Login');
        }
    }

    function logout(){
        Auth::logout();
        return redirect('login')->with('succes', 'Berhasil Logout');
    }
    function register(){
        return view('session.register');
    }
    function create(Request $request){
        Session::flash('name', $request->name);
        Session::flash('email', $request->email);
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'
        ],[
            'name.required'=>'Nama wajib diisi.',
            'email.required'=>'Email wajib diisi.',
            'email.email'=>'Silakan masukan email yang benar',
            'email.unique'=>'Email sudah Digunakan',
            'password.required'=>'Password wajib diisi.',
            'password.min'=>'Password minimal 6 karakter.'
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];

        User::create($data);

        $infologin =[
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($infologin)) {
            return redirect('/');
        } else {
            return 'gagal';
        }
    }
}
