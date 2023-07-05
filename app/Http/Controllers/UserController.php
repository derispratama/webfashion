<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('users')->where('email','!=','admin@gmail.com')->get();
        return view('manajemen_user.index',[
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manajemen_user.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
                return redirect('/users')->with('success', 'User berhasil di daftarkan');
            } else {
                return redirect('/users/create')->with('error', 'User gagal di daftarkan');
            }
        }else{
            return redirect('/users/create')->with('error', 'User telah terdaftar');
        }
    }

    public function checkRegistered($email)
    {
        $check = DB::table('users')->where('email', $email)->get();

        if (isset($check[0]->name)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = DB::table('users')->where('id',$id)->get()[0];
        return view('manajemen_user.form',[
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if($request->password != ''){
            $validate = $request->validate([
                'name' => 'required',
                'email' => 'required|email:rfc,dns',
                'password' => 'required',
                'cpassword' => 'required|required_with:password|same:password',
            ]);
        }else{
            $validate = $request->validate([
                'name' => 'required',
                'email' => 'required|email:rfc,dns',
            ]);
        }

            $data = [
                'name' =>  $request->name,
                'email' =>  $request->email,
            ];

            if($request->password != ''){
                $data['password'] = Crypt::encryptString($request->password);
            }

            $action = DB::table('users')->where('id',$id)->update($data);

            if ($action) {
                return redirect('/users')->with('success', 'User berhasil di daftarkan');
            } else {
                return redirect('/users/create')->with('error', 'User gagal di daftarkan');
            }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $action = DB::table('users')->where('id',$id)->delete();
            if ($action) {
                echo json_encode(['msg' => 'User berhasil di hapus','status' => true]);
            } else {
                echo json_encode(['msg' => 'User gagal di hapus','status' => false]);
            }
        }catch (\Illuminate\Database\QueryException $ex){
            echo json_encode(['msg' => 'User gagal dihapus','status' => false]);
        }
    }
}
