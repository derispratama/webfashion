<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function index(){
        return view('login.login');
    }

    public function register(){
        return view('login.register');
    }

    public function forgotpass(){
        return view('login.forgotpass');
    }

    public function checklogin(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
        ]);

        $check = DB::table('users')->where('email',$request->email)->get();

        if($check){
            if($request->password != Crypt::decryptString($check[0]->password)){
                return redirect('/login')->with('error', 'User tidak terdaftar');
            }else{
                $request->session()->put('id', $check[0]->id);
                $request->session()->put('name', $check[0]->name);
                $request->session()->put('email', $check[0]->email);

                return redirect('/')->with('success', 'User berhasil register');
            }

        }else{
            return redirect('/login')->with('error', 'User tidak terdaftar');
        }
    }

    public function user_register(Request $request)
    {

        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns',
            'password' => 'required',
            'cpassword' => 'required|required_with:password|same:password',
        ]);

        $checkreg = $this->checkRegistered($request->email);

        if($checkreg){
            $data = [
                'name' =>  $request->name,
                'email' =>  $request->email,
                'password' =>  Crypt::encryptString($request->password),
            ];

            $action = DB::table('users')->insertGetId($data);

            if ($action) {
                $request->session()->put('id', $action);
                $request->session()->put('name', $data['name']);
                $request->session()->put('email', $data['email']);

                return redirect('/')->with('success', 'User berhasil di daftarkan');
            } else {
                return redirect('/register')->with('error', 'User gagal di daftarkan');
            }
        }else{
            return redirect('/register')->with('error', 'User telah terdaftar');
        }

    }

    public function checkRegistered($email)
    {
        $check = DB::table('users')->where('email', $email)->get();

        if (isset($check[0]->username)) {
            return $check;
        } else {
            return false;
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');
    }
}
