<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('produk')->join('liga','liga.id','=','produk.id_liga')->select('produk.*','liga.gambar as gambar_liga')->get();
        return view('manajemen_produk.produk.index',[
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $liga = DB::table('liga')->get();
        return view('manajemen_produk.produk.form',[
            'liga' => $liga
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:100',
            'id_liga' => 'required|max:20',
            'stok' => 'required|max:20',
            'harga' => 'required|max:20',
            'gambar' => 'required|mimes:jpg,jpeg,png',
        ]);

        $data = [
            'nama' => $request->nama,
            'gambar' => $request->file('gambar')->store('produk'),
            'id_liga' => $request->id_liga,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ];

        $action = DB::table('produk')->insert($data);

        if ($action) {
            return redirect('/produk')->with('success', 'Produk berhasil ditambahkan');
        } else {
            return redirect('/produk/create')->with('error', 'Produk gagal ditambahkan');
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
        $data = DB::table('produk')->where('id',$id)->get()[0];
        $liga = DB::table('liga')->get();
        return view('manajemen_produk.produk.form',[
            'data' => $data,
            'liga' => $liga,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'nama' => 'required|max:100',
            'id_liga' => 'required|max:20',
            'stok' => 'required|max:20',
            'harga' => 'required|max:20',
        ]);

        $data = [
            'nama' => $request->nama,
            'id_liga' => $request->id_liga,
            'stok' => $request->stok,
            'harga' => $request->harga,
        ];

        if(isset($_FILES['gambar']['name']) && $_FILES['gambar']['name'] != ''){
            $data['gambar'] = $request->file('gambar')->store('produk');
        }

        $action = DB::table('produk')->where('id',$request->id)->update($data);

        if ($action) {
            return redirect('/produk')->with('success', 'Produk berhasil diubah');
        } else {
            return redirect('/produk/'.$request->id.'/edit')->with('error', 'Produk gagal diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $action = DB::table('produk')->where('id',$id)->delete();
            if ($action) {
                echo json_encode(['msg' => 'Produk berhasil di hapus','status' => true]);
            } else {
                echo json_encode(['msg' => 'Produk gagal di hapus','status' => false]);
            }
        }catch (\Illuminate\Database\QueryException $ex){
            echo json_encode(['msg' => 'Produk sudah mempunyai relasi dengan payment','status' => false]);
        }
    }
}
