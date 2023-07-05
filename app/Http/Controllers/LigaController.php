<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class LigaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('liga')->get();
        return view('manajemen_produk.liga.index',[
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('manajemen_produk.liga.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:20',
            'gambar' => 'required|mimes:jpg,jpeg,png',
        ]);

        $data = [
            'nama' => $request->nama,
            'gambar' => $request->file('gambar')->store('liga'),
        ];

        $action = DB::table('liga')->insert($data);

        if ($action) {
            return redirect('/liga')->with('success', 'Liga berhasil ditambahkan');
        } else {
            return redirect('/liga/create')->with('error', 'Liga gagal ditambahkan');
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
        $data = DB::table('liga')->where('id',$id)->get()[0];
        return view('manajemen_produk.liga.form',[
            'data' => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:20',
        ]);

        $data = [
            'nama' => $request->nama
        ];

        if(isset($_FILES['gambar']['name']) && $_FILES['gambar']['name'] != ''){
            $data['gambar'] = $request->file('gambar')->store('liga');
        }

        $action = DB::table('liga')->where('id',$request->id)->update($data);

        if ($action) {
            return redirect('/liga')->with('success', 'Liga berhasil diubah');
        } else {
            return redirect('/liga/'.$request->id.'/edit')->with('error', 'Liga gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $action = DB::table('liga')->where('id',$id)->delete();
            if ($action) {
                echo json_encode(['msg' => 'Liga berhasil di hapus','status' => true]);
            } else {
                echo json_encode(['msg' => 'Liga gagal di hapus','status' => false]);
            }
        }catch (\Illuminate\Database\QueryException $ex){
            echo json_encode(['msg' => 'Liga sudah mempunyai relasi dengan produk','status' => false]);
        }
    }
}
